<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;

use App\Modules\Permission\Repositories\PermissionRepository;
use App\Modules\UserRolePermission\Repositories\UserRolePermissionRepository;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;
class PermissionController extends AdminController
{


    public function actionIndex(PermissionRepository $permissionRepository){
        $datas = $permissionRepository->getAllPermission();
        return view("admin.author.permission.index",["datas"=>$datas]);
    }

    public function actionAjaxEditePermission($permissionId=0,PermissionRepository $permissionRepository){
        Log::Info("编辑权限信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        $data = $permissionRepository->getPermissionById($permissionId);
        return response()->json($data);
    }

    public function actionSavePermission(PermissionRepository $permissionRepository){
        Log::Info("保存权限信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        if($permissionRepository->savePermission()){
            return redirect("/admin/author/permission")->with('status',1)->with('msg', "编辑成功");
        }else{
            return redirect("/admin/author/permission")->with('status',-1)->with('msg', "编辑失败");
        }
    }
}
