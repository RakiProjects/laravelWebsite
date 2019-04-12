<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use App\Models\ProductsModel;
use App\Http\Requests\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $data =[];
    private $gallery = null; 

    public function __construct(){
        $this->gallery = new GalleryModel(); 
    }

    public function index()
    {
        $this->data['gallery'] = $this->gallery->getAdminGallery();
        try{
            if($this->data['gallery']){
                return view("admin.gallery.index", $this->data);
            }
        }catch(QueryExeption $e){
            $this->data['gallery'] = [];
            return view("admin.gallery.index", $this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = new ProductsModel();
        $this->data['models'] = $models->getProducts();
        return view("admin.gallery.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $file = $request->file('picture');
        $fileName = time()."_".$file->getClientOriginalName();
        try{
            $file->move(public_path('images\gallery'), $fileName);
            $this->gallery->model = $request->input('model');
            $this->gallery->src = "images/gallery/".$fileName;
            $this->gallery->alt = $request->input('alt');

            $this->gallery->addPicture();
            return redirect('admin/galerija')->with("message", "Uspešno je dodata slika.");

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
        $models = new ProductsModel();
        $this->data['models'] = $models->getProducts();
        $this->data['picture'] = $this->gallery->getPictureById($id);
        return view("admin.gallery.edit", $this->data);
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
            'model' => 'required',
            'alt' => 'required|min:2',
            'picture' => 'mimes:jpeg,jpg,png,gif|max:2000',
        ]);

        try{
        if($request->file('picture')){
            $oldPicture = $request->input('oldSrc');
            unlink(public_path($oldPicture));
            $file = $request->file('picture');
            $fileName = time()."_".$file->getClientOriginalName();
            $file->move(public_path('images\gallery'), $fileName); 
            $this->gallery->src = "images/gallery/".$fileName;      
        }else {
            $this->gallery->src = $request->input('oldSrc');
        }
        $this->gallery->alt = $request->input('alt');
        $this->gallery->model = $request->input('model');
        $this->gallery->updatePicture($id);
            return redirect('admin/galerija')->with('message', "Uspešno je ažurirana slika");
         }catch(QueryException $e){
            return redirect()->back()->with('message', "Greška na serveru, pokušajte kasnije");       
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
        $oldPicturePath = $this->gallery->getPictureById($id)->src;
        unlink(public_path($oldPicturePath));
        $this->gallery->deletePicture($id);
        return redirect()->back()->with('message', "Uspešno je obrisano");

     }catch(QueryException $e){
        return redirect()->back()->with('message', "Greška na serveru, pokušajte kasnije");       
      }
    }
}
