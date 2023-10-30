<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyImageRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ImageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Image::query()->select(sprintf('%s.*', (new Image())->table))->orderBy('created_at', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'image_show';
                $editGate = 'image_edit';
                $deleteGate = 'image_delete';
                $crudRoutePart = 'images';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('document', function ($row) {
                if ($photo = $row->document) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->editColumn('type', function ($row) {
                return isset($row->type) ? Image::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('status', function ($row) {
                return isset($row->status) ? Image::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'document']);

            return $table->make(true);
        }

        return view('admin.images.index');
    }

    public function create()
    {
        abort_if(Gate::denies('image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.images.create');
    }

    public function store(StoreImageRequest $request)
    {

        DB::beginTransaction();

        try {

            $image = Image::create($request->all());

            if ($request->input('document', false)) {
                $image->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $image->id]);
            }

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollback();

            return redirect()->route('admin.images.create')->withInput($request->input())->withErrors(['error' => ['Something Error !']]);

        }
        
        return redirect()->route('admin.images.index');
    }

    public function edit(Image $image)
    {
        abort_if(Gate::denies('image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.images.edit', compact('image'));
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

        return redirect()->route('admin.images.index');
    }

    public function show(Image $image)
    {
        abort_if(Gate::denies('image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.images.show', compact('image'));
    }

    public function destroy(Image $image)
    {
        abort_if(Gate::denies('image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image->delete();

        return back();
    }

    public function massDestroy(MassDestroyImageRequest $request)
    {
        Image::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('image_create') && Gate::denies('image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Image();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
