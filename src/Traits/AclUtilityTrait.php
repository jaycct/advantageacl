<?php

namespace jaycct\advantageacl\Traits;

trait AclUtilityTrait
{
    public function getAclRoutes($moduleName = ''){
        $app = app();
        $routes = $app->routes->getRoutes();

        $routePath = [];
        foreach($routes as $route ){
            if(!empty($moduleName)) {
                if (strpos($route->uri(), strtolower($moduleName)) !== false) {
                    $routePath[] = $route->uri();
                }
            }else{
                $routePath[] = $route->uri();
            }
        }
        return $routePath;
    }
}