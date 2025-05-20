<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\IncomeNormalization;
use App\Models\Income;
use App\Models\IncomeSource;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    const rootURL = "income";
    const storeTitle = "Новый доход";
    const storeFormHeader = "Доход";
    const editTitle = "Редактировать доход";
    const editFormHeader = "Доход";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Income::all()->sortByDesc('date');
        foreach($columns as $i){
            $i = IncomeNormalization::beautify_datetime($i);
        }
        
        return view("income/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sources = IncomeSource::all();
        
        return view('income/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 'sources'=> $sources]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $income = new Income();

        $income->date = $request['date'];
        $income->amount = $request['amount'];
        $income->source_id = $request['source'];
        $income->number = $request['number'];

        $income->save();

        return redirect($this::rootURL);

    }

    public static function CreateExternal($number, $date, $amount, $receiptId){
        $income = new Income();
        $income->number = $number;
        $income->date = $date;
        $income->amount = $amount;
        $income->source_id = 1;
        $income->receipt_id= $receiptId;

        $income->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = Income::findOrFail($id);
        return [$receipt->date,
        $receipt->amount,
        ];

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $income = Income::findOrFail($id);
        $sources = IncomeSource::all();

        if (!is_null($income)){
            return view('income/edit', ["rootURL" => $this::rootURL,
            "income"=> $income, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, "sources"=>$sources,
            
        ]);
        }
        return view('income/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, "sources"=>$sources,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $income = Income::findOrFail($id);

        if (!is_null($income)){
            $income->date = $request['date'];
            $income->amount = $request['amount'];
            $income->source_id = $request['source'];

            $income->save();

        }
        return redirect( $this::rootURL);
    }

    public static function UpdateExternal(Request $request, $receiptId){
        $income = Income::findOrFail($request["check"]);

        if (!is_null($income)){
            $income->receipt_id = $receiptId;
            $income->save();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect( $this::rootURL);
    }

}
