<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FavoriteMovie extends Pivot
{
    protected $table = 'favorite_movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'user_id',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'user_id',
        'movie_id'
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBelongsToUser($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }
}
