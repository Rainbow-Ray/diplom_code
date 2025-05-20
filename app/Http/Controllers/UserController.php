<?php

namespace App\Http\Controllers;

use App\Http\Utils\Utils;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const rootURL = "user";
    const storeTitle = "Пользователь";
    const storeFormHeader = "Пользователь";
    const editTitle = "Пользователь";
    const editFormHeader = "Пользователь";

    public function __construct()
    {
    }

    public function index()
    {
        $columns = User::all();
        return view("user/card", ['items' => $columns, 'rootURL' => $this::rootURL]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = User::findOrFail($id);
        return [
            $service->name,
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
        $workers = Worker::all();

        // return(1);
        if (!is_null($user)) {
            if (Auth::user()->id == $user->id) {
                return view('user/edit', [
                    "rootURL" => $this::rootURL,
                    'title' => $this::editTitle,
                    "formHeader" => $this::editFormHeader,
                    'user'=> $user,
                ]);
            } elseif(Auth::user()->hasRole('director') ||Auth::user()->hasRole('admin') ) {
                return view('user/editRoles', [
                    "rootURL" => $this::rootURL,
                    'title' => $this::editTitle,
                    "formHeader" => $this::editFormHeader,
                    "roles" => $roles,
                    "workers" => $workers,
                                        'user'=> $user,

                ]);
            }

            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {

            if($request['roleEdit'] == 0){
                                $user->email = $request['email'];

            }
             elseif ($request['roleEdit']==1) {
                $user->worker_id = $request['worker'];
                $old = Utils::skillsToArray($user->getRoles);

                if (is_null($request['role'])) {
                    $new =  [];
                } else {
                    $new =  $request['role'];
                }

                $this::UpdateSkills($user, $old, $new);
            }
            $user->save();
        }

        return redirect($this::rootURL);
    }


    static function UpdateSkills($user, $oldSkills, $newSkills)
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
            UserRole::where('user_id', $user->id)->where('role_id', $i)->delete();
        }

        foreach ($add as $i) {
            UserRole::create($user->id, $i);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
