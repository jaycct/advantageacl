<?php

namespace  jaycct\advantageacl\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AclAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
