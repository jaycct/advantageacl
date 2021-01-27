<?php

namespace jaycct\advantageacl\Http\Controllers;

use jaycct\advantageacl\Http\Requests\AdvantageAclStoreRequest;
use jaycct\advantageacl\Repositories\AclModuleRepository;
use jaycct\advantageacl\Repositories\AclRolesRepository;
use Illuminate\Http\Request;

class AclRolesController extends AclAdminController
{


    protected $aclRolesRepository;
    protected $aclModuleRepository;

    public function __construct(AclRolesRepository $aclRolesRepository,AclModuleRepository $aclModuleRepository)
    {

        parent::__construct();
        $this->aclRolesRepository = $aclRolesRepository;
        $this->aclModuleRepository = $aclModuleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{

            $aclRoles = $this->aclRolesRepository->getUserRoleList($request->all());
            $message = __('acl-roles.delete_role_confirmation');
            return view('advantageacl::roles.list_role',compact('aclRoles','message'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
       try{
            $aclModules = $this->aclModuleRepository->getAclModulesWithRoutes();
            return view('advantageacl::roles.add_role',compact('aclModules'));
       }catch (Exception $ex){
           Log::error($ex->getMessage());
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvantageAclStoreRequest $request)
    {

       try{

           $postData = $request->only('role_name','role_description','status','permission');
           $postData['status'] = (isset($postData['status']) && $postData['status'] == 'on')?'Active':'Inactive';
           $this->aclRolesRepository->store($postData);
           return redirect()->route('admin.aclrole.list')->with('alert-success',__('acl-roles.role_created_successfully'));
       }catch (Exception $ex){
           Log::error($ex->getMessage());
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try{
            $userRoleDetails = $this->aclRolesRepository->getUserAclRoleById($id);
            $aclModules = $this->aclModuleRepository->getAclModulesWithRoutes();
            $userRole =$userRoleDetails['role'];
            $permissions = $userRoleDetails['permissions'];
            return view('advantageacl::roles.edit_role',compact('userRole','aclModules','permissions'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvantageAclStoreRequest $request)
    {

        try{
            $postData = $request->only('id','role_name','role_description','status','permission');
            $postData['status'] = (isset($postData['status']) && $postData['status'] == 'on')?'Active':'Inactive';
            $this->aclRolesRepository->update($postData);
            return redirect()->route('admin.aclrole.list')->with('alert-success',__('acl-roles.role_updated_successfully'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
        //return redirect()->route('admin.userGroups')->withFlashSuccess(__('UserGroup updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->aclRolesRepository->delete($id);
            return redirect()->route('admin.aclrole.list')->with('alert-success',__('acl-roles.role_deleted_successfully'));
        }catch (Exception $ex){
            Log::error($ex->getMessage());
        }
    }
}
