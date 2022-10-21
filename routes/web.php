<?php
// Admin
use App\Http\Controllers\Admin\CoaController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\PriceManagementController;
use App\Http\Controllers\Admin\PrincipalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UoMController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserSubmenuController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
// End Admin

// Utils
use Illuminate\Support\Facades\Route;

// End Utils
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware(['guest'])->controller(RegisterController::class)->group(function(){
    Route::post('/register/update', 'update');
    Route::post('/register/create', 'create');
    Route::get('/register_verify', 'register_verify');
    Route::post('/checkemail', 'checkemail');
});

Route::middleware(['guest'])->controller(ForgotPasswordController::class)->group(function(){
    Route::get('/forgot-password', 'show');
    Route::post('/forgot-password/sendemail', 'sendemail');
    Route::post('/forgot-password/checkemail', 'checkemail');
    Route::get('/reset-password', 'reset_password');
    Route::post('/reset-password/submit', 'reset_password_submit');
});


Auth::routes();

//Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/admin/loadmenu/{parent}/{role_id}', [DashboardController::class, 'loadmenu'])->middleware('auth');
Route::get('/admin/checkonline', [DashboardController::class, 'checkonline'])->middleware('auth');
Route::get('/admin/useractivity', [DashboardController::class, 'useractivity'])->middleware('auth');
Route::get('/admin/listuseractivity', [DashboardController::class, 'listuseractivity'])->middleware('auth');
Route::get('/admin/checknotification', [DashboardController::class, 'checknotification'])->middleware('auth');
//End Dashboard


// GET IP menggunakan package geoip yang sudah diinstal barangkali dibutuhkan
// Route::get('/ip', function(){
//     $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
//     return $checkLocation->toArray();
// });
// END GET API


// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function(){
    Route::get('admin/myprofile', 'index');
    Route::get('admin/myprofile/edit', 'editmyprofile');
    Route::post('admin/myprofile/update', 'update');
});
// Profile End

//Menu Start
Route::middleware(['auth'])->controller(MenuController::class)->group(function(){
    Route::get('admin/configuration/menu',  'index');
    Route::post('admin/configuration/menu/store', 'store');
    Route::post('admin/configuration/menu/update', 'update');
    Route::get('admin/configuration/menu/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/menu/delete/{id}', 'destroy');
});
//End Menu


//UserAccessMenu Start
Route::middleware(['auth'])->controller(UserRoleController::class)->group(function(){
    Route::get('admin/configuration/userrole/viewrole/{id}', 'viewrole');
    Route::post('admin/configuration/userrole/store', 'store');
    Route::post('admin/configuration/userrole/update', 'update');
    Route::get('admin/configuration/userrole/editmodalrole/{id}', 'editmodalrole');
    Route::get('admin/configuration/userrole/delete/{id}', 'destroy');
    Route::get('admin/configuration/useraccessmenu/{id}', 'viewuseraccess')->name('viewaccess');
    Route::get('admin/configuration/useraccessmenu/editmodalaccess/{id}', 'editmodalaccess');
    Route::post('/admin/configuration/useraccessmenu/change', 'changeaccess')->name('changeaccess');
    Route::post('/admin/configuration/useraccessmenu/permissionmenu', 'permissionmenu')->name('permissionmenu');
    Route::get('admin/configuration/useraccessmenu/editcustomaccess/{id}', 'editcustomaccess');
    Route::post('/admin/configuration/useraccessmenu/blockaccess', 'blockaccess');
    Route::post('/admin/configuration/useraccessmenu/unblockaccess', 'unblockaccess');
    Route::get('/admin/configuration/useraccessmenu/editpermissionmodal/{id}', 'editpermissionmodal');
});
//UserAccessMenu End

//Users Start
Route::middleware(['auth'])->controller(UsersController::class)->group(function(){
    Route::get('admin/users', 'index');
    Route::get('admin/users/show/{id}', 'show');
    Route::get('admin/users/create', 'create');
    Route::post('admin/users/store', 'store');
    Route::get('admin/users/edit/{id}', 'edit');
    Route::post('admin/users/update', 'update');
    Route::get('admin/users/delete/{id}', 'destroy');
    Route::post('admin/users/checkusername', 'checkusername');
    Route::post('admin/users/checkemail', 'checkemail');
    Route::get('admin/users/editmodal/{id}', 'editmodal');
});
//Users END


// Lokasi Start
Route::middleware(['auth'])->controller(RegionController::class)->group(function(){
    Route::get('admin/configuration/location/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/location/delete/{id}', 'destroy');
    Route::post('admin/configuration/location/store', 'store');
    Route::post('admin/configuration/location/update', 'update');
});
// Lokasi End


