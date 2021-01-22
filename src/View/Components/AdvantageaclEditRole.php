<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclEditRole extends Component
{
    public $userRole;
    public $aclModules;
    public $permissions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($userRole=null,$aclModules = null,$permissions=null)
    {

        $this->userRole  = $userRole;
        $this->aclModules  = $aclModules;
        $this->permissions  = $permissions;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.roles.edit_role');
    }
}
