<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use Intervention\Image\Facades\Image;
use App\User;
use DB;

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
        $rv = DB::select('select * from posts p inner join hours h 
            on p.id = h.post_id  where h.volunteer_id =' .$volunteer->id.'');

        $hours = DB::select('select * from hours h inner join volunteers v on h.volunteer_id = v.id');

    	return view('volunteers.show', compact('volunteer', 'rv', 'hours'));
    }

    public function store()
    {
    	$data = request()->validate([

    		'first_and_last_name' => 'required',
    		'date_of_joining' => 'required',
    		'image' => ['required', 'image'],

    	]);

    	$imagePath = request('image')->store('volunteers', 'public');

    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    	$image->save();

    	auth()->user()->volunteers()->create([
    		'first_and_last_name' => $data['first_and_last_name'],
    		'date_of_joining' => $data['date_of_joining'],
    		'image' => $imagePath,
    	]);

    	return redirect('/profile/'.auth()->user()->id);
    }

    public function showAll (Volunteer $volunteer)
    {

      $rv = DB::select('select * from hours h inner join volunteers v on h.volunteer_id = v.id');

    	return view('volunteers.showAll', compact('volunteer', 'rv'));
    }




}
