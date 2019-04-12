<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\ColorsModel;
use App\Models\PriceAndSizeModel;

class ProductsController extends FrontEndController
{
    public function __construct(){
        parent::__construct();
        $products = new ProductsModel();
        $this->data['products'] = $products->getProducts();
    }

    public function showProducts(){      
        
        return view("pages.products", $this->data);
    }

    public function showOneProduct($productName){
        
        $product = new ProductsModel();
        $this->data['product'] = $product->getOneProductByName($productName);
        if(empty($this->data['product'])){
            abort(404);
        } 
        $colors = new ColorsModel();
        $this->data['colors'] = $colors->getColors();
       
        return view("pages.product", $this->data);
    }
}
