<?php

namespace Core\Controllers\Api;

use App\Exporter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExporterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function export(Request $request)
    {
        $head_array = $request->input('head');
        $data_array = $request->input('data');
        Log::info($head_array);
        Log::info($data_array);
        // remove invisible-Html variable and clean head array
        $header_array = [];
        $in_visible_key_array = ['action','orderRequirement','orderTasks','updateAt'];
        foreach ($head_array as $key => $head) {
            if (!in_array($key,$in_visible_key_array)&&$head['isVisible'])
                $header_array[] = $head['title'];

            if (!$head['isVisible']){
                $in_visible_key_array[]=$key;
            }
        }
        foreach ($data_array as $i => $data) {
            foreach ($data as $j => $item) {
                if (substr($j, -4)==="Html" || in_array($j,$in_visible_key_array)) {
                    unset($data_array[$i][$j]);
                }
            }
        }

        Log::info($header_array);
        Log::info($data_array);
        $file_name = 'export_' . time() . '.xlsx';
        Excel::store(new Exporter($data_array, $header_array), $file_name,'export');
        return asset('export/'.$file_name);

    }
}
