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
            'grossProfit' => $this->gross_profit,
            'director' => $this->director,
            'actorsList' => ActorsResource::collection($this->actors)
        ];
    }
}
