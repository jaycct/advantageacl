<?php

namespace jaycct\advantageacl\Helpers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class GenerateMenuHelper
{
    /*
     *
     * Get menus from Database
     *
     * */
    public static function __menu() {

        $menu = \DB::table('acl_menus');
        $menu = $menu->select(\DB::raw('DISTINCT acl_modules.module_path,acl_menus.*,acl_modules.module_name as module_title,acl_modules.module_icon'));
        $menu = $menu->join('acl_modules', 'acl_modules.acl_menus_id', '=', 'acl_menus.id');
        $menu = $menu->join('acl_module_route', 'acl_module_route.acl_modules_id', '=', 'acl_modules.id');
        $menu = $menu->where('acl_menus.status','Active');

        if(auth('admin')->user()->acl_role_id != 1 ) {
            $menu= $menu->join('acl_role_permissions', 'acl_role_permissions.module_route_id', '=', 'acl_module_route.id');
            $menu=$menu->where('acl_role_permissions.role_id', auth('admin')->user()->acl_role_id);
        }

        $menu = $menu->get();

        if(!empty($menu)){
            $menu = json_decode(json_encode($menu->toArray()),true);
            $menu_name = array_unique(array_column($menu,'menu_name'));
            // $menu_name = $menu;
            $finalMenu = [];

            foreach ($menu_name as $key => $main_menu){
                foreach ($menu as $k => $menu_path){
                    if($main_menu == $menu_path['menu_name'] && $menu_path['menu_name'] != 'PARENTS') {
                        $_menu['module_path'] = $menu_path['module_path'];
                        $_menu['menu_name'] = $menu_path['module_title'];
                        $_menu['icon'] = $menu_path['module_icon'];
                        $_menu['class'] = GenerateMenuHelper::activeClass($menu_path['module_path']);;
                        $finalMenu[$main_menu]['sub_menu'][] = $_menu;
                        $finalMenu[$main_menu]['icon'] = $menu_path['icon'];
                        $finalMenu[$main_menu]['class'] = ($_menu['class'] != '') ? 'm-menu__item--open m-menu__item--expanded': '';
                    }
                    if( $menu_path['menu_name'] == 'PARENTS') {
                        $finalMenu[$menu_path['module_title']]['module_path'] = $menu_path['module_path'];
                        $finalMenu[$menu_path['module_title']]['icon'] = $menu_path['module_icon'];
                        $finalMenu[$menu_path['module_title']]['class'] =GenerateMenuHelper::activeClass($menu_path['module_path']);;
                    }
                }
            }
        }
        return $finalMenu;
    }
 /*
  *
  * Add active class to selected menu
  *
  * */
    public static function activeClass($path = '',$expanded = false) {
        $class = 'm-menu__item--active';
        if($expanded == true){
            $class = 'm-menu__item--open m-menu__item--expanded';
        }
        $route = \Request::route()->uri();
        $path = 'admin/' . $path . '*';
        if (Str::is($path, $route)) {
            return $class;
        } else {
            return '';
        }
    }
    /*
     *
     * Generate navigation menu
     *
     * */
    public static function getNavMenus() {
        $menuString = '';
        $dbMenus    = Self::__menu();
        if(!empty($dbMenus)) {
            foreach ($dbMenus as $main => $menu) {
                if (isset($menu['sub_menu'])) {
                    $menuString .= '<li class="c-sidebar-nav-dropdown" >';
                    $menuString .= '<a class="c-sidebar-nav-dropdown-toggle" href = "#" >';
                    $menuString .= $menu['icon'];
                    $menuString .= '<span>'.$main.'</span >';
                    $menuString .= '</a>';
                    $menuString .= '<ul class="c-sidebar-nav-dropdown-items">';
                    foreach ($menu['sub_menu'] as $key => $sub_menu) {
                        $menuString .= '<li class="c-sidebar-nav-title">';
                        $menuString .= '<a class="c-sidebar-nav-link" href="' . URL('admin').'/'.$sub_menu['module_path'].'">';
                        $menuString .= $menu['icon'];
						$menuString .= '<span>'.$sub_menu['menu_name'].'</span>';
                        $menuString .= '</a>';
                        $menuString .= '</li>';
                    }
                    $menuString .= '</ul>';
                    $menuString .= '</li>';
                } else {
                    $menuString .= '<li class="c-sidebar-nav-item" >';
                    $menuString .= '<a class="c-sidebar-nav-link" href ="'.URL('admin').'/'.$menu['module_path']. '">';
                    $menuString .= $menu['icon'];
                    $menuString .= '<span>'.$main.'</span>';
                    $menuString .= '</a>';
                    $menuString .= '</li >';
                }
            }
        }
        return $menuString;
    }
}