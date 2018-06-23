<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function showPosts(Request $request)
    {
        $posts = Post::paginate(5);
        if ($request->ajax()) {
            return response()->json(view('posts', array('posts' => $posts))->render());
        }
        return view('blog', array('posts' => $posts));
    }

}
