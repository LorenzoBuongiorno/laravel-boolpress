<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Mail\RegistrationMail;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where("user_id" , Auth::user()->id)->withTrashed()->get();

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|max:30",
            "content" => "required|max:140",
            "coverImg" => "nullable|max:500",
            "category_id" => "nullable",
            "tags" => "nullable"
        ]);

        $post = new Post();
        $post->fill($data);
    
        $slug = Str::slug($post->title);

        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
          $newSlug = $slug . "-" . $counter;
          $counter++;

          $exists = Post::where("slug", $newSlug)->first();
            
          if (!$exists) {
            $slug = $newSlug;
          }
        }

        $post->slug = $slug;
        $post->user_id = Auth::user()->id;

        if(key_exists("coverImg", $data)) {
          $post->coverImg = Storage::put("PostCovers", $data["coverImg"]);
        }

        $post->save();

        Mail::to("admin@gmail.com")->send(new RegistrationMail());

        if(key_exists("tags", $data)){
          $post->tags()->attach($data["tags"]);
        }

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", ["post" => $post, "categories" => $categories, "tags" => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "title" => "required|max:30",
            "content" => "required|max:140",
            "coverImg" => "nullable|max:500",
            "category_id" => "nullable",
            "tags" => "nullable|exists:tags,id"
          ]);
          $post = Post::findOrFail($id);
      
          if ($data["title"] !== $post->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }

        $post->update($data);

        if (key_exists("coverImg", $data)){
          if($post->coverImg) {
            Storage::delete($post->coverImg);
          }

          $coverImg = Storage::put("postCovers", $data["coverImg"]);
          $post->coverImg = $coverImg;
          $post->save();
        }
    
    
        if (key_exists("tags", $data)) {
            $post->tags()->sync($data["tags"]);
          }

        return redirect()->route("admin.posts.show", $post->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if($post->trashed()){
          $post->tags()->detach();
          $post->forceDelete();
        } else {
          $post->delete();
        }


        return redirect()->route("admin.posts.index");
    }






    
    protected function generateSlug($postTitle) {
        $slug = Str::slug($postTitle);

        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
          $newSlug = $slug . "-" . $counter;
          $counter++;

          $exists = Post::where("slug", $newSlug)->first();
            
          if (!$exists) {
            $slug = $newSlug;
          }
        }
    
        return $slug;

    }
}
