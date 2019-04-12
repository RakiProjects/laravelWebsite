<?php

namespace App\Models;


class GalleryModel
{
    
    private $table = "pictures";
    public $model;
    public $src;
    public $alt;

    public function getGallery(){
        return \DB::table($this->table)            
                ->where("src", "like", "images/gallery/%")  
                ->orderBy('id', 'desc')
                ->get();
    }

    public function getAdminGallery(){
        return \DB::table($this->table)            
                ->where("src", "like", "images/gallery/%")  
                ->orderBy('id', 'desc')
                ->get();             
    }

    public function getPictureById($id){
        return \DB::table($this->table)
                    ->where("id", "=", $id)
                    ->first();
    }

    public function addPicture(){
        \DB::table($this->table)
            ->insert([
                'model' => $this->model,
                'alt' => $this->alt,
                'src' => $this->src
            ]);
    }

    public function deletePicture($id){
        \DB::table($this->table)
            ->where("id", "=", $id)
            ->delete();
    }

    public function updatePicture($id){        
            \DB::table($this->table)
                    ->where("id", "=", $id)
                    ->update(["src" => $this->src,"alt" => $this->alt, "model" => $this->model ]);           
    }
}
