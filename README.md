# advantageacl installation guide

Run bellow command to install


composer require jaycct/advantageacl


Then follow bellow steps


1.php artisan migrate

2.php artisan db:seed



3.In confing/app.php add

	'providers' =>
         jaycct\advantageacl\AdvantageAclServiceProvider::class,
    'aliases' =>
        'PermissionHelper' => jaycct\advantageacl\Helpers\PermissionHelper::class,
        'GenerateMenuHelper' => jaycct\advantageacl\Helpers\GenerateMenuHelper::class,
        'SortingHelper' => jaycct\advantageacl\Helpers\SortingHelper::class,
		
		
4.In app/Http/Kerner.php add bellow in $routeMiddleware array list

	'checkPermission' => \jaycct\advantageacl\Http\Middleware\CheckPermission::class,
		  
5. Then run bellow command to publish config and resource files

	php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="config"		  
	php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="views"		  
	php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="lang"		  


6.In AdminUser model add bellow method

 public function aclRole(){
        return $this->belongsTo('jaycct\advantageacl\Models\AclRole','acl_role_id');
 }

That's it!
 
=>  If you wish to use package nav menus then just include bellow blade file in 
    views\advantageacl\layouts\shared\nav-builder.blade.php 
	
	This blade file display menus in admin sidebar
	
=>  If you wish to hide some actions, buttons or code area etc then just put it under bellow condition
	
	@if(PermissionHelper::__checkPermission('route url'))
	
	@endif
	
	example:
	
	@if(PermissionHelper::__checkPermission('admin/users/add'))
		<a class="btn btn-success" routerlink="add" routerlinkactive="active" style="margin-right:10px;" ng-reflect-router-link="add" ng-reflect-router-link-active="active" href="{{ route('admin.users.add') }}"> Add New User</a>
	@endif
 
    Above code will allow to add new user who have "admin/users/add" route permission.