<?php

namespace App\Models;

class ProductsModel {

    private $table = "products";
    private $tablePictures = 'pictures';
    private $tablePrices = 'prices';
    private $tableSize = 'size';
    public $name;
    public $description;
    public $src;
    public $alt;
    public $size;
    public $price;


    public function getProducts(){
        return \DB::table($this->table)
                ->join($this->tablePictures, "products.picture_id", "=", "$this->tablePictures.id")   
                ->join($this->tablePrices, "$this->tablePrices.product_id", "=", "$this->table.id")
                ->join($this->tableSize, "$this->tablePrices.size_id", "=", "$this->tableSize.id")       
                ->get();
    }

    public function getOneProductByName($productName){
        return \DB::table($this->table)
                ->join("pictures", "products.picture_id", "=", "pictures.id")
                ->join($this->tablePrices, "$this->tablePrices.product_id", "=", "$this->table.id")
                ->join($this->tableSize, "$this->tablePrices.size_id", "=", "$this->tableSize.id") 
                ->where("products.name", "=", $productName)
                ->orderBy("$this->tablePrices.id", "desc")
                ->first();
    }

    public function getOneProductById($id){
        return \DB::table($this->table)
                ->join("pictures", "products.picture_id", "=", "pictures.id")
                ->join($this->tablePrices, "$this->tablePrices.product_id", "=", "$this->table.id")
                ->join($this->tableSize, "$this->tablePrices.size_id", "=", "$this->tableSize.id") 
                ->where("products.id", "=", $id)
                ->orderBy("$this->tablePrices.id", "desc")
                ->first();
    }


    public function addProduct(){
        try{
            \DB::transaction(function(){
                $idPicture = \DB::table($this->tablePictures)
                                ->insertGetId([
                                    'alt' => $this->alt,
                                    'src' => $this->src
                                ]);

                $idProduct = \DB::table($this->table)
                                ->insertGetId([
                                    'name' => $this->name,
                                    'description' => $this->description,
                                    'picture_id' => $idPicture
                                ]);

                $idSize = \DB::table($this->tableSize)
                                ->insertGetId([
                                    'dimensions' => $this->size
                                ]);
                               
                            \DB::table($this->tablePrices)
                                    ->insert([
                                        'price' => $this->price,
                                        'product_id' =>$idProduct,
                                        'size_id' => $idSize
                                    ]);
            });
        }catch(\Throwable $e){
            throw new \Exception("Greska pri unosu");
        }
    }

    public function deleteProduct($id){ 
        try{
        \DB::transaction(function() use ($id) {          
            $data['idSize'] = \DB::table($this->tablePrices)
                        ->where('product_id', "=", $id)
                        ->select('size_id')
                        ->first();  
                                
            $data['idPicture'] = \DB::table($this->table)
                        ->where('id', "=", $id)
                        ->select('picture_id')
                        ->first();

            \DB::table($this->tablePrices)
                ->where('product_id', "=", $id)
                ->delete();
                
             \DB::table($this->tableSize)
                ->where('id', "=",  $data['idSize']->size_id)
                ->delete();
            
            \DB::table($this->tablePictures)
                ->where('id', "=", $data['idPicture']->picture_id)
                ->delete();  
                
            \DB::table($this->table)
                ->where('id', "=", $id)
                ->delete();            
        });
    }catch(\Throwable $e){
        throw new \Exception("Greska pri brisanju," .$e);
     }  
    } 
    
    
    public function updateProduct($id, $sizeId){
        try{
            \DB::transaction(function() use ($id, $sizeId) {
                \DB::table($this->tablePrices)
                        ->where("product_id", "=", $id)
                        ->update(["price" => $this->price]);
                
                \DB::table($this->tableSize)
                        ->where("id", "=", $sizeId)
                        ->update(["dimensions" => $this->size]);
                        
                \DB::table($this->table)
                        ->where("id", "=", $id)
                        ->update(["name" => $this->name, "description" => $this->description]);
            });
        }catch(\Throwable $e){
            throw new \Exception("Greska pri brisanju," .$e);
         }  
                
    }

    public function updatePicture($pictureId){
        try{         
                \DB::table($this->tablePictures)
                        ->where("id", "=", $pictureId)
                        ->update(["src" => $this->src,"alt" => $this->alt ]);           
        }catch(\Throwable $e){
            throw new \Exception("Greska pri azuriranju," .$e);
         }  
    }
}

