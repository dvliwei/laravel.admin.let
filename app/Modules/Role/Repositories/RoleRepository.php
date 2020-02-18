<?php

namespace App\Modules\Role\Repositories;

use App\Modules\BaseRepository;
use App\Modules\Role\Model\RoleModel;


class RoleRepository extends BaseRepository
{
    //

    public function saveAdBranch($ad_account_id = 0, $ad_campaign_id = 0, $ad_set_id = 0, $ad_id = 0, $date_at = "", $hour = "", $data = [])
    {
        // TODO: Implement saveAdBranch() method.
    }

    /**
     * @Notes:所有角色
     * @Interface getAllRole
     * @param int $page
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   14:31
     */
    public function getAllRole($page=20){
        return RoleModel::orderBy("id","desc")->paginate($page);
    }

    public function getAllRoleNoPage(){
        return RoleModel::orderBy("id","desc")->get();
    }
    /**
     * @Notes:保存角色
     * @Interface saveRole
     * @author: liwei
     * @Time: 2019/11/8   14:49
     */
    public function saveRole(){
        $model = RoleModel::find($this->_input("id"));
        if(!$model)$model = new RoleModel();
        $model->role_name = $this->_input("role_name");
        $model->comment = $this->_input("comment");
        return $model->save();
    }

    /**
     * @Notes:查询角色
     * @Interface getRoleById
     * @param int $roleId
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   14:57
     */
    public function getRoleById($roleId=0){
        return  RoleModel::find($roleId);
    }

    /**
     * @Notes:硬删除角色
     * @Interface delRoleById
     * @param $roleId
     * @author: liwei
     * @Time: 2019/11/8   15:07
     */
    public function delRoleById($roleId){
        $model =$this->getRoleById($roleId);
        return $model->delete();
    }

}
