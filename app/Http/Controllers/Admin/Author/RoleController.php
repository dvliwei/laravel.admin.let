<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Role\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;
class RoleController extends AdminController
{
    //

    public function actionIndex(RoleRepository $repository){
        $datas = $repository->getAllRole();
        return view("admin.author.role.index",["datas"=>$datas]);
    }

    /**
     * @Notes:保存角色
     * @Interface actionSaveRole
     * @param RoleRepository $repository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: liwei
     * @Time: 2019/11/8   14:49
     */
    public function actionSaveRole(RoleRepository $repository){
        Log::Info("保存角色",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        if($repository->saveRole()){
            return redirect("/admin/author/role")->with('status',1)->with('msg', "编辑成功");
        }else{
            return redirect("/admin/author/role")->with('status',-1)->with('msg', "编辑失败");
        }
    }


    public function actionAjaxEditeRole($roleId=0, RoleRepository $repository){
        Log::Info("修改角色",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp(),"role_id"=>$roleId]);
        $data = $repository->getRoleById($roleId);
        return response()->json($data);
    }

    public function actionDelRole($roleId=0, RoleRepository $repository){
        Log::Notice("删除角色",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp(),"role_id"=>$roleId]);
        if($repository->delRoleById($roleId)){
            return redirect($_SERVER['HTTP_REFERER'])->with('status',1)->with('msg', "删除成功");
        }else{
            return redirect($_SERVER['HTTP_REFERER'])->with('status',-1)->with('msg', "删除失败");
        }
    }


}
