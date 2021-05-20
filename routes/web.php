<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ModeloController;
use App\Http\Controllers\Admin\MolduraController;
use App\Http\Controllers\Admin\PlacaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\FonteController;
use App\Http\Controllers\Admin\FrasesController;
use App\Http\Controllers\Admin\FundoController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/admin', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin');
Route::post('/admin/do_login', [App\Http\Controllers\Admin\AuthController::class, 'do_login'])->name('admin.do_login');
Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/password', [App\Http\Controllers\Admin\AuthController::class, 'password'])->name('admin.password');

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('admin')->name('admin.')->group(function(){

        Route::prefix('dashboard')->name('dashboard.')->group(function(){
            Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
            Route::post('/orderNotification', [App\Http\Controllers\Admin\HomeController::class, 'orderNotification'])->name('orderNotification');
            Route::post('/messageNotification', [App\Http\Controllers\Admin\HomeController::class, 'messageNotification'])->name('messageNotification');
        });

        Route::resources([
            'users' => UserController::class,
            'banners' => BannerController::class,
            'placas' => PlacaController::class,
            'modelos' => ModeloController::class,
            'molduras' => MolduraController::class,
            'fundos' => FundoController::class,
            'fontes' => FonteController::class,
            'frases' => FrasesController::class,
        ]);

        // CUSTOMERS
        Route::prefix('customers')->name('customers.')->group(function(){
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
            Route::get('/create', [CustomerController::class, 'create'])->name('create');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
            Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
            Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('update');
            Route::post('/delete', [CustomerController::class, 'delete'])->name('delete');
            Route::get('/orderby', [CustomerController::class, 'orderby'])->name('orderby');
        });

        


        // PLACAS
        Route::prefix('placas')->name('placas.')->group(function(){
            Route::post('/delete', [PlacaController::class, 'delete'])->name('delete');
        });
        
        // MODELOS
        Route::prefix('modelos')->name('modelos.')->group(function(){
            Route::post('/delete', [ModeloController::class, 'delete'])->name('delete');
        });

        // MOLDURAS
        Route::prefix('molduras')->name('molduras.')->group(function(){
            Route::post('/delete', [MolduraController::class, 'delete'])->name('delete');
        });

        // FUNDOS
        Route::prefix('fundos')->name('fundos.')->group(function(){
            Route::post('/delete', [FundoController::class, 'delete'])->name('delete');
        });

        // FONTES
        Route::prefix('fontes')->name('fontes.')->group(function(){
            Route::post('/delete', [FonteController::class, 'delete'])->name('delete');
        });

        // FRASES
        Route::prefix('frases')->name('frases.')->group(function(){
            Route::post('/delete', [FrasesController::class, 'delete'])->name('delete');
        });

        // BANNERS
        Route::prefix('banners')->name('banners.')->group(function(){
            Route::post('/delete', [BannerController::class, 'delete'])->name('delete');
        });

        // USUÁRIOS
        Route::prefix('users')->name('users.')->group(function(){
            Route::post('/delete', [UserController::class, 'delete'])->name('delete');
        });


        // MESSAGES
        Route::prefix('messages')->name('messages.')->group(function(){
            Route::get('', [MessageController::class, 'index'])->name('index');
            Route::get('/show/{message}', [MessageController::class, 'show'])->name('show');
            Route::post('/delete', [MessageController::class, 'delete'])->name('delete');
        });
        
        // ORDERS
        Route::prefix('orders')->name('orders.')->group(function(){
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/show/{order}', [OrderController::class, 'show'])->name('show');
            Route::post('/delete', [OrderController::class, 'delete'])->name('delete');
            Route::get('/orderby', [OrderController::class, 'orderby'])->name('orderby');
            Route::post('/insertTrackingCode', [OrderController::class, 'insertTrackingCode'])->name('insertTrackingCode');
        });


    });
    
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('placas')->name('placas.')->group(function(){
    Route::get('/', [App\Http\Controllers\PlacaController::class, 'index'])->name('index');
    Route::post('/create', [App\Http\Controllers\PlacaController::class, 'create'])->name('create');
    Route::post('/getDetails', [App\Http\Controllers\PlacaController::class, 'getDetails'])->name('getDetails');
    Route::post('/getmodelo', [App\Http\Controllers\PlacaController::class, 'getmodelo'])->name('getmodelo');
    Route::post('/getfundo', [App\Http\Controllers\PlacaController::class, 'getfundo'])->name('getfundo');
    Route::post('/calcFrete', [App\Http\Controllers\PlacaController::class, 'calcFrete'])->name('calcFrete');
    Route::post('/uploadCropImage', [App\Http\Controllers\PlacaController::class, 'uploadCropImage'])->name('uploadCropImage');
});

Route::prefix('checkout')->name('checkout.')->group(function(){

    Route::get('/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::get('/remove_placa/{id}', [App\Http\Controllers\CheckoutController::class, 'removePlaca'])->name('removePlaca');
    
    Route::get('/auth', [App\Http\Controllers\CheckoutController::class, 'auth'])->name('auth');
    Route::post('/doAuth', [App\Http\Controllers\CheckoutController::class, 'doAuth'])->name('doAuth');
    Route::get('/customer', [App\Http\Controllers\CheckoutController::class, 'customer'])->name('customer');
    Route::post('/createCustomer', [App\Http\Controllers\CheckoutController::class, 'createCustomer'])->name('createCustomer');
    Route::get('/address', [App\Http\Controllers\CheckoutController::class, 'address'])->name('address');
    Route::post('/createAddress', [App\Http\Controllers\CheckoutController::class, 'createAddress'])->name('createAddress');
    Route::get('/customer/edit', [App\Http\Controllers\CheckoutController::class, 'edit'])->name('edit');
    Route::get('/customer/logout', [App\Http\Controllers\CheckoutController::class, 'logout'])->name('logout');
    
    Route::put('/updateCustomer/{id}', [App\Http\Controllers\CheckoutController::class, 'updateCustomer'])->name('updateCustomer');

    Route::get('/shipment', [App\Http\Controllers\CheckoutController::class, 'shipment'])->name('shipment');
    Route::post('/frete', [App\Http\Controllers\CheckoutController::class, 'frete'])->name('frete');
    Route::post('/consultaCep', [App\Http\Controllers\CheckoutController::class, 'consultaCep'])->name('consultaCep');
    Route::post('/calcFrete', [App\Http\Controllers\CheckoutController::class, 'calcFrete'])->name('calcFrete');
    
});

Route::prefix('payment')->name('payment.')->group(function(){
    Route::get('/mercadopago', [App\Http\Controllers\PaymentController::class, 'mercadopago'])->name('mercadopago');
    Route::get('/mercadopago/otherpayments', [App\Http\Controllers\PaymentController::class, 'otherpayments'])->name('otherpayments');
    Route::get('/order/{code}', [App\Http\Controllers\PaymentController::class, 'order'])->name('order');
    Route::post('/createOrder', [App\Http\Controllers\PaymentController::class, 'createOrder'])->name('createOrder');
    
});

Route::prefix('frases')->name('frases.')->group(function(){
    Route::get('/', [App\Http\Controllers\FrasesController::class, 'index'])->name('index');
});

Route::prefix('contato')->name('contato.')->group(function(){
    Route::get('/', [App\Http\Controllers\ContatoController::class, 'index'])->name('index');
    Route::post('/enviaEmail', [App\Http\Controllers\ContatoController::class, 'enviaEmail'])->name('enviaEmail');
});
