<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    //

    public function actionIndex(){
        return view("admin.permission.401",["code"=>401,"mes"=>"Insufficient permissions, please contact the administrator"]);
    }
}
