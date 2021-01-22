<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclListModule extends Component
{
    public $aclModules;
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aclModules=null,$message = null)
    {

        $this->aclModules  = $aclModules;
        $this->message  = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.module.list_module');
    }
}
