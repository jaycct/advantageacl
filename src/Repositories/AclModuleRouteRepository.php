<?php

namespace  jaycct\advantageacl\Repositories;

use Illuminate\Support\Facades\DB;
use  jaycct\advantageacl\Models\AclModulesRoute;
use Illuminate\Support\Facades\Config;

/**
 * Class ModuleRouteRepository
 * @package App\Repositories\Admin
 */
class AclModuleRouteRepository
{
    public function getAclRoutesByModule($moduleId){
        $routes = AclModulesRoute::where('acl_modules_id',$moduleId)->get();
        return $routes;
    }

    public function delete($id){
        DB::transaction(function () use($id) {
            AclModulesRoute::destroy($id);
        });
        return true;
    }

}