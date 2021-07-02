<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckBookablePriceRequest;
use App\Models\Bookable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
{
    public function __invoke(CheckBookablePriceRequest $cbpr, Bookable $bookable)
    {
        $days = (new Carbon(request()->from))->diffInDays(new Carbon(request()->to)) + 1;
        $price = $days * $bookable->price;
        return response()->json([
           'data' => [
               'total' => $price,
               'breakdown' => [
                   $bookable->price => $days,
               ]
           ]
        ]);
    }
}
