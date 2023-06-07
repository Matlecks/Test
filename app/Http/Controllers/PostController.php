<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        Auth::login($user);
        $posts = Post::orderBy('rating', 'desc')->orderBy('created_at', 'desc')->paginate(3);

        return view('index', compact('posts'));
    }
}
