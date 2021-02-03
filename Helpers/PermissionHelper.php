<?php

namespace  jaycct\advantageacl\Helpers;

class PermissionHelper
{
    /*
     * check user has permission to access that part or not
    */
    public static function __checkPermission($path = '') {
        if(auth('admin')->user()->acl_role_id == 1){
            return true;
        }
        $actualPath = \Request::route()->uri();
        if(trim($path) != '' ) {
            $actualPath = $path;
        }
        $permissionData = auth('admin')->user()->load('aclRole')->aclRole->load('aclRolePermissions')->aclRolePermissions->load('moduleRoute')->toArray();
         $data = array_column(array_column($permissionData,'module_route'),'route');
        if(in_array($actualPath,$data)){
            return true;
        } else {
            return false;
        }
    }

}