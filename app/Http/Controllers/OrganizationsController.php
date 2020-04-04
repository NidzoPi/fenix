<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use DB;
use App\Hours;

class OrganizationsController extends Controller
{
   public function index(User $user)
    {
    
      /*  $rv = DB::select('select hours from hours h 
            inner join posts p on h.post_id = p.id
            where p.user_id = '. $user->id); */

        $userPosts = $user->posts;
        $sumHours = 0;

        foreach ($userPosts as $p)
        {
            $postHours = $p->hours;
            foreach ($postHours as $h)
            {
                $sumHours+=$h->hours;
            }
        }



        return view('profiles.index', compact('user', 'sumHours'));
    }



    public function edit (User $user)
    {
    	$this->authorize('update', $user->profile);

    	return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {

    	$this->authorize('update', $user->profile);

    	$data =request()->validate([

    		'title' => 'required',
    		'address' => 'required',
    		'fbUrl' => 'url',
            'ytUrl' => 'url',
            'president' => 'required',
            'tNumber' => 'required',
    		'image' => '',

    	]);

    	if (request('image')){

	    	$imagePath = request('image')->store('profile', 'public');

	    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
	    	$image->save();

            $imageArray = ['image' => $imagePath];
    	}

    	auth()->user()->profile->update(array_merge(
    		$data,
    		$imageArray ?? []
	 	));

    	return redirect("/profile/{$user->id}");

    }

}
