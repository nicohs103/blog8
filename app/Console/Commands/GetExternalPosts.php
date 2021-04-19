<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class GetExternalPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetExternalPosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts created in a external blogging web';

    const CACHE_KEY = 'welcome_posts_';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $total = 0;
        $response = $this->guzzleGetPosts();

        if (empty($response) || empty($response->data)) {
            return $total;
        }

        foreach ($response->data as $data) {
            $this->createAdminPost($data);
            $total++;
        }

        return $total;
    }

    /**
     * guzzleGetPosts
     *
     * @return object
     */
    private function guzzleGetPosts()
    {
        $externalBlogUrl = config('helper.EXTERNAL_BLOG_URL');
        $response = Http::get($externalBlogUrl . 'posts');

        if ($response->successful()) {
            $this->forgetCache();

            return json_decode($response->body());
        }

        return;
    }

    /**
     * createAdminPost
     *
     * @param object $data
     * @return void
     */
    private function createAdminPost($data)
    {
        if (empty($data)) {
            return;
        }

        $data->created_by = config('helper.ADMIN_ID');
        $post = new Post((array) $data);
        $post->save();

        return;
    }

    private static function forgetCache()
    {
        for ($i = 1; $i < 500; $i++) {
            $key = self::CACHE_KEY . $i;
            if (Cache::has($key)) {
                Cache::forget($key);
            } else {
                break;
            }
        }
    }
}
