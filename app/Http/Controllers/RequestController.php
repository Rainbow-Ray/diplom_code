<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use App\Models\Ei;
use App\Models\EquipType;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use App\Models\Worker;
use App\Models\Request as ModelRequest;
use App\Models\RequestRow;
use Illuminate\Http\Request;
use App\Http\Helpers\Item;


class RequestController extends Controller
{

    const rootURL = "request";
    const storeTitle = "Новый запрос";
    const storeFormHeader = "Запрос на закупку";
    const editTitle = "Редактировать запрос";
    const editFormHeader = "Запрос на закупку";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = ModelRequest::all()->sortByDesc('dateCreated');;
        foreach ($columns as $i) {
            $i['dateCreated'] = Normalization::beautify_date_from_str($i['dateCreated']);
            $i['dateClosed'] = Normalization::beautify_date_from_str($i['dateClosed']);
        }
        return view("request/card", [
            'items' => $columns,
            'rootURL' => $this::rootURL
        ]);
    }

    public function closeRequest($id)
    {
        $req = ModelRequest::findOrFail($id);
        if (!is_null($req)) {
            $req->isDone = 1;
            $time = Utils::timeNow();
            $req->dateClosed = $time;
            $req->save();
        }

        return redirect(RequestController::rootURL . '/' . $id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workers = Worker::all();
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();
        $number = ModelRequest::defNumber();

        return view("request/create", [
            'workers' => $workers,
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'equipCat' => $equipCat,
            'number' => $number,

            'rootURL' => $this::rootURL
        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $req = new ModelRequest();
        $request['isUrgent'] = Normalization::normalize_checkbox($request['isUrgent']);

        $req->number = $request['number'];
        $req->dateCreated = $request['dateCreated'];
        $req->isUrgent = $request['isUrgent'];
        $req->worker_id = $request['worker'];
        $req->save();


        if ($request['itemCheck'] != null) {
            $arr = Item::getItems($request);
            foreach ($arr as $item) {
                $row = new RequestRow();

                $row->count = $item->count;
                // $row->name = $item->name;
                $row->mat_id = $item->mat_id;
                $row->equip_id = $item->equip_id;
                // $row->ei_id =  $item->ei;
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
        $request = ModelRequest::findOrFail($id);

        return view('request.data', [
            'item' => $request,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $request = ModelRequest::findOrFail($id);
        $workers = Worker::all();
        $cats = MaterialCat::all();
        $types = MaterialType::all();
        $eis = Ei::all();
        $equipCat = EquipType::all();

        if (!is_null($request)) {
            return view("request/edit", [
                'item' => $request,
                'workers' => $workers,
                'cats' => $cats,
                'types' => $types,
                'eis' => $eis,
                'equipCat' => $equipCat,
                'rootURL' => $this::rootURL
            ]);
        }
        return view("request/create", [
            'workers' => $workers,
            'cats' => $cats,
            'types' => $types,
            'eis' => $eis,
            'equipCat' => $equipCat,

            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    static function tableRowsToArray($rows)
    {
        $arr = [];
        for ($i = 0; $i < count($rows) - 1; $i += 2) {
            $itemType = $rows[$i][0];
            $id_name = substr($rows[$i], 1);
            $count = $rows[$i + 1];
            $ei = null;
            if (str_contains($rows[$i + 1], " ")) {
                $count = explode(' ', $rows[$i + 1])[0];
                $ei = explode(' ', $rows[$i + 1])[1];
            }

            $arr[$itemType . $id_name] = [$count, $ei];
        }
        return $arr;
    }

    public function update(Request $request, string $id)
    {
        $req = ModelRequest::findOrFail($id);

        if (!is_null($req)) {

            $request['isUrgent'] = Normalization::normalize_checkbox($request['isUrgent']);
             $req->number = $request['number'];

            $req->dateCreated = $request['dateCreated'];
            $req->isUrgent = $request['isUrgent'];
            $req->worker_id = $request['worker'];
            $req->save();

            $old = [];
            foreach ($req->rows as $i) {
                $old[] = $i;
            }
            $new = [];

            if (is_null($request['itemCheck'])) {
            } else {

                $arr = Item::getItems($request);

                foreach ($arr as $item) {
                    $row = new RequestRow();

                    $row->count = $item->count;
                    // $row->name = $item->name;
                    $row->mat_id = $item->mat_id;
                    $row->equip_id = $item->equip_id;
                    // $row->ei_id =  $item->ei;
                    $row->req_id = $req->id;
                    $new[] = $row;
                }
            }
            Utils::UpdateItems($old, $new);
        }
        return redirect($this::rootURL);
    }


    // public function update(Request $request, string $id)
    // {
    //     $req = ModelRequest::findOrFail($id);

    //     if (!is_null($req)){

    //         $request['isUrgent'] = Normalization::normalize_checkbox($request['isUrgent']);

    //         $req->dateCreated = $request['dateCreated'];
    //         $req->isUrgent = $request['isUrgent'];
    //         $req->worker_id = $request['worker'];


    //         $old = [];
    //         foreach ($req->rows as $i) {
    //             $old[]=$i;
    //         }
    //         $new = [];

    //         if (is_null($request['itemCheck'])) {
    //         }
    //         else{


    //             for ($i = 0; $i < count($request['itemCheck']) - 1; $i += 2) {

    //                 $itemType = $request['itemCheck'][$i][0];
    //                 $id_name = substr($request['itemCheck'][$i], 1);
    //                 $count = $request['itemCheck'][$i + 1];
    //                 $ei = null;
    //                 if (str_contains($request['itemCheck'][$i + 1], " ")) {
    //                     $count = explode(' ', $request['itemCheck'][$i + 1])[0];
    //                     $ei = explode(' ', $request['itemCheck'][$i + 1])[1];
    //                 }

    //                 $row = new RequestRow();

    //                 $row->count = $count;
    //                 if ($itemType == "I") {
    //                     $row->name = $id_name;
    //                 } elseif ($itemType == "M") {
    //                     $row->mat_id = $id_name;
    //                 } elseif ($itemType == "F") {
    //                     $row->equip_id = $id_name;
    //                 }

    //                 $row->ei_id = $ei;
    //                 $row->req_id = $req->id;

    //                 $new[]= $row;

    //             }
    //         }
    //         $this::UpdateItems($old, $new);
    //     }
    //     return redirect( $this::rootURL);

    // }

    static function printArray($arr)
    {
        foreach ($arr as $i) {
            echo $i;
            echo '<br>';
        }
        echo '---------------<br>';
    }
    static function printItemsArray($arr)
    {
        foreach ($arr as $i) {
            echo $i->print();
            echo '<br>';
        }
        echo '---------------<br>';
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $req = ModelRequest::findOrFail($id);
        $req->delete();
        return redirect($this::rootURL);
    }
}


    // public function store(Request $request)
    // {

    //     $req = new ModelRequest();
    //     $request['isUrgent'] = Normalization::normalize_checkbox($request['isUrgent']);

    //     $req->dateCreated = $request['dateCreated'];
    //     $req->isUrgent = $request['isUrgent'];
    //     $req->worker_id = $request['worker'];
    //     $req->save();


    //     if ($request['itemCheck'] != null) {
    //         for ($i = 0; $i < count($request['itemCheck']) - 1; $i += 2) {
    //             $itemType = $request['itemCheck'][$i][0];
    //             $id_name = substr($request['itemCheck'][$i], 1);
    //             $itemsCountPrice = explode('|', $request['itemCheck'][$i + 1]);

    //             $count = $itemsCountPrice[0];
    //             if (count($itemsCountPrice)>1) {
    //                 $ei = $itemsCountPrice[1];
    //             }

    //             if($ei==''|| $ei=='null'){
    //                 $ei = null;
    //             }

    //             $row = new RequestRow();

    //             $row->count = $count;
    //             if ($itemType == "I") {
    //                 $row->name = $id_name;
    //             } elseif ($itemType == "M") {
    //                 $row->mat_id = $id_name;
    //             } elseif ($itemType == "F") {
    //                 $row->equip_id = $id_name;
    //             }

    //             $row->ei_id = $ei;
    //             $row->req_id = $req->id;

    //             $row->save();
    //         }
    //     }
    //     return redirect($this::rootURL);
    // }