// Items start
Route::middleware(['auth'])->controller(ItemsController::class)->group(function(){
    Route::get('admin/masterdata/items', 'index');
    Route::post('admin/masterdata/items/store', 'store');
    Route::post('admin/masterdata/items/update', 'update');
    Route::get('admin/masterdata/items/addmodal', 'addmodal');
    Route::get('admin/masterdata/items/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/items/delete/{id}', 'destroy');
    Route::get('admin/masterdata/typeitems', 'typeitems');
    Route::get('/admin/masterdata/typeitems/addmodal', 'typeitemsaddmodal');
    Route::get('/admin/masterdata/typeitems/editmodal/{id}', 'typeitemseditmodal');
    Route::post('/admin/masterdata/typeitems/store', 'typeitemsstore');
    Route::post('/admin/masterdata/typeitems/update', 'typeitemsupdate');
    Route::get('/admin/masterdata/typeitems/delete/{id}', 'typeitemsdelete');
    Route::get('/admin/masterdata/itemqty', 'itemqty');
    Route::get('/admin/masterdata/itemprice', 'itemprice');
    Route::get('/admin/masterdata/itemprice/addmodal', 'addModalItemPrice');
    Route::get('/admin/masterdata/itemprice/getdetailitem/{id}', 'getdetailitem');
    Route::post('/admin/masterdata/itemprice/store', 'storeitemprice');
    Route::get('/admin/masterdata/itemprice/editmodal/{id}', 'editmodalitemprice');
    Route::post('/admin/masterdata/itemprice/update', 'updateitemprice');
});

// Principal Start
Route::middleware(['auth'])->controller(PrincipalController::class)->group(function(){
    Route::get('admin/masterdata/principal', 'index');
    Route::post('admin/masterdata/principal/store', 'store');
    Route::post('admin/masterdata/principal/update', 'update');
    Route::get('admin/masterdata/principal/delete/{id}', 'destroy');
    Route::get('admin/masterdata/principal/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/principal/addmodal', 'addmodal');
});
// Principal End

// Partners Start
Route::middleware(['auth'])->controller(PartnersController::class)->group(function(){
    Route::get('admin/masterdata/partners', 'index');
    Route::get('admin/masterdata/partners/list', 'list');
    Route::post('admin/masterdata/partners/store', 'store');
    Route::post('admin/masterdata/partners/update', 'update');
    Route::get('admin/masterdata/partners/delete/{id}', 'destroy');
    Route::get('admin/masterdata/partners/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/partners/addmodal', 'addmodal');
    Route::get('admin/masterdata/typeofpartner', 'typeofpartner');
    Route::get('admin/masterdata/partners/listtypeofpartners', 'listtypeofpartners');
    Route::get('admin/masterdata/partners/addtypepartnermodal', 'addtypepartnermodal');
    Route::post('admin/masterdata/partners/storetypepartners', 'storetypepartners');
    Route::get('admin/masterdata/partners/edittypepartnermodal/{id}', 'edittypepartnermodal');
    Route::post('admin/masterdata/partners/updatetypepartners', 'updatetypepartners');
    Route::get('admin/masterdata/partners/destroytypepartners/{id}', 'destroytypepartners');
});
// Principal End


// UoM Start
Route::middleware(['auth'])->controller(UoMController::class)->group(function(){
    Route::get('admin/masterdata/uom', 'index');
    Route::get('admin/masterdata/uom/list', 'list');
    Route::get('admin/masterdata/uom/addmodal', 'addmodal');
    Route::get('admin/masterdata/uom/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/uom/delete/{id}', 'destroy');
    Route::post('admin/masterdata/uom/store', 'store');
    Route::post('admin/masterdata/uom/update', 'update');
});
//End UoM

//Customer
Route::middleware(['auth'])->controller(CustomerController::class)->group(function(){
    Route::get('admin/masterdata/customer', 'index');
    Route::get('admin/masterdata/customer/addmodal', 'addmodal');
    Route::get('admin/masterdata/customer/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/customer/delete/{id}', 'destroy');
    Route::post('admin/masterdata/customer/store', 'store');
    Route::post('admin/masterdata/customer/update', 'update');
});
// End

// PriceManagement
Route::middleware(['auth'])->controller(PriceManagementController::class)->group(function(){
    Route::get('admin/masterdata/pricemanagement','index');
    Route::get('admin/masterdata/pricemanagement/editmodal/{id}','editmodal');
    Route::post('admin/masterdata/pricemanagement/update', 'update');
});
// End PriceManagement

// Coa
Route::middleware(['auth'])->controller(CoaController::class)->group(function(){
    Route::get('admin/masterdata/coa', 'index');
    Route::get('admin/masterdata/coa/list', 'list');
    Route::get('admin/masterdata/coa/addmodal', 'addmodal');
    Route::get('admin/masterdata/coa/editmodal/{id}','editmodal');
    Route::post('admin/masterdata/coa/store', 'store');
    Route::post('admin/masterdata/coa/update', 'update');
    Route::get('admin/masterdata/coa/delete/{id}', 'destroy');
});
// End Coa


// Purchase Order
Route::middleware(['auth'])->controller(PurchaseOrderController::class)->group(function(){
    Route::get('/admin/procurement/purchase-order', 'index');
    Route::get('/admin/procurement/purchase-order/addmodal', 'addmodal');
    Route::get('/admin/procurement/purchase-order/editmodal/{id}', 'editmodal');
});
//End Purchase Order

//Blocked Page Start
Route::get('/blocked', function(){
    return view('admin.blocked');
});
//Blocked Page End




