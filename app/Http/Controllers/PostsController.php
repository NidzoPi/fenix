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
use Session;
use Storage;
use App\PostImage;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    public function __construct()
    {
    	
    }

    public function showUploadImages($postId)
    {

        $post = Post::find($postId);
        $this->authorize('update', $post);

        $postImages = $post->images;

        return view('images.upload')->withPost($post)->withPostImages($postImages);

    }

    public function uploadImages(Post $post, Request $request)
    {
        $this->authorize('update', $post);
       $image = $request->file('file');

       if ($image)
       {
        $imageName = time() . '-' . $image->getClientOriginalName();
      //  

        $image->move('images', $imageName);
        $imagePath = "images/$imageName";

        $imagee = Image::make(sprintf('images/%s', $imageName))->resize(1200, 720)->save();

        $imggg = $post->images()->create(['image_path' => $imagePath]);
       }
     

       return $imggg;
    }

    public function deleteImage($postId, $imageId)
    {
        $post = Post::find($postId);
        $this->authorize('update', $post);
        
        $image = PostImage::find($imageId);
        //Storage::delete($image->image_path);
       unlink(public_path($image->image_path));
        
        $image -> delete();
        
        Session::flash('success', 'Slika je uspješno obrisana');
        return redirect()->back();
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
        $modifiedTitle = strtolower(str_replace(' ', '-', $post->title));
        $post->slug  = auth()->user()->username.'-'.$modifiedTitle;
        $ifTitleExsist = Post::where('slug', '=', $post->slug)->first();
        if ($ifTitleExsist != null){  $post->slug  = auth()->user()->username.'-'.$modifiedTitle.rand(1,1000); }
    	$post->description = $request->description;
        $post->startDate = $request->startDate;
        $post->endDate = $request->endDate;
        $post->place = $request->place;
    	$post->image = $imagePath;
        $post->user_id = Auth::user()->id;
    
        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'Uspješno ste napravili akciju / projekat!');

        return redirect('/profile/'.auth()->user()->username);
        
    }

    public function show ($postSlug)
    {
        $post = Post::where('slug', '=', $postSlug)->first();
    
         $postHours = $post->hours;
         $models = [];


         foreach ($postHours as $pH) {
             $volunteer = $pH->volunteer;
             $vHours = $volunteer->hours;
             $user = $volunteer->user->name;
             $userImage =  $volunteer->user->profile->image;
          
             foreach ($vHours as $vH) {
                 $sum = $vH->hours;
             }

             $models[] = [

                'volunteer' => $volunteer,
                'sum' => $sum,
                'user' => $user,
                'userImage' => $userImage,
                'hours' => $pH,
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

        Session::flash('success', 'Uspješno ste uredili akciju / projekat! Možete nastaviti dalje sa aktivnostima.');
        return redirect('/p/'.$post->slug);
    }

    public function destroy(Post $post)
    {

        $this->authorize('update', $post);
        
         $post->tags()->detach();
         $post->hours()->delete();

         foreach($post->images as $image){
           unlink(public_path($image->image_path));
        }

        $post->images()->delete();
        unlink(storage_path('/app/public/'.$post->image));
        $post->delete();

        Session::flash('success', 'Uspješno ste obrisali akciju / projekat.');
        return redirect('/profile/'.auth()->user()->username);
    }

}
