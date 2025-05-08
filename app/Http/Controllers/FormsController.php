<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Customer;

class FormsController extends Controller
{
    public function index(): View
    {
        $users = DB::table('Acc')->get();
 
        return view('db', ['users' => $users]);
    }
    public function newR(): View
    {
        return view('ReceiptForm');
    }
    public function newC(): View
    {
        return view('ClientForm');
    }
    public function clientList(): View{
        return view('list', ['title' => 'Клиенты', 'items'=> Customer::all()]);
    }
}

