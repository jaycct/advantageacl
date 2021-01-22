<?php 
Route::prefix('/admin')->name('admin.')->group(function(){
    Route::group(['middleware' => ['auth:admin','checkPermission']], function () {

        //module routes
        Route::get('/acl-modules/', 'AclModulesController@index')->name('aclmodules');
        Route::get('/acl-modules/add', 'AclModulesController@add')->name('aclmodules.add');
        Route::post('/acl-modules/store', 'AclModulesController@store')->name('aclmodules.store');
        Route::get('/acl-modules/edit/{id}', 'AclModulesController@edit')->name('aclmodules.edit');
        Route::get('/acl-modules/sync/{id}', 'AclModulesController@sync')->name('aclmodules.sync');
        Route::put('/acl-modules/update', 'AclModulesController@update')->name('aclmodules.update');
        Route::get('/acl-modules/destroy/{id}', 'AclModulesController@destroy')->name('aclmodules.destroy');


        //Users routes
        Route::get('/roles','AclRolesController@index')->name('aclrole.list');
        Route::get('/roles/add', 'AclRolesController@add')->name('aclrole.add');
        Route::post('/roles/store', 'AclRolesController@store')->name('aclrole.store');
        Route::get('/roles/edit/{id}', 'AclRolesController@edit')->name('aclrole.edit');
        Route::put('/roles/update', 'AclRolesController@update')->name('aclrole.update');
        Route::get('/roles/destroy/{id}', 'AclRolesController@destroy')->name('aclrole.destroy');



    });
});



