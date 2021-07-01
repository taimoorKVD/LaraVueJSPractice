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
Route::apiResource('reviews', 'Api\ReviewController')->only(['show','store']);

Route::get('bookables/{bookable}/availability', 'Api\BookableAvailabilityController')
    ->name('bookable.availability.show');
Route::get('bookables/{bookable}/reviews', 'Api\BookableReviewController')
    ->name('bookable.reviews.index');
Route::get('booking-by-review/{reviewKey}', 'Api\BookingByReviewController')
    ->name('booking.by-review.show');

// for knowledge //
//Route::get('bookables/{id}/{optional?}', function ($id, $optional = "tester"){
//    return $id . '-' . $optional;
//});
