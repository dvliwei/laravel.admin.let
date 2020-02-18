<?php

namespace App\Modules\UserRolePermission\Model;

use Illuminate\Database\Eloquent\Model;

class UserRolePermissionModel extends Model
{
    //

    protected  $table = "sys_role_permissions";
    protected $guarded =[];

    protected $primaryKey = "id";
}
