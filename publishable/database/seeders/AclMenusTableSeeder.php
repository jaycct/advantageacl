<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AclMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('acl_menus')) {
            $menuId = DB::table('acl_menus')->insertGetId([
                'menu_name' => 'PARENTS',
                'icon' => '',
                'status' => 'Active'
            ]);
			DB::table('acl_menus')->insert([
                'menu_name' => 'Modules Management',
                'icon' => '',
                'status' => 'Active'
            ]);
            DB::table('acl_menus')->insert([
                'menu_name' => 'Users Management',
                'icon' => '',
                'status' => 'Active'
            ]);

            if(Schema::hasTable('acl_modules')) {
               $moduleId =  DB::table('acl_modules')->insertGetId([
                    'module_name' => 'Modules',
                    'module_path' => 'acl-modules',
                    'acl_menus_id' => $menuId,
                    'status' => 'Active'
                ]);
            }
            if(Schema::hasTable('acl_module_route')) {
                 DB::table('acl_module_route')->insert(
                     [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules',
                         'status' => 'Active'
                     ],
                     [
                    'acl_modules_id' => $moduleId,
                    'route' => 'admin/acl-modules/update',
                    'status' => 'Active'
                    ],
                    [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules/destroy/{id}',
                         'status' => 'Active'
                    ],
                    [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules/sync/{id}',
                         'status' => 'Active'
                    ],
                    [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules/add',
                         'status' => 'Active'
                     ],
                     [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules/store',
                         'status' => 'Active'
                     ],
                     [
                         'acl_modules_id' => $moduleId,
                         'route' => 'admin/acl-modules/edit/{id}',
                         'status' => 'Active'
                     ]
                 );
            }
        }
    }
}
