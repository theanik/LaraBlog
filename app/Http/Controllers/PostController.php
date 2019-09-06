<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;

class PostController extends Controller
{
   public function index(){
       $posts = Post::latest()->approved()->published()->paginate(15);
      return view('posts',compact('posts'));
   }
   public function details($slug){
      $post = Post::where('slug',$slug)->first();
         $postKey = 'blog_'.$post->id;
         if(!Session::has($postKey)){
            $post->increment('view_count');
            Session::put($postKey, 1);
         }
         if( Post::all()->count() > 3){
            $randomPost = Post::approved()->published()->take(3)->inRandomOrder()->get();
       return view('post',compact('post','randomPost'));
         }else{
            $randomPost = Post::approved()->published()->take(Post::all()->count())->inRandomOrder()->get();
       return view('post',compact('post','randomPost'));
         }
       
   }

   public function post_by_category($slug){
      //return $slug;
       $posts = Category::where('slug',$slug)->first()->posts()->approved()->published()->paginate(15);
       $cat = Category::where('slug',$slug)->first();
       return view('posts',compact('posts','cat'));
   }
   public function post_by_tag($slug){
      $posts = Tag::where('slag',$slug)->first()->posts()->approved()->published()->paginate(15);
      $tag = Tag::where('slag',$slug)->first();
       return view('posts',compact('posts','tag'));
   }


}
