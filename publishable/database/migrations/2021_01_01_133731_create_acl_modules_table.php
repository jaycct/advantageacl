<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAclModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::disableForeignKeyConstraints();
        Schema::create('acl_modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_name',255);
            $table->string('module_path',1024);
            $table->string('module_icon',1024)->nullable();
            $table->bigInteger('acl_menus_id')->unsigned();
            $table->string('module_description',1024)->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('acl_menus_id')->references('id')->on('acl_menus');

        });
		Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_modules');
    }
}
