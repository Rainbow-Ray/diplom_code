<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Models\Ei;
use App\Models\EquipType;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use App\Models\Purchase;
use App\Models\Request as ModelRequest;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    const rootURL = "purchase";
    const storeTitle = "Новая закупка";
    const storeFormHeader = "Закупка";
    const editTitle = "Редактировать закупку";
    const editFormHeader = "Закупка";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Purchase::all();
        foreach ($columns as $i) {
            $i['date'] = Normalization::beautify_date_from_str($i['dateCreated']);
        }
        return view("purchase/card", [
            'items' => $columns,
            'rootURL' => $this::rootURL
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();

        return view("purchase/create", [
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'equipCat' => $equipCat,
            'req'=> null,
            'rootURL' => $this::rootURL
        ]);
    }
    public function createWithReq($reqId)
    {
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();
        $req = ModelRequest::findOrFail($reqId);
        return view("purchase/create", [
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'equipCat' => $equipCat,
            'req'=> $req,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purch = new Purchase();

        $purch->date = $request['date'];
        $purch->save();


        if ($request['itemCheck'] != null) {
            for ($i = 0; $i < count($request['itemCheck']) - 1; $i += 2) {

                $itemType = $request['itemCheck'][$i][0];
                $id_name = substr($request['itemCheck'][$i], 1);
                $count = $request['itemCheck'][$i + 1];
                $ei = null;
                $price = null;
                if (str_contains($request['itemCheck'][$i + 1], " ")) {
                    $arrCountPrice = explode(' ', $request['itemCheck'][$i + 1]);
                    
                    $count = [0];
                    $ei = explode(' ', $request['itemCheck'][$i + 1])[1];
                    $price = explode(' ', $request['itemCheck'][$i + 1])[2];
                }

                $row = new RequestRow();

                $row->count = $count;
                if ($itemType == "I") {
                    $row->name = $id_name;
                } elseif ($itemType == "M") {
                    $row->mat_id = $id_name;
                } elseif ($itemType == "F") {
                    $row->equip_id = $id_name;
                }

                $row->ei_id = $ei;
                $row->req_id = $req->id;

                $row->save();
            }
        }
        return redirect($this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
