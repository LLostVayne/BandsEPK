<?php
use App\Http\Middleware\AuthBandPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::post('/handleCreateBandForm',[App\Http\Controllers\CreateBandController::class,'store'])->name('handleCreateBandForm');
    Route::put('/handleEditBandForm/{id}',[App\Http\Controllers\DashboardController::class,'handleEdit'])->name('handleEditBandForm');
    Route::get('/createBandForm', [App\Http\Controllers\CreateBandController::class, 'createBandForm'])->name('createBandForm');
    Route::get('/editBand',[App\Http\Controllers\DashboardController::class,'edit'])->name('editBand');
    Route::delete('/deleteBand/{id}',[App\Http\Controllers\DashboardController::class,'delete'])->name('deleteBand');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard');
    Route::get('/permitAdmins',[App\Http\Controllers\DashboardController::class,'permitAdminsView'])->name('permitAdminsView');
    Route::post('/handlePermitAdmins',[App\Http\Controllers\DashboardController::class,'handlePermitAdmins'])->name('handlePermitAdmins');
});

Route::get('/search',[App\Http\Controllers\SearchController::class,'searchPage'])->name('searchPage');
Route::post('/searchResults',[App\Http\Controllers\SearchController::class,'searchResults'])->name('searchResults');
Route::get('/',[App\Http\Controllers\HomeController::class,'show'])->name('show');


Route::get('/AuthBandPage', function() {
    return view("authBandPage");
})->name('AuthBandPage');


Route::get('/band/{id}',[App\Http\Controllers\BandPageController::class,'index'])->name('band')->middleware(AuthBandPage::class);


Route::get('/token', function () {
    return csrf_token(); 
});