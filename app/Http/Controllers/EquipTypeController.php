<?php

namespace App\Http\Controllers;

use App\Models\EquipType;
use Illuminate\View\View;
use Illuminate\Http\Request;

class EquipTypeController extends DictController
{
    const rootURL = "equip_type";
    const storeTitle = "Новый тип оборудования";
    const storeFormHeader = "Тип оборудования";
    const editTitle = "Редактировать тип оборудования";
    const editFormHeader = "Тип оборудования";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = EquipType::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $eType = new EquipType();
        return parent::p_store($eType, $request, $this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eType = EquipType::find($id);
        return parent::p_show($eType);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $eType = EquipType::find($id);

        return parent::p_edit($eType,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $eType = EquipType::find($id);
        return parent::p_update($request, $eType, $this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $eType = EquipType::find($id);
        return parent::p_destroy($eType, $this::rootURL);
    }
}
