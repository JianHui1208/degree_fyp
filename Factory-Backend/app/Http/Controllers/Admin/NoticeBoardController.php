<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNoticeBoardRequest;
use App\Http\Requests\StoreNoticeBoardRequest;
use App\Http\Requests\UpdateNoticeBoardRequest;
use App\Models\NoticeBoard;
use App\Models\Image;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NoticeBoardController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('notice_board_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NoticeBoard::query()->select(sprintf('%s.*', (new NoticeBoard())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'notice_board_show';
                $editGate = 'notice_board_edit';
                $deleteGate = 'notice_board_delete';
                $crudRoutePart = 'notice-boards';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->editColumn('type', function ($row) {
                return NoticeBoard::TYPE_SELECT[$row->type] ? NoticeBoard::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('status', function ($row) {
                return NoticeBoard::STATUS_SELECT[$row->status] ? NoticeBoard::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.noticeBoards.index');
    }

    public function create()
    {
        abort_if(Gate::denies('notice_board_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $images = Image::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.noticeBoards.create', compact('images'));
    }

    public function store(StoreNoticeBoardRequest $request)
    {
        NoticeBoard::create($request->all());
        return redirect()->route('admin.notice-boards.index');
    }

    public function edit(NoticeBoard $noticeBoard)
    {
        abort_if(Gate::denies('notice_board_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $images = Image::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $noticeBoard->load('image');

        return view('admin.noticeBoards.edit', compact('images', 'noticeBoard'));
    }

    public function update(UpdateNoticeBoardRequest $request, NoticeBoard $noticeBoard)
    {
        $noticeBoard->update($request->all());
        return redirect()->route('admin.notice-boards.index');
    }

    public function show(NoticeBoard $noticeBoard)
    {
        abort_if(Gate::denies('notice_board_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noticeBoard->load('image');

        return view('admin.noticeBoards.show', compact('noticeBoard'));
    }

    public function destroy(NoticeBoard $noticeBoard)
    {
        abort_if(Gate::denies('notice_board_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noticeBoard->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoticeBoardRequest $request)
    {
        NoticeBoard::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('notice_board_create') && Gate::denies('notice_board_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NoticeBoard();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
