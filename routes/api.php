<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecksApiController;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Item;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\MainMenuController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\RequestController;
use App\Http\Helpers\PurchasedItem;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('can:create, App\Models\Material')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Фильтры
Route::get('/order/filter', [FilterController::class, 'order']);
Route::get('/receipt/filter', [FilterController::class, 'receipt']);
Route::get('/income/filter', [FilterController::class, 'income']);
Route::get('/expense/filter', [FilterController::class, 'expense']);
Route::get('/materialExp/filter', [FilterController::class, 'materialExp']);



Route::get('/checks', [ChecksApiController::class, 'index']);
Route::get('/checks', [ChecksApiController::class, 'index']);

Route::get("types/{id}", [MaterialTypeController::class, 'apiIndex']);
Route::get("types", [MaterialTypeController::class, 'apiAll']);

Route::get("materials", [MaterialController::class, 'apiIndex']);
Route::get("equips", [EquipController::class, 'apiIndex']);

Route::post('items', function (Request $request) {

    
    $request['price']  = str_replace(',', '.', $request['price'] );

    $data = $request->all();
    $rules = [
        'name' => 'required|string',
        'id' => 'required|numeric',
        'count' => 'required|numeric|min:1',
        'ei' => 'nullable|string',
        'type' => 'required|in:material,equip,other',
    ];
    if($request['isPurch']){
        $rules['price'] = 'required|numeric|min:0';
    }

    $messages = [
        'name.required' => 'Имя обязательно к заполнению',
        'count.required' => 'Количество товара обязательно к заполнению',
        'price.required' => 'Цена обязательна к заполнению',
        'count.min' => 'Минимальное количество: 1',
    ];
    
    $validator = Validator::make($data, $rules, $messages);


    if ($validator->fails()) {
                    // return $json = json_encode("FAIL", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

        $errors = ['hasErrors'=> true, 'errors'=> $validator->errors() ];
        return $json = json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    $validated = $validator->validated();

    if($request['isPurch']){
        $item = PurchasedItem::create($validated);
    }
    else{
        $item = Item::create($validated);
    }

    $json = json_encode($item, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    return $json;

    // return response()->json($item); // Возвращаем JSON, а не HTML


});

// /api/a
Route::get('/', function(){
    return view('/', [MainMenuController::class, 'index']);
});



Route::get('items', function () {
    if( $_GET['item_type'] == 'material'){
        return MaterialController::class::apiIndex();
    }
    else if($_GET['item_type'] == 'equip'){
        return EquipController::class::apiIndex();
    }

    return 1;
    // $validated = $request->validate([
    //     'name' => 'required|string',
    //     'id' => 'required|numeric',
    //     'count' => 'required|numeric',
    //     'ei' => 'nullable|string',
    //     'type' => 'required|in:material,equip,other'
    // ]);

    // $item = Item::create($validated);
    // return response()->json($item); // Возвращаем JSON, а не HTML
});

Route::get('materials', function () {
    
        return MaterialController::class::apiCat();

    return 1;
    // $validated = $request->validate([
    //     'name' => 'required|string',
    //     'id' => 'required|numeric',
    //     'count' => 'required|numeric',
    //     'ei' => 'nullable|string',
    //     'type' => 'required|in:material,equip,other'
    // ]);

    // $item = Item::create($validated);
    // return response()->json($item); // Возвращаем JSON, а не HTML
});







Route::get('a', function(){
    $request = array(
        'name' => 'assss',
        'id' => '1',
        'count' => '12',
        'ei' => '1',
        'type' => 'other',
        'price' => null,

    );
    $r = new Request([],$request);

    $validated = $r->validate([
        'name' => 'required|numeric',
        'id' => 'required|numeric',
        'count' => 'required|numeric',
        'ei' => 'nullable|string',
        'type' => 'required|in:material,equip,other',
        'price' => 'required|numeric|>0',
    ]);

    $item = PurchasedItem::create($validated);


    return  $json = json_encode($item, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

});

