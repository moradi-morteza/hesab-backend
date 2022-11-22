<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Core\Models\PermissionParent;
use Core\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Request $request)
    {

        $settings = Setting::all();
        return response($settings);

    }

    public function update(Request $request)
    {

        $setting_array = $request->input('settings');

        foreach ($setting_array as $item){
            $setting = Setting::query()->where('id',$item['id'])->first();
            $setting->value = $item['value'];
            $setting->save();
        }


        return response(['msg' => trans('app.done')], 200);
    }


}
