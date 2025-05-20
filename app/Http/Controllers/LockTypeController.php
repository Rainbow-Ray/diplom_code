<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\MaterialCat;
use App\Models\MaterialType;


class LockTypeController extends DictController
{
    const rootURL = "lock_type";
    const storeTitle = "Новый тип замка";
    const storeFormHeader = "Тип замка";
    const editTitle = "Редактировать тип замка";
    const editFormHeader = "Тип замка";


    public function create_material(){
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::where('cat_id', 2)->get();
        $cats = MaterialCat::find(2);
        
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
