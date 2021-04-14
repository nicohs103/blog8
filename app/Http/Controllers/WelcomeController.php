<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastPosts  = Post::with('user')->orderBy('id', 'DESC')->limit(10)->get();

        return view('welcome', compact('lastPosts'));
    }
}
