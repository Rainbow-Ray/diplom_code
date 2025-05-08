<?php

namespace App\Http\Controllers;

use App\Models\ExpenseSource;
use Illuminate\Http\Request;

class ExpenseSourceController extends DictController
{
    const rootURL = "expense_source";
    const storeTitle = "Новый источник расхода";
    const storeFormHeader = "Источник расхода";
    const editTitle = "Редактировать источник расхода";
    const editFormHeader = "Источник расхода";

    public function index()
    {
        $columns = ExpenseSource::all();
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
        $source = new ExpenseSource();
        return parent::p_store($source, $request, $this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $source = ExpenseSource::find($id);
        return parent::p_show($source);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $source = ExpenseSource::find($id);

        return parent::p_edit($source,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $source = ExpenseSource::find($id);
        return parent::p_update($request, $source, $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $source = ExpenseSource::find($id);
        return parent::p_destroy($source, $this::rootURL);

    }

}
