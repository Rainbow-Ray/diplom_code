<?php

namespace App\Http\Controllers;

use App\Models\MaterialCat;
use App\Models\MaterialType;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    const rootURL = "mat_type";
    const storeTitle = "Новый тип материала";
    const storeFormHeader = "Тип материала";
    const editTitle = "Редактировать тип материала";
    const editFormHeader = "Тип материала";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = MaterialType::all();
        
        return view("materialType/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    public function apiIndex($cat){
        $types = MaterialType::where('cat_id', $cat)->get();
        echo json_encode($types, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public function apiAll(){
        $types = MaterialType::all();
        echo json_encode($types, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = MaterialCat::all();
        
        return view('materialType/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 'category'=> $category]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = new MaterialType();

        $type->name = $request['name'];
        $type->cat_id = $request['category'];

        $type->save();

        return redirect($this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = MaterialType::findOrFail($id);
        return [$type->name,
        $type->category->name,
        ];

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = MaterialType::findOrFail($id);
        $category = MaterialCat::all();

        if (!is_null($type)){
            return view('materialType/edit', ["rootURL" => $this::rootURL,
            "type"=> $type, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, "category"=>$category,
            
        ]);
        }
        return view('materialType/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, "category"=>$category,
            ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = MaterialType::findOrFail($id);

        if (!is_null($type)){
            $type->name = $request['name'];
            $type->cat_id = $request['category'];

            $type->save();

        }
        return redirect( $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = MaterialType::findOrFail($id);
        $type->delete();
        return redirect( $this::rootURL);

    }
}
