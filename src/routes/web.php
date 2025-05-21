<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\AuthController;
use App\Providers\FortifyServiceProvider;

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

Route::get('/register/step1', [AuthController::class, 'create']);
Route::post('/register/step1', [AuthController::class, 'store']);
Route::get('/register/step2', [WeightTargetController::class, 'create']);
Route::post('/register/step2', [WeightTargetController::class, 'store']);
Route::get('/logout', [AuthController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'weight_logs']);
});

Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'setting']);
Route::patch('/weight_logs/goal_setting/update', [WeightTargetController::class, 'update']);

Route::get('/weight_logs/search', [WeightLogController::class, 'search']);
Route::post('/weight_logs/create', [WeightLogController::class, 'store']);
Route::get('/weight_logs/:{weightLogId}', [WeightLogController::class, 'detail']);
Route::patch('weight_logs/:{weightLogId}/update', [WeightLogController::class, 'update']);
Route::delete('weight_logs/:{weightLogId}/delete', [WeightLogController::class, 'destroy']);