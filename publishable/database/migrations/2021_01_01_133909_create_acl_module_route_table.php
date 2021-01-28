<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAclModuleRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::disableForeignKeyConstraints();
        Schema::create('acl_module_route', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('acl_modules_id')->unsigned();
            $table->string('route',1024)->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('acl_modules_id')->references('id')->on('acl_modules');
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
        Schema::dropIfExists('acl_module_route');
    }
}
