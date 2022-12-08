<?php

namespace App\Models;

use Core\Models\AppLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use UuidModel, SoftDeletes;

    protected $guard_name = 'api';
    protected $fillable = [
        'id',
        'full_name',
        'email',
        'mobile',
        'username',
        'avatar',
        'type',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return config('app.url') . '/files/user/profile/' . $this->avatar;
        } else {
            return config('app.url') . '/img/avatar.jpg';
        }
    }

    public function getRoleNameAttribute(): string
    {
        return $this->roles[0]->fa_name;
    }

    /*
 * Order Action ids
 * used for create log
 * its depend on : create_app_actions in appUp.php file
 */
    public static $user_action_codes = [
        'login_action_code' => "login",
        'logout_action_code' => "logout",
    ];

    /*
     * ACL for Vuejs
     * combine ideas :
     * https://github.com/ahmedsaoud31/laravel-permission-to-vuejs
     * https://mmccaff.github.io/2018/11/03/laravel-permissions-in-vue-components/
     */
    public function jsPermissions()
    {
        return json_encode($this->getRolesPermissions());
    }

    public function objPermissions()
    {
        return (object)$this->getRolesPermissions();
    }

    private function getRolesPermissions()
    {
        return [
            'roles' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()->pluck('name'),
        ];
    }

    public function addRoleAndItsPermissionsToUser($role_id)
    {

        $role = Role::where('id', $role_id)->where('guard_name', 'api')->first();

        if ($role) {
            $this->addRole($role->id);
        }
    }

    public function addRole($role_id)
    {
        DB::table('model_has_roles')->insert([
            'role_id' => $role_id,
            'model_type' => 'App\Models\User',
            'model_id' => $this->id
        ]);

        $role_permission_ids = DB::table('role_has_permissions')
            ->where('role_id', '=', $role_id)
            ->pluck('permission_id')->toArray();
        if ($role_permission_ids) {
            foreach ($role_permission_ids as $permission_id) {
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permission_id,
                    'model_type' => 'App\Models\User',
                    'model_id' => $this->id
                ]);
            }
        }
    }

    public function removeRole($role_id)
    {
        DB::table('model_has_roles')
            ->where('role_id', $role_id)
            ->where('model_type', 'App\Models\User')
            ->where('model_id', $this->id)
            ->delete();

        $role_permission_ids = DB::table('role_has_permissions')
            ->where('role_id', '=', $role_id)
            ->pluck('permission_id')->toArray();
        if ($role_permission_ids) {
            foreach ($role_permission_ids as $permission_id) {
                DB::table('model_has_permissions')
                    ->where('permission_id', $permission_id)
                    ->where('model_type', 'App\Models\User')
                    ->where('model_id', $this->id)
                    ->delete();
            }
        }
    }

    public function removePermission($permission_id)
    {
        DB::table('model_has_permissions')
            ->where('model_id', $this->id)
            ->where('model_type', User::class)
            ->where('permission_id', $permission_id)
            ->delete();
    }

    public function hasUserPermissionById()
    {

    }

    public function hasUserPermissionByName($permission_name)
    {
        $permission = Permission::where('name', $permission_name)->first();
        $has_permission = DB::table('model_has_permissions')
            ->where('model_id', $this->id)
            ->where('model_type', User::class)
            ->where('permission_id', $permission->id)->first();
        if ($has_permission) {
            return true;
        } else {
            return false;
        }

    }

    public function hasUserRoleByName($permission_name)
    {
        $role = Role::where('name', $permission_name)->first();
        $has_permission = DB::table('model_has_roles')
            ->where('model_id', $this->id)
            ->where('model_type', User::class)
            ->where('role_id', $role->id)->first();
        if ($has_permission) {
            return true;
        } else {
            return false;
        }

    }

    function getUserPermissionCollections(): \Illuminate\Support\Collection
    {
        $permission_ids = DB::table('model_has_permissions')
            ->where('model_id', $this->id)
            ->where('model_type', User::class)
            ->pluck('permission_id');
        return Permission::whereIn('id', $permission_ids)->get();

    }

    function get_allowed_action_log_ids(): array
    {
        $allowed_action_log_ids = [];
        $allowed_action_log_payload = $this->getUserPermissionCollections()
            ->where('parent_id', 5)
            ->where('payload', '!=', null)->pluck('payload');
        foreach ($allowed_action_log_payload as $payload) {
            Log::info($payload);
            $payload_array = json_decode($payload, true);
            if (array_key_exists('action_code', $payload_array)) {
                $allowed_action_log_ids[] = $payload_array['action_code'];
            }
        }
        return $allowed_action_log_ids;
    }

    function get_allowed_order_status_ids(): array
    {
        $allowed_order_status_ids = [];
        $allowed_status_payloads = $this->getUserPermissionCollections()->where('parent_id', 3)->where('payload', '!=', null)->pluck('payload');
        foreach ($allowed_status_payloads as $payload) {
            $payload_array = json_decode($payload, true);
            if (array_key_exists('status_id', $payload_array)) {
                $allowed_order_status_ids[] = $payload_array['status_id'];
            }
        }
        return $allowed_order_status_ids;
    }

    public static function submit_login_log()
    {
        $app_log = new AppLog();
        $app_log->user_id = Auth::id();
        $app_log->model = User::class;
        $app_log->action_code = User::$user_action_codes['login_action_code'];
        $app_log->save();
    }

    public static function submit_logout_log()
    {
        $app_log = new AppLog();
        $app_log->user_id = Auth::id();
        $app_log->model = User::class;
        $app_log->action_code = User::$user_action_codes['logout_action_code'];
        $app_log->save();
    }

    public static function generate_log_message($user, $action): array
    {

        $action_name = $action->fa_name;
        $by_pre = ' توسط ';
        $by_user_full_name = $user->full_name . ' ( ' . $user->role_name . ' )';

        return [
            'global' => '<span class="badge badge-soft-primary">' . $action_name . '</span> '.$by_pre . ' <a href="user/'.$user->id.'">' . $by_user_full_name . '</a> ',
            'special' => '-' ,
        ];
    }


}
