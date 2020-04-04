<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Hour;
use App\Volunteer;
use App\User;
use App\Profile;

class WelcomeController extends Controller
{
    public function index  (User $user)
    {

      // Get 10 the best volunteers

        $volunteers = Volunteer::all();
        
        $models = [];

        foreach ($volunteers as $volunteer) {
            $posts = $volunteer->hours;
            $sum = 0;

            foreach ($posts as $post) {
                $sum += $post->hours;
            }

            $models[] = [
                'volunteer' => $volunteer,
                'hours' => $sum,
            ];
        }


        uasort($models, function($a, $b) {
            if ($a['hours'] == $b['hours']) {
                return 0;
            }  

            return ($a['hours'] > $b['hours']) ? -1 : 1;
        });

        $takeModels =  array_slice($models, 0, 10);
       


    	$posts = Post::all();
    	$sumOfPosts = $posts->count();

    	$hours = Hour::all();
    	$sumOfHours = 0;

  		foreach ($hours as $h) {
  			$sumOfHours += $h->hours;
  		}

  		$users = User::all();
  		$sumOfUsers = $users->count();

  		$volunteers = Volunteer::all();
  		$sumOfVolunteers = $volunteers->count();

 		$userModels = [];

  		foreach ($users as $user) {

  			$u = $user->profile;
  			$image = $u->image;
        $title = $u->title;
        $id = $u->id;

  			$userModels[] = [
  				'image' => $image,
          'title' => $title,
          'id'    => $id,
  			];
  			
  		}

 
    	return view ('welcome',[
            'userModels' => $userModels,
            'takeModels' => $takeModels,
          ], 
          compact('sumOfPosts', 'sumOfHours', 'sumOfUsers', 'sumOfVolunteers', 'user'));
    }
}
