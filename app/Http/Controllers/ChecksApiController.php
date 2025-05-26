<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use App\Models\Income;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use tidy;

class ChecksApiController extends BaseController
{
    function index() {
        $now = new DateTime('now', new DateTimeZone("Asia/Yekaterinburg"));
        $hour = new DateInterval("PT1H");
        $now_min_hour = $now->sub($hour)->format('Y-m-d H:m:s');

        // $checks = Income::where('date', '>', $now_min_hour)->where('source_id', '=', 2)->get();
        $checks = Income::where('source_id', '=', 2)->get();
        foreach($checks as $i){
            $i->date = Normalization::beautify_dateTime($i->date);
        }
        echo json_encode($checks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }



    function getIncome($id) {
        $inc = Income::find($id);


        $data = [

            'source_name'=> $inc->source->name,
            'amount'=> $inc->amount,
            'date'=> $inc->date(),

        ];



        return json_encode($data);
        
    }
}
