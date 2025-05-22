<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Models\Receipt;
use App\Models\Customer;
use App\Models\Worker;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Normalizators\ReceiptNormalization;
use App\Http\Utils\Utils;
use App\Models\Order;
use App\Models\Service;

class ReceiptController extends Controller
{

    const rootURL = "receipt";
    const storeTitle = "Новая квитанция";
    const storeFormHeader = "Квитанция";
    const editTitle = "Редактировать квитанцию";
    const editFormHeader = "Квитанция";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $columns = Receipt::all()->sortByDesc('dateIn');
        foreach($columns as $i){
            $i = ReceiptNormalization::beautify_dates($i);
        }
        
        return view("receipt/receiptCard", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $workers = Worker::where('job_id', 1)->get();
        $services = Service::all();
        $number = Receipt::defNumber();
        
        return view('receipt/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, 'customers'=> $customers, 'workers'=> $workers,
        'number' => $number,
        'services'=> $services ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $receipt = new Receipt();
        $request = ReceiptNormalization::normalize($request);

        $receipt->item = $request['item'];
        $receipt->number = $request['number'];
        $receipt->dateIn = $request['dateIn'];
        $receipt->cost = $request['cost'];
        $receipt->dateOut = $request['dateOut'];
        $receipt->note = $request['note'];
        $receipt->costAdd = $request['costAdd'];
        $receipt->costPred = $request['costPred'];
        $receipt->datePlan = $request['datePlan'];
        $receipt->isPaid = $request['isPaid'];
        $receipt->paidNow = $request['paidNow'];
        $receipt->worker_id = $request['worker'];
        $receipt->customer_id = $request['customer'];

        $receipt->save();

        $data = [
            "count"=> $request['count'], 
            "countDone"=> 0, 
            "isDone"=> 0, 
            "isUrgent"=> $request['isUrgent'], 
            "receipt_id"=> $receipt->id, 
            "service_id" => $request['service']
        ];
        OrderController::store($data);

        if($receipt->isPaid){
            if($request['payment']==1){
                IncomeController::CreateExternal($request['payNumber'], $request['dateIn'], $request['amount'], $receipt->id);
            }
            else if($request['payment']==2){
                IncomeController::UpdateExternal($request, $receipt->id);
            }
            // $receipt->cost = $request['amount'];
            $receipt->paymentClose();
        }

        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = Receipt::findOrFail($id);

        return view('receipt.receiptData', ['item'=>$receipt]);
        return [$receipt->item,
        $receipt->dateIn,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt = Receipt::findOrFail($id);
        $customers = Customer::all();
        $workers = Worker::all();
        $services = Service::all();

        if (!is_null($receipt)){
            return view('receipt/edit', ["rootURL" => $this::rootURL,
            "receipt"=> $receipt, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, "customers"=>$customers,
            'workers' => $workers, 'services'=> $services
        ]);
        }
        return view('receipt/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, "customers"=>$customers,
            'workers' => $workers, 'services'=> $services]);
    }

    /**
     * Update the specified resource in storage.
     */

    public static function closeReceipt($id){
        $receipt = Receipt::findOrFail($id);

        if(!is_null($receipt)){
            $time = Utils::timeNow();
            if(!$receipt->order->isHandedOver()){
                $count = $receipt->order->count - $receipt->order->handedOverCount();
                OrderOutController::storeClosed($time, $count, $receipt->order->id);
            }
            $receipt->order->receiptClose();
            $receipt->dateOut = $time;
            $pred = is_null($receipt->costPred) ? 0 : $receipt->costPred;
            $add = is_null($receipt->costAdd) ? 0 : $receipt->costAdd;
            $receipt->cost = $pred + $add;
            
            $receipt->save();
        }

        return;
    }

    public function update(Request $request, string $id)
    {
        $receipt = Receipt::findOrFail($id);
        $request = ReceiptNormalization::normalize($request);

        if (!is_null($receipt)){
            $receipt->item = $request['item'];
            $receipt->dateIn = $request['dateIn'];
            $receipt->cost = $request['cost'];
            $receipt->dateOut = $request['dateOut'];
            $receipt->note = $request['note'];
            $receipt->costAdd = $request['costAdd'];
            $receipt->costPred = $request['costPred'];
            $receipt->datePlan = $request['datePlan'];
            $receipt->isPaid = $request['isPaid'];
            $receipt->paidNow = $request['paidNow'];
            $receipt->worker_id = $request['worker'];
            $receipt->customer_id = $request['customer'];
            $receipt->save();

            if(!is_null($receipt->order->id)){
                $data = [
                    "count"=> $request['count'], 
                    "service_id" => $request['service'],
                    "isHanded" => $request['isHanded'],
                    "isUrgent" => $request['isUrgent']
                ];
                OrderController::updateFromReceipt($data, $receipt->order->id);        
            }
        }
        return redirect( $this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
        return redirect( $this::rootURL);

    }





}
