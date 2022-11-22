<?php

namespace Core\Models;

use App\Models\User;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppLog extends AppModel
{
    use HasFactory;

    public function getMessageAttribute()
    {
        $user = User::query()->select(['id', 'full_name'])->where('id', $this->user_id)->first();

//        if ($this->model===Order::class){
//            $order = Order::query()->select(['id', 'tracking_code'])->where('id', $this->model_id)->first();
//            return Order::generate_log_message($user, $order, $this->action, $this->data);
//        }
        if($this->model === User::class){
            return User::generate_log_message($user,$this->action);
        }

        return null;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select(['id', 'full_name']);
    }

//    public function action()
//    {
//        return $this->hasOne(AppAction::class, 'code', 'action_code');
//    }

}
