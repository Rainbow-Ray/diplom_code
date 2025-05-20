<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\MaterialCat;
use App\Models\MaterialType;


class KeyTypeController extends DictController
{
    const rootURL = "key_type";
    const storeTitle = "Новый тип ключа";
    const storeFormHeader = "Тип ключа";
    const editTitle = "Редактировать тип ключа";
    const editFormHeader = "Тип ключа";

    const storeTitleA = "Новый автомобильный ключ";
    const storeFormHeaderA = "Автомобильный ключ";
    const editTitleA = "Редактировать автомобильный ключ";
    const editFormHeaderA = "Автомобильный ключ";
    const storeTitleD = "Новый замочный ключ";
    const storeFormHeaderD = "Замочный ключ";
    const editTitleD = "Редактировать замочный ключ";
    const editFormHeaderD = "Замочный ключ";



    /**
     * Display a listing of the resource.
     */


     public function create_material_a(){
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::where('cat_id', 3)->get();
        $cats = MaterialCat::find(3);
        
        return view('material/byCat/create', ["rootURL"=> MaterialController::rootURL, "title"=>  $this::storeTitleA, 
        "formHeader"=> $this::storeFormHeaderA, 
        'eis'=> $eis, 
        'countries'=> $countries,
        'colors'=> $colors ,
        'types'=> $types,
        'category'=> $cats,
    ]);
    }

     public function create_material_d(){
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::where('cat_id', 4)->get();
        $cats = MaterialCat::find(4);
        
        return view('material/byCat/create', ["rootURL"=> MaterialController::rootURL, "title"=>  $this::storeTitleD, 
        "formHeader"=> $this::storeFormHeaderD, 
        'eis'=> $eis, 
        'countries'=> $countries,
        'colors'=> $colors ,
        'types'=> $types,
        'category'=> $cats,
    ]);
    }
}
