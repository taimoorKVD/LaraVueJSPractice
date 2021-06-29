<?php

use App\Models\Bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bookables', 'Api\BookableController');
Route::get('bookables/{id}/availability', 'Api\BookableAvailabilityController')
    ->name('bookable.availability.show');

// for knowledge //
//Route::get('bookables/{id}/{optional?}', function ($id, $optional = "tester"){
//    return $id . '-' . $optional;
//});
