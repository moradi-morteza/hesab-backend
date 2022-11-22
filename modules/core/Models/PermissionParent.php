<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionParent extends Model
{
    use HasFactory;
    protected $table ="permission_parent";
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];

    public function children(){
        return $this->hasMany(Permission::class,'parent_id','id')->select('id','name','parent_id','fa_name');
    }

}
