<?php

namespace App\Http\Controllers\Reports;

use  App\Http\Controllers\Controller;
use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Receipt;
use App\Models\Order;
use App\Models\PurchaseRow;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/mainPage');
    }

    public function incomeAndExpense()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Доходы и расходы предприятия за период',
            'url' => 'incomes'
        ]);
    }

    public function orderIncome()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Доход за заказы ',
            'url' => 'orderIncome'
        ]);
    }

    public function orderMaterial()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Затраченные материалы за период ',
            'url' => 'orderMaterial'
        ]);
    }
    public function worker()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Количество выполненных заказов на мастера  ',
            'url' => 'worker'
        ]);
    }
    public function customer()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Постоянные клиенты',
            'url' => 'customer'
        ]);
    }

    public function incomeMedian()
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        return view('report/reportForm', [
            'title' => 'Изменение прибыли предприятия за период',
            'url' => 'incomeMedian'
        ]);
    }


    public function incomeAndExpenseForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");

        $income = Income::where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->join('IncomeSource', 'Income.source_id', 'IncomeSource.id')
            ->selectRaw('IncomeSource.name ,source_id , sum(amount) as sum')
            ->groupBy('source_id')->get();


        $expense = PurchaseRow::selectRaw('"Закупки" as `name`, -1 as id, sum(count * price) as sum')
        ->join('Purchase', 'Purchase.id', 'PurchaseRow.purch_id')
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->union(
                Expense::where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
                    ->join('ExpenseSource', 'Expense.source_id', 'ExpenseSource.id')
                    ->whereNot('Expense.source_id', 2)
                    ->selectRaw('ExpenseSource.name ,source_id , sum(amount) as sum ')
                    ->groupBy('source_id')
            );

        $fail = Expense::where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->join('ExpenseSource', 'Expense.source_id', 'ExpenseSource.id')
            ->where('Expense.source_id', 2)
            ->selectRaw('ExpenseSource.name ,source_id , sum(amount) * 1.1 as sum ')
            ->groupBy('source_id');

        $expense = $expense->union($fail)->get();

        $incSum = $income->sum('sum');
        $expSum = $expense->sum('sum');
        $profit = $incSum - $expSum;

        $row = ReportController::concat($income, $expense, 'i', 'e');

        if (is_null($row)) {
            $row = array();
        }

        return view('report/incomeExpenseReport', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'rows' => $row,
            'iItog' => $incSum,
            'eItog' => $expSum,
            'profit' => $profit
        ]);
    }


    public function orderIncomeForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");

        // $order = Order::join('Receipt', '_Order.receipt_id', 'Receipt.id')->where('dateIn', '>', $dateStart)
        //     ->where('dateIn', '<', $dateEnd)->where('isPaid', 1)->where('cost', '>', 0)
        //     ->get();

        $order = Order::join('Receipt', '_Order.receipt_id', 'Receipt.id')->where('dateIn', '>=', $dateStart)
            ->where('dateIn', '<=', $dateEnd)->where('isPaid', 1)->where('cost', '>', 0)->get();

        // $order = Receipt::where('dateIn', '>=', $dateStart)
        //     ->where('dateIn', '<=', $dateEnd)->where('isPaid', 1)->get();

        // $order = Order::join('Receipt', '_Order.receipt_id', 'Receipt.id')->where('dateIn', '>', $dateStart)
        //     ->where('dateIn', '<', $dateEnd)->where('isPaid', 1)->where('cost', '>', 0)
        //     ->get();

        $orderSumm = $order->sum('cost');
        $avgSumm = $order->avg('cost');
        $countItog = $order->sum('count');

        return (view('report/orderIncomeReport', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'rows' => $order,
            'summ' => $orderSumm,
            'avg' => $avgSumm,
            'countItog' => $countItog,
        ]));
    }


    public function orderMaterialForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");

        $order = Order::join('Receipt', '_Order.receipt_id', 'Receipt.id')->where('dateIn', '>=', $dateStart)
            ->where('dateIn', '<=', $dateEnd)->where('isPaid', 1)->where('cost', '>', 0)
            ->get();


        $expense = PurchaseRow::selectRaw('PurchaseRow.*, count*price as sum')->join('Purchase', 'Purchase.id', 'PurchaseRow.purch_id')
            ->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd)
            ->get();

        $orderSumm = $order->sum('cost');
        $expenseSumm = $expense->sum('sum');
        $expenseAmountSumm = $expense->sum('count');
        $countItog = $order->sum('count');



        $query =    "select Material.name, T.start_amount, V.income, V.expense, T.start_amount+V.income-V.expense as 'itog',
    Ei.name as ei 
    from 
