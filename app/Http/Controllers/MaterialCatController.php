<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use Illuminate\Http\Request;

class MaterialCatController extends DictController
{

    const rootURL = "category";
    const storeTitle = "Новая категория материала";
    const storeFormHeader = "Категория материала";
    const editTitle = "Редактировать категорию";
    const editFormHeader = "Категория материала";

    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        $columns = MaterialCat::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $eType = new MaterialCat();
        return parent::p_store($eType, $request, $this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eType = MaterialCat::find($id);
        return parent::p_show($eType);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eType = MaterialCat::find($id);

        return parent::p_edit($eType,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $eType = MaterialCat::find($id);
        return parent::p_update($request, $eType, $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eType = MaterialCat::find($id);
        return parent::p_destroy($eType, $this::rootURL);

    }
}
