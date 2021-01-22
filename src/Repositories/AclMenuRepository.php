<?php

namespace jaycct\advantageacl\Repositories;
use jaycct\advantageacl\Models\AclMenu;

class AclMenuRepository
{
    public function getAclMenuList(){
		try{
			$menus = new AclMenu();
			$menus = collect($menus::all()->toArray());
			$menus = $menus->pluck('menu_name','id');
			return $menus->all();
		}catch (Exception $ex){
            Log::error($ex->getMessage());
            echo $ex->getMessage();exit;
        }
    }
}