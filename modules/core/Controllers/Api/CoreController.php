<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Core\Models\AppAction;
use Illuminate\Http\Request;
use Modules\order\Models\Attachment;
use function getCurrentLocale;

class CoreController extends Controller
{
    // Localization for javascript and vuejs
// below function return all lang variables in resources/lang/*.php as json for use in vuejs
    function getLangJs()
    {

        $lang = getCurrentLocale();
        $files = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];
        foreach ($files as $file) {
            $name = basename($file, '.php');
            $strings[$name] = require $file;
        }
        header('Content-Type: text/javascript');
        echo('window.i18n = ' . json_encode($strings) . ';');
        exit();

    }

    function upload_to_temp(Request $request)
    {
        $files = $request->file('file');
        $upload_result_array = array();
        foreach ($files as $key=>$file) {

            $size = $file->getSize();
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $attachment = [];
            $attachment['file_name'] = upload_file_direct($file, 'temp', $key.'-'.time());
            $attachment['file_size'] = convertUploadedFileToHumanReadable($size);
            $attachment['file_extension'] = $extension;
            $attachment['original_name'] = $originalName;

            $upload_result_array[] = $attachment;
        }
        return response(['files' => $upload_result_array]);
    }

    public function destroy_attachment($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();
        return response(['msg' => trans('app.done')], 200);
    }


}
