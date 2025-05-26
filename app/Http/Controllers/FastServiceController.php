<?php

namespace App\Http\Controllers;

use App\Http\Normalizators\Normalization;
use Illuminate\Http\Request;
use App\Http\Utils\Utils;
use App\Models\FastService;
use App\Models\Service;

class FastServiceController extends Controller
{
    const rootURL = "fast_service";
    const storeTitle = "Новая быстрая услуга";
    const storeFormHeader = "Быстрая услуга";
    const editTitle = "Редактировать быструю услугу";
    const editFormHeader = "Быстрая услуга";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = FastService::all()->sortByDesc('date');;
        return view("fastService/card", [
            'items' => $columns,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = Service::all();
        $number = FastService::getNumber();

        return view("fastService/create", [
            'services' => $service,
            'number' => $number,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new FastService();

        $service->date = $request['date'];
        $service->number = $request['number'];
        $service->service_id = $request['service'];
        $service->count = $request['count'];
        $service->save();

        if ($request['payment'] == 1) {
            $income = IncomeController::CreateFastExternal($request['payNumber'], $request['date'], $request['amount'], $service->id);
        } else if ($request['payment'] == 2) {
            $income = IncomeController::UpdateFastExternal($request, $service->id);
        }
        $service->income_id = $income;
        $service->save();

        return redirect($this::rootURL);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = FastService::findOrFail($id);

        return view('fastService/create', [
            'item' => $request,
            'rootURL' => $this::rootURL
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serv = FastService::findOrFail($id);
        $service = Service::all();
        $number = FastService::getNumber();
        if (!is_null($serv)) {
            return view("fastService/edit", [
                'item' => $serv,
                'services' => $service,
                'rootURL' => $this::rootURL
            ]);
        }
        return view("fastService/create", [
            'services' => $service,
            'number' => $number,
            'rootURL' => $this::rootURL
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $serv = FastService::findOrFail($id);

        if (!is_null($serv)) {
            $serv->date = $request['date'];
            $serv->number = $request['number'];
            $serv->service_id = $request['service'];
            $serv->count = $request['count'];
            $serv->save();
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pur = FastService::findOrFail($id);
        $pur->delete();
        return redirect($this::rootURL);
    }
}
