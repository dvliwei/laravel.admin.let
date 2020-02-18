<?php
/**
 * Created by PhpStorm.
 * 文件描述
 * User: liwei
 * Date: 2019/10/31
 * Time: 21:21
 */

Route::group([
    'prefix'     => 'author',
    'as'         => 'author',
    'middleware'=>'admin.auth',
], function () {

    /*角色*/
    Route::group([
        'prefix'     => 'role',
        'as'         => 'role',
        //'middleware'=>'admin.auth',
    ], function () {
        Route::any('/', 'Author\RoleController@actionIndex')->name('author_role');
        Route::any('/save_role', 'Author\RoleController@actionSaveRole')->name('author_save_role');
        Route::get('/edite/{roleId}', 'Author\RoleController@actionAjaxEditeRole')->name('author_edite_role');
        Route::get('/del/{roleId}', 'Author\RoleController@actionDelRole')->name('author_del_role');



        Route::get('/prmission/{roleId}', 'Author\RolePerssionController@actionRolePrmission')->name('author_role_prmission');
        Route::any('/add_role_prmission', 'Author\RolePerssionController@actionAddRolePrmission')->name('add_role_prmission');
    });

    /*用户*/
    Route::group([
        'prefix'     => 'user',
        'as'         => 'user',
        'middleware'=>'admin.auth',
    ], function () {
        Route::any('/', 'Author\UserController@actionIndex')->name('author_role');
        Route::any('/emailCheck', 'Author\UserController@actionEmailCheck')->name('user_emailCheck');
        Route::any('/save_user', 'Author\UserController@actionSaveUser')->name('author_save_user');
        Route::any('/edite_password', 'Author\UserController@actionEditerUserPassword')->name('author_user_edite_password');
        Route::get('/edite/{userId}', 'Author\UserController@actionAjaxEditeUser')->name('author_edite_user');
        Route::get('/del/{userId}', 'Author\UserController@actionDelUser')->name('author_del_user');
    });


    /*权限*/
    Route::group([
        'prefix'     => 'permission',
        'as'         => 'permission',
        //'middleware'=>'admin.auth',
    ], function () {
        Route::any('/', 'Author\PermissionController@actionIndex')->name('AUTHOR_PERMISSION');
        Route::get('/edite/{permissionId}', 'Author\PermissionController@actionAjaxEditePermission')->name('AUTHOR_PERMISSION_EDITER');
        Route::any('/save_permission', 'Author\PermissionController@actionSavePermission')->name('AUTHOR_PERMISSION_SAVE');

    });


});