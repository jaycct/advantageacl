<?php

namespace jaycct\advantageacl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AclRole extends Authenticatable
{
    use HasFactory;
    protected $table = 'acl_role';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name', 'role_description', 'status',
    ];

    public function users()
    {
        return $this->hasMany('User');
    }

    public function aclRolePermissions()
    {
        return $this->hasMany('\jaycct\advantageacl\Models\AclRolePermissions','role_id');
    }

    /**
     * The route that belong to the userGroup.
     */
    public function mod_route()
    {
        return $this->belongsToMany('\jaycct\advantageacl\Models\AclModulesRoute','acl_role_permissions','role_id','module_route_id');
    }
}
