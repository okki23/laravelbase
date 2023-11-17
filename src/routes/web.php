<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GroupinsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentTypeController;
use Symfony\Component\HttpKernel\Profiler\Profile;

 Route::get('/', function () {
     return view('welcome');
 });

 Auth::routes();


 Route::group(['middleware' => ['auth']], function() {
        Route::get('/home', [HomeController::class,'index'])->name('home');

      //master-member
        Route::get('/member',[MemberController::class,'index'])->name('member');
        Route::get('/member_list',[MemberController::class,'datalist'])->name('member_list');
        Route::get('/member_list_get',[MemberController::class,'datalist_get'])->name('member_list_get');
        Route::post('/member_save',[MemberController::class,'save'])->name('member_save');
        Route::post('/member_destroy',[MemberController::class,'destroy'])->name('member_destroy');
        Route::get('/member_add_form',[MemberController::class,'add_form'])->name('member_add_form');
        Route::get('/member_kartu/{id}',[MemberController::class,'kartu'])->name('member_kartu');
        Route::post('/member_get_data',[MemberController::class,'get_data'])->name('member_get_data');

      //master-bank
        Route::get('/bank',[BankController::class,'index'])->name('bank');
        Route::get('/bank_list',[BankController::class,'datalist'])->name('bank_list');
        Route::post('/bank_save',[BankController::class,'save'])->name('bank_save');
        Route::post('/bank_destroy',[BankController::class,'destroy'])->name('bank_destroy');
        Route::post('/bank_get_data',[BankController::class,'get_data'])->name('bank_get_data');


      //master-category
        Route::get('/category',[CategoryController::class,'index'])->name('category');
        Route::get('/category_list',[CategoryController::class,'datalist'])->name('category_list');
        Route::post('/category_save',[CategoryController::class,'save'])->name('category_save');
        Route::post('/category_destroy',[CategoryController::class,'destroy'])->name('category_destroy');
        Route::post('/category_get_data',[CategoryController::class,'get_data'])->name('category_get_data');

      //master-payment_type
        Route::get('/payment_typpe',[PaymentTypeController::class,'index'])->name('payment_type');
        Route::get('/payment_type_list',[PaymentTypeController::class,'datalist'])->name('payment_type_list');
        Route::post('/payment_type_save',[PaymentTypeController::class,'save'])->name('payment_type_save');
        Route::post('/payment_type_destroy',[PaymentTypeController::class,'destroy'])->name('payment_type_destroy');
        Route::post('/payment_type_get_data',[PaymentTypeController::class,'get_data'])->name('payment_type_get_data');

      //master-uom
        Route::get('/uom',[UomController::class,'index'])->name('uom');
        Route::get('/uom_list',[UomController::class,'datalist'])->name('uom_list');
        Route::post('/uom_save',[UomController::class,'save'])->name('uom_save');
        Route::post('/uom_destroy',[UomController::class,'destroy'])->name('uom_destroy');
        Route::post('/uom_get_data',[UomController::class,'get_data'])->name('uom_get_data');

     //master-instruktur
        Route::get('/instruktur',[InstrukturController::class,'index'])->name('instruktur');
        Route::get('/instruktur_list',[InstrukturController::class,'datalist'])->name('instruktur_list');
        Route::post('/instruktur_save',[InstrukturController::class,'save'])->name('instruktur_save');
        Route::post('/instruktur_destroy',[InstrukturController::class,'destroy'])->name('instruktur_destroy');
        Route::post('/instruktur_get_data',[InstrukturController::class,'get_data'])->name('instruktur_get_data');
        Route::get('/instruktur_add_form',[InstrukturController::class,'add_form'])->name('instruktur_add_form');
        Route::get('/instruktur_kartu/{id}',[InstrukturController::class,'kartu'])->name('instruktur_kartu');

   //master-groupins
       Route::get('/groupins',[GroupinsController::class,'index'])->name('groupins');
       Route::get('/groupins_list',[GroupinsController::class,'datalist'])->name('groupins_list');
       Route::post('/groupins_save',[GroupinsController::class,'save'])->name('groupins_save');
       Route::post('/groupins_destroy',[GroupinsController::class,'destroy'])->name('groupins_destroy');
       Route::post('/groupins_get_data',[GroupinsController::class,'get_data'])->name('groupins_get_data');

    //master-employee
      Route::get('/employee',[EmployeeController::class,'index'])->name('employee');
      Route::get('/employee_list',[EmployeeController::class,'datalist'])->name('employee_list');
      Route::post('/employee_save',[EmployeeController::class,'save'])->name('employee_save');
      Route::post('/employee_destroy',[EmployeeController::class,'destroy'])->name('employee_destroy');
      Route::post('/employee_get_data',[EmployeeController::class,'get_data'])->name('employee_get_data');
      Route::get('/employee_add_form',[EmployeeController::class,'add_form'])->name('employee_add_form');
      Route::get('/employee_kartu/{id}',[EmployeeController::class,'kartu'])->name('employee_kartu');

    //master-pengguna
      Route::get('/pengguna',[PenggunaController::class,'index'])->name('pengguna');
      Route::get('/pengguna_list',[PenggunaController::class,'datalist'])->name('pengguna_list');
      Route::get('/pengguna_profile',[PenggunaController::class,'pengguna_profile'])->name('pengguna_profile');
      Route::post('/pengguna_save',[PenggunaController::class,'save'])->name('pengguna_save');
      Route::post('/destroy',[PenggunaController::class,'destroy'])->name('pengguna_destroy');
      Route::post('/pengguna_get_data',[PenggunaController::class,'get_data'])->name('pengguna_get_data');
      Route::post('/save_profile',[PenggunaController::class,'save_profile'])->name('save_profile');
      // Route::get('/user_add_form',[UserController::class,'add_form'])->name('employee_add_form');
      // Route::get('/user_kartu/{id}',[UserController::class,'kartu'])->name('employee_kartu');

     //master-service
      Route::get('/service',[ServiceController::class,'index'])->name('service');
      Route::get('/service_list',[ServiceController::class,'datalist'])->name('service_list');
      Route::get('/service_list_get',[ServiceController::class,'datalist_get'])->name('service_list_get');
      Route::post('/service_save',[ServiceController::class,'save'])->name('service_save');
      Route::post('/service_destroy',[ServiceController::class,'destroy'])->name('service_destroy');
      Route::get('/service_add_form',[ServiceController::class,'add_form'])->name('service_add_form');
      // Route::get('/service_kartu/{id}',[ServiceController::class,'kartu'])->name('member_kartu');
      Route::post('/service_get_data',[ServiceController::class,'get_data'])->name('service_get_data');

      //point of sale
      Route::get('/pos',[POSController::class,'index'])->name('pos');
      Route::get('/pos_list',[POSController::class,'datalist'])->name('pos_list');
      Route::get('/listpos/{transcode}',[POSController::class,'listpos'])->name('listpos');
      Route::post('/savetodetail',[POSController::class,'savetodetail'])->name('savetodetail');
      Route::post('/pos_save',[POSController::class,'save'])->name('pos_save');
      Route::post('/pos_destroy',[POSController::class,'destroy'])->name('pos_destroy');
      Route::get('/pos_add_form',[POSController::class,'add_form'])->name('pos_add_form');
      // Route::get('/pos_kartu/{id}',[POSController::class,'kartu'])->name('member_kartu');
      Route::post('/pos_get_data',[POSController::class,'get_data'])->name('pos_get_data');


 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
