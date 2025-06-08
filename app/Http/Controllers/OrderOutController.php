<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use Illuminate\Http\Request;
use App\Models\OrderOut;
use App\Models\Receipt;

class OrderOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function hand_over(string $id){
        $receipt = Receipt::findOrFail($id);
        if (!is_null($receipt)){
            return view('order/cardHandOver', ["rootURL" => ReceiptController::rootURL,
            "receipt"=> $receipt, 
            'title'=>ReceiptController::editTitle, "formHeader"=>ReceiptController::editFormHeader, 
        ]);
        }
    }

    public function hand_over_done(Request $request, string $id){
        $receipt = Receipt::findOrFail($id);

        if (!is_null($receipt)){

            $this::store($request, $receipt);

            if($request['isHanded'] == 1){
                $var = ReceiptController::closeReceipt($id, $request['date']);
            }
        }
        return redirect( ReceiptController::rootURL);
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(Request $request, $receipt)
    {
        $order = new OrderOut();
        $request['isFail'] = Normalization::normalize_checkbox($request['isFail']);
        $request['isHanded'] = Normalization::normalize_checkbox($request['isHanded']);
        
        $order->date = $request['date'];
        $order->count = $request['count'];
        $order->note = $request['note'];
        $order->isFail = $request['isFail'];
        $order->order_id = $receipt->order->id;
        $order->save();

        if($request['isFail'] == 0){
            if($request['payment']==1){
                IncomeController::CreateExternal($request['payNumber'],$request['date'], $request['amount'], $receipt->id);
            } 
            else if($request['payment']==2){
                IncomeController::UpdateExternal($request, $receipt->id);
            }
            $receipt->paymentClose();
        }
        else{
            ExpenseController::CreateExternal($request['date'], $request['amount'], $receipt->worker->id, $order->id);
        }

        if($request['isFail'] == 1){
            $order->order->countDone -= $order->count;
            $order->order->isDone = 0;
            $order->order->save();
        }

        if($request['isHanded'] == 1){
            $receipt->order->handOver();
        }

        return redirect(ReceiptController::rootURL);
    }

    public static function storeClosed($date, $count, $orderId){
        $order = new OrderOut();
        $order->date = $date;
        $order->count = $count;
        $order->isFail = 0;
        $order->order_id = $orderId;
        $order->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