(Select s.mat_id as 'Mat', sum(s.count) as 'income', sum(s.amount) as 'expense' from 
 (SELECT PurchaseRow.mat_id, `PurchaseRow`.`count`, MatExp.amount FROM `PurchaseRow` left JOIN `MatExp` ON `PurchaseRow`.`mat_id` = `MatExp`.`mat_id` inner join `Purchase` on PurchaseRow.`purch_id` = `Purchase`.`id` where
  Purchase.date >= '" . $dateStart . "'  and Purchase.date <= '" . $dateEnd . "' 

Union all

SELECT MatExp.mat_id, `PurchaseRow`.`count`, MatExp.amount FROM `PurchaseRow` Right JOIN `MatExp` ON `PurchaseRow`.`mat_id` = `MatExp`.`mat_id` WHERE PurchaseRow.mat_id is null and 
MatExp.date >= '" . $dateStart . "'  and MatExp.date <= '" . $dateEnd . "') as s GROUP BY s.mat_id) 

as V

left join 
(select mat_id,  sum(count) as 'start_amount' from `PurchaseRow` inner join `Purchase` on `purch_id` = `Purchase`.`id` 
where `date` <= '" . $dateStart . "' group by `mat_id`)
as T 
on V.Mat = T.mat_id 

INNER join Material on Material.id = V.Mat 
INNER join Ei on Material.ei_id = Ei.id 

