<?php

namespace App\Http\Controllers\Api;

use App\FavoriteMovie;
use App\Movie;
use App\User;
use App\Http\Controllers\Api\ApiBaseController;
use Tmdb\Laravel\Facades\Tmdb;

class UserController extends ApiBaseController
{
    /**
     * @param $id
     * @return mixed
     */
    public function addFavourite($id)
    {
        try {
            $tmdb = Tmdb::getMoviesApi()->getMovie($id);
            $data = [
                'title' => $tmdb['title'],
                'description' => $tmdb['overview'],
                'vote_average' => $tmdb['vote_average'],
                'poster' => $tmdb['poster_path'],
            ];
            $movie = Movie::firstOrCreate(['tmdb_id' => $id], $data);
            FavoriteMovie::create([
                'movie_id' => $movie->id,
                'user_id' => \Auth::user()->id
            ]);
        } catch (\Exception $exception) {
            $this->sendError($exception->getMessage());
        }
        return $this->sendResponse(\Auth::user()->favoriteMovies, 'Favourite movie added');
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        try {
            $favoriteMovies = \Auth::user()->favoriteMovies;
        } catch (\Exception $exception) {
            $this->sendError($exception->getMessage());
        }
        return $this->sendResponse($favoriteMovies, '');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function removeFavourite($id)
    {
        try {
            $movie = Movie::where('tmdb_id', $id)->first();
            $deleted = FavoriteMovie::BelongsToUser()->where('movie_id', $movie->id)->delete();
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        return $this->sendResponse($deleted, '');
    }
}
