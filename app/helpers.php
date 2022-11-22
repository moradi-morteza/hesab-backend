<?php

use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

function fnumber($number)
{

    if ($number!=null){
        $number=str_replace("0","۰",$number);
        $number=str_replace("1","۱",$number);
        $number=str_replace("2","۲",$number);
        $number=str_replace("3","۳",$number);
        $number=str_replace("4","۴",$number);
        $number=str_replace("5","۵",$number);
        $number=str_replace("6","۶",$number);
        $number=str_replace("7","۷",$number);
        $number=str_replace("8","۸",$number);
        $number=str_replace("9","۹",$number);
    }
    return $number;
}

function enumber($number)
{
    if ($number!=null){
        $number=str_replace("۰","0",$number);
        $number=str_replace("۱","1",$number);
        $number=str_replace("۲","2",$number);
        $number=str_replace("۳","3",$number);
        $number=str_replace("۴","4",$number);
        $number=str_replace("۵","5",$number);
        $number=str_replace("۶","6",$number);
        $number=str_replace("۷","7",$number);
        $number=str_replace("۸","8",$number);
        $number=str_replace("۹","9",$number);
    }
    return $number;
}

function upload_file($request,$name,$directory,$save_name): ?string
{
    if (!file_exists('files/'.$directory)) {
        mkdir('files/'.$directory, 0777, true);
    }

    if($request->hasFile($name))
    {
        $file = $request->file($name);
        $file_name=$save_name.'.'.$request->file($name)->getClientOriginalExtension();
        if($file->move('files/'.$directory,$file_name)) {
            return $file_name;
        } else {
            return null;
        }
    }

    else
    {
        return null;
    }
}

function upload_file_direct($file,$directory,$save_name): ?string
{
    if (!file_exists('files/'.$directory)) {
        mkdir('files/'.$directory, 0777, true);
    }
        $file_name=$save_name.'.'.$file->getClientOriginalExtension();
        if($file->move('files/'.$directory,$file_name)) {
            return $file_name;
        } else {
            return null;
        }

}

function upload_base64($request,$name,$directory,$save_name): ?string
{
    if (!file_exists('files/'.$directory)) {
        mkdir('files/'.$directory, 0777, true);
//        mkdir('files/'.$directory.'/thumbnail', 0777, true);
    }

    if($request->input($name)===null)
    {
        return null;
    }
    else
    {
        $file_name = $save_name . '.jpg';
        $img =Image::make($request->input($name));
        $img->save(public_path('files/'.$directory).'/'. $file_name,50);
        return $file_name;
    }
}

function remove_file($file_name,$directory)
{
    if ($file_name!=null){

        if(file_exists($directory.'/'.$file_name))
        {
            unlink($directory.'/'.$file_name);
        }
    }
}

function getCurrentLocale(){
    // you can play and do anything
    return  config('app.locale');

}

function convertUploadedFileToHumanReadable($size, $precision = 2)
{
    if ( $size > 0 ) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

    return $size;
}

function en_date_time_to_fa($en_date_time){
    $array = explode(' ',$en_date_time);
    $date = $array[0];
    $time = $array[1];
    $date_array = explode('-',$date);
    $fa_date_array = gregorian_to_jalali((int)$date_array[0],(int)$date_array[1],(int)$date_array[2]);
    return implode('/',$fa_date_array).' '.$time;
}

function en_date_to_fa($date){
    $date_array = explode('-',$date);
    $fa_date_array = gregorian_to_jalali((int)$date_array[0],(int)$date_array[1],(int)$date_array[2]);
    return implode('/',$fa_date_array);
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'سال',
        'm' => 'ماه',
        'w' => 'هفته',
        'd' => 'روز',
        'h' => 'ساعت',
        'i' => 'دقیقه',
        's' => 'ثانیه',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' قبل' : 'لحظاتی قبل';
}

function get_name_order_priority($priority){
    switch ($priority){
        case '1':
            return "اولویت اورژانسی";
        case '2':
            return "اولویت نرمال";
        case '3':
            return "اولویت پایین";

        default:
            return "نامشخص";
    }
}

function unique_code($limit)
{
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}


