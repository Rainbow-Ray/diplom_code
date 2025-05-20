<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\MaterialCat;
use App\Models\MaterialType;


class AccController extends DictController
{
    const rootURL = "accessories";
    const storeTitle = "Новый аксессуар";
    const storeFormHeader = "Аксессуар";
    const editTitle = "Редактировать аксессуар";
    const editFormHeader = "Редактировать аксессуар";

    public function create_material(){
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::where('cat_id', 1)->get();
        $cats = MaterialCat::find(1);
        
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
