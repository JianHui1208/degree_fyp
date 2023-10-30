<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserLoginLogRequest;
use App\Http\Requests\StoreUserLoginLogRequest;
use App\Http\Requests\UpdateUserLoginLogRequest;
use App\Models\User;
use App\Models\UserLoginLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserLoginLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_login_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserLoginLog::with(['user'])->select(sprintf('%s.*', (new UserLoginLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_login_log_show';
                $editGate = 'user_login_log_edit';
                $deleteGate = 'user_login_log_delete';
                $crudRoutePart = 'user-login-logs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('uid', function ($row) {
                return $row->user ? $row->user->uid : '';
            });
            
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('login_ip', function ($row) {
                return $row->login_ip ? $row->login_ip : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.userLoginLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_login_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userLoginLogs.create', compact('users'));
    }

    public function store(StoreUserLoginLogRequest $request)
    {
        $userLoginLog = UserLoginLog::create($request->all());

        return redirect()->route('admin.user-login-logs.index');
    }

    public function edit(UserLoginLog $userLoginLog)
    {
        abort_if(Gate::denies('user_login_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userLoginLog->load('user');

        return view('admin.userLoginLogs.edit', compact('users', 'userLoginLog'));
    }

    public function update(UpdateUserLoginLogRequest $request, UserLoginLog $userLoginLog)
    {
        $userLoginLog->update($request->all());

        return redirect()->route('admin.user-login-logs.index');
    }

    public function show(UserLoginLog $userLoginLog)
    {
        abort_if(Gate::denies('user_login_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLoginLog->load('user');

        return view('admin.userLoginLogs.show', compact('userLoginLog'));
    }

    public function destroy(UserLoginLog $userLoginLog)
    {
        abort_if(Gate::denies('user_login_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLoginLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserLoginLogRequest $request)
    {
        UserLoginLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
