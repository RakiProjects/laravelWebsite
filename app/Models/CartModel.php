<?php

namespace App\Models;


class CartModel{
    //tables
    private $table ='cart';
    private $tableOrders = 'orders';
    private $tableOrdersDetail = "orders_detail";
    //add item into cart
    public $productName;
    public $productPrice;
    public $productDimensions;
    public $productColor;
    public $pictureSrc;
    public $userId;

    public function addItem(){
        \DB::table($this->table)
            ->insert([
                "user_id" => $this->userId,
                "model_name" => $this->productName,
                "color" => $this->productColor,
                "dimensions" => $this->productDimensions,
                "price" => $this->productPrice,
                "src" => $this->pictureSrc,
            ]);
    }

    public function getCartItems($id){
        return \DB::table($this->table)
                    ->where('user_id', "=", $id)
                    ->get();
    }

    public function delete($id){
        \DB::table($this->table)
            ->where('id', "=", $id)
            ->delete();
    }

} 