<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\ApiRequests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\Admin\ImageResource;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

/**
 * @title Image Control
 */
class ImageApiController extends BaseController
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ImageResource(Image::all());
    }

    public function StoreImage(StoreImageRequest $request)
    {
        DB::beginTransaction();

        try {
            if (!is_numeric($request->type)) {
                return parent::error('Image Type Must be a number.');
            }

            $count_array = count(Image::TYPE_SELECT);
            if ($request->type >= $count_array) {
                return parent::error('Image haven include in system.');
            }

            $image = Image::create($request->all());
            $image->addMedia($request->file('document'))->toMediaCollection('document');

            DB::commit();
            return parent::resFormat(1999, null, ['document_id' => $image->id]);
        } catch (\Error $e) {
            DB::rollback();
            Log::channel("api")->error("StoreImage Function Error(Users/ImageApiController)", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::resFormat(-1);
        }
    }

    public function show(Image $image)
    {
        abort_if(Gate::denies('image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ImageResource($image);
    }

    public function update(UpdateImageRequest $request, Image $image)
    {
        $image->update($request->all());

        if ($request->input('document', false)) {
            if (!$image->document || $request->input('document') !== $image->document->file_name) {
                if ($image->document) {
                    $image->document->delete();
                }
                $image->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($image->document) {
            $image->document->delete();
        }

        return (new ImageResource($image))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Image $image)
    {
        abort_if(Gate::denies('image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
