<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;

use Illuminate\Http\Request;
use App\Http\Normalizators\Normalization;

class CustomerController extends Controller
{

    const rootURL = "customer";
    const storeTitle = "Новый клиент";
    const storeFormHeader = "Клиент";
    const editTitle = "Редактировать данные клиента";
    const editFormHeader = "Клиент";


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Customer::all();
        return view("customer/customerCard", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $phone = Normalization::class::normalize_phone($request['phone']);

        $customer = new Customer();
        $customer->name = $request['name'];
        $customer->surname = $request['surname'];
        $customer->patronym = $request['patronym'];
        $customer->phone = $phone;
        $customer->discount = $request['discount'];
        $customer -> save();
        return redirect($this::rootURL);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return [$customer->name,
        $customer->surname,
        $customer->phone,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $customer = Customer::findOrFail($id);

        if (!is_null($customer)){
            return view('customer/edit', ["rootURL" => $this::rootURL,
            "customer"=> $customer, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('customer/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        if (!is_null($customer)){
            $phone = Normalization::class::normalize_phone($request['phone']);
            $customer->name = $request['name'];
            $customer->surname = $request['surname'];
            $customer->patronym = $request['patronym'];
            $customer->phone = $phone;
            $customer->discount = $request['discount'];
            $customer->save();
        }
        return redirect( $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect( $this::rootURL);

    }
}
