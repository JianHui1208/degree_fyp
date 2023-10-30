<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLaravelPassportRequest;
use App\Http\Requests\StoreLaravelPassportRequest;
use App\Http\Requests\UpdateLaravelPassportRequest;
use Gate;
use App\Models\LaravelPassport;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LaravelPassportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('laravel_passport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LaravelPassport::query()->select(sprintf('%s.*', (new LaravelPassport())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $viewGate = '';
                $editGate = '';
                $deleteGate = '';
                $crudRoutePart = '';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('user_id', function ($row) {
                return $row->user_id ? $row->user_id : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('secret', function ($row) {
                return $row->secret ? $row->secret : '';
            });

            $table->editColumn('provider', function ($row) {
                return $row->provider ? $row->provider : '';
            });

            $table->editColumn('redirect', function ($row) {
                return $row->redirect ? $row->redirect : '';
            });

            $table->editColumn('personal_access_client', function ($row) {
                return isset($row->personal_access_client) ? $row->personal_access_client : '';
            });

            $table->editColumn('password_client', function ($row) {
                return isset($row->password_client) ? $row->password_client : '';
            });

            $table->editColumn('revoked', function ($row) {
                return isset($row->revoked) ? $row->revoked : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.laravelPassports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('laravel_passport_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.laravelPassports.create');
    }

    public function store(StoreLaravelPassportRequest $request)
    {
        $laravelPassport = LaravelPassport::create($request->all());

        return redirect()->route('admin.laravel-passports.index');
    }

    public function edit(LaravelPassport $laravelPassport)
    {
        abort_if(Gate::denies('laravel_passport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.laravelPassports.edit', compact('laravelPassport'));
    }

    public function update(UpdateLaravelPassportRequest $request, LaravelPassport $laravelPassport)
    {
        $laravelPassport->update($request->all());

        return redirect()->route('admin.laravel-passports.index');
    }

    public function show(LaravelPassport $laravelPassport)
    {
        abort_if(Gate::denies('laravel_passport_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.laravelPassports.show', compact('laravelPassport'));
    }

    public function destroy(LaravelPassport $laravelPassport)
    {
        abort_if(Gate::denies('laravel_passport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laravelPassport->delete();

        return back();
    }

    public function massDestroy(MassDestroyLaravelPassportRequest $request)
    {
        LaravelPassport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
