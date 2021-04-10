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
        $today_start = Carbon::today()->startOfDay();
        $today_end = Carbon::today()->endOfDay();

        $lastPosts  = Post::whereBetween('publication_date', [$today_start, $today_end])->with('user')->get();

        return view('welcome', compact('lastPosts'));
    }
}
