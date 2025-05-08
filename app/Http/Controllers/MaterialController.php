<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\Material;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    const rootURL = "materials";
    const storeTitle = "Новый материал";
    const storeFormHeader = "Материал";
    const editTitle = "Редактировать материал";
    const editFormHeader = "Материал";


    static function getMaterialByCat($cat){
         return Material::join('MaterialType', 'Material.type_id', '=', 'MaterialType.id')->where('cat_id', $cat)->select('Material.*')->get();
        //  return Material::join('MaterialType', 'Material.type_id', '=', 'MaterialType.id')->where('cat_id', $cat)->get();
    }

    public function show_accessories(){
        $columns = $this::getMaterialByCat(1);
        return view('material.card', ['title'=> 'Аксессуары', 'createURL'=>'accessories', 'items'=> $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_locks(){
        $columns = $this::getMaterialByCat(2);
        return view('material.card', ['title'=> 'Замки', 'createURL'=>'locks', 'items'=> $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_key_auto(){
        $columns = $this::getMaterialByCat(3);
        return view('material.card', ['title'=> 'Автомобильные ключи', 'createURL'=>'key_auto', 'items'=> $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_key_door(){
        $columns = $this::getMaterialByCat(4);
        return view('material.card', ['title'=> 'Замочные ключи', 'createURL'=>'key_door', 'items'=> $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_furniture(){
        $columns = $this::getMaterialByCat(5);
        return view('material.card', ['title'=> 'Фурнитура', 'createURL'=>'furniture','items'=> $columns, 'rootURL' => $this::rootURL]);
    }

    public function apiIndex(){
        $type =  $_GET['type'];
        $cat =  $_GET['cat'];

        if($type == null){
            if($cat==null){
                $mat = Material::all();
            }
            else{
                $mat = Material::select('Material.name', 'Material.id')->join('MaterialType','Material.type_id', 'MaterialType.id')->where('cat_id', $cat)->get();
            }
        }
        else{
            $mat = Material::where('type_id', $type)->get();
        }
        return json_encode($mat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


    public function index()
    {
        $columns = Material::all();
        
        return view("material/card", ['title'=> 'Материалы', 'createURL'=> $this::rootURL, 'editURL'=> $this::rootURL, 'items' => $columns, 'rootURL' => $this::rootURL]);

    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::all();
        $cats = MaterialCat::all();
        
        return view('material/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 
        'eis'=> $eis, 
        'countries'=> $countries,
        'colors'=> $colors ,
        'types'=> $types,
        'cats'=> $cats,
    ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = new Material();

        $material->name = $request['name'];
        $material->amount = $request['amount'];
        $material->min_amount = $request['min_amount'];
        $material->ei_id = $request['ei'];
        $material->country_id = $request['country'];
        $material->color_id = $request['color'];
        $material->type_id = $request['type'];
        $material->save();

        return redirect($this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::findOrFail($id);

        // return view('material.receiptData', ['item'=>$receipt]);
        return [$material->name,
        $material->amount,
        ];

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = Material::findOrFail($id);
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::all();
        $cats = MaterialCat::all();

        if (!is_null($material)){
            return view('material/edit', ["rootURL" => $this::rootURL,
            "item"=> $material, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, 
            'eis'=> $eis, 
            'countries'=> $countries,
            'colors'=> $colors,
            'types'=> $types,
            'cats'=> $cats,
                
        ]);
        }
        return view('material/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 
        'eis'=> $eis, 
        'countries'=> $countries,
        'colors'=> $colors ,
        'types'=> $types,        
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        if (!is_null($material)){
            $material->name = $request['name'];
            $material->amount = $request['amount'];
            $material->min_amount = $request['min_amount'];
            $material->ei_id = $request['ei'];
            $material->country_id = $request['country'];
            $material->color_id = $request['color'];
            $material->type_id = $request['type'];
            $material->save();
        }
        return redirect( $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect( $this::rootURL);

    }
}
