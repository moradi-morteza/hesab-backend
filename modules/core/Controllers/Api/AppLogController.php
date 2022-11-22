<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Models\AppAction;
use Core\Models\AppLog;

class AppLogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $logs = AppLog::query()->with(['user', 'action'])->orderBy('id','DESC')->get();
        return response( $logs, 200);
    }


}
