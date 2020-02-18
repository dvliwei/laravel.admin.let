<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2018/3/28
 * Time: 下午4:16
 */

use Carbon\Carbon;
if (!function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return app('active')->getClassIf($condition, $activeClass, $inactiveClass);
    }
}



/* 获取当前控制器与方法
 *
 * @return array
 */
if (!function_exists('getCurrentAction')) {
    function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }
}


if (!function_exists('if_uri_pattern')) {
    /**
     * Check if the current URI matches one of specific patterns (using `str_is`)
     *
     * @param array|string $patterns
     *
     * @return bool
     */
    function if_uri_pattern($patterns)
    {
        return app('active')->checkUriPattern($patterns);
    }
}


if (! function_exists('includeRouteFiles')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory = $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if ($filename != '.' && $filename != '..' && is_dir($directory . $filename)) {
                array_push($directory_list, $directory . $filename . '/');
            }
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory . '*.php') as $filename) {
                require $filename;
            }
        }
    }
}

if(!function_exists('secToTime')){
    function secToTime($times){
        $result = '00:00:00';
        if ($times>0) {
            $hour = floor($times/3600);
            $minute = floor(($times-3600 * $hour)/60);
            $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
            $result = $hour.':'.$minute.':'.$second;
        }
        return $result;
    }
}

if(!function_exists('getDateByTimeZone')){
    function getDateByTimeZone($dateTime){
        if(!is_int($dateTime))$dateTime = (int)strtotime($dateTime);
        $timeZone= env("ORDER_TIME_ZONE",'GMT+08:00');
        return Carbon::now()->timestamp($dateTime)->timezone($timeZone)->format('Y-m-d H:i:s');
    }
}


/**
 * 日期差
 */
if(!file_exists('getDiffDays')){
    function getDiffDays($update_at){
        $created = new Carbon($update_at);
        $timeZone= env("ORDER_TIME_ZONE",'GMT+03:00');
        $now = Carbon::now()->timezone($timeZone);
        $day = $created->diff($now)->days;
        return $day;
    }
}

if(!file_exists("hasRolePermission")){
    function hasRolePermission($roleId,$permissionID){
        if(\Illuminate\Support\Facades\Auth::user()->id==1){
            return true;
        }
        $rolePermission = new \App\Modules\UserRolePermission\Repositories\UserRolePermissionRepository();
        if($rolePermission->hasAuthByRoleAndPerId($roleId,$permissionID)){
            return true;
        }
        return false;
    }
}

if(!file_exists("hasRolePermissionByCode")){
    function hasRolePermissionByRoleId($roleId){
        $menus =[];
        $rolePermission = new \App\Modules\UserRolePermission\Repositories\UserRolePermissionRepository();
        $menus = $rolePermission->hasAuthByRolebyId($roleId);
        return $menus;
    }
}

if(!file_exists("getUserActionIp")){
    function getUserActionIp(){
        $action = new \App\Modules\AdminRepository();
        return $action->getIp();
    }
}


if(!file_exists("getAccountReport")){
    function getAccountReport($accountId){
        $result =  new \App\Modules\TabAdAccount\Repositories\TabAdAccountRepository();
        return $result->getAccountReportById($accountId);
    }
}

if(!file_exists("getCampaignReport")){
    function getCampaignReport($campaignId){
        $result =  new \App\Modules\TabAdCampaign\Repositories\TabAdCampaignModelRepository();
        return $result->getCampaignReportById($campaignId);
    }
}

if(!file_exists("getAdsetReport")){
    function getAdsetReport($adsetId){
        $result = new  \App\Modules\TabAdSet\Repositories\TabAdSetRepository();
        return $result->getAdsetReportById($adsetId);
    }
}

if(!file_exists("getAdReport")){
    function getAdReport($adId){
        $result = new  \App\Modules\TabAd\Repositories\TabAdRepository();
        return $result->getAdReportById($adId);
    }
}