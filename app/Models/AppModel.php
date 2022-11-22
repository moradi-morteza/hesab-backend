<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AppModel extends Model
{

    protected $appends= ['created_at_fa','updated_at_fa','created_at_fa_date','updated_at_fa_date','created_at_ago','updated_at_ago'];

    public function getCreatedAtFaAttribute(){
        $date = Carbon::parse($this->created_at);
        $date =  $date->format('Y-m-d H:i:s');
        return en_date_time_to_fa($date);
    }

    public function getUpdatedAtFaAttribute(){
        $date = Carbon::parse($this->updated_at);
        $date =  $date->format('Y-m-d H:i:s');
        return en_date_time_to_fa($date);
    }

    public function getCreatedAtFaDateAttribute(){
        $date = Carbon::parse($this->created_at);
        $date =  $date->format('Y-m-d');
        return en_date_to_fa($date);
    }

    public function getUpdatedAtFaDateAttribute(){
        $date = Carbon::parse($this->updated_at);
        $date =  $date->format('Y-m-d');
        return en_date_to_fa($date);
    }

    public function getCreatedAtAgoAttribute(){
        return time_elapsed_string($this->created_at);
    }

    public function getUpdatedAtAgoAttribute(){
        return time_elapsed_string($this->updated_at);
    }

    public function updateTime(){
        $this->updated_at = now();
        $this->save();
    }
}
