<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table("users", function (Blueprint $table){
            $table->smallInteger("role_id")->default(0)->comment("角色id");
        });

        //角色表
        Schema::create('sys_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("role_name",32)->default("")->comment("角色名称")->unique();
            $table->text("comment")->nullable()->comment("角色说明");
            $table->timestamps();
        });


        //权限
        Schema::create('sys_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name",32)->default("")->comment("权限名称")->index();
            $table->smallInteger("pid")->default(0)->comment("父id");
            $table->string("route_name",32)->default("")->comment("路由名称")->unique();
            $table->text("comment")->nullable()->comment("说明");
            $table->timestamps();
        });

        //角色权限表
        Schema::create('sys_role_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger("role_id")->default(0)->comment("角色id")->index();;
            $table->smallInteger("permission_id")->default(0)->comment("权限id")->index();;
            $table->timestamps();
            $table->unique(["role_id","permission_id"]);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_role');
    }
}
