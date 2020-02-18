<?php

use Illuminate\Database\Seeder;

class SysPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sys_permissions')->insert([
            'id' => 1,
            'name' => '测试1',
            'pid' => 0,
            'route_name' => 'AD',
            'comment' => '测试1',
        ]);
        DB::table('sys_permissions')->insert([
            'id' => 2,
            'name' => '测试2',
            'pid' => 1,
            'route_name' => 'AD_ACCOUNT_INDEX',
            'comment' => '测试2',
        ]);

        DB::table('sys_permissions')->insert([
            'id' => 3,
            'name' => '测试3',
            'pid' => 1,
            'route_name' => 'AD_REPORT_LIST',
            'comment' => '测试3',
        ]);


    }
}
