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
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function create (User $user, Post $post)
	{
		return view ('hours.create', compact('user', 'post'));
	}

	public function store(Request $request)
    {
    	 $this->validate($request, array(
            'post_id' => 'required|integer',
            'volunteer_id' => 'required|integer',
            'hours' => 'required|numeric|max:300',
        ));

         // Ovaj kod ne radi kako sad zamislio, moracu da se angazujem.

      /*   $volunteers = auth()->user()->volunteers;
         $br = 0;

         foreach($volunteers as $volunteer)
         {
            if($volunteer->id == $request->volunteer_id)
            {
              $br++;
            }   
            if ($br < 1) 
            {
              Session::flash('error', 'Taj volonter se ne nalazi u tvojoj organizaciji.');
              return redirect()->back();
            }
         } */

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

       // dd($hour->post);
        $this->authorize('update', $hour->post);
        $hour->delete();

        Session::flash('success', 'Uspješno ste obrisali sate volonteru.');
        return redirect()->back();
    }

}
