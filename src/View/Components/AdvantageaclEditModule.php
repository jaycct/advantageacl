<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclEditModule extends Component
{
    public $aclModule;
    public $aclMenus;
    public $aclModuleRoutes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aclModule = null,$aclMenus=null,$aclModuleRoutes=null)
    {
        $this->aclModule = $aclModule;
        $this->aclMenus  = $aclMenus;
        $this->aclModuleRoutes  = $aclModuleRoutes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.module.edit_module');
    }
}
