# advantageacl
Run bellow command to install
composer create-project jaycct/advantageacl

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
		
4.in app/Http/Kerner.php add in $routeMiddleware array list
		
           'checkPermission' => \jaycct\advantageacl\Http\Middleware\CheckPermission::class,
		  
5. run
php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="config"		  
php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="views"		  
php artisan vendor:publish --provider="jaycct\advantageacl\AdvantageAclServiceProvider" --tag="lang"		  

6. In AdminUser model add 
 public function aclRole()
 {
        return $this->belongsTo('jaycct\advantageacl\Models\AclRole','acl_role_id');
 }
