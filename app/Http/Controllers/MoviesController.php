<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use App\Http\Resources\MoviesResource;
use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return pagination of required size with links of prev and following and size of each page
        $moviesPagination = Movie::paginate(10);
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
            return response()->json(['status' => 'success', 'data' => new MoviesResource($movieInstance)]);
        }
        return response()->json(['status' => 'error']);
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
        return response()->json(['status' => 'success', 'data' => $specificMovie]);
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
        return response()->json(['status' => 'success', 'data' => $specificMovie]);
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
            return response()->json(['status' => 'success', 'data' => new MoviesResource($movieInstance)]);
        }
        return response()->json(['status' => 'error']);
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
        if (Movie::destroy($id)) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function sort($criteria)
    {
        //sorting the API with criteria in the following array
        $sortCriteriaArray = ['title', 'description', 'image_url', 'release_year', 'rating', 'gross_profit', 'director'];
        if (!in_array($criteria, $sortCriteriaArray)) {
            return response()->json(['status' => 'error', 'message' => 'The criteria should be in (' . implode(' , ', $sortCriteriaArray) . ')']);
        }
        $sortedMovie = Movie::orderBy($criteria)->get();
        if (count($sortedMovie) > 0) {
            return response()->json(['status' => 'success', 'data' => MoviesResource::collection($sortedMovie)]);
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
            return response()->json(['status' => 'success', 'data' => $filteredMovies]);
        }
        return response()->json(['status' => 'error']);
    }
}
