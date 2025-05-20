<?php

namespace App\Http\Controllers;

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
}
