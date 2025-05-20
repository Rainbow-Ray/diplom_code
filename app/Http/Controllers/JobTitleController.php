<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\View\View;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    const rootURL = "job_title";
    const storeTitle = "Новая должность";
    const storeFormHeader = "Должность";
    const editTitle = "Редактировать должность";
    const editFormHeader = "Должность";

        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    public function index()
    {
        $columns = JobTitle::all()->sortBy('name');
        return view("jobTitle/jobTitleCard", ['title' => "Должности", 'items' => $columns, 'rootURL' => $this::rootURL]);
    }

    public function create() : View
    {
        return view('jobTitle/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);
    }

    public function store(Request $request)
    {
        $job = new JobTitle();
        $job->name = $request['name'];
        $job->salary = $request['salary'];
        $job->save();
        return redirect($this::rootURL);
    }

    public function show(string $id)
    {
        $job = JobTitle::find($id);
        return [$job->name, $job->salary];
    }

    public function edit(string $id) : View
    {
        $job = JobTitle::find($id);

        if (!is_null($job)){
            return view('jobTitle/edit', ["rootURL" => $this::rootURL,"name"=> $job->name, "salary"=>  $job->salary, "id"=> $job->id, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader]);
        }
        return view('jobTitle/store', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader]);
    }

    public function update(Request $request, $id)
    {
        $job = JobTitle::find($id);

        if (!is_null($job)){
            $job->name = $request['name'];
            $job->salary = $request['salary'];
            $job->save();
        }
        return redirect( $this::rootURL);

    }

    public function destroy($id)
    {
        $job = JobTitle::find($id);
        $job->delete();
        return redirect( $this::rootURL);
    }
}
