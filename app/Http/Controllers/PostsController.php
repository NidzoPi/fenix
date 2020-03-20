<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use DB;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
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

    public function show (User $user, \App\Post $post)
    {

         $rposts = DB::select('select * from volunteers v inner join hours h on v.id = h.volunteer_id where h.post_id = '.$post->id.'');
    	return view('posts.show', compact('post', 'rposts'));
    }
}
