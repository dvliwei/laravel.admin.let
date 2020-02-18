<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{

    protected $table ="users" ;
    protected $guarded =[];

    protected $primaryKey = "id";

    public function  userRole(){
        return $this->belongsTo('App\Modules\Role\Model\RoleModel',"role_id","id")->withDefault("异常");
    }
}
