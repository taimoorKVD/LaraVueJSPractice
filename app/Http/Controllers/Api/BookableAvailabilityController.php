<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckBookableAvailabilityRequest;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    public function __invoke(CheckBookableAvailabilityRequest $cbar, Bookable $bookable)
    {
        return $bookable->availableFor(request()->from, request()->to)
            ? response()->json([])
            : response()->json([], 404);
    }
}
