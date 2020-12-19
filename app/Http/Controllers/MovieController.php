<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $popular = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'])->map(function ($movie) {
            return collect($movie)->merge([
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'vote_average' => $movie['vote_average'] * 10,
                'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $movie['title'],
            ]);
        });

        $now_playing = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'])->map(function ($movie) {
            return collect($movie)->merge([
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'vote_average' => $movie['vote_average'] * 10,
                'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $movie['title'],
            ]);
        });

        $genre = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'])->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return [$popular, $genre, $now_playing];
    }

    public function show($id)
    {
        $movie = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')->json());

        $movie = $movie->merge([
            'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $movie['title'],
            'vote_average' => $movie['vote_average'] * 10,
            'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
            'youtube_link' => $movie['videos']['results'] ? 'https://www.youtube.com/embed/' . $movie['videos']['results'][0]['key'] : '',
        ]);

        return $movie;
    }
}
