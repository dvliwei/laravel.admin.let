<?php

namespace App\Modules\Permission\Repositories;

use App\Modules\BaseRepository;
use App\Modules\Permission\Model\PermissionModel;
use App\Modules\UserRolePermission\Model\UserRolePermissionModel;


class PermissionRepository extends BaseRepository
{


    public function saveAdBranch($ad_account_id = 0, $ad_campaign_id = 0, $ad_set_id = 0, $ad_id = 0, $date_at = "", $hour = "", $data = [])
    {
        // TODO: Implement saveAdBranch() method.
    }

    /**
     * @Notes:按照层级关系获取权限列表
     * @Interface getAllPermission
     * @return array
     * @author: liwei
     * @Time: 2019/11/11   11:06
     */
    public function getAllPermission(){
        $datas =[];
        $topModels = PermissionModel::Where(["pid"=>0])->orderBy("id")->get();
        foreach ($topModels as $topModel){
            $data["id"] = $topModel->id;
            $data["name"] = $topModel->name;
            $data["pid"] = $topModel->pid;
            $data["route_name"] = $topModel->route_name;
            $data["comment"] = $topModel->comment;
            $secondModels = PermissionModel::Where(["pid"=>$topModel->id])->orderBy("id")->get();
            $child=[];
            foreach ($secondModels as $secondModel){
                $second["id"] = $secondModel->id;
                $second["name"] = $secondModel->name;
                $second["pid"] = $secondModel->pid;
                $second["route_name"] = $secondModel->route_name;
                $second["comment"] = $secondModel->comment;
                $thirdModels = PermissionModel::Where(["pid"=>$secondModel->id])->orderBy("id")->get();
                $child1 =[];
                foreach ($thirdModels as $thirdModel){
                    $third["id"] =  $thirdModel->id;
                    $third["name"] =  $thirdModel->name;
                    $third["pid"] =  $thirdModel->pid;
                    $third["route_name"] =  $thirdModel->route_name;
                    $third["comment"] =  $thirdModel->comment;
                    $fourthModels = PermissionModel::Where(["pid"=>$thirdModel->id])->orderBy("id")->get();
                    $child2 =[];
                    foreach ($fourthModels as $fourthModel){
                        $fourth["id"] =  $fourthModel->id;
                        $fourth["name"] =  $fourthModel->name;
                        $fourth["pid"] =  $fourthModel->pid;
                        $fourth["route_name"] =  $fourthModel->route_name;
                        $fourth["comment"] =  $fourthModel->comment;
                        $fifthModels = PermissionModel::Where(["pid"=>$fourthModel->id])->orderBy("id")->get();
                        $child3=[];
                        foreach ($fifthModels as $fifthModel){
                            $fifth["id"] =  $fifthModel->id;
                            $fifth["name"] =  $fifthModel->name;
                            $fifth["pid"] =  $fifthModel->pid;
                            $fifth["route_name"] =  $fifthModel->route_name;
                            $fifth["comment"] =  $fifthModel->comment;
                            $child3[]=$fifth;
                            $fourth["child"]=$child3;
                        }
                        $child2[]=$fourth;
                    }
                    $third["child"] = $child2;
                    $child1[]= $third;
                }
                $second["child"] = $child1;
                $child[]=$second;
            }
            $data["child"] = $child;
            $datas[]=$data;
        }
        return $datas;
    }

    /**
     * @Notes:所有权限信息
     * @Interface getPermissionById
     * @param int $id
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/11   11:06
     */
    public function getAll(){
        return PermissionModel::orderBy("id")->get();
    }

    /**
     * @Notes:根据路由名称查询权限信息
     * @Interface getPermissionById
     * @param int $id
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/11   11:06
     */
    public function getPerByCode($route_name=""){
        return PermissionModel::Where(["route_name"=>$route_name])->first();
    }

    /**
     * @Notes:根据id查询权限信息
     * @Interface getPermissionById
     * @param int $id
     * @return mixed
     * @author: liwei
     * @Time: 2019/11/11   11:06
     */
    public function  getPermissionById($id=0){
        return PermissionModel::find($id);
    }

    /**
     * @Notes:保存权限信息
     * @Interface savePermission
     * @return bool
     * @author: liwei
     * @Time: 2019/11/11   11:12
     */
    public function savePermission(){
        $model = PermissionModel::find($this->_input("permission_id"));
        if(!$model) return false;
        $model->name = $this->_input("permission_name");
        $model->comment = $this->_input("permission_comment");
        return $model->save();
    }
}
