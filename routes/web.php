<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\Admin;

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

Route::get('/', [GuestController::class,'home']);
Route::get('/contact', [GuestController::class,'contact']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


                      /*------------Route Admin--------*/
Route::get('/admin/dashboard', [AdminController::class,'dashboard'] )->middleware('auth','admin');
Route::get('/admin/dashboard', [AdminController::class, 'stat']);
//recupérer tous les employes
Route::get('/admin/listEmploye', [AdminController::class, 'getEmploye'])->middleware('auth','admin');
//ajouter employe
Route::post('/admin/listEmploye/store', [AdminController::class, 'store'])->middleware('auth','admin');
//supprimer employe
Route::get('/admin/listEmploye/{id}/delete', [AdminController::class,'destroyEmploye'] )->middleware('auth','admin');
//recuperer tous les clients
Route::get('/admin/listClient', [AdminController::class, 'getClients'])->middleware('auth','admin');
//supprimer client
Route::get('/admin/listClient/{id}/delete', [AdminController::class,'destroyClient'] )->middleware('auth','admin');
//assigné un employe
Route::post('/admin/assign/{client_id}', [AdminController::class, 'assignEmployee'])->middleware('auth','admin');
Route::get('/admin/profile', [AdminController::class,'profile'] )->middleware('auth','admin');
Route::post('/admin/profile/update', [AdminController::class,'updateProfile'] )->middleware('auth','admin');


Route::get('/admin/listDemande', [AdminController::class, 'listDemande'])->middleware('auth','admin');
Route::get('/admin/listdemandeAdmin', [DemandeController::class, 'ListDemandeA']);
Route::get('/admin/listdemandeAdmin/{id}', [DemandeController::class,'detailsA'] );
Route::post('/admin/{id}/refuser', [DemandeController::class, 'refuserDemandeA'])->name('demande.refuserA');
Route::get('/admin/search', [DemandeController::class, 'search']);

Route::get('/admin/dashboardd', [AdminController::class, 'dash'])->name('admin.dashboard');
Route::post('/notification/{id}/read', [AdminController::class, 'markAsRead'])->name('notification.Read');
Route::delete('/notification/{notification}', [AdminController::class, 'delete'])->name('notification.delete');









                    /*------------Route Client--------*/


Route::get('/client/profile', [ClientController::class,'profile'] );
Route::post('/client/profile/update', [ClientController::class,'updateProfile'] )->middleware('auth');
Route::get('/client/demande', [DemandeController::class, 'index']);
Route::post('/client/demande/store', [DemandeController::class, 'store']);
Route::get('/client/demande/{id}/delete', [DemandeController::class,'destroy'] );
Route::post('/client/demande/update', [DemandeController::class, 'update']);
Route::get('/client/dashboardd', [ClientController::class, 'dash'])->name('client.dashboard');
Route::post('/notificationC/{id}/read', [ClientController::class, 'markAsRead'])->name('notification.Read');
Route::delete('/notificationC/{notification}', [ClientController::class, 'delete'])->name('notification.delete');





                    /*------------Route Employe--------*/
Route::get('/employe/dashboard', [EmployeController::class, 'dashboard']);
Route::get('/employe/dashboard', [EmployeController::class, 'stat']);
Route::get('/employe/profile', [EmployeController::class,'profile'] );
Route::post('/employe/profile/update', [EmployeController::class,'updateProfile'] )->middleware('auth');
Route::get('/employe/searchClients', [DemandeController::class, 'searchClients']);
Route::get('/employe/listdemande', [EmployeController::class, 'ListDemande']);
Route::get('/employe/listdemande/{id}', [DemandeController::class,'details'] );
Route::post('/demande/{id}/refuser', [DemandeController::class, 'refuserDemande'])->name('demande.refuser');
Route::post('/demande/{id}/accepter', [DemandeController::class, 'accepterDemande'])->name('demande.accepter');
Route::get('/employe/listClient', [EmployeController::class, 'ListClient']);


Route::get('/employe/dashboardd', [EmployeController::class, 'dash'])->name('employe.dashboard');
Route::post('/notificationE/{id}/read', [EmployeController::class, 'markAsRead'])->name('notification.Read');
Route::delete('/notificationE/{notification}', [EmployeController::class, 'delete'])->name('notification.delete');



