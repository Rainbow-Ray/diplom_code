<?php

namespace App\Http\Controllers;

use App\Models\Ei;
use Illuminate\View\View;
use Illuminate\Http\Request;


class EiController extends DictController
{
    const rootURL = "ei";
    const storeTitle = "Новая единица измерения";
    const storeFormHeader = "Единица измерения";
    const editTitle = "Редактировать единицу измерения";
    const editFormHeader = "Единица измерения";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Ei::all()->sortBy('name');
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
        $ei = new Ei();
        return parent::p_store($ei, $request, $this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ei = Ei::find($id);
        return parent::p_show($ei);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $ei = Ei::find($id);

        return parent::p_edit($ei,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ei = Ei::find($id);
        return parent::p_update($request, $ei, $this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ei = Ei::find($id);
        return parent::p_destroy($ei, $this::rootURL);
    }
}

