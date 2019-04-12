<?php 

namespace App\Models;

class OrdersModel{

    private $table ='orders';
    private $tableCart = 'cart';
    private $tableOrdersDetail = "orders_detail";
    private $tableUsers = 'users';

     
     public $userId;
     public $priceSum;
     public $address;
     public $phone;
     public $sent_at;
     public $data=[];
     public $time;

    public function order(){
        try{
        \DB::transaction(function(){
            $orderId = \DB::table($this->table)
                        ->insertGetId([
                            'user_id' => $this->userId,
                            'full_price' => $this->priceSum,
                            'address' => $this->address,
                            'phone' => $this->phone,
                            'time_of_order' => $this->time,
                        ]);
                    
                    foreach($this->data['cartItems'] as $row){
                  \DB::table($this->tableOrdersDetail)
                        ->insert([
                            'order_id' => $orderId,
                            'product_name' => $row->model_name,
                            'product_size' => $row->dimensions,
                            'product_color' => $row->color,
                            'price' => $row->price,
                        ]);
                    }

                    \DB::table($this->tableCart)
                        ->where("user_id", '=', $this->userId)
                        ->delete();
        });
            }catch(\Throwable $e){
                throw new \Exception("Greska pri orderu," .$e->getMessage());
             }  
    }

    public function getOrders(){
        return \DB::table($this->table)
                    ->get();
    }

    public function deleteOrder($id){
        \DB::transaction(function() use($id){

            \DB::table($this->tableOrdersDetail)
                ->where('order_id', "=", $id)
                ->delete();
            
            \DB::table($this->table)
                ->where('id', "=", $id)
                ->delete();
        });
    }

    public function sendOrder($id){
        \DB::table($this->table)
            ->where('id', '=', $id)
            ->update(["sent_at" => $this->sent_at]);
    }

    public function getOrderDetail($id){
        return \DB::table($this->table .' as o')
                    ->join($this->tableOrdersDetail.' as d', 'd.order_id', '=', 'o.id')  
                    ->where('o.id', '=', $id)  
                    ->select('d.id as productId', 'd.product_name', 'd.product_size', 'd.product_color', 'd.price')             
                    ->get();
    }

    public function getUserOrders($userId){
        return \DB::table($this->table) 
                ->where('user_id', "=", $userId)
                ->get();
               
    }

    public function getOrderInfo($id){
        return \DB::table($this->table .' as o')
                ->join($this->tableUsers.' as u', 'u.id', '=', 'o.user_id')
                ->where('o.id', '=', $id) 
                ->select('o.id', 'o.address', 'o.phone', 'o.full_price', 'o.time_of_order', 'o.sent_at', 'u.username', 'u.email')
                ->first();
    }
}