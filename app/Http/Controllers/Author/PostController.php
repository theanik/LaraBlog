<?php

namespace App\Http\Controllers\Author;

use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Notification; 
use App\Notifications\NewAuthorPostNotification;
use App\User;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'image'=> 'required',
            'categories'=> 'required',
            'tags'=> 'required',
            'body'=> 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            $carbon = Carbon::now()->toDateString();
            $imgname = $slug."-".$carbon."-".uniqid().".".$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $postImg = Image::make($image)->resize(1600,1066)->save($imgname,90);
            Storage::disk('public')->put('post/'.$imgname,$postImg);

        }else{
            $imgname = "default.png";
        }

        $post = new Post();

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imgname;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;

        $post->save();

        $post->categories()->attach($request->categories); //this categories() come from post model function
        $post->tags()->attach($request->tags); //this tags() come from post model function

        $alladmin = User::where('role_id','1')->get();
        Notification::send($alladmin, new NewAuthorPostNotification($post));
        Toastr::success('Post Add successfylly','success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id == Auth::id()){
            return view('author.post.show',compact('post'));
        }else{
            Toastr::error('Error Bad Request','error');
            return redirect()->route('author.dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id == Auth::id()){
                $tags = Tag::all();
                $categories = Category::all();
                return view('author.post.edit',compact('post','categories','tags'));
        }else{
            Toastr::error('Error Bad Request','error');
        return redirect()->route('author.dashboard');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required',
            'image'=> 'image',
            'categories'=> 'required',
            'tags'=> 'required',
            'body'=> 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            $carbon = Carbon::now()->toDateString();
            $imgname = $slug."-".$carbon."-".uniqid().".".$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postImg = Image::make($image)->resize(1600,1066)->save($imgname,90);
            Storage::disk('public')->put('post/'.$imgname,$postImg);

        }else{
            $imgname = $post->image;
        }
        
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imgname;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;

        $post->save();

        $post->categories()->sync($request->categories); //this categories() come from post model function
        $post->tags()->sync($request->tags); //this tags() come from post model function
        Toastr::success('Post Update successfylly','success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id == Auth::id()){
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $post->categories()->detach();
            $post->tags()->detach();
            $post->delete();
            Toastr::success('Post Delete successfylly','success');
            return redirect()->route('author.post.index');
        }else{
            Toastr::error('Error Bad Request','error');
        return redirect()->route('author.dashboard');
        }
    }
}
