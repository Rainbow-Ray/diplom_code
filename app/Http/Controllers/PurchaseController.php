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
use App\Http\Helpers\Item;
use App\Http\Helpers\PurchasedItem;
use App\Http\Utils\Utils;
use App\Models\Equip;
use App\Models\Material;
use App\Models\PurchaseRow;

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
        $columns = Purchase::all()->sortByDesc('date');;
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
        $num = Purchase::defNumber();

        return view("purchase/create", [
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'number' => $num,
            'equipCat' => $equipCat,
            'req' => null,
            'rootURL' => $this::rootURL
        ]);
    }
    public function createWithReq($reqId)
    {
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();
        $num = Purchase::defNumber();

        $req = ModelRequest::findOrFail($reqId);
        return view("purchase/create", [
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'number' => $num,

            'equipCat' => $equipCat,
            'req' => $req,
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
        $purch->number = $request['number'];

        $purch->save();


        if ($request['itemCheck'] != null) {
            $arr = PurchasedItem::getItems($request);
            foreach ($arr as $item) {
                $row = new PurchaseRow();

                $row->count = $item->count;
                $row->name = $item->name;
                $row->mat_id = $item->mat_id;
                $row->equip_id = $item->equip_id;
                // $row->ei_id =  $item->ei;
                $row->price = $item->price;

                $row->purch_id = $purch->id;

                $row->save();

                if(!is_null($row->mat_id )){
                    Material::add($row->mat_id, $row->count, $request['date']);
                }
                if(!is_null($row->equip_id )){
                    Equip::addEquip();

                }
            }
        }
        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = Purchase::findOrFail($id);

        return view('purchase.data', [
            'item' => $request,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();

        if (!is_null($purchase)) {
            return view("purchase/edit", [
                'item' => $purchase,
                'cats' => $cats,
                'types' => $types,
                'eis' => $eis,
                'equipCat' => $equipCat,
                'req' => null,
                'rootURL' => $this::rootURL
            ]);
        }
        return view("purchase/create", [
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'equipCat' => $equipCat,
            'req' => null,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pur = Purchase::findOrFail($id);

        if (!is_null($pur)) {
            $pur->date = $request['date'];
            $pur->number = $request['number'];


            $old = [];
            foreach ($pur->rows as $i) {
                $old[] = $i;
            }
            $new = [];

            if (is_null($request['itemCheck'])) {
            } else {

                $arr = PurchasedItem::getItems($request);

                foreach ($arr as $item) {
                    $row = new PurchaseRow();

                    $row->count = $item->count;
                    $row->name = $item->name;
                    $row->mat_id = $item->mat_id;
                    $row->equip_id = $item->equip_id;
                    // $row->ei_id =  $item->ei;
                    $row->price = $item->price;

                    $row->purch_id = $pur->id;
                    $new[] = $row;
                }
            }
            Utils::UpdateItems($old, $new);
        }
                    // return print_r($request);

        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pur = Purchase::findOrFail($id);
        $pur->delete();
        return redirect($this::rootURL);
    }
}
