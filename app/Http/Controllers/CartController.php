<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\CartModel;
use App\Models\OrdersModel;

class CartController extends FrontEndController
{
    private $cart=null;

    public function __construct(){
        parent::__construct();
        $this->cart = new CartModel();
    }

    public function addItem(Request $request){

        try{
                $this->cart->productName = $request->input('productName');
                $this->cart->productPrice = $request->input('productPrice');
                $this->cart->productColor = $request->input('productColor');
                $this->cart->productDimensions = $request->input('productDimensions');
                $this->cart->pictureSrc = $request->input('pictureSrc');
                $this->cart->userId = session()->get('user')->id;

                $this->cart->addItem();
                return ['success' => true, 'message' => 'Proizvod ste uspešno dodali u korpu'];
            }catch(Exception $e){
                return redirect('/proizvodi')->with('message', "Greska ".$e->getMessage());
            }     
    }

    public function showCart(){
        
        $id = session()->get('user')->id;
        $this->data['cartItems'] = $this->cart->getCartItems($id);
        $this->data['priceSum'] = 0;
        if( $this->data['cartItems']){
        return view('pages.cart', $this->data);
        }else{
            return view('pages.cart');
        }
    }

    public function deleteItem($id){

        try{
         $this->cart->delete($id);
         return redirect()->back();
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    public function order(Request $request){
        $request->validate([
            'address' => 'required|min:4',
            'phone' => 'required|regex:/^[0-9\/\-\s]+$/',          
        ]);

        $order = new OrdersModel();

        $id = $request->session()->get('user')->id;
        $order->userId = $request->session()->get('user')->id;
        $order->address= $request->input('address');
        $order->phone= $request->input('phone');
        $order->priceSum =  $request->input('priceSum');
        $order->data['cartItems'] = $this->cart->getCartItems($id);
        $order->time =  date('Y-m-d H-i-s');
        
        try{
            $order->order();
            $username = $request->session()->get('user')->username;
            \Log::info("[".date('Y-m-d H:i:s')."] korisnik ".$username." je izvrsio porudzbinu: ");
            return redirect('/')->with('message', "Uspešno ste poručili, očekujte dolazak pošiljke za nedelju dana");
         }catch(QueryException $e){
           return redirect('/')->with('message', "Greška na serveru, pokušajte kasnije");       
         }        
    }

    public function userOrders(Request $request){
        $orders = new OrdersModel();
        $userId = $request->session()->get('user')->id;
        $this->data['orders'] = $orders->getUserOrders($userId);
   
        foreach( $this->data['orders'] as $index => $order){
            $id = $order->id;         
            $this->data['orders'][$index]->orderDetails = $orders->getOrderDetail($id);
        }
            return view ('pages.orders', $this->data);
    }
}      


        


   
    

