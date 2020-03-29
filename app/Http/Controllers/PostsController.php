<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use DB;
use App\User;
use App\Post;
use App\Volunteer;

class PostsController extends Controller
{
    public function __construct()
    {
    	
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
    	$data = request()->validate([

    		'title' => 'required',
    		'description' => 'required',
    		'image' => ['required', 'image'],

    	]);

    	$imagePath = request('image')->store('uploads', 'public');

    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    	$image->save();

    	auth()->user()->posts()->create([
    		'title' => $data['title'],
    		'description' => $data['description'],
    		'image' => $imagePath,
    	]);

    	return redirect('/profile/'.auth()->user()->id);
    }

    public function show ( Post $post)
    {

    
         $postHours = $post->hours;
         $models = [];


         foreach ($postHours as $pH) {
             $volunteer = $pH->volunteer;
             $vHours = $volunteer->hours;
             foreach ($vHours as $vH) {
                 $sum = $vH->hours;
             }

             $models[] = [

                'volunteer' => $volunteer,
                'sum' => $sum,

             ];
         }

            uasort($models, function($a, $b) {
            if ($a['sum'] == $b['sum']) {
                return 0;
            }  

            return ($a['sum'] > $b['sum']) ? -1 : 1;
        });

    	return view('posts.show', ['models' => $models])->withPost($post);
    }
}
