<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersModel;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $data =[];
    private $orders = null; 

    public function __construct(){
        $this->orders = new OrdersModel(); 
    }
    public function index()
    {
        $this->data['orders'] = $this->orders->getOrders();
        try{
            if($this->data['orders']){
                return view("admin.orders.index", $this->data);
            }
        }catch(QueryExeption $e){
            $this->data['orders'] = [];
            return view("admin.orders.index", $this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['order'] = $this->orders->getOrderInfo($id);
        $this->data['orderDetail'] = $this->orders->getOrderDetail($id);
        return view('admin.orders.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->orders->sent_at = date('Y-m-d H-i-s');
            $this->orders->sendOrder($id);
            return redirect()->back()->with('message', "Uspešno je poslata pošiljka");
        }catch(QueryException $e){
           return redirect()->back()->with('message', "Greška,". $e->getMessage());       
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->orders->deleteOrder($id);
            return redirect()->back()->with('message', "Uspešno je obrisano");
        }catch(QueryException $e){
           return redirect()->back()->with('message', "Greška,". $e->getMessage());       
         }
    }
}
