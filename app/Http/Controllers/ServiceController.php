<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\Models\Service;
use App\Models\ServiceSkill;
use App\Models\Skill;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    const rootURL = "service";
    const storeTitle = "Новая услуга";
    const storeFormHeader = "Услуга";
    const editTitle = "Редактировать услугу";
    const editFormHeader = "Услуга";



        public function __construct()
    {
        $this->middleware('can:create, App\Models\Material')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = Service::all();
        return view("service/card", ['items' => $columns, 'rootURL' => $this::rootURL]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();

        return view('service/create', ["rootURL"=> $this::rootURL, "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader, "skills"=>$skills]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Service();

        $service->name = $request['name'];
        $service->cost = $request['cost'];

        $service->save();

        if(!is_null($request['skill'])){
            if(count($request['skill']) > 0){
                foreach($request['skill'] as $skill){
                    ServiceSkill::create($service->id, $skill);
                }
            }    
        }

        return redirect($this::rootURL);

    }


    static function UpdateSkills($service,$oldSkills, $newSkills){
        $inter = array_intersect($oldSkills, $newSkills);
        $delete = array_diff($oldSkills, $inter);
        $add = array_diff($newSkills, $inter);

        foreach($delete as $i){
            ServiceSkill::where('service_id', $service->id)->where('skill_id', $i)->delete();
        }

        foreach($add as $i){
            ServiceSkill::create($service->id, $i);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return [$service->name,
        $service->cost,
        ];

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $skills = Skill::all();

        if (!is_null($service)){
            return view('service/edit', ["rootURL" => $this::rootURL,
            "service"=> $service, 
            'title'=>$this::editTitle, "formHeader"=>$this::editFormHeader, 
            'skills'=> $skills
        ]);
        }
        return view('service/create', ["rootURL"=> $this::rootURL,
         "title"=>  $this::storeTitle, 
        "formHeader"=> $this::storeFormHeader,
        'skills'=> $skills
    ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        if (!is_null($service)){
            $service->name = $request['name'];
            $service->cost = $request['cost'];
    
            $service->save();
    
        }

        $old = Utils::skillsToArray($service->skills);
        $new =  $request['skill'];

        if(is_null($request['skill'])){
            $new =  [];
        }

        $this::UpdateSkills($service, $old, $new);

        return redirect( $this::rootURL);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect( $this::rootURL);

    }
}
