<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    //

    public function index()
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        // $animeURL = env('ANIME_BASE_URL');
        $MAX_BANNER = 3;
        $MAX_MOVIE_ITEM = 10;

        // HIT BANNER API
        $bannerResponse = Http::get("{$baseURL}/trending/movie/week", [
            'api_key' => $apiKey,
        ]);

        // prepare variable
        $bannerArray = [];

        //cheking api response
        if ($bannerResponse->successful()) {
            //cheking data available or null
            $resultArray = $bannerResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($bannerArray, $item);

                    // checking if reached max banner
                    if (count($bannerArray) >= $MAX_BANNER) {
                        break;
                    }
                }
            }
        }

        // HIT TOP MOVIE API
        $topMovieResponse = Http::get("{$baseURL}/movie/top_rated", [
            'api_key' => $apiKey,
        ]);
        // dd($topMovieResponse->json());
        // prepare variable
        $topMovieArray = [];

        //cheking api response
        if ($topMovieResponse->successful()) {
            //cheking data available or null
            $resultArray = $topMovieResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($topMovieArray, $item);

                    // checking if reached max movie item
                    if (count($topMovieArray) >= $MAX_MOVIE_ITEM) {
                        break;
                    }
                }
            }
        }
        // HIT  API TV show
        $TvShowResponse = Http::get("{$baseURL}/tv/top_rated", [
            'api_key' => $apiKey,
        ]);
        // dd($topMovieResponse->json());
        // prepare variable
        $TvShowArray = [];

        //cheking api response
        if ($TvShowResponse->successful()) {
            //cheking data available or null
            $resultArray = $TvShowResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($TvShowArray, $item);

                    // checking if reached max movie item
                    if (count($TvShowArray) >= $MAX_MOVIE_ITEM) {
                        break;
                    }
                }
            }
        }

        // HIT MOvie Pupular TMDB
        $animeResponse = Http::get("{$baseURL}/discover/tv", [
            'api_key' => $apiKey,
            'with_genres' => 16, // Genre anime di TMDB
            'with_origin_country' => 'JP', // Hanya anime dari Jepang
        ]);
        // dd($animeResponse->json());
        // prepare variable
        $animeArray = [];

        //cheking api response
        if ($animeResponse->successful()) {
            //cheking data available or null
            $resultArray = $animeResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($animeArray, $item);

                    // checking if reached max movie item
                    if (count($animeArray) >= $MAX_MOVIE_ITEM) {
                        break;
                    }
                }
            }
        }
        // HIT ANIME API FROM TMDB
        $onGoingAnimeResponse = Http::get("https://api.themoviedb.org/3/discover/movie", [
            'api_key' => $apiKey,
            'sort_by' => 'popularity.desc', // Urut berdasarkan popularitas
            'first_air_date.gte' => now()->subMonths(3)->format('Y-m-d'), // Anime 3 bulan terakhir
            'page' => 1,

        ]);
        // dd($onGoingAnimeResponse->json());  
        // prepare variable
        $onGoingAnimeArray = [];

        //cheking api response
        if ($onGoingAnimeResponse->successful()) {
            //cheking data available or null
            $resultArray = $onGoingAnimeResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($onGoingAnimeArray, $item);

                    // checking if reached max movie item
                    if (count($onGoingAnimeArray) >= $MAX_MOVIE_ITEM) {
                        break;
                    }
                }
            }
        }





        // // HIT ANIME API FROM TMDB
        // $sameOnGoing = Http::get("{$animeURL}/ongoing",);
        // // dd($sameOnGoing->json());  
        // // prepare variable
        // $sameArray = [];

        // //cheking api response
        // if ($sameOnGoing->successful()) {
        //     //cheking data available or null
        //     $resultArray = $sameOnGoing->object()->data;

        //     if (isset($resultArray)) {
        //         //looping response data 
        //         foreach ($resultArray as $item) {
        //             // save data to new variable
        //             array_push($sameArray, $item);

        //             // checking if reached max movie item
        //             if (count($sameArray) >= $MAX_MOVIE_ITEM) {
        //                 break;
        //             }
        //         }
        //     }
        // }

        // dd($onGoingAnimeArray);

        return view('movie.home', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'banner' => $bannerArray,
            'topMovie' => $topMovieArray,
            'tvshow'  => $TvShowArray,
            'anime' => $animeArray,
            'airinganime' => $onGoingAnimeArray,
            // 'onGoingAnime'=> $sameArray,
        ]);
    }
    public function movies()
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $sortBy = "popularity.desc";
        $page = 1;
        $minimalVoter = 100;

        $movieResponse = Http::get("{$baseURL}/discover/movie", [
            'api_key' => $apiKey,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page,
        ]);

        $movieArray = [];

        if ($movieResponse->successful()) {
            //cheking data available or null
            $resultArray = $movieResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($movieArray, $item);

                    // checking if reached max movie item
                    // if (count($TvShowArray) >= $MAX_MOVIE_ITEM) {
                    //     break;
                    // }
                }
            }
        }



        return view('movie.movie', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'movies' => $movieArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minimalVoter' => $minimalVoter,
        ]);
    }
    public function tvShows()
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $sortBy = "popularity.desc";
        $page = 1;
        $minimalVoter = 100;

        $tvResponse = Http::get("{$baseURL}/discover/tv", [
            'api_key' => $apiKey,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page,
        ]);

        $tvArray = [];

        if ($tvResponse->successful()) {
            //cheking data available or null
            $resultArray = $tvResponse->object()->results;

            if (isset($resultArray)) {
                //looping response data 
                foreach ($resultArray as $item) {
                    // save data to new variable
                    array_push($tvArray, $item);

                    // checking if reached max movie item
                    // if (count($TvShowArray) >= $MAX_MOVIE_ITEM) {
                    //     break;
                    // }
                }
            }
        }



        return view('tv_shows.tv', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'tvShows' => $tvArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minimalVoter' => $minimalVoter,
        ]);
    }

    public function search()
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        return view('search', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
        ]);
    }
    public function movieDetails($id)
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        // hit api
        $response = Http::get("{$baseURL}/movie/{$id}", [
            'api_key' => $apiKey,
            'append_to_response' => 'videos'
        ]);

        $movieData = null;

        if ($response->successful()) {
            $movieData = $response->object();
        }
        return view('movie.movie_details', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'movieData' => $movieData

        ]);
    }
    public function tvDetails($id)
    {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        // hit api
        $response = Http::get("{$baseURL}/tv/{$id}", [
            'api_key' => $apiKey,
            'append_to_response' => 'videos'
        ]);

        $tvData = null;

        if ($response->successful()) {
            $tvData = $response->object();
        }
        return view('tv_shows.tv_details', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'tvData' => $tvData

        ]);
    }
}
