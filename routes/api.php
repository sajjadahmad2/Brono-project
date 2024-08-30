<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardStyleController;
use App\Http\Controllers\Webhooks\ContactController;
use App\Http\Controllers\PropertyApiController;

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
Route::get('/contacts', [DashboardController::class, 'contacts']);
Route::get('/properties', [PropertyApiController::class, 'index']);           // Get all properties
Route::get('/properties/{id}', [PropertyApiController::class, 'show']);
Route::get('/get/properties/limited', [PropertyApiController::class, 'getLimitedProperties']);
Route::get('/get/properties/sorted-by-price', [PropertyApiController::class, 'getPropertiesSortedByPrice']);
Route::get('/get/properties/search', [PropertyApiController::class, 'search']);
Route::get('/get/properties/types', [PropertyApiController::class, 'getDistinctTypes']);
Route::get('/get/properties/type/{type}', [PropertyApiController::class, 'getByType']);
Route::get('/get/properties/currency', [PropertyApiController::class, 'getpropertycurrency']);
Route::get('/property/filter', [PropertyApiController::class, 'filterproperty'])->name('filter.properties');
Route::get('/properties/all/filter/items', [PropertyApiController::class, 'getFilterItems'])->name('filter.items');
