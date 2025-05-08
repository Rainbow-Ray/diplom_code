<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\State;

class StateController extends DictController
{
    const rootURL = "state";
    const storeTitle = "Новое состояние оборудования";
    const storeFormHeader = "Состояние оборудования";
    const editTitle = "Редактировать состояние оборудования";
    const editFormHeader = "Состояние оборудования";
    public function index()
    {
        $columns = State::all();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    public function store(Request $request)
    {
        $state = new State();
        return parent::p_store($state, $request, $this::rootURL);
    }

    public function show(string $id)
    {
        $state = State::find($id);
        return parent::p_show($state);

    }

    public function edit(string $id) : View
    {
        $state = State::find($id);

        return parent::p_edit($state,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    public function update(Request $request, $id)
    {
        $state = State::find($id);
        return parent::p_update($request, $state, $this::rootURL);
    }

    public function destroy($id)
    {
        $state = State::find($id);
        return parent::p_destroy($state, $this::rootURL);
    }
}