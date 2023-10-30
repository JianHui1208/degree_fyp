<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Role;
use App\Models\SecretKey;
use App\Models\User;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles'])->select(sprintf('%s.*', (new User())->table))->orderBy('created_at', 'DESC');

            if (isset($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (isset($request->email)) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if (isset($request->type)) {
                if ($request->type != 'All') {
                    $query->where('type', $request->type);
                }
            }

            if (isset($request->is_active)) {
                if ($request->is_active != 'All') {
                    $query->where('is_active', $request->is_active);
                }
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $activeGate = 'user_edit';
                $inactiveGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'activeGate',
                    'inactiveGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('uid', function ($row) {
                return $row->uid ? $row->uid : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('type', function ($row) {
                return User::TYPE_SELECT[$row->type] ? User::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('is_active', function ($row) {
                return User::STATUS_SELECT[$row->is_active] ? User::STATUS_SELECT[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'roles', 'two_factor', 'is_active']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $countries = Country::select('id', 'name', 'mobile_code')->where([
            'is_active' => 1
        ])->get();

        return view('admin.users.create', compact('roles', 'countries'));
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->type == '2') {

                if (empty($request->mobile_code)) {
                    return redirect()->route('admin.users.create')->withInput($request->input())->withErrors(['error' => ['Mobile code must be required !']]);
                }

                if (empty($request->mobile_number)) {
                    return redirect()->route('admin.users.create')->withInput($request->input())->withErrors(['error' => ['Mobile number must be required !']]);
                }

                $customer = Customer::where([
                    'phone_country_id'  => $request->mobile_code,
                    'phone_number' => $request->mobile_number
                ])->first();

                if (!empty($customer)) {
                    return response()->json(['status' => FALSE, 'MSG' => 'Phone Number Already Exists !']);
                }
            }

            if ($request->transaction_password != null && $request->transaction_password != '') {
                $request['transaction_password'] = Hash::make($request->transaction_password);
            } else {
                $request['transaction_password'] = null;
            }

            do {
                $request['uid'] = uniqid('UID');

                $uid_data = User::where([
                    'uid' => $request['uid'],
                ])->first();
            } while (!empty($uid_data));

            do {
                $request['invitation_code'] = uniqid('INV');

                $invitation_code_data = User::where([
                    'invitation_code' => $request['invitation_code'],
                ])->first();
            } while (!empty($invitation_code_data));

            $request['register_time'] = now();

            $user = User::create($request->all());
            $user->roles()->sync($request->input('roles', []));

            if ($user->type == '2') {
                // generate the user's secret key
                $secret_key = SecretKey::generateSecretKey(32, $user->id);
                $user->secret_key = $secret_key;
                $user->save();
                $user->refresh();

                // create 'pending' customer information
                Customer::create([
                    'user_id'               => $user->id,
                    'phone_country_id'      => $request->mobile_code,
                    'phone_number'          => $request->mobile_number,
                    'status'                => 0
                ]);
            }

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->route('admin.users.create')->withInput($request->input())->withErrors(['error' => ['Something Error !']]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        DB::beginTransaction();
        try {
            if ($request->password != null && $request->password != '') {
                $request['password'] = Hash::make($request->password);
            } else {
                $request['password'] = $user->password;
            }

            if ($request->transaction_password != null && $request->transaction_password != '') {
                $request['transaction_password'] = Hash::make($request->transaction_password);
            } else {
                $request['transaction_password'] = $user->transaction_password;
            }

            $find_same_data = User::where([
                'email' => $request->email,
                ['id', '<>', $user->id]
            ])->count();

            if ($find_same_data > 0) {
                return redirect()->route('admin.users.edit', $user->id)->withInput($request->input())->withErrors(['error' => ['Email already exists !']]);
            }

            $user->update($request->all());
            $user->roles()->sync($request->input('roles', []));

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->route('admin.users.edit', $user->id)->withInput($request->input())->withErrors(['error' => ['Something Error !']]);
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load(['roles', 'invited_by', 'invited']);

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', $request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function active(Request $request)
    {
        User::where('id', $request->id)->update(['is_active' => 1]);
        return redirect()->route('admin.users.index');
    }

    public function inactive(Request $request)
    {
        User::where('id', $request->id)->update(['is_active' => 0]);
        return redirect()->route('admin.users.index');
    }
}
