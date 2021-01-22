<?php

namespace jaycct\advantageacl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AclModules extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'acl_modules';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name','module_path','module_description', 'status','acl_menus_id'
    ];

    /**
     * get Modules
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules_route()
    {
        return $this->hasMany (\jaycct\advantageacl\Models\AclModulesRoute::class);
    }

    /**
     * get Menu
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(\jaycct\advantageacl\Models\AclMenu::class);
    }
}
