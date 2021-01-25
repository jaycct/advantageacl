<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AclRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (Schema::hasTable('acl_role')) {
            $roleId = DB::table('acl_role')->insertGetId([
                'role_name' => 'Super Admin'
            ]);
            if(Schema::hasTable('admin_users')) {
                DB::table('admin_users')->insert([
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('12345678'),
                    'acl_role_id'=>$roleId
                ]);
            }
        }
    }
}
