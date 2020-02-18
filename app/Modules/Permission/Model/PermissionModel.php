<?php

namespace App\Modules\Permission\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected  $table = "sys_permissions";
    protected $guarded =[];

    protected $primaryKey = "id";
}
