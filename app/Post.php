<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function hours()
    {
    	return $this->hasMany(Hour::class);
    }
    public function tags ()
    {
    	return $this->belongsToMany(Tag::class);
    }
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

}
