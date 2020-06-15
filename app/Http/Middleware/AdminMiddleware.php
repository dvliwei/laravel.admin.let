<?php

namespace App\Http\Middleware;

use App\Modules\Permission\Repositories\PermissionRepository;
use Closure;
use Illuminate\Support\Facades\Auth;
use Log;
class AdminMiddleware
{
    /**
     * 权限控制
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(empty(Auth::user())){
            Auth::logout();
            return redirect("/login");
        }
        $roleName = $request->route()->getName();
        $role_id = Auth::user()->role_id;
        $adminId=Auth::user()->id;
        if( Auth::user()->id===1){
            Log::Info($roleName,["user_id"=>$adminId,"role_id"=>$role_id,"ip"=>getUserActionIp()]);
            return $next($request);
        }else{
            Log::Info($roleName,["user_id"=>$adminId,"role_id"=>$role_id,"ip"=>getUserActionIp()]);
            $names = explode('.',$roleName);
            $permis = new PermissionRepository();
            $permisModel = $permis->getPerByCode(end($names));
            if(!empty($permisModel) && hasRolePermission($role_id,$permisModel->id)){
                return $next($request);
            }else{
                return redirect("/admin/permission/401");
            }

        }

    }
}
