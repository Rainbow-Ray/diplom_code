<?php

namespace App\Http\Controllers;

use App\Models\EquipCheck;
use Illuminate\Http\Request;

class EquipCheckController extends Controller
{

    const rootURL = "equip_check";
    const storeTitle = "";
    const storeFormHeader = "Оборудование";
    const editTitle = "Редактировать оборудование";
    const editFormHeader = "Оборудование";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipCheck $equipCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipCheck $equipCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipCheck $equipCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipCheck $equipCheck)
    {
        //
    }
}
