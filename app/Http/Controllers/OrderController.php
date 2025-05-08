<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Http\Normalizators\ReceiptNormalization;
use App\Models\Order;
use App\Models\OrderOut;
use App\Models\Receipt;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const rootURL = "order";
    const storeTitle = "Новый заказ";
    const storeFormHeader = "Заказ";
    const editTitle = "Редактировать заказ";
    const editFormHeader = "Заказ";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Order::orderBy('isUrgent', 'desc')
        ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))->get();

        foreach($columns as $i){
            $i->receipt = ReceiptNormalization::beautify_dates($i->receipt);
        }
        return view("order/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store($data)
    {
        $order = new Order();


        $order->count = $data['count'];
        $order->countDone = $data['countDone'];
        $order->isDone = $data['isDone'];
        $order->isUrgent = $data['isUrgent'];
        $order->receipt_id = $data['receipt_id'];
        $order->service_id = $data['service_id'];

        $order->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        return view('singleItemShow', ['view'=>'order.cardData','item'=>$order]);
        return $order->isDone;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        if (!is_null($order)){
            $order->receipt = ReceiptNormalization::beautify_dates($order->receipt);
            return view('order/edit', ["rootURL" => $this::rootURL,
            "order"=> $order, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader
        ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public static function updateFromReceipt($data, string $id)
    {
        $order = Order::findOrFail($id);

        if(!is_null($order)){
            $order->count = $data['count'];
            $order->service_id = $data['service_id'];
            $order->isHanded = $data['isHanded'];
            $order->isUrgent = $data['isUrgent'];
            $order->save();
        }
    }


    public function update(Request $data, string $id)
    {
        $order = Order::findOrFail($id);
        $isDone = Normalization::normalize_checkbox( $data['isDone']);

        if(!is_null($order)){
            $done = $order->countDone + $data['countDone'];
            if($done >=0){
                $order->countDone = $done;
            }
            else{
                $order->countDone = 0;
            }
            if($done >= $order->count){
                $isDone = 1;
            }
            $order->isDone = $isDone;
            $order->save();
        }
        return redirect( $this::rootURL);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
