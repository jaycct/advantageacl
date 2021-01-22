<?php

namespace jaycct\advantageacl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AclModulesRoute extends Model
{
    use HasFactory;

    use Notifiable;
    protected $table = 'acl_module_route';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acl_menus_id', 'route', 'status'
    ];

    /**
     * get Modules
     */
    public function modules()
    {
        return $this->belongsTo(\ jaycct\advantageacl\Models\AclModules::class, 'acl_menus_id');
    }
}
