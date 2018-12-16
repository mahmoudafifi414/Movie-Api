API routes should be prefixes with /api/v1

the routes endpoints:
   get /api/v1/movies/{size}
   get /api/v1/movie/id
   get /api/v1/movie/id/edit
   patch /api/v1/movie/id
   delete/api/v1/movie/id

   get /api/v1/movie/sort/{criteria}
   get /api/v1/movie/filter/{genre}


you can save new Movie in the following json shape

{
	 "title":"Game of thrones",
	 "description": "testtesttesttesttesttesttesttest",
	 "image_url":"https://www.layoutit.com/img/people-q-c-600-200-1.jpg",
	 "release_year":2014,
	 "gross_profit":"2555000000M",
	 "director":"mahmoud",
	 "actors":[
	 	   {
	 	   	"name":"mahmoud gamal"
	 	   }
	 ],
	 "genres":[
	 	 {
	 	 	"name":"action"
	 	 }
	 ]
}



run the test through
 ./vendor/bin/phpunit
 
 
 please run "composer install"
