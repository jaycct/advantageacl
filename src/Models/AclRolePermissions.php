<?php

namespace  jaycct\advantageacl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AclRolePermissions extends Model
{
    use HasFactory;
    protected $table = 'acl_role_permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'module_route_id'
    ];

    public function moduleRoute()
    {
        return $this->belongsTo(' jaycct\advantageacl\Models\AclModulesRoute');
    }
}
