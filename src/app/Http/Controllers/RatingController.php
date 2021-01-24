<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sneaker;
use App\Models\Rating;
use App\Http\Resources\RatingResource;
use Auth;
use App\Http\Requests\RatingRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;


class RatingController extends Controller
{
       public function store(RatingRequest $request, $id)
    {

   // echo auth('api')->user()->id; exit;
      try {
      $rating = Rating::firstOrCreate(
        [
          'user_id' => auth('api')->user()->id,
          'sneaker_id' => $id
        ],
        ['rating' => $request->rating]
      );
     // $sneaker->fill($request->validated())->save();
      return new RatingResource($rating);

     } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data ");
      }

    }
}
