<?php

namespace jaycct\advantageacl\Http\Controllers;


use jaycct\advantageacl\Repositories\AclModuleRepository;
use jaycct\advantageacl\Repositories\AclModuleRouteRepository;
use jaycct\advantageacl\Repositories\AclMenuRepository;
use Illuminate\Http\Request;
use jaycct\advantageacl\Traits\AclUtilityTrait;
use Mockery\Exception;
use jaycct\advantageacl\Http\Requests\AdvantageAclStoreRequest;
use Session;
use Illuminate\Support\Facades\Redirect;




class AclModulesController extends AclAdminController
{
    use AclUtilityTrait;

    public function __construct(AclModuleRepository $aclModuleRepository,AclModuleRouteRepository $aclModuleRouteRepository,AclMenuRepository $aclMenuRepository)
    {

        parent::__construct();
        $this->aclModuleRepository = $aclModuleRepository;
        $this->aclModuleRouteRepository = $aclModuleRouteRepository;
        $this->aclMenuRepository = $aclMenuRepository;
    }
    /**
     * Show the Acl Modules.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try {
            $aclModules = $this->aclModuleRepository->getAclModulesList($request->all());
            foreach ($aclModules as $module) {
                $systemRoute = count($this->getAclRoutes($module['path']));
                $dbRoute = count($this->aclModuleRouteRepository->getAclRoutesByModule($module['id']));
                $module['routeChange'] = ($systemRoute - $dbRoute) ? 1 : 0;
            }
            $message = __('acl-modules.delete_modules_confirmation');
            $aclModules->appends($request->except('page'));

            return view('advantageacl::module.list_module', compact('aclModules','message'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
            echo $ex->getMessage();exit;
        }
    }

    /**
     * Show the add Acl Modules.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(\Illuminate\Routing\Route $route)
    {
        try{
            $aclMenus = $this->aclMenuRepository->getAclMenuList();
            return view('advantageacl::module.add_module',compact('aclMenus'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
            echo $ex->getMessage();exit;
        }
    }
    /**
     * store  Acl Modules.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(AdvantageAclStoreRequest $request)
    {

        try {

            $postData = $request->only('module_name', 'module_path', 'module_description', 'status', 'acl_menus_id');
            $postData['status'] = (isset($postData['status']) && $postData['status'] == 'on') ? 'Active' : 'Inactive';
            $postData['modules'] = $postData;

            $routePath = $this->getAclRoutes($postData['modules']['module_path']);
            if (count($routePath) == 0) {
                return redirect()->route('admin.aclmodules.add')->withInput()->with('alert-danger',__('acl-modules.route_path_not_found'));
            }
            $postData['modules_route'] = $routePath;

            $this->aclModuleRepository->store($postData);
            return redirect()->route('admin.aclmodules')->with('alert-success',__('acl-modules.module_created_successfully'));

        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
    /**
     * Usage: Get Module data
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try{

            $aclModules = $this->aclModuleRepository->getAclModulesList(['id'=> $id])->toArray();
            $aclModule = $aclModules['data'][0];
            $aclModuleRoutes =  $this->aclModuleRouteRepository->getAclRoutesByModule($id,['id','route'])->toArray();
            $aclMenus = $this->aclMenuRepository->getAclMenuList();
            return view('advantageacl::module.edit_module',compact('aclModule','aclModuleRoutes', 'aclMenus'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
    /**
     * Usage: Update acl module and acl modules route
     * @param AdvantageAclStoreRequest $request
     * @return mixed
     */
    public function update(AdvantageAclStoreRequest $request)
    {
        try {

            $postData = $request->only('id', 'module_name', 'module_path', 'module_description', 'status', 'acl_menus_id');

            $postData['status'] = (isset($postData['status']) && $postData['status'] == 'on') ? 'Active' : 'Inactive';
            $postData['modules'] = $postData;
            $elementToAdd = $this->updateRoutes($postData);
            if($elementToAdd===false){
                return Redirect::back()->with('alert-danger',__('acl-modules.route_path_not_found'))->withData($postData);
            }
            $postData['acl_modules_route'] = $elementToAdd;
            $this->aclModuleRepository->update($postData);
            return redirect()->route('admin.aclmodules')->with('alert-success',__('acl-modules.module_updated_successfully'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
    /**
     * remove route that doesn't exist in route file and add new routes for module
     * @param $aclModuleId
     * @param $aclModulePath
     * @return array
     */
    protected function updateRoutes($postData){

        try {
            $aclModuleId = $postData['id'];
            $aclModulePath = $postData['modules']['module_path'];
            //Get routes of module from route file
            $routePath = $this->getAclRoutes($aclModulePath);
            //check if route exist or not
            if(count($routePath) == 0) {
                return false;
            }
            //get routes of modules from database
            $aclModuleRoutes = $this->aclModuleRouteRepository->getAclRoutesByModule($aclModuleId)->toArray();
            $dbModuleRoutes = [];
            foreach ($aclModuleRoutes as $route) {
                $dbModuleRoutes[$route['id']] = $route['route'];
            }
            $elementToDelete = array_diff($dbModuleRoutes, $routePath);
            foreach ($elementToDelete as $key => $path) {
                $this->aclModuleRouteRepository->delete($key);
            }
            $elementToAdd = array_diff($routePath, $dbModuleRoutes);
            $elementToAdd = array_values($elementToAdd);
            return $elementToAdd;
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->aclModuleRepository->delete($id);
            return redirect()->route('admin.aclmodules')->with('alert-success',__('acl-modules.module_deleted_successfully'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }

    }

}
