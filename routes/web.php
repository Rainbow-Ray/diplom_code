<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\AccController;
use App\Http\Controllers\CategoryFurnController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EiController;
use App\Http\Controllers\EquipCheckController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EquipTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseSourceController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeSourceController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\KeyTypeController;
use App\Http\Controllers\LockTypeController;
use App\Http\Controllers\MainMenuController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderOutController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [MainMenuController::class, 'index']);
Route::get('/db', [FormsController::class, 'index']);
Route::get('/new_receipt', [FormsController::class, 'newR']);
Route::get('/new_client', [FormsController::class, 'newC']);
Route::post('/new_client', [FormsController::class, 'createClient']);
Route::get('/clients', [FormsController::class, 'clientList'] );

// Route::resource('customers', CustomerController::class);


Route::resources([
    MaterialTypeController::class::rootURL => MaterialTypeController::class,
    ColorController::class::rootURL => ColorController::class,
    CountryController::class::rootURL => CountryController::class,
    EiController::class::rootURL => EiController::class,

    MaterialController::class::rootURL => MaterialController::class,

    EquipTypeController::class::rootURL => EquipTypeController::class,
    StateController::class::rootURL => StateController::class,
    EquipController::class::rootURL => EquipController::class,

    IncomeSourceController::class::rootURL => IncomeSourceController::class,
    IncomeController::class::rootURL => IncomeController::class,
    ExpenseSourceController::class::rootURL => ExpenseSourceController::class,
    ExpenseController::class::rootURL => ExpenseController::class,

    CustomerController::class::rootURL => CustomerController::class,
    WorkerController::class::rootURL => WorkerController::class,
    JobTitleController::class::rootURL => JobTitleController::class,
    SkillController::class::rootURL => SkillController::class,

    ReceiptController::class::rootURL => ReceiptController::class,
    ServiceController::class::rootURL => ServiceController::class,

    RequestController::class::rootURL => RequestController::class,
    PurchaseController::class::rootURL => PurchaseController::class,
]);

Route::resource(EquipCheckController::class::rootURL, EquipCheckController::class)->only([
    'create', 'store', 'edit', 'update', 'destroy'
]);

Route::resource(OrderController::class::rootURL, OrderController::class)->only([
    'index', 'edit', 'update', 'show'
]);
Route::get('/orderOut/{id}/edit', [OrderOutController::class, '']);
Route::get('/receipt/{id}/hand_over', [OrderOutController::class, 'hand_over']);
Route::post('/receipt/{id}/hand_over', [OrderOutController::class, 'hand_over_done']);

Route::get('accessories', [MaterialController::class, 'show_accessories']);
Route::get('key_auto', [MaterialController::class, 'show_key_auto']);
Route::get('key_door', [MaterialController::class, 'show_key_door']);
Route::get('locks', [MaterialController::class, 'show_locks']);
Route::get('furniture', [MaterialController::class, 'show_furniture']);

Route::get('accessories/create', [AccController::class, 'create_material']);
Route::get('key_auto/create', [KeyTypeController::class, 'create_material_a']);
Route::get('key_door/create', [KeyTypeController::class, 'create_material_d']);
Route::get('locks/create', [LockTypeController::class, 'create_material']);
Route::get('furniture/create', [CategoryFurnController::class, 'create_material']);

Route::get('accessories/{id}/edit', [AccController::class, 'edit_material']);
Route::get('key_auto/{id}/edit', [KeyTypeController::class, 'edit_material_a']);
Route::get('key_door/{id}/edit', [KeyTypeController::class, 'edit_material_d']);
Route::get('locks/{id}/edit', [LockTypeController::class, 'edit_material']);
Route::get('furniture/{id}/edit', [CategoryFurnController::class, 'edit_material']);

Route::post('receipt/{id}/done', [ReceiptController::class, 'closeReceipt']);

Route::post('request/{id}/done', [RequestController::class, 'closeRequest']);
Route::get('request/{id}/purchased', [PurchaseController::class, 'createWithReq']);


Route::get('/clear',[ConfigController::class, 'clearRoute']);


// Старые руты
// CategoryFurnController::class::rootURL => CategoryFurnController::class,
    // 'accessories' => AccController::class,

//     KeyTypeController::class::rootURL => KeyTypeController::class,
// LockTypeController::class::rootURL => LockTypeController::class,
// MatTypeController::class::rootURL => MatTypeController::class,
