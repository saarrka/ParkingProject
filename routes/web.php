<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParkingSpotController;
use App\Http\Controllers\ReservationController;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Registracija
Route::post('register', [UserController::class, 'register']);

// O nama
Route::get('about', [AboutController::class, 'show'])->name('about');

// Kontakt
Route::get('contact', [ContactController::class, 'show'])->name('contact');
Route::post('contact', [ContactController::class, 'submit'])->name('contact.submit');

// Rezervacija parkinga
// Prikaz forme za rezervaciju
Route::get('/users/reserve-parking', [ParkingSpotController::class, 'create'])->name('users.reserve-parking');
// Obrada rezervacije
Route::post('/users/reserve-parking', [ParkingSpotController::class, 'store'])->name('users.reserve-parking.store');

// Upravljanje sopstvenim vozilima
Route::get('/your-vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');


// Upravljanje vozilima od strane admina
Route::get('/admins/view-vehicles', [VehicleController::class, 'viewVehicles'])->name('admins.view-vehicles');

// Upravljanje kategorijama
// Prikaz liste kategorija i forma za dodavanje
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Kreiranje nove kategorije
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Brisanje kategorije
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
 // Prikaz forme za izmenu kategorije
 Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
 // Ažuriranje kategorije
 Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Upravljanje korisnicima
Route::resource('users', UserController::class);

// Upravljanje rezervacijama parking mesta
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');


// Sta rade menadzeri
Route::get('/managers/view-users', [ManagerController::class, 'view_users'])->name('managers.view-users');

// Editovanje profila
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');