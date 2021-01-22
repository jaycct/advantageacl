<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclAddModule extends Component
{
    public $aclMenus;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aclMenus  = null)
    {
        $this->aclMenus  = $aclMenus ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.module.add_module');
    }
}
