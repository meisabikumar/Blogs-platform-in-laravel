<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cover_image' => 'array',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
