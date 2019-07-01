<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb;

class TMDBController extends ApiBaseController
{
    public function show($id)
    {
        return Tmdb::getMoviesApi()->getMovie($id);
    }

    public function popular(Request $request)
    {
        $page = $request->get('page') ?? 1;
        return Tmdb::getMoviesApi()->getPopular(['page' => $page]);
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        $page = $request->get('page') ?? 1;
        return Tmdb::getSearchApi()->searchMovies($search, ['page' => $page]);
    }
}
