<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	protected $guarded = [];


	public function profileImage()
	{
		return ($this->image) ? '/storage/'. $this->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
	}

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
