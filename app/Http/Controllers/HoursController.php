<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Volunteer;
use App\User;
use App\Hour;
use DB;
use Session;

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

         $hours = Hour::all();
         foreach ($hours as $h) {
             if ($h->post_id == $request->post_id && $h->volunteer_id == $request->volunteer_id)
             {
                Session::flash('error', 'Taj volonter već ima učešće u akciji / projektu.');
                return redirect()->back();
             }
         }

         $hours = new Hour;
         $hours->post_id = $request->post_id;
         $hours->volunteer_id = $request->volunteer_id;
         $hours->hours = $request->hours;
         $hours->save();

        Session::flash('success', 'Uspješno ste dodali volonteru učešće u akciji / projektu.');

        return redirect()->back();
    	//return redirect('/p/'.$hours->post_id);
    }

    public function destroy(Hour $hour)
    {
        $hour->delete();

        Session::flash('success', 'Uspješno ste obrisali sate volonteru.');
        return redirect()->back();
    }

}
