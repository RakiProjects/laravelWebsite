<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryModel;

class GalleryController extends FrontEndController
{
    private $gallery = null;

    public function __construct(){
        parent::__construct();
        $this->gallery = new GalleryModel();
    }

    public function index(){
        return view('pages.gallery', $this->data);
    }

     public function showGallery(){
         $gallery =  $this->gallery->getGallery();        
         return view('components.gallery.picture', array('gallery' => $gallery));
       
     } 
}
