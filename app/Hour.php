<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{	
	protected $guarded = [];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
	public function volunteer()
	{
		return $this->belongsTo(Volunteer::class);
	}

}
