<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MoviesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'rating' => $this->rating,
            'genres'=>GenreResource::collection($this->genres),
            'release_year' => $this->release_year,
            'gross_profit' => $this->gross_profit,
            'director' => $this->director,
            'actors_list' => ActorsResource::collection($this->actors)
        ];
    }
}
