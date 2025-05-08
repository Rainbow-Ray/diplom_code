<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\LockType;
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



    public function index()
    {
        $columns = LockType::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    public function store(Request $request)
    {
        $lType = new LockType();
        return parent::p_store($lType, $request, $this::rootURL);
    }

    public function show(string $id)
    {
        $lType = LockType::find($id);
        return parent::p_show($lType);

    }

    public function edit(string $id) : View
    {
        $lType = LockType::find($id);

        return parent::p_edit($lType,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    public function update(Request $request, $id)
    {
        $lType = LockType::find($id);
        return parent::p_update($request, $lType, $this::rootURL);
    }

    public function destroy($id)
    {
        $lType = LockType::find($id);
        return parent::p_destroy($lType, $this::rootURL);
    }
}
