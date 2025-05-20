<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainMenuController extends Controller
{
    public function index()
    {

        $query = "SELECT * FROM `Receipt` INNER JOIN `_Order` ON _Order.receipt_id = Receipt.id WHERE _Order.isDone=1 AND _Order.isHanded = 0;";

        $receipt = DB::table('Receipt')->join('_Order', '_Order.receipt_id', '=', 'Receipt.id')
            ->join('Customer', "customer_id", "Customer.id")
            ->select('*')->where('_Order.isDone', 1)->where("_Order.isHanded", 0)->get();

        $order = Order::where('isHanded', 0)->where('isDone', 0)->get();

        $equip = Equip::getNeedReplace();


        // $doneOrders = Order::where('isDone', 1);
        // foreach ($doneOrders as $order){
        //     $order->receipt;
        // }
        return view('mainMenu', ['receipt' => $receipt, 
        'order' => $order,
        'equip' => $equip,
    ]);
    }
}
