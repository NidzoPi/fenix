<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use DB;
use App\Hours;
use Session;

class OrganizationsController extends Controller
{
   public function index($username)
    {
    
      /*  $rv = DB::select('select hours from hours h 
            inner join posts p on h.post_id = p.id
            where p.user_id = '. $user->id); */
        $user = User::where('username', '=', $username)->first();

        $userPosts = $user->posts;
        $sumHours = 0;
        $postsHoursModel = [];

        foreach ($userPosts as $p)
        {
            $sumPostHours = 0;
            $sumVolunteer = 0;
            $pImage = $p->image;
            $pTitle = $p->title;
            $pSlug = $p->slug;

            $postHours = $p->hours;
            

            foreach ($postHours as $h)
            {
                $sumVolunteer++;
                $sumHours+=$h->hours;
                $sumPostHours+=$h->hours;
            }

            $postsHoursModel[] = [
                'sumPostHours' => $sumPostHours,
                'pImage' => $pImage,
                'pTitle' => $pTitle,
                'pSlug' => $pSlug,
                'sumVolunteer' => $sumVolunteer,
            ];
        }



        return view('profiles.index',
            ['postsHoursModel' => $postsHoursModel],
            compact('user', 'sumHours'));
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

    		'title' => 'required|string|min:3|max:40',
    		'address' => 'required|string|min:3|max:40',
            'place' => 'required|regex:/[a-z{1}A-Z{1}]+/|min:2|max:30',
    		'fbUrl' => 'nullable|url',
            'ytUrl' => 'nullable|url',
            'president' => 'required|regex:/[a-z{1}A-Z{1}]+/|min:4|max:40',
            'tNumber' => 'required|numeric',
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

        Session::flash('success', 'Uspješno ste uredili informacije o organizaciji! Nadamo se da ćete imati mnogo uspjeha.');
        
    	return redirect("/profile/".auth()->user()->username);

    }

}
