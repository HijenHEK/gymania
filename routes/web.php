<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PackageController;
use App\Models\Membership;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::apiResource('members', MemberController::class);
Route::apiResource('packages', PackageController::class);


Route::post('members/{member}/memberships', [MembershipController::class , 'store']);
Route::get('members/{member}/memberships', [MembershipController::class , 'index']);