;";




        $ass = DB::select($query);

        $itogs = ReportController::countItog($ass);


        // $amountStart = PurchaseRow::selectRaw('mat_id, date, sum(count)')->join('Purchase', 'purch_id', 'Purchase.id')
        // ->where('dateIn', '<', $dateStart)->groupBy('mat_id')->get();

        // $inc = PurchaseRow::selectRaw('mat_id, date, sum(co unt)')->join('Purchase', 'purch_id', 'Purchase.id')
        // ->where('dateIn', '>=', $dateStart)->where('dateIn', '<=', $dateEnd)->groupBy('mat_id')->get();



        return (view('report/orderMaterialReport', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'rows' => $order,
            'expenseRows' => $expense,
            'expenseAmountSumm' => $expenseAmountSumm,
            'orderSumm' => $orderSumm,
            'expenseSumm' => $expenseSumm,
            'materials' => $ass,
            'matItog' => $itogs,
            'countItog' => $countItog,
        ]));
    }


    public static function countItog($ass)
    {

        $arr = array();

        foreach ($ass as $i) {
            $start = is_null($i->start_amount)  ? 0 : $i->start_amount;
            $income = is_null($i->income)  ? 0 : $i->income;
            $expense = is_null($i->expense)  ? 0 : $i->expense;

            $arr[] = $start + $income - $expense;


            # code...
        }
        return $arr;
    }


    public function workerForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");

        $days = Utils::dateDifference($request['dateEnd'], $request['dateStart'])->days;

        $orders = Order::selectRaw(
            'Worker.id, Worker.name, Worker.surname, sum(CASE WHEN OrderOut.isFail = 1 then OrderOut.count ELSE 0 END ) as fails, 
            count(DISTINCT(_Order.id)) as orderCount, count(DISTINCT(_Order.id))/' . $days . ' as orderDay, 
            (SELECT sum(cost) from Receipt where Receipt.worker_id = Worker.id and isPaid = 1 
            and  `dateIn` >= "' . $dateStart . '" and `dateIn` <= "' . $dateEnd . '") as sum
'
        )
            ->join('Receipt', 'Receipt.id', '_Order.receipt_id')
            ->join('Worker', 'Worker.id', 'Receipt.worker_id')
            ->leftJoin('OrderOut', 'OrderOut.order_id', '_Order.id')
            ->where('isDone', 1)
            ->where('dateIn', '>=', $dateStart)->where('dateIn', '<=', $dateEnd)
            ->whereNotNull('worker_id')->groupBy('worker_id')->orderBy('Worker.id')->get();


        $izdel = Order::selectRaw('Worker.id, sum(count) as sum, sum(count)/' . $days . ' as sumDay')
            ->where('isDone', 1)
            ->join('Receipt', 'Receipt.id', '_Order.receipt_id')
            ->where('dateIn', '>=', $dateStart)->where('dateIn', '<=', $dateEnd)
            ->join('Worker', 'Worker.id', 'Receipt.worker_id')
            ->whereNotNull('worker_id')->groupBy('worker_id')->orderBy('Worker.id')->get();


        $failPer = array();

        for ($i = 0; $i < count($orders); $i++) {

            $failPer[] = $orders[$i]->fails / $izdel[$i]->sum * 100;
            # code...
        }

        $failAvg = array_sum($failPer) / count($failPer);


        // 'isPaid', 1
        $itog = $orders->sum('orderCount');
        $avgOrder = $orders->avg('orderDay');
        $sum = $orders->sum('sum');
        $itogIz = $izdel->sum('sum');
        $avgIz = $izdel->avg('sumDay');

        // ->where('isDone', 1) CASE WHEN isPaid=1 THEN cost ELSE 0 END
        return (view('report/workerReport', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'rows' => $orders,
            'itog' => $itog,
            'days' => $days,
            'avgFail' => $failAvg,
            'avgOrder' => $avgOrder,
            'sum' => $sum,
            'iz' => $izdel,
            'avgIz' => $avgIz,
            'itogIz' => $itogIz,
        ]));
    }


    public function customerForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");


        $customer = Receipt::selectRaw('customer_id, 
        Customer.name,Customer.surname,Customer.patronym,  count(Receipt.id) as countOrder, 
        avg( case when isnull(cost) THEN costPred ELSE cost END) as avg, 
        Customer.discount')
        ->join('Customer', 'Customer.id', 'Receipt.customer_id')
        ->where('dateIn', '>=', $dateStart)
        ->where('dateOut', '<=', $dateEnd)
        ->whereNotNull('customer_id')
        ->groupBy('customer_id')
        ->havingRaw('count(Receipt.id) > 1')->get();

        $custPost = $customer->count('customer_id');
        $custAll = Customer::count();

        $rpr = 0;
        if ($custAll > 0) {
            $rpr = $custPost / $custAll;
        }

        $avgSum = $customer->avg('avg');
        $itog = $customer->sum('countOrder');


        return (view('report/customerReport', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'rows' => $customer,
            'itog' => $itog,
            'rpr' => $rpr,
            'avgSum' => $avgSum,
        ]));
    }


    public function incomeMedianForm(Request $request)
    {
        if (!Gate::allows('report-forming')) {
            abort(403);
        }

        $dateStart = Utils::formatDateFromStr($request['dateStart'], "Y-m-d H:m:s");
        $dateEnd = Utils::formatDateFromStr($request['dateEnd'], "Y-m-d H:m:s");

        $labels = ReportController::getInterval($dateStart, $dateEnd);

        $data = ReportController::computeProfit($labels);

        for ($i = 0; $i < count($labels); $i++) {
            $labels[$i] = Normalization::beautify_date_from_str($labels[$i]);
        }

        $dataPerDiff = array();
        $dataPerDiff[] = 0;

        for ($i = 1; $i < count($data); $i++) {
            $dataPerDiff[] =  $data[$i] - $data[$i - 1];
        }

        // return $data;

        $labels = array_slice($labels, 1);
        $labelsJ = ReportController::encodeToJson($labels);
        $dataJ = ReportController::encodeToJson($data);
        $itog = array_sum($data);
        $avgProfit =  $itog / count($data);

        $st = $data[0];
        $en =  $data[count($data) - 1];

        $seDiff = ReportController::diffPercent($st, $en);
        $avgeDiff = ReportController::diffPercent($avgProfit, $en);

        // return(count($data));
        // return(count($labels));
        // return(($labels));

        return (view('report/incomeMedian', [
            'dateS' => Normalization::beautify_date_from_str($dateStart),
            'dateE' => Normalization::beautify_date_from_str($dateEnd),
            'labels' => $labels,
            'data' => $data,
            'labelsJ' => $labelsJ,
            'dataJ' => $dataJ,
            'itog' => $itog,
            'avgProfit' => $avgProfit,
            'start' => $st,
            'end' => $en,
            'seDiff' => $seDiff,
            'avgeDiff' => $avgeDiff,
            'dataPerDiff' => $dataPerDiff,

            // 'avgSum' => $avgSum,
        ]));
    }

    public static function diffPercent($a, $b)
    {
        $b = is_null($b) || $b == 0 ? 1 : $b;
        $a = is_null($a) || $a == 0 ? $b : $a;
        $diff = ($a - $b) / ($a / 100);
        $diff = abs($diff);

        if ($a > $b) {
            $diff = -$diff;
        }
        return $diff;
    }

    public static function encodeToJson($arr)
    {
        $s = '[';
        foreach ($arr as  $value) {
            $s = $s . '`' . $value . '`';
            $s = $s . ',';
        }
        $s = substr($s, 0, strlen($s) - 1);
        $s = $s . ']';
        return $s;
    }



    public static function getInterval($dateS, $dateE)
    {
        $diff = Utils::dateDifference($dateS, $dateE);

        $dateStart = new DateTime($dateS);
        $dateEnd = new DateTime($dateE);

        $inervalArr = array();
        $date = $dateStart;
        $inervalArr[] = $dateStart->format('Y-m-d');
        
        if ($diff->days >= (365 * 2)) {
            $dayDiff = intval($diff->days / 10);
            $dayInterval = new DateInterval('P' . $dayDiff . 'D');
            $inervalArr = array_merge($inervalArr, ReportController::addInterval($date, $dayInterval, 9));
        } elseif ($diff->days > 120 && $diff->days < (365 * 2)) {
            $dayDiff = intval($diff->days / 29) - 1;
            $dayInterval = new DateInterval('P1M');
            $inervalArr = array_merge($inervalArr, ReportController::addInterval($date, $dayInterval, $dayDiff));
        } else {
            $dayDiff = intval($diff->days / 7) - 1;
            $dayInterval = new DateInterval('P' . $dayDiff . 'D');
            $inervalArr = array_merge($inervalArr, ReportController::addInterval($date, $dayInterval, 7));
        }
        $inervalArr[] = $dateEnd->format('Y-m-d');

        return $inervalArr;
    }


    public static function computeProfit($inervalArr)
    {

        $profitArr = array();

        for ($i = 0; $i < count($inervalArr) - 1; $i++) {
            $ds = $inervalArr[$i];
            $de = $inervalArr[$i + 1];
            $income = Income::select('amount')->where('date', '>=', $ds)
                ->where('date', '<=', $de)->get()->sum('amount');

            $expense = PurchaseRow::selectRaw('sum(count * price) as sum')
                ->join('Purchase', 'Purchase.id', 'PurchaseRow.purch_id')
                ->where('date', '>=', $ds)
                ->where('date', '<', $de)
                ->union(Expense::selectRaw('sum(amount) as sum')
                    ->where('date', '>=', $ds)
                    ->where('date', '<', $de))->get()->sum('sum');

            $profit = $income - $expense;
            $profitArr[] = $profit;
        }
        return $profitArr;
    }


    public static function addInterval($date, $inter, $count)
    {
        $inervalArr = array();
        for ($i = 0; $i < $count; $i++) {
            $date->add($inter);
            $inervalArr[] = $date->format('Y-m-d');
        }

        return $inervalArr;
    }


    public static function concat($a, $b, $prefA, $prefB)
    {
        if (count($a) < 1 || count($b) < 1) {
            return;
        }
        $c = collect([]);
        $max_len = count($a) >= count($b) ? count($a) : count($b);

        $keysA = array_keys($a[0]->attributesToArray());
        $keysB = array_keys($b[0]->attributesToArray());

        for ($i = 0; $i < $max_len; $i++) {
            $row = collect([]);

            foreach ($keysA as $index => $key) {
                $val = null;
                if (count($a) > $i) {
                    $val = $a[$i]->$key;
                }
                $row->put($prefA . $key,  $val);
            }
            foreach ($keysB as $index => $key) {
                $val = null;
                if (count($b) > $i) {
                    $val = $b[$i]->$key;
                }
                $row->put($prefB . $key,  $val);
            }
            $c->push($row);
        }
        return $c;
    }
}
