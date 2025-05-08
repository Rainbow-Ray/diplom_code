<?php

namespace App\Http\Controllers;

use App\Models\IncomeSource;
use Illuminate\Http\Request;

class IncomeSourceController extends DictController
{
    const rootURL = "income_source";
    const storeTitle = "Новый источник дохода";
    const storeFormHeader = "Источник дохода";
    const editTitle = "Редактировать источник дохода";
    const editFormHeader = "Источник дохода";

    public function index()
    {
        $columns = IncomeSource::all();
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
        $source = new IncomeSource();
        return parent::p_store($source, $request, $this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $source = IncomeSource::find($id);
        return parent::p_show($source);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $source = IncomeSource::find($id);

        return parent::p_edit($source,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $source = IncomeSource::find($id);
        return parent::p_update($request, $source, $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $source = IncomeSource::find($id);
        return parent::p_destroy($source, $this::rootURL);

    }
}
