<?php

namespace jaycct\advantageacl\Repositories;

use Illuminate\Support\Facades\DB;
use jaycct\advantageacl\Models\AclModules;
use jaycct\advantageacl\Models\AclModulesRoute;
use Illuminate\Support\Facades\Config;

use Mockery\Exception;
use Log;
/**
 * Class ModuleRepository.
 */
class AclModuleRepository
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getAclModulesList($filter = array())
    {
        try{
                 $moduleList =new AclModules;

                 if(isset($filter['sort_by']) && $filter['sort_by'] != '') {
                     $orderBy= $filter['sort_by'];
                 } else {
                     $orderBy = 'created_at';
                 }

                 if(isset($filter['sort_dir']) && $filter['sort_dir'] != '') {
                     $sortDir = $filter['sort_dir'];
                 } else {
                     $sortDir = 'ASC';
                 }
                 $moduleList = $moduleList->orderBy($orderBy, $sortDir);

                 if(isset($filter['module_name']) && $filter['module_name'] != '') {
                     $moduleList->where('module_name', 'LIKE', '%' . $filter['module_name'] . '%');
                 }

                 if(isset($filter['id']) && $filter['id'] != '') {
                     $moduleList->where('id', $filter['id']);
                 }

                 $moduleList = $moduleList->paginate(Config::get('constants.PAGINATION'));
                 return $moduleList;
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
        }



    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store($data = array())
    {
        try {
            DB::transaction(function () use ($data) {
                $modules = AclModules::create($data['modules']);
                foreach ($data['modules_route'] as $routes) {
                    $route_post['route'] = $routes;
                    $route_post['status'] = 'Active';
                    $modules->modules_route()->save(new AclModulesRoute($route_post));
                }
            });
            return true;
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update($data = array())
    {
        try{
            DB::transaction(function () use($data) {
                $modules =  AclModules::find($data['id']);
                $modules->update($data['modules']);
                foreach ($data['acl_modules_route'] as $routes){
                    $route_post['route'] = $routes;
                    $route_post['status'] = '1';
                    $modules->modules_route()->save(new AclModulesRoute($route_post));
                }
            });
            return true;
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    public function sync($data = array())
    {
        DB::transaction(function () use($data) {
            $modules =  AclModules::find($data['id']);
            foreach ($data['modules_route'] as $routes){
                $route_post['route'] = $routes;
                $route_post['status'] = 'Active';
                $modules->modules_route()->save(new AclModulesRoute($route_post));
            }
        });
        return true;
    }

    public function getAclModulesWithRoutes(){
        $modules = AclModules::where(['status'=>'Active'])->with('modules_route')->get();
        return $modules;
    }

    public function delete($id){
        DB::transaction(function () use($id) {
            AclModules::destroy($id);
        });
        return true;
    }
}
