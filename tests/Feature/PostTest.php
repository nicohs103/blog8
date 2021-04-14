<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make_a_blog_post()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $redirect_uri = 'admin/post';
        $blog_post = ['title' => 'Write Article', 'description' => 'Write and publish an article'];

        $response = $this->actingAs($user)
            // ->withSession(['banned' => false])
            ->post('admin/post', $blog_post);

        $response->assertRedirect($redirect_uri);

        $this->assertTrue(count(Post::all()) == 1);
    }
}
