<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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
use App\Http\Controllers\Reports\ReportController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Models\Material;
use App\Models\User;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Главная страница
Route::get('/', [MainMenuController::class, 'index']);

//Пользователи.
Route::get('user/{id}/edit', [UserController::class, 'edit'])
->middleware('can:update, App\Models\User');
Route::put('user/{id}', [UserController::class, 'update'])
->middleware('can:view, App\Models\User');

Route::get('user', [UserController::class, 'index'])
->middleware('can:view, App\Models\User');

// Ресурсы. Роли внутри контроллеров.
Route::resources([
    // Материалы. Характеристики.
    MaterialTypeController::class::rootURL => MaterialTypeController::class,
    ColorController::class::rootURL => ColorController::class,
    CountryController::class::rootURL => CountryController::class,
    EiController::class::rootURL => EiController::class,

    MaterialController::class::rootURL => MaterialController::class,

    // Оборудования. Характеристики.
    EquipTypeController::class::rootURL => EquipTypeController::class,
    StateController::class::rootURL => StateController::class,

    // Доходы и Расходы.
    IncomeSourceController::class::rootURL => IncomeSourceController::class,
    IncomeController::class::rootURL => IncomeController::class,
    ExpenseSourceController::class::rootURL => ExpenseSourceController::class,
    ExpenseController::class::rootURL => ExpenseController::class,

    // Клиенты, навыки, должности, услуги.
    CustomerController::class::rootURL => CustomerController::class,
    JobTitleController::class::rootURL => JobTitleController::class,
    SkillController::class::rootURL => SkillController::class,
    ServiceController::class::rootURL => ServiceController::class,

]);

// Сотрудники. Роли.
Route::resource(WorkerController::class::rootURL, WorkerController::class)
    ->only(['create', 'store', 'edit', 'update'])
    ->middleware('can:create, App\Models\Worker');
Route::resource(WorkerController::class::rootURL, WorkerController::class)
    ->only(['destroy'])
    ->middleware('can:delete, App\Models\Worker');
Route::resource(WorkerController::class::rootURL, WorkerController::class)
    ->only(['index', 'show']);

