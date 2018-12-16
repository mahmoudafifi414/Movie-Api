<?php

namespace App\Http\Controllers;

use App\Movie;
use App\UserMovieRating;
use Illuminate\Http\Request;
use Validator;

class RatingController extends Controller
{
    public function rateMovie($movieId, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ratingNumber' => 'required|numeric|between:0,5',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 400);
        }

        if ($this->checkIfUserRateBefore($movieId, $request->ratingNumber)) {
            return response()->json(['status' => 'success', 'message' => 'Rating updated successfully'], 200);
        }

        $ratingNumber = $request->ratingNumber;
        $userMovieRating = new UserMovieRating;
        $userMovieRating->movie_id = $movieId;
        $userMovieRating->user_id = 1;
        $userMovieRating->rating_number = $ratingNumber;
        if ($userMovieRating->save()) {
            $this->updateMoviesTable($movieId);
            return response()->json(['status' => 'success', 'message' => 'Rating done successfully'], 200);
        }
        return response()->json(['status' => 'error'], 500);
    }

    //if user rate for this movie before then update his rating
    public function checkIfUserRateBefore($movieId, $ratingNumber)
    {
        $ratingRelatedToUser = UserMovieRating::where('user_id', /*Auth::user()->id*/
            1)
            ->where('movie_id', $movieId)
            ->first();
        if ($ratingRelatedToUser) {
            $ratingRelatedToUser->rating_number = $ratingNumber;
            if ($ratingRelatedToUser->save()) {
                $this->updateMoviesTable($movieId);
                return true;
            }
            return false;
        }
        return false;
    }

    //update movie table when user make raing to calculate the average
    public function updateMoviesTable($movieId)
    {
        $ratingRelatedToMovie = UserMovieRating::where('movie_id', $movieId)->avg('rating_number');
        $movie = Movie::find($movieId);
        $movie->rating = $ratingRelatedToMovie;
        $movie->save();
    }
}
