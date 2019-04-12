<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularProductsModel;
use App\Models\SliderModel;

class HomeController extends FrontEndController
{

     public function __construct(){
         parent::__construct();
     }

    public function index(){
        $popularP = new PopularProductsModel();
        $this->data['popularProducts'] = $popularP->getPopularProducts();

        $slider = new SliderModel();
        $this->data['sliders'] = $slider->getSliders();
        
        return view("pages.home", $this->data);
    }

    public function author(){
        return view('pages.author', $this->data);
    }
}
