<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Core\Models\PermissionParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function me()
    {
        return auth('api')->user();
    }

    public function index()
    {

        $users = User::with('roles')->where('type', 'staff')->get();
        $users = $users->filter(function ($user) {
            if ($user->id == auth()->user()->id) {
                return false;
            }
            return true;
        })->values();

        return response($users, 200);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'full_name' => 'required|string|min:2',
            'gender' => 'required',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'mobile' => 'required|unique:users|regex:/^0[0-9]{9,10}$/',
            'password' => 'required|confirmed|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/'], [],
            [
                'full_name' => __('app.name'),
                'role_id' => __('app.role_id'),
                'email' => __('app.email'),
                'mobile' => __('app.mobile'),
                'gender' => __('app.gender'),
                'password' => __('app.password')
            ]);

        $user = new User();
        $user['id'] = Str::uuid();
        $user->full_name = $request->full_name;
        $user->note = $request->note;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        $image_url = upload_base64($request, "profile_image", 'user/profile', time()); // return name of image
        $user->avatar = $image_url;
        $user->password = bcrypt($request->password);
        $user->save();

        // set role to user
        $user->addRole($request->role_id);

        return response(['msg' => trans('app.done'), 'object' => $user], 200);
    }

    public function update(Request $request, $id)
    {

        $user = User::with('roles')->findOrFail($id);
        $this->validate($request, [
            'full_name' => 'required|string|min:2',
            'role_id' => 'required',
            'gender' => 'required',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'username' => 'required|string|unique:users,username,' . $id,
            'mobile' => 'required|regex:/^0[0-9]{9,10}$/|unique:users,mobile,' . $id,
            'password' => 'sometimes|nullable|confirmed|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/'
        ], [], [

            'full_name' => __('app.name'),
            'role_id' => __('app.role_id'),
            'username' => __('app.username'),
            'email' => __('app.email'),
            'mobile' => __('app.mobile'),
            'password' => __('app.password'),
            'password_confirmation' => __('app.password_confirmation'),
        ]);

        $requested_role = Role::find($request->input('role_id'));
        if (!$user->hasUserRoleByName($requested_role->name)) {
            $user->removeRole($user->role_id);
            $user->addRole($request->input('role_id'));
        }
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->note = $request->note;
        $user->gender = $request->gender;
        if ($request->input("profile_image") !== null && $request->input("avatar") == null) {
            remove_file($user->avatar, 'files/user/profile');
            $image_url = upload_base64($request, "profile_image", 'user/profile', time()); // return name of image
            $user->avatar = $image_url;
        }
        $user->save();

        $permissions_array = $request->input('permissions_for_edit');
        foreach ($permissions_array as $permission_parent) {
            foreach ($permission_parent['children'] as $permission) {
                $permission_id = $permission['id'];
                $permission_name = $permission['name'];
                $check_exist_before = $user->hasUserPermissionByName($permission_name);
                if ($permission['is_selected']) {
                    if (!$check_exist_before) {
                        $user->givePermissionTo($permission_name);
                    }
                } else {
                    if ($check_exist_before) {
                        $user->removePermission($permission_id);
                    }
                }

            }
        }

        return response(['msg' => trans('app.done'), 'object' => $user], 200);
    }

    public function read($id)
    {

        $user = User::with('roles')->where('id', ($id))->first();

        $permission_parents = PermissionParent::query()->with('children')->get();

        $user_permissions = $user->permissions;

        foreach ($permission_parents as $key => $parent) {
            $permissions = $parent->children;
            foreach ($permissions as $key => $permission) {
                $permission["is_selected"] = false;
                foreach ($user_permissions as $user_permission) {
                    if ($user_permission['id'] == $permission['id']) {
                        $permission["is_selected"] = true;
                    }
                }
            }
        }

        $user['permissions_for_edit'] = $permission_parents;

        return response($user, 200);

    }

    public function removeProfileImage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            remove_file($user->avatar, 'files/user/profile');
            $user->avatar = null;
            $user->save();
            return response(['msg' => trans('app.done')], 200);
        } else {
            return response(['msg' => trans('app.failed')], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(['msg' => trans('app.done')], 200);
    }

}
