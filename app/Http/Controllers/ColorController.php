<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ColorController extends DictController
{

    const rootURL = "colors";
    const storeTitle = "Новая цветовая гамма";
    const storeFormHeader = "Цветовая гамма";
    const editTitle = "Редактировать цветовую гамму";
    const editFormHeader = "Цветовая гамма";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return parent::displayDict($this::storeFormHeader, Color::all()->sortBy('name'), $this::rootURL);

    }

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
        $color = new Color();
        $color->name = $request['name'];
        $color->save();
        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $color = Color::find($id);
        return $color->name;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $color = Color::find($id);

        if (!is_null($color)){
            return view('dictionaries/edit', ["rootURL" => $this::rootURL,"name"=> $color->name, "id"=> $color->id, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        if (!is_null($color)){
            $color->name = $request['name'];
            $color->save();
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect($this::rootURL);
    }
}
