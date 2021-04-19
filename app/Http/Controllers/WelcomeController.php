<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    const CACHE_KEY = 'welcome_posts_';
    const CACHE_TTL = 600;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $limit = request()->get('limit', 10);

        $welcome_posts = Cache::remember(self::CACHE_KEY . $page, self::CACHE_TTL, function () use ($limit) {
            return Post::with('user')->orderBy('id', 'DESC')->limit(500)->simplePaginate($limit);
        });

        return view('welcome', ['lastPosts' => $welcome_posts]);
    }
}
