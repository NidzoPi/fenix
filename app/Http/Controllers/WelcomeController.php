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
            $userName = $volunteer->user->name;
            $userProfileImage = $volunteer->user->profile->image;
            $userId = $volunteer->user->id;
            
            
            foreach ($posts as $post) {
                $sum += $post->hours;
            }

            $models[] = [
                'volunteer' => $volunteer,
                'hours' => $sum,
                'userName' => $userName,
                'userProfileImage' => $userProfileImage,
                'userId' => $userId,
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


      $orgHoursModel = [];

      foreach ($users as $user)
      {
        
        $userVolunteers = $user->volunteers;
        $sumOrgHours = 0;
        $userImage = $user->profile->image;
        $userName = $user->name;
        $userPosts = $user->posts;
        $postSum = 0;
        $userId = $user->id;

        foreach ($userPosts as $post) {
          $postSum ++;
          $postHours = $post->hours;
          $sumPostHour = 0;
          foreach($postHours as $postHour)
          {
            $sumPostHour += $postHour->hours;
          }
          $sumOrgHours += $sumPostHour;
        }

/*
         foreach ($userVolunteers as $userVolunteer) 
         {
           $volunteersHours = $userVolunteer->hours;
           $sumVolHours = 0;


           foreach ($volunteersHours as $volunteerHour) {
             $sumVolHours += $volunteerHour->hours;
           }
           $sumOrgHours += $sumVolHours;
         }
*/

         $orgHoursModel[] = [
          'sumOrgHours' => $sumOrgHours,
          'userImage' => $userImage,
          'userName' => $userName,
          'postSum' => $postSum,
          'userId' => $userId,
         ];
      
      }



      uasort($orgHoursModel, function($a, $b) {
            if ($a['sumOrgHours'] == $b['sumOrgHours']) {
                return 0;
            }  

            return ($a['sumOrgHours'] > $b['sumOrgHours']) ? -1 : 1;
        });

        $takeOrgHours =  array_slice($orgHoursModel, 0, 5);
    
 
    	return view ('welcome',[
            'userModels' => $userModels,
            'takeModels' => $takeModels,
            'takeOrgHours' => $takeOrgHours,
          ], 
          compact('sumOfPosts', 'sumOfHours', 'sumOfUsers', 'sumOfVolunteers', 'user'));
    }
}
