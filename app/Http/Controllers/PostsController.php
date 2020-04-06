<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use DB;
use App\User;
use App\Post;
use App\Volunteer;
use App\Tag;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
    	
    }

    public function create()
    {
        $tags = Tag::all();
    	return view('posts.create', compact('tags'));
    }

   
    public function store(Request $request)
    {
  
    	$this->validate($request, array(

    		'title' => 'required',
    		'description' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'place' => 'required',
    		'image' => ['required', 'image'],

    	));

    	$imagePath = request('image')->store('uploads', 'public');

    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    	$image->save();


        // Store

        $post = new Post;

    	
    	$post->title = $request->title;
    	$post->description = $request->description;
        $post->startDate = $request->startDate;
        $post->endDate = $request->endDate;
        $post->place = $request->place;
    	$post->image = $imagePath;
        $post->user_id = Auth::user()->id;
    
        $post->save();

        $post->tags()->sync($request->tags, false);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show (Post $post)
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

    public function edit (Post $post)
    {
        $this->authorize('update', $post);

        $tags = Tag::all();
        $tags2 = array();
        $post_tags = DB::select('select * from post_tag');

        foreach($tags as $tag)
        {
            foreach ($post_tags as $post_tag) {

                if ($post_tag->post_id == $post->id && $post_tag->tag_id == $tag->id )
                    $tags2[] = $tag->name;
            }
        }
        
        return view('posts.edit', compact('post', 'tags2', 'tags'));
    }

    public function update(Request $request,Post $post)
    {
        
        $this->authorize('update', $post);
  
        $data =request()->validate([

            'title' => 'required',
            'description' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'place' => 'required',
            'image' => '',

        ]);
       

        if (request('image')){

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        $imageArray = ['image' => $imagePath];
        }

    
        $post->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        if (isset($request->tags)){
        $post->tags()->sync($request->tags);
        }
        else{
            $post->tags()->sync(array());
        }

        return redirect('/p/'.$post->id);
    }
}