// Закупка. Роли.
Route::resource(PurchaseController::class::rootURL, PurchaseController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('can:create, App\Models\Worker');
Route::get('request/{id}/purchased', [PurchaseController::class, 'createWithReq'])
    ->middleware('can:create, App\Models\Worker');
    Route::resource(PurchaseController::class::rootURL, PurchaseController::class)
    ->only(['index', 'show']);


// Запрос о закупке. Роли.
Route::resource(RequestController::class::rootURL, RequestController::class)->only([
    'create',
    'store',
])->middleware('can:create, App\Models\Request');
Route::resource(RequestController::class::rootURL, RequestController::class)->only([
    'edit',
    'update',
    'destroy'
])->middleware('can:update, App\Models\Request');
Route::post('request/{id}/done', [RequestController::class, 'closeRequest'])
    ->middleware('can:update, App\Models\Request');
Route::resource(RequestController::class::rootURL, RequestController::class)
    ->only(['index', 'show']);

// Оборудование. Роли.
Route::resource(EquipController::class::rootURL, EquipController::class)
    ->only(['create', 'store', 'destroy'])
    ->middleware('can:create, App\Models\Equip');
Route::resource(EquipController::class::rootURL, EquipController::class)
    ->only(['edit', 'update'])
    ->middleware('can:update, App\Models\Equip');

Route::resource(EquipController::class::rootURL, EquipController::class)
    ->only(['index', 'show']);

// Проверка состояния оборудования. Роли.
Route::get('equip_check/{id}/create', [EquipCheckController::class, 'createWithEquipId'])
    ->middleware('can:create, App\Models\EquipCheck');
Route::resource(EquipCheckController::class::rootURL, EquipCheckController::class)->only([
    'create',
    'store',
    'edit',
    'update',
    'destroy'
])
    ->middleware('can:create, App\Models\EquipCheck');

//Заказы. Роли.
Route::resource(OrderController::class::rootURL, OrderController::class)->only([
    'edit',
    'update'
])->middleware('can:update, App\Models\Order');
Route::resource(OrderController::class::rootURL, OrderController::class)->only([
    'index',
    'show'
]);

//Квитанция. Роли.
Route::resource(ReceiptController::class::rootURL, ReceiptController::class)->only([
    'destroy'
])->middleware('can:delete, App\Models\Receipt');
Route::resource(ReceiptController::class::rootURL, ReceiptController::class)->only([
    'create',
    'store',
    'edit',
    'update'
])->middleware('can:create, App\Models\Receipt');
Route::resource(ReceiptController::class::rootURL, ReceiptController::class)->only([
    'index',
    'show'
]);


Route::get('/orderOut/{id}/edit', [OrderOutController::class, '']);
Route::get('/receipt/{id}/hand_over', [OrderOutController::class, 'hand_over']);
Route::post('/receipt/{id}/hand_over', [OrderOutController::class, 'hand_over_done']);
Route::post('receipt/{id}/done', [ReceiptController::class, 'closeReceipt']);

// Материалы по категориям.
Route::get('accessories', [MaterialController::class, 'show_accessories']);
Route::get('key_auto', [MaterialController::class, 'show_key_auto']);
Route::get('key_door', [MaterialController::class, 'show_key_door']);
Route::get('locks', [MaterialController::class, 'show_locks']);
Route::get('furniture', [MaterialController::class, 'show_furniture']);
Route::get('leather', [MaterialController::class, 'show_leather']);
Route::get('matOther', [MaterialController::class, 'show_matOther']);

// Материалы по категориям. Создание
Route::get('accessories/create', [AccController::class, 'create_material'])
->middleware('can:create, App\Models\Material');
Route::get('key_auto/create', [KeyTypeController::class, 'create_material_a'])
->middleware('can:create, App\Models\Material');
Route::get('key_door/create', [KeyTypeController::class, 'create_material_d'])
->middleware('can:create, App\Models\Material');
Route::get('locks/create', [LockTypeController::class, 'create_material'])
->middleware('can:create, App\Models\Material');
Route::get('furniture/create', [CategoryFurnController::class, 'create_material'])
->middleware('can:create, App\Models\Material');
// Материалы по категориям. Редактирование
Route::get('accessories/{id}/edit', [AccController::class, 'edit_material'])
->middleware('can:create, App\Models\Material');
Route::get('key_auto/{id}/edit', [KeyTypeController::class, 'edit_material_a'])
->middleware('can:create, App\Models\Material');
Route::get('key_door/{id}/edit', [KeyTypeController::class, 'edit_material_d'])
->middleware('can:create, App\Models\Material');
Route::get('locks/{id}/edit', [LockTypeController::class, 'edit_material'])
->middleware('can:create, App\Models\Material');
Route::get('furniture/{id}/edit', [CategoryFurnController::class, 'edit_material'])
->middleware('can:create, App\Models\Material');


//Материалы. Расход.
Route::get('material/exp', [MaterialController::class, 'expenseShow'])
->middleware('can:create, App\Models\Material');
Route::post('material/exp', [MaterialController::class, 'expenseAdd'])
->middleware('can:create, App\Models\Material');
Route::get('materialExp', [MaterialController::class, 'expenseIndex'])
->middleware('can:create, App\Models\Material');
Route::get('material/exp/edit/{date}', [MaterialController::class, 'expenseEdit'])
->middleware('can:create, App\Models\Material');
Route::post('material/exp/edit', [MaterialController::class, 'expenseEditsave'])
->middleware('can:create, App\Models\Material');




//Отчеты
Route::get('report', [ReportController::class, 'index']);

Route::get('report/incomes', [ReportController::class, 'incomeAndExpense']);
Route::post('report/incomes', [ReportController::class, 'incomeAndExpenseForm']);

Route::get('report/orderIncome', [ReportController::class, 'orderIncome']);
Route::post('report/orderIncome', [ReportController::class, 'orderIncomeForm']);

Route::get('report/orderMaterial', [ReportController::class, 'orderMaterial']);
Route::post('report/orderMaterial', [ReportController::class, 'orderMaterialForm']);


Route::get('report/worker', [ReportController::class, 'worker']);
Route::post('report/worker', [ReportController::class, 'workerForm']);

Route::get('report/customer', [ReportController::class, 'customer']);
Route::post('report/customer', [ReportController::class, 'customerForm']);

Route::get('report/incomeMedian', [ReportController::class, 'incomeMedian']);
Route::post('report/incomeMedian', [ReportController::class, 'incomeMedianForm']);


Route::get('/clear', [ConfigController::class, 'clearRoute']);


// Старые руты
// CategoryFurnController::class::rootURL => CategoryFurnController::class,
// 'accessories' => AccController::class,

//     KeyTypeController::class::rootURL => KeyTypeController::class,
// LockTypeController::class::rootURL => LockTypeController::class,
// MatTypeController::class::rootURL => MatTypeController::class,

// Route::get('/db', [FormsController::class, 'index']);
// Route::get('/new_receipt', [FormsController::class, 'newR']);
// Route::get('/new_client', [FormsController::class, 'newC']);
// Route::post('/new_client', [FormsController::class, 'createClient']);
// Route::get('/clients', [FormsController::class, 'clientList'] );

// Route::resource('customers', CustomerController::class);



require __DIR__ . '/auth.php';
