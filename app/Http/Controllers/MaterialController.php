<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\Ei;
use App\Models\Material;
use App\Models\MaterialCat;
use App\Models\MaterialType;
use App\Models\MatExp;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    const rootURL = "materials";
    const storeTitle = "Новый материал";
    const storeFormHeader = "Материал";
    const editTitle = "Редактировать материал";
    const editFormHeader = "Материал";

    public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }


    static function getMaterialByCat($cat)
    {
        return Material::join('MaterialType', 'Material.type_id', '=', 'MaterialType.id')->where('cat_id', $cat)->select('Material.*')->get()->sortBy('name');
        //  return Material::join('MaterialType', 'Material.type_id', '=', 'MaterialType.id')->where('cat_id', $cat)->get();
    }

    public function show_accessories()
    {
        $columns = $this::getMaterialByCat(1);
        return view('material.card', ['title' => 'Аксессуары', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_locks()
    {
        $columns = $this::getMaterialByCat(2);
        return view('material.card', ['title' => 'Замки', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_key_auto()
    {
        $columns = $this::getMaterialByCat(3);
        return view('material.card', ['title' => 'Автомобильные ключи', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_key_door()
    {
        $columns = $this::getMaterialByCat(4);
        return view('material.card', ['title' => 'Замочные ключи', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_furniture()
    {
        $columns = $this::getMaterialByCat(5);
        return view('material.card', ['title' => 'Фурнитура', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_leather()
    {
        $columns = $this::getMaterialByCat(6);
        return view('material.card', ['title' => 'Кожа', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_matOther()
    {
        $columns = $this::getMaterialByCat(7);
        return view('material.card', ['title' => 'Прочие материалы', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }
    public function show_item()
    {
        $columns = $this::getMaterialByCat(8);
        return view('material.card', ['title' => 'Изделия', 'createURL' => 'materials', 'items' => $columns, 'rootURL' => $this::rootURL]);
    }

    public static function apiIndex()
    {
        $type =  $_GET['type'];
        $cat =  $_GET['cat'];

        $a = 'sas';
        if ($type == null) {
            if ($cat == null) {
                $mat = Material::select('Material.id', 'Material.name', 'Ei.name as ei')
                    ->join('Ei', 'Material.ei_id', 'Ei.id')
                    ->get();
            } else {

                $mat = Material::select('Material.id', 'Material.name', 'Ei.name as ei')
                    ->join('Ei', 'Material.ei_id', 'Ei.id')
                    ->join('MaterialType', 'Material.type_id', 'MaterialType.id')
                    ->where('cat_id', $cat)->get();
            }
        } else {
            $mat = Material::select('Material.id', 'Material.name', 'Ei.name as ei')->where('type_id', $type)
                ->join('Ei', 'ei_id', 'Ei.id')->get();
        }
        return json_encode($mat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
    public static function apiCat()
    {
        $cat =  $_GET['cat'];

        if ($cat == null) {
            $mat = Material::all();
        } else {
            $mat = Material::select('Material.name', 'Material.id')->join('MaterialType', 'Material.type_id', 'MaterialType.id')->where('cat_id', $cat)->get();
        }
        return json_encode($mat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }


    public function index()
    {
        $columns = Material::all()->sortBy('name');

        return view("material/card", ['title' => 'Материалы', 'createURL' => $this::rootURL, 'editURL' => $this::rootURL, 'items' => $columns, 'rootURL' => $this::rootURL]);
    }



    public function expenseShow()
    {
        $types = MaterialType::all();
        $cats = MaterialCat::all();
        $mats = Material::all();

        return view('material/expense', [
            "rootURL" => $this::rootURL,
            'types' => $types,
            'cats' => $cats,
            'mats' => $mats,

        ]);
    }

    public function expenseEdit(Request $req)
    {
        $types = MaterialType::all();
        $cats = MaterialCat::all();
        $mats = Material::all();

        $exp = MatExp::selectRaw(
'        MatExp.date, 
        MatExp.id, 
        MatExp.amount, 
        MatExp.mat_id
'
        )->where('date', $req['date'])->get();

        return view('material/expenseEdit', [
            "rootURL" => $this::rootURL,
            'types' => $types,
            'cats' => $cats,
            'mats' => $mats,
            'exp' => $exp,

        ]);
    }

    public function expenseEditsave(Request $req)
    {
        $date = $req['date'];
        $expOld = MatExp::where('date', $date)->delete();

        MaterialController::expenseAdd($req);
        return redirect('materialExp');
    }

    public static function expenseAdd(Request $req)
    {
        $date = $req['date'];
        $items = $req['items'];

        if (!is_null($items) && count($items) > 0) {
            for ($i = 0; $i < count($items) - 1; $i++) {

                $id = $items[$i];
                $count = $items[$i+1];

                if (is_null($count)) {
                    $count = 0;
                }
                if (!is_null($id)) {
                    Material::sub($id, $count, $date);
                }
            }
        }
        return redirect('materialExp');
    }

    public function expenseIndex()
    {
        $mats = MatExp::selectRaw('
        MatExp.date, 
        MatExp.date as dateNow, 
        MatExp.id, 
        MatExp.amount, 
        MatExp.mat_id, 
        (Select COUNT(MatExp.id) from MatExp where MatExp.date = dateNow) as rowCount,
        (Select sum(MatExp.amount) from MatExp where MatExp.date = dateNow) as dateAmount
        ')
        ->orderByDesc('date')
        ->get();

        // return $mats;
        // return $mats;

        return view('material/expenseCard', ['items' => $mats]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::all();
        $cats = MaterialCat::all();

        return view('material/create', [
            "rootURL" => $this::rootURL,
            "title" =>  $this::storeTitle,
            "formHeader" => $this::storeFormHeader,
            'eis' => $eis,
            'countries' => $countries,
            'colors' => $colors,
            'types' => $types,
            'cats' => $cats,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = new Material();

        $material->name = $request['name'];
        // $material->amount = $request['amount'];
        // $material->min_amount = $request['min_amount'];
        $material->ei_id = $request['ei'];
        $material->country_id = $request['country'];
        $material->color_id = $request['color'];
        $material->type_id = $request['type'];
        $material->save();

        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::findOrFail($id);

        return view('material/data', [
            'item' => $material,
            "rootURL" => $this::rootURL,

        ]);
        return [
            $material->name,
            $material->amount,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = Material::findOrFail($id);
        $eis = Ei::all();
        $countries = Country::all();
        $colors = Color::all();
        $types = MaterialType::all();
        $cats = MaterialCat::all();

        if (!is_null($material)) {
            return view('material/edit', [
                "rootURL" => $this::rootURL,
                "item" => $material,
                'title' => $this::editTitle,
                "formHeader" => $this::editFormHeader,
                'eis' => $eis,
                'countries' => $countries,
                'colors' => $colors,
                'types' => $types,
                'cats' => $cats,

            ]);
        }
        return view('material/create', [
            "rootURL" => $this::rootURL,
            "title" =>  $this::storeTitle,
            "formHeader" => $this::storeFormHeader,
            'eis' => $eis,
            'countries' => $countries,
            'colors' => $colors,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        if (!is_null($material)) {
            $material->name = $request['name'];
            // $material->amount = $request['amount'];
            // $material->min_amount = $request['min_amount'];
            $material->ei_id = $request['ei'];
            $material->country_id = $request['country'];
            $material->color_id = $request['color'];
            $material->type_id = $request['type'];
            $material->save();
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect($this::rootURL);
    }
}
