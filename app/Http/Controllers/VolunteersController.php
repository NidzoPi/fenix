<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use Intervention\Image\Facades\Image;
use App\User;
use DB;
use Auth;
use Session;
use Storage;

class VolunteersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function create()
	{
		return view('volunteers.create');
	}
	
    public function show (Volunteer $volunteer)
    {
       /* $rv = DB::select('select * from posts p inner join hours h 
            on p.id = h.post_id  where h.volunteer_id =' .$volunteer->id.'');*/
        
        $user = Auth::user();
        $postsHours = $volunteer->hours;

        $sum = 0;
        $models = [];

        foreach ($postsHours as $pH) {
            $sum+=$pH->hours;
            $post = $pH->post;
            $hours = $pH->hours;            

             $models[] = [
                'post' => $post,
                'hours'=> $hours,
            ];
        }

    	return view('volunteers.show', [
            'models' => $models
        ])->withSum($sum)->withVolunteer($volunteer)->withUser($user);
    }

    public function store()
    {
    	$data = request()->validate([

    		'first_and_last_name' => 'required',
    		'date_of_joining' => 'required',
            'date_of_born'   => 'required',
            'jmbg'  => 'required',
            'rank'  => 'required',
    		'image' => ['required', 'image'],

    	]);

    	$imagePath = request('image')->store('volunteers', 'public');

    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    	$image->save();

    	auth()->user()->volunteers()->create([
    		'first_and_last_name' => $data['first_and_last_name'],
    		'date_of_joining' => $data['date_of_joining'],
            'date_of_born' => $data['date_of_born'],
            'jmbg' => $data['jmbg'],
            'rank' => $data['rank'],
    		'image' => $imagePath,
    	]);

        Session::flash('success', 'Uspješno ste dodali volontera! Nadamo se da će broj biti sve veći.');
        return redirect()->back();
    	//return redirect('/profile/'.auth()->user()->id);
    }

    public function showAll ()
    {
        $user = Auth::user();
        $volunteers = $user->volunteers;
        
        $models = [];

        foreach ($volunteers as $volunteer) {
            $posts = $volunteer->hours;
            $sum = 0;
            $numberOfPosts = 0;

            foreach ($posts as $post) {
                $sum += $post->hours;
                $numberOfPosts++;
            }

            $models[] = [
                'volunteer' => $volunteer,
                'hours' => $sum,
                'number' => $numberOfPosts,
            ];
        }


        uasort($models, function($a, $b) {
            if ($a['hours'] == $b['hours']) {
                return 0;
            }  

            return ($a['hours'] > $b['hours']) ? -1 : 1;
        });
        
        return view('volunteers.showAll', ['models' => $models]);
    }


    public function edit (Volunteer $volunteer)
    {

        $user = Auth::user();
        $this->authorize('update', $volunteer);


        return view('volunteers.edit', compact('volunteer'));
    }

    public function update(Volunteer $volunteer)
    {


        $this->authorize('update', $volunteer);


        $data =request()->validate([

            'first_and_last_name' => 'required',
            'date_of_joining' => 'required',
            'date_of_born' => 'required',
            'image' => '',

        ]);

        if (request('image')){

            $imagePath = request('image')->store('volunteers', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }


        $volunteer->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        Session::flash('success', 'Uspješno ste uredili informacije o volonteru!');
        return redirect("/v/{$volunteer->id}");

    }

    public function destroy(Volunteer $volunteer)
    {
        //$path = asset('/storage/app/public/volunteers/{{$volunteer->image}}');
        //$path = public_path("storage/{$volunteer->image}");
        //  dd(storage_path('/app/public/'.$volunteer->image));
        // Storage::delete($path);
         $this->authorize('update', $volunteer);

        $volunteer->hours()->delete();
        unlink(storage_path('/app/public/'.$volunteer->image));
        $volunteer->delete();

        Session::flash('success', 'Uspješno ste obrisali volontera iz baze!');
        return redirect('/v/all');

    }

}
