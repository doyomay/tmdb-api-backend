<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb;

class TMDBController extends ApiBaseController
{
    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tmdb = Tmdb::getMoviesApi()->getMovie($id);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        return $this->sendResponse($tmdb, '');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function popular(Request $request)
    {
        try {
            $page = $request->get('page') ?? 1;
            $popularMovies = Tmdb::getMoviesApi()->getPopular(['page' => $page]);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        return $this->sendResponse($popularMovies, '');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('q');
            $page = $request->get('page') ?? 1;
            $result = Tmdb::getSearchApi()->searchMovies($search, ['page' => $page]);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        return $this->sendResponse($result, '');
    }
}
