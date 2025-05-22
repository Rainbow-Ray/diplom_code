<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Http\Normalizators\ReceiptNormalization;
use App\Models\Expense;
use App\Models\Income;
use App\Models\MatExp;
use App\Models\Order;
use App\Models\Receipt;
use App\View\Components\jsExpense;
use App\View\Components\jsIncome;
use App\View\Components\jsMessage;
use App\View\Components\jsOrder;
use App\View\Components\jsReceipt;
use App\View\Components\materialExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

enum Type
{
    case Order;
    case Receipt;
    case Income;
    case Expense;
    case MaterialExp;
}

class ResultArray
{
    public $arrResult = array();
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function toJson($result, $message)
    {
        if (!is_null($result) && count($result)>0) {
            foreach ($result as $res) {
                $v = FilterController::getComponent($this->type, $res);
                $arrResult[] = json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            }
            return json_encode($arrResult, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        }
        $mess = new jsMessage($message);
        $arrResult[] = json_encode($mess->viewRender(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        return json_encode($arrResult, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}

class FilterController extends Controller
{
    public static function getComponent($type, $res)
    {
        if ($type == Type::Order) {
            $comp = new jsOrder($res);
            return $comp->viewRender();
        }
        if ($type == Type::Receipt) {
            $comp = new jsReceipt($res);
            return $comp->viewRender();
        }
        if ($type == Type::Income) {
            $comp = new jsIncome($res);
            return $comp->viewRender();
        }
        if ($type == Type::Expense) {
            $comp = new jsExpense($res);
            return $comp->viewRender();
        }
        if ($type == Type::MaterialExp) {
            $comp = new materialExpense($res);
            return $comp->viewRender();
        }
    }

    public function order()
    {
        $filter = $_GET['filter'];
        $result = null;
        $res = new ResultArray(Type::Order);

        if ($filter == 'all') {
            $result = Order::orderBy('isUrgent', 'desc')
                ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))->get();
        }

        if ($filter == 'mine') {
            if (!is_null(Auth::user())) {
                $result = Order::where('isDone', 0)->join('Receipt', 'receipt_id', 'Receipt.id')
                    ->where('worker_id', Auth::user()->worker_id)
                    ->orderBy('isUrgent', 'desc')
                    ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))
                    ->get();
            }
        }

        if ($filter == 'done') {
            $result = Order::where('isDone', 1)->where('isHanded', 0)
                ->orderBy('isUrgent', 'desc')
                ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))
                ->get();
        }

        if ($filter == 'inWork') {
            $result = Order::where('isDone', 0)->where('isHanded', 0)
                ->orderBy('isUrgent', 'desc')
                ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))->get();
        }
        if ($filter == 'closed') {
            $result = Order::where('isHanded', 1)
                ->orderBy('isUrgent', 'desc')
                ->orderBy(Receipt::select("datePlan")->whereColumn('Receipt.id', '_Order.receipt_id')->orderBy('datePlan', 'desc'))
                ->get();
        }

        $json = $res->toJson($result, 'Нет заказов, подходящих под данный фильтр');
        return $json;
    }


    public function receipt()
    {
        $filter = $_GET['filter'];
        $result = null;
        $res = new ResultArray(Type::Receipt);

        if ($filter == 'all') {
            $result = Receipt::all()->sortByDesc('dateIn');;
        }

        if ($filter == 'open') {
            $result = Receipt::select('Receipt.*')->join('_Order', 'Receipt.id', '_Order.receipt_id')
                ->where('isHanded', 0)->get()->sortByDesc('dateIn');;
            // return $result;
        }
        if ($filter == 'ready') {
            $result = Receipt::select('Receipt.*')->join('_Order', 'Receipt.id', '_Order.receipt_id')
                ->where('isDone', 1)->where('isHanded', 0)->get()->sortByDesc('dateIn');;
            // return $result;
        }

        if ($filter == 'done') {
            $result = Receipt::select('Receipt.*')->join('_Order', 'Receipt.id', '_Order.receipt_id')
                ->where('isDone', 1)->where('isHanded', 1)->get()->sortByDesc('dateIn');;
            // return $result;
        }
        $json = $res->toJson($result,  'Нет квитанций, подходящих под данный фильтр');
        return $json;
        // FilterController::toJson($result, 'Нет квитанций, подходящих под данный фильтр');
    }

    public function income()
    {
        $filter = $_GET['filter'];
        $dateStart = $_GET['dateStart'];
        $dateEnd = $_GET['dateEnd'];
        $result = null;
        $res = new ResultArray(Type::Income);

        if ($filter == 'all') {
            $result = Income::all()->sortByDesc('date');
        }

        if ($filter == 'date') {
            $result = Income::where('date', '>=', $dateStart )->where('date', '<=', $dateEnd)->get()
            ->sortByDesc('date');
            // return $result;
        }
        $json = $res->toJson($result,  'Нет доходов');
        return $json;
        // FilterController::toJson($result, 'Нет квитанций, подходящих под данный фильтр');
    }
    public function expense()
    {
        $filter = $_GET['filter'];
        $dateStart = $_GET['dateStart'];
        $dateEnd = $_GET['dateEnd'];
        $result = null;
        $res = new ResultArray(Type::Expense);

        if ($filter == 'all') {
            $result = Expense::all()->sortByDesc('date');
        }

        if ($filter == 'date') {
            $result = Expense::where('date', '>=', $dateStart )->where('date', '<=', $dateEnd)->get()
            ->sortByDesc('date');
        }
        $json = $res->toJson($result,  'Нет расходов');
        return $json;
    }
    public function materialExp()
    {
        $filter = $_GET['filter'];
        $dateStart = $_GET['dateStart'];
        $dateEnd = $_GET['dateEnd'];
        $result = null;
        $res = new ResultArray(Type::MaterialExp);

        if ($filter == 'all') {
            $result = MatExp::selectRaw('
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
        }

        if ($filter == 'date') {
            $result = MatExp::selectRaw('
        MatExp.date, 
        MatExp.date as dateNow, 
        MatExp.id, 
        MatExp.amount, 
        MatExp.mat_id, 
        (Select COUNT(MatExp.id) from MatExp where MatExp.date = dateNow) as rowCount,
        (Select sum(MatExp.amount) from MatExp where MatExp.date = dateNow) as dateAmount
        ')
        ->where('date', '>=', $dateStart )->where('date', '<=', $dateEnd)
        ->orderByDesc('date')
        ->get();
        }


        $result = collect([$result]);




        $json = $res->toJson($result,  'Нет расходов материала');
        return $json;
    }
}







