<?php
/**
 * Created by PhpStorm.
 * 文件描述
 * User: liwei
 * Date: 2019/11/11
 * Time: 09:51
 */


Route::group([
    'prefix'     => 'permission',
    'as'         => 'permission.',
], function () {

    Route::get("/401","PermissionController@actionIndex")->name("401");
});