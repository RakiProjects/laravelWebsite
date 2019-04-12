<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;

abstract class FrontEndController extends Controller
{
    protected $data;

    public function __construct(){
        $menu = new MenuModel();
        $this->data['menu'] = $menu->getMenuLinks();       
    }
}
