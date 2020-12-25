<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershipStatusController;
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


Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
  ]);


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::apiResource('members', MemberController::class);
Route::apiResource('packages', PackageController::class);
Route::apiResource('cycles', CycleController::class);
Route::apiResource('activities', ActivityController::class);


Route::post('members/{member}/memberships', [MembershipController::class , 'store']);
Route::get('members/{member}/memberships', [MembershipController::class , 'index']);
Route::get('/memberships', [MembershipController::class , 'index']);

Route::post('membership/{membership}/suspend', [MembershipStatusController::class , 'suspend']);
Route::post('membership/{membership}/activate', [MembershipStatusController::class , 'activate']);
Route::post('membership/{membership}/renew', [MembershipStatusController::class , 'renew']);
