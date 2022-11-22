<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Models\PermissionParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $roles = Role::all();
        return response($roles, 200);
    }

    public function read($id)
    {

        $role = Role::find($id);
        $permission_of_role_ids = DB::table('role_has_permissions')->where('role_id', $role->id)->pluck('permission_id')->toArray();
        $permission_parents = PermissionParent::query()->with('children')->get();
        foreach ($permission_parents as $key => $parent) {
            $permissions = $parent->children;
            foreach ($permissions as $key => $permission) {
                if (in_array($permission->id, $permission_of_role_ids)) {
                    $permission["is_selected"] = true;
                } else {
                    $permission["is_selected"] = false;
                }
            }
        }

        return response(['role' => $role, 'permissions' => $permission_parents], 200);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'fa_name' => 'required|string|min:4|unique:roles,fa_name',
            'name' => 'required|string|min:4|unique:roles,name',
            'permissions' => 'required',
        ], [], ['fa_name' => "نام فارسی", 'name' => 'نام انگلیسی']);
        $des = $request->input('des');
        $role = Role::create([
            'name' => $request->input('name'),
            'fa_name' => $request->input('fa_name'),
            'des' => $des
        ]);
        $permissions_array = $request->input('permissions');
        foreach ($permissions_array as $permission_parent) {
            foreach ($permission_parent['children'] as $permission) {
                if ($permission['is_selected']) {
                    $permission_id = $permission['id'];
                    DB::insert('insert into role_has_permissions (permission_id, role_id) values (' . $permission_id . ',' . $role->id . ')');
                }

            }
        }
        return response(['msg' => trans('app.done'), 'object' => []], 200);
    }

    public function update(Request $request, $id)
    {
        $role = Role::query()->find($id);
        $this->validate($request, [
            'fa_name' => 'required|string|min:4|unique:roles,fa_name,' . $id,
            'name' => 'required|string|min:4|unique:roles,name,' . $id,
            'permissions' => 'required',
        ], [], ['fa_name' => "نام فارسی", 'name' => 'نام انگلیسی']);

        $des = $request->input('des');
        $fa_name = $request->input('fa_name');
        $en_name = $request->input('name');

        $role->fa_name = $fa_name;
        $role->name = $en_name;
        $role->des = $des;
        $role->save();


        $permissions_array = $request->input('permissions');

        foreach ($permissions_array as $permission_parent) {
            foreach ($permission_parent['children'] as $permission) {
                $permission_id = $permission['id'];
                $check_exist_before = DB::table('role_has_permissions')->where('role_id', $role->id)->where('permission_id', $permission_id)->first();
                if ($permission['is_selected']) {
                    if (!$check_exist_before) {
                        DB::insert('insert into role_has_permissions (permission_id, role_id) values (' . $permission_id . ',' . $role->id . ')');
                    }

                } else {
                    if ($check_exist_before) {
                        DB::table('role_has_permissions')->where('role_id', $role->id)->where('permission_id', $permission_id)->delete();
                    }
                }

            }
        }
        return response(['msg' => trans('app.done'), 'object' => []], 200);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
        $role->delete();
        return response(['msg' => trans('app.done')], 200);
    }

    public function get_permissions(Request $request)
    {
        $permission_parents = PermissionParent::query()->with('children')->get();
        foreach ($permission_parents as $key => $parent) {
            $permissions = $parent->children;
            foreach ($permissions as $key => $permission) {
                $permission["is_selected"] = false;
            }
        }
        return response($permission_parents, 200);

    }

}
