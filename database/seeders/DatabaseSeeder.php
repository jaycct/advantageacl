<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Database\Seeders\AclMenusTableSeeder;
use Database\Seeders\AclRoleTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AclMenusTableSeeder::class,
            AclRoleTableSeeder::class,
        ]);

    }
}
