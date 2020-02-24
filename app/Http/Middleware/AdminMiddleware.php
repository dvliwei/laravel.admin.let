<?php

namespace App\Http\Middleware;

use App\Modules\Permission\Repositories\PermissionRepository;
use Closure;
use Illuminate\Support\Facades\Auth;

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

        if( Auth::user()->id===1){
            return $next($request);
        }else{
            $role_id = Auth::user()->role_id;
            $roleName = $request->route()->getName();
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
