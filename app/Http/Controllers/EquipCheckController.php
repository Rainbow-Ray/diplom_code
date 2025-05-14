<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\EquipCheck;
use App\Models\EquipType;
use App\Models\State;
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

    public function createWithEquipId($id)
    {
        $equip = Equip::findOrFail($id);
        if(!is_null($equip)){
        $state = State::all();
        return view('equipCheck/create', ["rootURL"=> EquipCheckController::rootURL, "title"=>  EquipCheckController::storeTitle, 
        "formHeader"=> EquipCheckController::storeFormHeader, 'equipStates'=> $state, 'equip'=>$equip]);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $c = new EquipCheck();
            $c->equip_id = $request['equip'];
            $c->state_id = $request['equip_state'];
            $c->date = $request['date'];

            $c->save();

        return(redirect('equip'));
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
