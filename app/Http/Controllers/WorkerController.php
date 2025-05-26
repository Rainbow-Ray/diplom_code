<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use App\Models\Service;
use App\Models\Skill;
use App\Models\WorkerService;
use App\Models\WorkerSkill;

class WorkerController extends Controller
{
    const rootURL = "worker";
    const storeTitle = "Новый сотрудник";
    const storeFormHeader = "Сотрудник";
    const editTitle = "Редактировать данные сотрудника";
    const editFormHeader = "Сотрудник";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Worker::all()->sortBy('surname');
        return view("worker/workerCard", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = JobTitle::all();
        $services = Service::all();
        return view('worker/create', [
            "rootURL" => $this::rootURL,
            "title" =>  $this::storeTitle,
            "formHeader" => $this::storeFormHeader,
            "jobs" => $jobs,
            "services" => $services
        ]);

        // $skills = Skill::all();
        // return view('worker/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        // "formHeader"=> $this::storeFormHeader, "jobs" => $jobs, "skills"=>$skills]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $phone = Normalization::class::normalize_phone($request['phone']);

        $worker = new Worker();
        $worker->name = $request['name'];
        $worker->surname = $request['surname'];
        $worker->patronym = $request['patronym'];
        $worker->dateBirth = $request['dateBirth'];
        $worker->passSerie = $request['passSerie'];
        $worker->passNum = $request['passNum'];
        $worker->datePass = $request['datePass'];
        $worker->addrPass = $request['addrPass'];
        $worker->addrFact = $request['addrFact'];
        $worker->email = $request['email'];
        $worker->phone = $phone;
        $worker->job_id = $request['job'];

        $worker->save();

        if (!is_null($request['skill'])) {
            if (count($request['skill']) > 0) {
                foreach ($request['skill'] as $skill) {
                    // WorkerService::create($worker->id, $skill);
                }
            }
        }
        // if (!is_null($request['skill'])) {
        //     if (count($request['skill']) > 0) {
        //         foreach ($request['skill'] as $skill) {
        //             WorkerSkill::create($worker->id, $skill);
        //         }
        //     }
        // }


        return redirect($this::rootURL);
    }


    static function UpdateSkills($worker, $oldSkills, $newSkills)
    {
        $inter = array_intersect($oldSkills, $newSkills);
        $delete = array_diff($oldSkills, $inter);
        $add = array_diff($newSkills, $inter);


        // return (print_r(
        //     [
        
        //     $oldSkills,
        //     $newSkills,
        //     $inter,
        //     $delete,
        //     $add,        $inter]));

        foreach ($delete as $i) {
            // WorkerService::where('worker_id', $worker->id)->where('service_id', $i)->delete();
        }

        foreach ($add as $i) {
            // WorkerService::create($worker->id, $i);
        }
    }
    // static function UpdateSkills($worker, $oldSkills, $newSkills)
    // {
    //     $inter = array_intersect($oldSkills, $newSkills);
    //     $delete = array_diff($oldSkills, $inter);
    //     $add = array_diff($newSkills, $inter);

    //     foreach ($delete as $i) {
    //         WorkerSkill::where('worker_id', $worker->id)->where('skill_id', $i)->delete();
    //     }

    //     foreach ($add as $i) {
    //         WorkerSkill::create($worker->id, $i);
    //     }
    // }

    static function showArr($arr)
    {
        foreach ($arr as $i) {
            echo $i;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $worker = Worker::findOrFail($id);

        return view('worker.workerData', ['worker' => $worker]);


        foreach ($worker->services as $i) {
            echo $i->name;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $worker = Worker::findOrFail($id);
        $jobs = JobTitle::all();
        $services = Service::all();
        // $skills = Skill::all();

        if (!is_null($worker)) {
            return view('worker/edit', [
                "rootURL" => $this::rootURL,
                "worker" => $worker,
                'title' => $this::editTitle,
                "formHeader" => $this::editFormHeader,
                "services" => $services,
                "jobs" => $jobs
            ]);
        }
        return view('worker/create', [
            "rootURL" => $this::rootURL,
            "title" =>  $this::storeTitle,
            "formHeader" => $this::storeFormHeader,
            "services" => $services,
            "jobs" => $jobs

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $worker = Worker::findOrFail($id);

        if (!is_null($worker)) {
            $phone = Normalization::class::normalize_phone($request['phone']);
            $worker->name = $request['name'];
            $worker->surname = $request['surname'];
            $worker->patronym = $request['patronym'];
            $worker->dateBirth = $request['dateBirth'];
            $worker->passSerie = $request['passSerie'];
            $worker->passNum = $request['passNum'];
            $worker->datePass = $request['datePass'];
            $worker->addrPass = $request['addrPass'];
            $worker->addrFact = $request['addrFact'];
            $worker->email = $request['email'];
            $worker->phone = $phone;
            $worker->job_id = $request['job'];
            $worker->save();

            $old = Utils::skillsToArray($worker->services);

            if (is_null($request['skill'])) {
                $new =  [];
            } else {
                $new =  $request['skill'];
            }

            $this::UpdateSkills($worker, $old, $new);
        }
        return redirect($this::rootURL);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        return redirect($this::rootURL);
    }
}
