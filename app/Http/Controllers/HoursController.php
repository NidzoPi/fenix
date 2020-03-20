<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Volunteer;
use App\User;
use App\Hour;
use DB;

class HoursController extends Controller
{

	public function create (User $user, Post $post)
	{
		return view ('hours.create', compact('user', 'post'));
	}

	public function store(Request $request)
    {
    	 $this->validate($request, array(
            'post_id' => 'required',
            'volunteer_id' => 'required',
            'hours' => 'required',
        ));

         $hours = new Hour;
         $hours->post_id = $request->post_id;
         $hours->volunteer_id = $request->volunteer_id;
         $hours->hours = $request->hours;
         $hours->save();

    	return redirect('/p/'.$hours->post_id);
    }

    public function showInAction(Volunteer $volunteer)
    {
        $rposts = DB::select('select v.first_and_last_name from volunteers v inner join hours h on v.id = h.volunteer_id;');

        return view ('volunteers.show')->withRposts($rposts);
        
    }


}
