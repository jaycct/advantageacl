<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAclRoleIdToAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('admin_users', 'acl_role_id')) {
            Schema::disableForeignKeyConstraints();
			Schema::table('admin_users', function (Blueprint $table) {
                $table->bigInteger('acl_role_id')->unsigned()->after('password');
                $table->foreign('acl_role_id')->references('id')->on('acl_role');
            });
			Schema::enableForeignKeyConstraints();

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('acl_role_id');
        });
    }
}
