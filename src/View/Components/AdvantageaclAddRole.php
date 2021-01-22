<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclAddRole extends Component
{
    public $aclModules;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aclModules  = null)
    {
        $this->aclModules  = $aclModules ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.roles.add_role');
    }
}
