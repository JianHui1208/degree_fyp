<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserLoginLogRequest;
use App\Http\Requests\UpdateUserLoginLogRequest;
use App\Http\Resources\Admin\UserLoginLogResource;
use App\Models\UserLoginLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLoginLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_login_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserLoginLogResource(UserLoginLog::with(['user'])->get());
    }

    public function store(StoreUserLoginLogRequest $request)
    {
        $userLoginLog = UserLoginLog::create($request->all());

        return (new UserLoginLogResource($userLoginLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserLoginLog $userLoginLog)
    {
        abort_if(Gate::denies('user_login_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserLoginLogResource($userLoginLog->load(['user']));
    }

    public function update(UpdateUserLoginLogRequest $request, UserLoginLog $userLoginLog)
    {
        $userLoginLog->update($request->all());

        return (new UserLoginLogResource($userLoginLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserLoginLog $userLoginLog)
    {
        abort_if(Gate::denies('user_login_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLoginLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
