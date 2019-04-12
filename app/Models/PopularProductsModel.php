<?php

namespace App\Models;

class PopularProductsModel {

    private $table = 'popular_products';

    public function getPopularProducts(){
        return \DB::table($this->table)
                ->join('pictures', "$this->table.picture_id", '=', "pictures.id")
                ->get();
    }
}