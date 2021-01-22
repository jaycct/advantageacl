<?php

namespace jaycct\advantageacl\View\Components;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class AdvantageaclListRole extends Component
{
    public $aclRoles;
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aclRoles=null,$message = null)
    {

        $this->aclRoles  = $aclRoles;
        $this->message  = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       return view('advantageacl::components.roles.list_role');
    }
}
