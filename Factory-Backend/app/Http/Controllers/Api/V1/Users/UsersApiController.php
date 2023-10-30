<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\BaseController;
use App\Exceptions\ClientApiValidationException;
use App\Http\Requests\ApiRequests\UserRegisterRequest;
use App\Http\Requests\ApiRequests\UserLoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class UsersApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $request['uid'] = $this->generateUID('users');
            $request['is_active'] = 1;
            $request['decrypt_key'] = $this->generateKey();
            $request['encrypt_key'] = $this->generateKey();
            $request['type'] = 2;
            $user = User::create($request->all());
            $user->roles()->sync(2);

            DB::commit();
            return parent::success(700);
        } catch (Exception $e) {
            DB::rollback();
            Log::channel("api")->error("UserRegister 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $user = User::with(['company'])->where('username', $request['input'])->orWhere('email', $request['input'])->first();

            if (empty($user)) {
                return parent::resFormat(701);
            }

            $loginData = [];
            $loginData['email'] = $user->email;
            $loginData['password'] = $request->password;

            if (!auth()->attempt($loginData)) {
                return parent::resFormat(703);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            $user->company_name = $user->company->name ?? null;
            $user->company_email = $user->company->email ?? null;
            $user->company_subscription = $user->company->subscription ?? null;
            $user->company_status = $user->company->status ?? null;
            $user->makeHidden(['company']);

            return parent::resFormat(702, null, [
                'user' => $user,
                'token' => $accessToken
            ]);
        } catch (Exception $e) {
            Log::channel("api")->error("UserLogin 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }
}
