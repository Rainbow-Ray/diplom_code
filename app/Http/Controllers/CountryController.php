<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends DictController
{
    const rootURL = "country";
    const storeTitle = "Новая страна производства";
    const storeFormHeader = "Страна производства";
    const editTitle = "Редактировать страну";
    const editFormHeader = "Страна производства";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return parent::displayDict($this::storeFormHeader, Country::all(), $this::rootURL);
        $columns = Country::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);

        // return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        // "formHeader"=> $this::storeFormHeader]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $country = new Country();
        
        return parent::p_store($country, $request, $this::rootURL);

        // $color->name = $request['name'];
        // $color->save();
        // return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = Country::find($id);
        return parent::p_show($country);
        // return $color->name;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $country = Country::find($id);

        return parent::p_edit($country,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);

        // if (!is_null($country)){
        //     return view('dictionaries/edit', ["rootURL" => $this::rootURL,"name"=> $color->name, "id"=> $color->id, 
        //     'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        // }
        // return view('dictionaries/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        // "formHeader"=> $this::storeFormHeader]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        return parent::p_update($request, $country, $this::rootURL);
        // if (!is_null($color)){
        //     $color->name = $request['name'];
        //     $color->save();
        // }
        // return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        return parent::p_destroy($country, $this::rootURL);
        // $color->delete();
        // return redirect($this::rootURL);
    }
}
