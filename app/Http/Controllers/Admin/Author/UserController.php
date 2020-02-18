<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Role\Repositories\RoleRepository;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;
class UserController extends AdminController
{

    public function actionIndex(UserRepository $userRepository, RoleRepository $repository){
        $datas = $userRepository->getAllUser();
        $roles = $repository->getAllRoleNoPage();
        return view("admin.author.user.index",["datas"=>$datas,"roles"=>$roles]);
    }

    /**
     * @Notes:验证邮箱是否被占用
     * @Interface actionEmailCheck
     * @param UserRepository $userRepository
     * @author: liwei
     * @Time: 2019/11/8   15:47
     */
    public function actionEmailCheck(UserRepository $userRepository){
        if(empty($userRepository->getUserByEmail())){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function actionSaveUser(UserRepository $userRepository){
        Log::Info("保存用户信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        if($userRepository->saveUser()){
            return redirect("/admin/author/user")->with('status',1)->with('msg', "编辑成功");
        }else{
            return redirect("/admin/author/user")->with('status',-1)->with('msg', "编辑失败");
        }
    }

    public function  actionAjaxEditeUser($userId=0,UserRepository $userRepository){
        $data = $userRepository->getUserById($userId);
        return response()->json($data);
    }

    public function  actionEditerUserPassword(UserRepository $userRepository){
        Log::Info("更新用户密码信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp()]);
        if($userRepository->updatePassword()){
            return redirect("/admin/author/user")->with('status',1)->with('msg', "更新密码成功");
        }else{
            return redirect("/admin/author/user")->with('status',-1)->with('msg', "更新密码失败");
        }
    }


    public function actionDelUser($userId=0,UserRepository $userRepository){
        Log::Notice("删除用户信息",["user_id"=>Auth::user()->id,"role_id"=>Auth::user()->role_id,"ip"=>getUserActionIp(),"user_id"=>$userId]);
        if($userId==1){
            return redirect("/admin/author/user")->with('status',-1)->with('msg', "无权删除该用户");
        }
        if($userRepository->delUser($userId)){
            return redirect("/admin/author/user")->with('status',1)->with('msg', "更新密码成功");
        }else{
            return redirect("/admin/author/user")->with('status',-1)->with('msg', "更新密码失败");
        }
    }

}
