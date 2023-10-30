<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGlobalSettingRequest;
use App\Http\Requests\StoreGlobalSettingRequest;
use App\Http\Requests\UpdateGlobalSettingRequest;
use Illuminate\Support\Facades\DB;
use App\Models\GlobalSetting;
use Exception;
use Gate;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;


class GlobalSettingsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        $GlobalSetting = GlobalSetting::all();
        $type = GlobalSetting::all()->unique('type');

        return view('admin.globalSettings.index', compact('GlobalSetting', 'type'));
    }

    public function create()
    {
        abort_if(Gate::denies('global_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.globalSettings.create');
    }

    public function store(StoreGlobalSettingRequest $request)
    {
        $globalSetting = GlobalSetting::create($request->all());

        if ($request->input('photo', false)) {
            $globalSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $globalSetting->id]);
        }

        return redirect()->route('admin.global-settings.index');
    }

    public function edit(GlobalSetting $globalSetting)
    {
        abort_if(Gate::denies('global_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.globalSettings.edit', compact('globalSetting'));
    }

    public function update(UpdateGlobalSettingRequest $request, GlobalSetting $globalSetting)
    {
        $globalSetting->update($request->all());

        if ($request->input('photo', false)) {
            if (!$globalSetting->photo || $request->input('photo') !== $globalSetting->photo->file_name) {
                if ($globalSetting->photo) {
                    $globalSetting->photo->delete();
                }
                $globalSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($globalSetting->photo) {
            $globalSetting->photo->delete();
        }

        return redirect()->route('admin.global-settings.index');
    }

    public function show(GlobalSetting $globalSetting)
    {
        abort_if(Gate::denies('global_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.globalSettings.show', compact('globalSetting'));
    }

    public function destroy(GlobalSetting $globalSetting)
    {
        abort_if(Gate::denies('global_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $globalSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyGlobalSettingRequest $request)
    {
        GlobalSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('global_setting_create') && Gate::denies('global_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new GlobalSetting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function custom_edit(Request $request)
    {
        DB::beginTransaction();
        try {

            foreach ($request->all() as $key => $item) {

                $SystemSetting = GlobalSetting::find($key);

                if (empty($SystemSetting)) {
                    continue;
                }

                $SystemSetting->update([
                    'value' => $item
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();

            return [
                'status' => -1,
                'ret_msg' => 'Something Error !!'
            ];
        }

        return [
            'status' => 0,
            'ret_msg' => trans('global.update_success')
        ];
    }
}
