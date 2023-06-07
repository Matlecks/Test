<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = new Like;
        $like->user_id = auth()->id();
        $like->post_id = $request->post_id;
        $like->save();

        $likes = Like::where('post_id', '=', $request->post_id)->count();

        $rating = Post::find($request->post_id);
        $rating->rating = ($likes);

        $rating->save();

        return back();
    }

    public function destroy(Request $request)
    {
        $like = Like::where('post_id','=', $request->post_id)->first();
        /* dd($like); */

        $like->delete();

        return back();
    }
}
