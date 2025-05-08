<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Skill;

class SkillController extends DictController
{
    const rootURL = "skill";
    const storeTitle = "Новый навык сотрудника";
    const storeFormHeader = "Навык сотрудника";
    const editTitle = "Редактировать навык сотрудника";
    const editFormHeader = "Навык сотрудника";
    public function index()
    {
        $columns = Skill::orderBy('name')->get();
        return parent::p_index($columns, $this::rootURL, $this::storeFormHeader);

    }

    public function create() : View
    {
        return parent::p_create($this::rootURL,  $this::storeTitle,$this::storeFormHeader);
    }

    public function store(Request $request)
    {
        $skill = new Skill();
        return parent::p_store($skill, $request, $this::rootURL);
    }

    public function show(string $id)
    {
        $skill = Skill::find($id);
        return parent::p_show($skill);

    }

    public function edit(string $id) : View
    {
        $skill = Skill::find($id);

        return parent::p_edit($skill,  $this::rootURL, $this::editTitle, $this::editFormHeader,
        $this::storeTitle, $this::storeFormHeader);
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);
        return parent::p_update($request, $skill, $this::rootURL);
    }

    public function destroy($id)
    {
        $skill = Skill::find($id);
        return parent::p_destroy($skill, $this::rootURL);
    }
}