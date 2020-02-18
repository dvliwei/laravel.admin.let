<?php

namespace App\Modules\UserRolePermission\Repositories;

use App\Modules\BaseRepository;
use App\Modules\Permission\Model\PermissionModel;
use App\Modules\Permission\Repositories\PermissionRepository;
use App\Modules\UserRolePermission\Model\UserRolePermissionModel;


class UserRolePermissionRepository extends BaseRepository
{


    public function saveAdBranch($ad_account_id = 0, $ad_campaign_id = 0, $ad_set_id = 0, $ad_id = 0, $date_at = "", $hour = "", $data = [])
    {
        // TODO: Implement saveAdBranch() method.
    }

    public function getRolePermissionByRoleId($roleId =0){
        $permissionModel = new PermissionRepository();
        $models = $permissionModel->getAll();
        $datas=array();
        foreach ($models as $model)
        {
            $node = new \stdClass();
            $node->id = (int)$model["id"];
            $node->pId = (int)$model["pid"];
            $node->name = $model["name"];
            $node->open =false;
            if($this->getRoleAuthor($roleId,$model["id"])){
                $node->open =true;
                $node->checked=true;
            }
            $datas[] = $node;
        }
        return $datas;
    }


    protected function getRoleAuthor($roleId=0, $permission_id=0){
        $model = UserRolePermissionModel::where(['role_id'=>$roleId, 'permission_id'=>$permission_id])->count();
        if(!empty($model)){
            return true;
        }else{
            return false;
        }
    }


    /**
     * @Notes:保存权限
     * @Interface saveRolePermisssion
     * @return bool
     * @author: liwei
     * @Time: 2019/11/8   19:13
     */
    public function saveRolePermisssion(){
        $roleId = $this->_input('role_id');
        $nodeIds = $this->_input('node_ids');
        if(!empty($roleId)){
            UserRolePermissionModel::where('role_id',$roleId)->delete();
            $items = explode(',', $nodeIds);
            foreach ($items as $item){
                if(empty($item))continue;
                $author = new UserRolePermissionModel();
                $author->role_id = $roleId;
                $author->permission_id = $item;
                $author->save();
            }
        }
        return true;
    }

    /**
     * @Notes:判断是否有权限
     * @Interface hasAuthByRoleAndPerId
     * @param int $roleId
     * @param int $permissionId
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   19:13
     */
    public function hasAuthByRoleAndPerId($roleId=0, $permissionId=0){
        return UserRolePermissionModel::Where(["role_id"=>$roleId,"permission_id"=>$permissionId])->count();
    }

    /**
     * @Notes:判断是否有权限
     * @Interface hasAuthByRoleAndPerId
     * @param int $roleId
     * @param int $permissionId
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/8   19:13
     */
    public function  hasAuthByRolebyId($roleId=0){
        $rows = UserRolePermissionModel::Where(["role_id"=>$roleId])->get(["permission_id"]);
        $dataes =[];
        foreach ($rows as $row){
            $dataes[] = (int)$row->permission_id;
        }
        return $dataes;
    }
}
