<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * @title UsersApiController
 */
class UsersApiController extends BaseController
{
    /**
     * @title Get All Users
     * @description Authentication Token
     * @author 开发者
     * @url /api/admin/users
     * @method GET
     *
     * @return Data:users
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updatePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if (!Hash::check($request->old_password, $user->password)) {
                return parent::resFormat(706); // Return an error if old password is incorrect
            }

            $user->update(['password' => Hash::make($request->new_password)]);
            DB::commit();
            return parent::resFormat(705);
        } catch (Exception $e) {
            DB::rollback();
            Log::channel("api")->error("UpdatePassword 出错", ["request" => $request->all(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }
}
