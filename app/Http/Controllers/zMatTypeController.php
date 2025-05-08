<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\MatType;

class MatTypeController extends DictController
{
    const rootURL = "mat_type";
    const storeTitle = "Новый тип материала";
    const storeFormHeader = "Тип материала";
    const editTitle = "Редактировать тип материала";
    const editFormHeader = "Тип материала";
    
    public function index()
    {
        $columns = MatType::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    public function store(Request $request)
    {
        $mType = new MatType();
        return parent::p_store($mType, $request, $this::rootURL);
    }

    public function show(string $id)
    {
        $mType = MatType::find($id);
        return parent::p_show($mType);

    }

    public function edit(string $id) : View
    {
        $mType = MatType::find($id);

        return parent::p_edit($mType,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    public function update(Request $request, $id)
    {
        $mType = MatType::find($id);
        return parent::p_update($request, $mType, $this::rootURL);
    }

    public function destroy($id)
    {
        $mType = MatType::find($id);
        return parent::p_destroy($mType, $this::rootURL);
    }
}