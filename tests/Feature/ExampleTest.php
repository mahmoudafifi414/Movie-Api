<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPaginationOfMovies()
    {
        $response = $this->json('GET', '/api/v1/movies/2');

        $response->assertStatus(200);
    }

    public function testMakeRatingForMovies()
    {
        $response = $this->json('POST', '/api/v1/rate/5', ['ratingNumber' => 2]);

        $response->assertStatus(200);
    }

    public function testSavingNewRecordForMovies()
    {
        $response = $this->json('POST', '/api/v1/movie',
            [
                "title" => "Gamsess of thrones",
                "description" => "testtesttesttesttesttesttesttest",
                "image_url" => "https://www.layoutit.com/img/people-q-c-600-200-1.jpg",
                "release_year" => 2014,
                "gross_profit" => "2555000000M",
                "director" => "mahmoud",
                "actors" => [
                    [
                        "name" => "mahmoud gamal"
                    ]
                ],
                "genres" => [
                    [
                        "name" => "action"
                    ]
                ]
            ]
        );

        $response->assertStatus(200);
    }
    public function testUpdatingRecordForMovies(){
        $response = $this->json('PATCH', '/api/v1/movie/5',
            [
                "title" => "testtestest",
                "description" => "testtesttesttesttesttesttesttest",
                "image_url" => "https://www.layoutit.com/img/people-q-c-600-200-1.jpg",
                "release_year" => 2014,
                "gross_profit" => "2555000000M",
                "director" => "mahmoud",
                "actors" => [
                    [
                        "name" => "mahmoud gamal"
                    ]
                ],
                "genres" => [
                    [
                        "name" => "action"
                    ]
                ]
            ]
        );

        $response->assertStatus(200);
    }
    public function testDeletingRecordForMovies()
    {
        $response = $this->json('DELETE', '/api/v1/movie/9');

        $response->assertStatus(200);
    }
}
