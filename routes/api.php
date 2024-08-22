<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardStyleController;
use App\Http\Controllers\Webhooks\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Dashboard CSS endpoint

Route::get('/dashboard-style/{location_id?}', [DashboardStyleController::class, 'dashboardResponse']);

Route::post('handle/webhooks', [ContactController::class, 'handle_webhook']);