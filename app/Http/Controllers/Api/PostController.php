<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class PostController extends Controller
{
    use SlugGenerator;
    public function index() {
        $posts = Post::paginate(6);

        // return response()->json([
        //     "esito" => "ok",
        //     "dataRichiesta" => now(),
        //     "data" => $posts
        // ]);

        return response()->json($posts);

    }
        public Function store(Request $request) {
            $data = $request->validate([
            "title" => "required|max:30",
            "content" => "required|max:140",
            "category_id" => "nullable",
            "tags" => "nullable"
            ]);

            $newPost = new Post();
            $newPost->fill($data);
            $newPost->save();
            $newPost->user_id = 5;
            $newPost->slug = $this->generateSlug($data["title"]);
            return response()->json($newPost);
        }
        
        public function show($slug) {

            $post = Post::where("slug", $slug)->with(["user","tags","category"])->first();

            // $post = Post::findOrFail($id);

            // $post->load("user","tags","category");
            return response()->json($post);
        }
    }
