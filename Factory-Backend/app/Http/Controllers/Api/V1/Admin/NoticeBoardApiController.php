<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNoticeBoardRequest;
use App\Http\Requests\UpdateNoticeBoardRequest;
use App\Http\Resources\Admin\NoticeBoardResource;
use App\Models\NoticeBoard;
use Illuminate\Contracts\Auth\Access\Gate;
use Symfony\Component\HttpFoundation\Response;

class NoticeBoardApiController extends BaseController
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('notice_board_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoticeBoardResource(NoticeBoard::with(['post_to'])->get());
    }

    public function store(StoreNoticeBoardRequest $request)
    {
        $noticeBoard = NoticeBoard::create($request->all());

        if ($request->input('image', false)) {
            $noticeBoard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new NoticeBoardResource($noticeBoard))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NoticeBoard $noticeBoard)
    {
        abort_if(Gate::denies('notice_board_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoticeBoardResource($noticeBoard->load(['post_to']));
    }

    public function update(UpdateNoticeBoardRequest $request, NoticeBoard $noticeBoard)
    {
        $noticeBoard->update($request->all());

        if ($request->input('image', false)) {
            if (!$noticeBoard->image || $request->input('image') !== $noticeBoard->image->file_name) {
                if ($noticeBoard->image) {
                    $noticeBoard->image->delete();
                }
                $noticeBoard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($noticeBoard->image) {
            $noticeBoard->image->delete();
        }

        return (new NoticeBoardResource($noticeBoard))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NoticeBoard $noticeBoard)
    {
        abort_if(Gate::denies('notice_board_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noticeBoard->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_banner($type)
    {
        $type = strtoupper($type);
        $key = array_search($type, NoticeBoard::TYPE_SELECT);

        $banners = NoticeBoard::with(['image'])->where([
            ['type', '=', $key],
            ['status', '=', 2]
        ])->get();

        foreach ($banners as $banner) {
            $banner->type = NoticeBoard::TYPE_SELECT[$banner->type];
            $banner->status = NoticeBoard::STATUS_SELECT[$banner->status];
            $banner->image_url = str_replace("http://localhost:8000", "", $banner->image->document->url);
        }

        $banners->makeHidden(['media', 'image', 'image_id', 'created_at', 'updated_at', 'deleted_at', 'post_at']);

        return parent::resFormat(1001, null, ['banners' => $banners]);
    }
}
