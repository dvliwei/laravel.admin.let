<?php

namespace App\Modules\User\Repositories;

use App\Modules\BaseRepository;

use App\Modules\User\Model\UserModel;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{

    public function saveAdBranch($ad_account_id = 0, $ad_campaign_id = 0, $ad_set_id = 0, $ad_id = 0, $date_at = "", $hour = "", $data = [])
    {
        // TODO: Implement saveAdBranch() method.
    }

    //
    public function getAllUser($page=20){
       return  UserModel::orderBy("id","desc")->paginate($page);
    }


    /**
     * @Notes:根据邮箱查询用户
     * @Interface getUserByEmail
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   15:47
     */
    public function getUserByEmail(){
        return UserModel::Where(["email"=>$this->_input("email")])->first();
    }

    /**
     * @Notes:创建用户
     * @Interface saveUser
     * @return bool
     * @author: liwei
     * @Time: 2019/11/12   15:58
     */
    public function saveUser(){
        $model = UserModel::find($this->_input("id"));
        if(!$model) $model = new UserModel();
        $model->name = trim($this->_input("name"));
        $model->email = $this->_input("email")? trim($this->_input("email")):$model->email;
        $model->password = $this->_input("password")?bcrypt(trim($this->_input("password"))):$model->password;
        $model->role_id = $this->_input("role_id");
        return $model->save();
    }

    /**
     * @Notes:id查询user
     * @Interface getUserById
     * @param int $userId
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   16:23
     */
    public function  getUserById($userId=0){
        return UserModel::find($userId);
    }


    /**
     * @Notes:更新密码
     * @Interface updatePassword
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   16:43
     */
    public function  updatePassword(){
        $model = UserModel::find($this->_input("id"));
        $model->password = bcrypt($this->_input("tu_password"));
        return $model->save();
    }

    /**
     * @Notes:删除用户
     * @Interface delUser
     * @param int $userId
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   16:46
     */
    public function delUser($userId=0){
        $model = $this->getUserById($userId);
        return $model->delete();
    }
}
