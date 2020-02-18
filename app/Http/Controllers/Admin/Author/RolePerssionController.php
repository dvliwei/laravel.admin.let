<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\UserRolePermission\Repositories\UserRolePermissionRepository;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;
class RolePerssionController extends AdminController
{

    public function actionRolePrmission($roleId=0, UserRolePermissionRepository $userRolePermissionRepository){
        Log::Info("获取角色权限信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        $items = $userRolePermissionRepository->getRolePermissionByRoleId($roleId);
        return response()->json($items);
    }

    public function actionAddRolePrmission(UserRolePermissionRepository $userRolePermissionRepository){
        Log::Info("更新角色权限信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        $userRolePermissionRepository->saveRolePermisssion();
        $data = ['status'=>'success', 'message'=>'更新权限成功'];
        return response()->json($data);
    }
}
