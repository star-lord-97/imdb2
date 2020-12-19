<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index()
    {
        $popular = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular')->json()['results'])->map(function ($show) {
            return collect($show)->merge([
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'vote_average' => $show['vote_average'] * 10,
                'poster_path' => $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $show['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $show['name'],
            ]);
        });

        $top_rated = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'])->map(function ($show) {
            return collect($show)->merge([
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'vote_average' => $show['vote_average'] * 10,
                'poster_path' => $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $show['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $show['name'],
            ]);
        });

        $genre = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'])->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return [$popular, $genre, $top_rated];
    }

    public function show($id)
    {
        $show = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')->json());

        $show = $show->merge([
            'poster_path' => $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $show['poster_path'] : 'https://ui-avatars.com/api/?size=500&name=' . $show['title'],
            'vote_average' => $show['vote_average'] * 10,
            'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
            'youtube_link' => $show['videos']['results'] ? 'https://www.youtube.com/embed/' . $show['videos']['results'][0]['key'] : '',
        ]);

        return $show;
    }
}
