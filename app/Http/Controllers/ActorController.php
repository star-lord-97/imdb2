<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    public function index($page = 1)
    {
        $popular = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/popular?page=' . $page)->json()['results'])->map(function ($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path'] : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],
            ]);
        });

        return $popular;
    }

    public function show($id)
    {
        $actor = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id)->json());
        $socials = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')->json());
        $cast = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')->json()['cast'])->sortByDesc('popularity')->take(5);
        $credits = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')->json()['cast']);

        $actor = $actor->merge([
            'birthday' => Carbon::parse($actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($actor['birthday'])->age,
            'profile_path' => $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w300' . $actor['profile_path'] : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],
            'twitter' => $socials['twitter_id'] ? 'https://twitter.com/' . $socials['twitter_id'] : null,
            'facebook' => $socials['facebook_id'] ? 'https://facebook.com/' . $socials['facebook_id'] : null,
            'instgram' => $socials['instagram_id'] ? 'https://instagram.com/' . $socials['instagram_id'] : null,
            'cast' => $cast->map(function ($show) {
                return collect($show)->merge([
                    'poster_path' =>
                    $show['poster_path']
                        ? 'https://image.tmdb.org/t/p/w185' . $show['poster_path']
                        : ($show['title']
                            ? 'https://ui-avatars.com/api/?size=235&name=' . $show['title']
                            : 'https://ui-avatars.com/api/?size=235&name=' . $show['name']),
                ]);
            }),
            'credits' => $credits->map(function ($show) {
                $releaseDate = isset($show['release_date']) ? $show['release_date'] : (isset($show['first_air_date']) ? $show['first_air_date'] : null);

                return collect($show)->merge([
                    'release_date' => $releaseDate,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => isset($show['title']) ? $show['title'] : $show['name'],
                ]);
            })->sortByDesc('release_year'),
        ]);

        return $actor;
    }
}
