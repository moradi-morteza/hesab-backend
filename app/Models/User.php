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

    public function generateAndSendVerificationCode(){
            $code = rand(10000,99999);
            $this->verification_code = $code;
            $this->save();
            sendSmsToMobile($this->mobile,$code);
    }












}
