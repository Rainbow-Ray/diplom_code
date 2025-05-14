<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\EquipType;
use Illuminate\View\View;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    const rootURL = "equip";
    const storeTitle = "Новое оборудование";
    const storeFormHeader = "Оборудование";
    const editTitle = "Редактировать оборудование";
    const editFormHeader = "Оборудование";


    public static function apiIndex(){
        $type =  $_GET['type'];

        if($type == null){
                $mat = Equip::all();
        }
        else{
            $mat = Equip::where('type_id', $type)->get();
        }
        return json_encode($mat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Equip::all();
        return view("equip/equipCard", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = EquipType::all();
        return view('equip/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 'equipTypes'=> $types]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equip = new Equip();
        $equip->name = $request->name;
        $equip->count = $request->count;
        $equip->number = $request->number;
        $equip->type_id = $request->equip_type;
        $equip -> save();
        return redirect($this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equip = Equip::findOrFail($id);
        return view('equip/data', ["rootURL" => $this::rootURL,
            "item"=> $equip, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $equip = Equip::findOrFail($id);
        $types = EquipType::all();

        if (!is_null($equip)){
            return view('equip/edit', ["rootURL" => $this::rootURL,
            "equip"=> $equip, 
            'equipTypes'=> $types,
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('equip/edit', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
         'equipTypes'=> $types,
        "formHeader"=> $this::storeFormHeader]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equip = Equip::findOrFail($id);

        if (!is_null($equip)){
            $equip->name = $request['name'];
            $equip->count = $request['count'];
            $equip->number = $request['number'];
            $equip->type_id = $request['equip_type'];
            $equip->save();
        }
        return redirect( $this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equip = Equip::findOrFail($id);
        $equip->delete();
        return redirect( $this::rootURL);

    }
}
