<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\State;
use App\Models\User;

class StateController extends Controller
{
    const rootURL = "user";
    const storeTitle = "Новое состояние оборудования";
    const storeFormHeader = "Состояние оборудования";
    const editTitle = "Редактировать состояние оборудования";
    const editFormHeader = "Состояние оборудования";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    public function index()
    {
        $columns = User::all();
        return view("service/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = User::findOrFail($id);
        return [$service->name,
        $service->cost,
        ];
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        if (!is_null($user)){
            return view('service/edit', ["rootURL" => $this::rootURL,
            "service"=> $service, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, 
            'skills'=> $skills
        ]);
        }
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)){
            $user->role = $request['role'];
            $user->save();
        }

        return redirect( $this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}