<?php

namespace App\Http\Controllers;

use App\Models\CategoryFurn;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\MaterialCat;
use App\Models\MaterialType;



class CategoryFurnController extends DictController
{
    const rootURL = "furniture_category";
    const storeTitle = "Новая категория";
    const storeFormHeader = "Категория фурнитуры";
    const editTitle = "Редактировать категорию";
    const editFormHeader = "Редактировать категорию";


    public function create_material(){
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::where('cat_id', 5)->get();
        $cats = MaterialCat::find(5);
        
        return view('material/byCat/create', ["rootURL"=> MaterialController::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 
        'eis'=> $eis, 
        'countries'=> $countries,
        'colors'=> $colors ,
        'types'=> $types,
        'category'=> $cats,
    ]);
    }




    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        return parent::displayDict('Категория фурнитуры', CategoryFurn::all(), $this::rootURL);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cat = new CategoryFurn();
        $cat->name = $request['name'];
        $cat->save();
        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cat = CategoryFurn::find($id);
        return $cat->name;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $cat = CategoryFurn::find($id);

        if (!is_null($cat)){
            return view('dictionaries/edit', ["rootURL" => $this::rootURL,"name"=> $cat->name, "id"=> $cat->id, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cat)
    {
        $cat = CategoryFurn::find($cat);
        if (!is_null($cat)){
            $cat->name = $request['name'];
            $cat->save();
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cat)
    {
        $cat = CategoryFurn::find($cat);
        $cat->delete();
        return redirect($this::rootURL);
    }
}
