<?php

namespace App\Http\Controllers;

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
        $movieInstance = new Movie;
        $movieInstance->title = $request->title;
        $movieInstance->description = $request->description;
        $movieInstance->image_url = $request->image_url;
        $movieInstance->rating = $request->rating;
        $movieInstance->release_year = $request->release_year;
        $movieInstance->gross_profit = $request->gross_profit;
        $movieInstance->director = $request->director;
        if ($movieInstance->save()) {
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
        $movieInstance = Movie::find($id);
        $movieInstance->fill($request->all());
        if ($movieInstance->save()) {
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
        if (Movie::destroy($id)) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function sort($criteria)
    {
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

        $filteredMovies = Genre::with('movies')
            ->where('name', 'like', '%' . $genre . '%')
            ->get();
        if (count($filteredMovies) > 0) {
            return response()->json(['status' => 'success', 'data' => $filteredMovies]);
        }
        return response()->json(['status' => 'error']);
    }
}
