<?php

namespace jaycct\advantageacl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AclMenu extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'acl_menus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','menu_name', 'icon', 'status'
    ];

    /**
     * get Modules
     */
    public function AclModules()
    {
        return $this->hasMany(\jaycct\advantageacl\Models\AclModules::class, 'acl_menus_id');
    }
}
