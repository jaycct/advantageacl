<?php

namespace jaycct\advantageacl\Repositories;

use jaycct\advantageacl\Models\AclRole;
use jaycct\advantageacl\Models\AclRolePermissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AclRolesRepository
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getUserRoleList($filter = array())
    {
        $userAclRoleList = NEW AclRole;

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
        $userAclRoleList = $userAclRoleList->orderBy($orderBy, $sortDir);

        if(isset($filter['name']) && $filter['name'] != '') {
            $userAclRoleList->where('role_name', 'LIKE', '%' . $filter['name'] . '%');
        }

        if(isset($filter['id']) && $filter['id'] != '') {
            $userAclRoleList->where('id', $filter['id']);
        }

        $userAclRoleList = $userAclRoleList->paginate(Config::get('constants.PAGINATION'));
        return $userAclRoleList;
    }

    /**
     * Usage: Save user group and routes permission
     * @param array $data
     * @return bool
     */
    public function store($data = array())
    {
        DB::transaction(function () use($data) {
            AclRole::create($data)->mod_route()->sync($data['permission']);
        });
        return true;
    }

    public function getUserAclRoleById($id){
        $aclRole = AclRole::find($id);
        $userPermission = AclRolePermissions::where('role_id',$id)->get();
        return ['role' => $aclRole,'permissions' => $userPermission];
    }

    /**
     * Usage: Save user group and routes permission
     * @param array $data
     * @return bool
     */
    public function update($data = array())
    {
        DB::transaction(function () use($data) {

            $aclRole = AclRole::find($data['id']);
            $aclRole->update($data);
            if(isset($data['permission'])){
                $aclRole->mod_route()->sync($data['permission']);
            }
        });
        return true;
    }

    /**
     * Usage: Save user group and routes permission
     * @param array $data
     * @return bool
     */
    public function delete($id = '')
    {
        DB::transaction(function () use($id) {
            AclRole::destroy($id);
        });
        return true;
    }
}