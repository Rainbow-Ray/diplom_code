<?php

namespace App\Http\Controllers;

use App\Models\Acc;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\Material;
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




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return parent::displayDict('Акссессуары', Acc::all(), 'accessories');
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
        $acc = new Acc;
        $acc->name = $request['name'];
        $acc->save();
        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $acc = Acc::find($id);
        return $acc->name;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) : View
    {
        $acc = Acc::find($id);

        if (!is_null($acc)){
            return view('dictionaries/edit', ["rootURL" => $this::rootURL,"name"=> $acc->name, "id"=> $acc->id, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $acc)
    {
        $acc = Acc::find($acc);
        if (!is_null($acc)){
            $acc->name = $request['name'];
            $acc->save();
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($acc)
    {
        $acc = Acc::find($acc);
        $acc->delete();
        return redirect($this::rootURL);
    }
}
