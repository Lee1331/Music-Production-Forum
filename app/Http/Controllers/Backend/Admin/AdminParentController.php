<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminParentController extends Controller
{

    protected $displayNumber = 25;

    public function __construct(){
        $this->middleware('auth:admin');
    }

}
