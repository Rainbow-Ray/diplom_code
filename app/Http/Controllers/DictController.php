<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;


use Illuminate\Database\Eloquent\Model;


class DictController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function displayList(string $title, $items) : View
    {
        return view("List", ['title' => $title, 'items' => $items]);
    }
    public function displayDict(string $title, $items, $rootURL) : View
    {
        return view('dictionaries.card', ['title' => $title, 'items' => $items, 'rootURL' => $rootURL]);
    }    
    
    public function p_index($columns, $rootURL, $title)
    {
        return $this->displayDict($title, $columns, $rootURL);
    }

    public function p_create($rootURL, $storeTitle,  $storeFormHeader) : View
    {
        return view('dictionaries/store', ["rootURL"=> $rootURL, "title"=>  $storeTitle, 
        "formHeader"=> $storeFormHeader]);
    }

    public function p_store($new_model, Request $request, $rootURL)
    {
        $new_model->name = $request['name'];
        $new_model->save();
        return redirect($rootURL);
    }

    public function p_show($model)
    {
        // if(is_null($model)){
        //     return "404";
        // }

            return $model->name;

    }

    public function p_edit( $model, $rootURL, $editTitle,  $editFormHeader, $storeTitle, $storeFormHeader) : View
    {
        if (!is_null($model)){
            return view('dictionaries/edit', ["rootURL" => $rootURL,"name"=> $model->name, "id"=> $model->id, 
            'title'=>$editTitle, "formHeader"=>$editFormHeader]);
        }
        return view('dictionaries/store', ["rootURL"=> $rootURL, "title"=>  $storeTitle, 
        "formHeader"=> $storeFormHeader]);

    }

    public function p_update(Request $request,  $model, $rootURL)
    {
        if (!is_null($model)){
            $model->name = $request['name'];
            $model->save();
        }
        return redirect($rootURL);
    }

    public function p_destroy( $model, $rootURL)
    {
        $model->delete();
        return redirect($rootURL);
    }

}
