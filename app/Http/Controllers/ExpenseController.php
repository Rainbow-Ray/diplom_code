<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\IncomeNormalization;
use App\Http\Normalizators\Normalization;
use App\Models\Expense;
use App\Models\ExpenseSource;
use App\Models\Worker;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    const rootURL = "expense";
    const storeTitle = "Новый расход";
    const storeFormHeader = "Расход";
    const editTitle = "Редактировать расход";
    const editFormHeader = "расход";


        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    public function index()
    {
        $columns = Expense::all()->sortByDesc('date');
        foreach($columns as $i){
            $i->date = Normalization::beautify_date_from_str($i->date);
        }
        
        return view("expense/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }


    public function create()
    {
        $sources = ExpenseSource::all();
        $workers = Worker::all();
        
        return view('expense/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 'sources'=> $sources, 'workers'=> $workers
    
    ]);
    }


    public function store(Request $request)
    {
        $expense = new Expense();

        $expense->date = $request['date'];
        $expense->amount = $request['amount'];
        $expense->source_id = $request['source'];
        $expense->worker_id = $request['worker'];

        $expense->save();

        return redirect($this::rootURL);

    }

    public static function CreateExternal($date, $amount, $workerId){
        $expense = new Expense();

        $expense->date = $date;
        $expense->amount = $amount;
        $expense->source_id = 2;
        $expense->worker_id = $workerId;

        $expense->save();
    }

    public function show(string $id)
    {
        $receipt = Expense::findOrFail($id);
        return [$receipt->date,
        $receipt->amount,
        ];

    }

    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        $sources = ExpenseSource::all();
        $workers = Worker::all();

        if (!is_null($expense)){
            return view('expense/edit', ["rootURL" => $this::rootURL,
            "expense"=> $expense, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, "sources"=>$sources,
            'workers'=> $workers
            
        ]);
        }
        return view('expense/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, "sources"=>$sources,
        'workers'=> $workers
            ]);
    }


    public function update(Request $request, string $id)
    {
        $expense = Expense::findOrFail($id);

        if (!is_null($expense)){
            $expense->date = $request['date'];
            $expense->amount = $request['amount'];
            $expense->source_id = $request['source'];
            $expense->worker_id = $request['worker'];

            $expense->save();

        }
        return redirect( $this::rootURL);
    }

    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return redirect( $this::rootURL);
    }




}
