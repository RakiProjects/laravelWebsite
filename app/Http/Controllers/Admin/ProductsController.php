<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $data =[];
    private $products = null; 

    public function __construct(){
        $this->products = new ProductsModel(); 
    }

    public function index()
    {
        $this->data['products'] = $this->products->getProducts();
        try{
            if($this->data['products']){
                return view("admin.products.index", $this->data);
            }
        }catch(QueryExeption $e){
            $this->data['products'] = [];
            return view("admin.products.index", $this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $file = $request->file('picture');
        $fileName = time()."_".$file->getClientOriginalName();
        try{
            $file->move(public_path('images\products'), $fileName);
            $this->products->name = $request->input('name');
            $this->products->description = $request->input('description');
            $this->products->src = "images/products/".$fileName;
            $this->products->alt = $request->input('alt');
            $this->products->size = $request->input('size');
            $this->products->price = $request->input('price');

            $this->products->addProduct();
            return redirect('admin/proizvodi')->with("message", "Uspešno je dodat proizvod.");

        }catch(\Exception $e){
            return redirect()->back()->with("message", "Doslo je do greske, neuspesan unos.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['product'] = $this->products->getOneProductById($id);
        return view("admin.products.edit", $this->data);
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
        
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required|min:5',          
            'size' => 'required|min:2',
            'price' => 'required|numeric',
        ]);
        $this->products->name = $request->input('name');
        $this->products->description = $request->input('description');      
        $this->products->size = $request->input('size');
        $this->products->price = $request->input('price');
        $sizeId = $request->input('sizeId');

        try{         
            $this->products->updateProduct($id, $sizeId);
            return redirect('admin/proizvodi')->with('message', "Uspešno je ažuriran proizvod");
         }catch(QueryException $e){
           return redirect()->back()->with('message', "Greška " .$e->getMessage());       
         }
      
       
    }

    public function updatePicture(Request $request){

        $request->validate([
            'alt' => 'min:2',
            'picture' => 'mimes:jpeg,jpg,png|max:2000',
            ]);
                   
          if($request->file('picture')){ 
            try{        
            $pictureId =  $request->input('pictureId');  
            $this->products->alt = $request->input('alt');
            $oldPicture = $request->input('oldSrc');
            unlink(public_path($oldPicture));
            $file = $request->file('picture');
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path('images\products'), $fileName);
            $this->products->src = "images/products/".$fileName;
            $this->products->updatePicture($pictureId);
            return redirect('admin/proizvodi')->with('message', "Uspešno je ažurirana slika");
         }catch(QueryException $e){
            return redirect()->back()->with('message', "Greška, ". $e->getMessage());       
          }
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
            $pictureFile = $this->products->getOneProductById($id)->src;
            unlink(public_path($pictureFile));
            $this->products->deleteProduct($id);
            return redirect()->back()->with('message', "Uspešno je obrisano");
         }catch(QueryException $e){
           return redirect()->back()->with('message', "Greška,". $e->getMessage());       
         }
    }
}
