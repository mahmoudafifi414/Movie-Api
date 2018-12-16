<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use App\Http\Resources\MoviesResource;
use App\Movie;
use Illuminate\Http\Request;
use Validator;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMovies($size = 5)
    {
        //return pagination of required size with links of prev and following and size of each page
        $moviesPagination = Movie::paginate($size);
        return response()
            ->json(['status' => 'success', 'data' => $moviesPagination]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'image_url' => 'required|url',
            'release_year' => 'required|numeric',
            'gross_profit' => 'required|min:6|max:100',
            'director' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 400);
        }
        //crete new movie with data in request
        $movieInstance = new Movie;
        $movieInstance->title = $request->title;
        $movieInstance->description = $request->description;
        $movieInstance->image_url = $request->image_url;
        $movieInstance->release_year = $request->release_year;
        $movieInstance->gross_profit = $request->gross_profit;
        $movieInstance->director = $request->director;
        if ($movieInstance->save()) {
            //saving actors and associate it with movie
            if (count($request->actors) > 0) {
                foreach ($request->actors as $val) {
                    $actor = new Actor();
                    $actor->fill($val);
                    $actor->movie_id = $movieInstance->id;
                    $actor->save();
                }
            }
            if (count($request->genres) > 0) {
                foreach ($request->genres as $val) {
                    $genre = new Genre();
                    $genre->fill($val);
                    $genre->save();
                    $movieInstance->genres()->attach($genre);
                }
            }
            return response()->json(['status' => 'success', 'data' => new MoviesResource($movieInstance)], 200);
        }
        return response()->json(['status' => 'error'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get specific movie with id
        $specificMovie = new MoviesResource(Movie::find($id));
        return response()->json(['status' => 'success', 'data' => $specificMovie], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit specific movie with id
        $specificMovie = new MoviesResource(Movie::find($id));
        return response()->json(['status' => 'success', 'data' => $specificMovie], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'max:255',
            'description' => 'min:10',
            'image_url' => 'url',
            'release_year' => 'numeric',
            'gross_profit' => 'min:6|max:100',
            'director' => 'max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 400);
        }
        //update specific movie with id by the request received
        $movieInstance = Movie::find($id);
        $movieInstance->fill($request->all());
        if ($movieInstance->save()) {
            if (count($request->actors) > 0) {
                foreach ($request->actors as $val) {
                    Actor::where('movie_id', $movieInstance->id)->delete();
                    $actor = new Actor();
                    $actor->fill($val);
                    $actor->movie_id = $movieInstance->id;
                    $actor->save();
                }
            }
            if (count($request->genres) > 0) {
                foreach ($request->genres as $val) {
                    $genre = new Genre();
                    $genre->fill($val);
                    $genre->save();
                    $movieInstance->genres()->sync($genre->id);
                }
            }
            return response()->json(['status' => 'success', 'data' => new MoviesResource($movieInstance)], 200);
        }
        return response()->json(['status' => 'error'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //destroy movie with spcific id
        if (Movie::where('id',$id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully'], 200);
        }
        return response()->json(['status' => 'error'], 500);
    }

    public function sort($criteria)
    {
        //sorting the API with criteria zin the following array
        $sortCriteriaArray = ['title', 'description', 'image_url', 'release_year', 'rating', 'gross_profit', 'director'];
        if (!in_array($criteria, $sortCriteriaArray)) {
            return response()->json(['status' => 'error', 'message' => 'The criteria should be in (' . implode(' , ', $sortCriteriaArray) . ')'], 400);
        }
        $sortedMovie = Movie::orderBy($criteria)->get();
        if (count($sortedMovie) > 0) {
            return response()->json(['status' => 'success', 'data' => MoviesResource::collection($sortedMovie)], 200);
        }
        return response()->json(['status' => 'error']);
    }

    public function filter($genre)
    {
        //filter movies with genre
        $filteredMovies = Genre::with('movies')
            ->where('name', 'like', '%' . $genre . '%')
            ->get();
        if (count($filteredMovies) > 0) {
            return response()->json(['status' => 'success', 'data' => $filteredMovies], 200);
        }
        return response()->json(['status' => 'error'],500);
    }
}
