<?php

namespace Tests\Unit;

use App\Models\Post;
use App\User;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_posts()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/posts')->assertViewIs('posts.index');
    }

    public function test_user_can_view_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/posts/create')->assertViewIs('posts.create');
    }

    public function test_user_can_show_a_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->get('/posts/'.$post->id)->assertViewIs('posts.show', $post);
    }

    public function test_user_can_store_a_post()
    {
        $user = factory(User::class)->create();
        $post = Arr::only(factory(Post::class)->create()->toArray(), ['title', 'details']);
        $response = $this->actingAs($user)->post('/posts/store', $post);
        $this->assertEquals(1, Post::all()->count());
    }

    public function test_user_can_view_edit_form()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->get('/posts/'.$post->id.'/edit')->assertViewIs('posts.edit', $post);
    }

    public function test_user_can_update_a_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $post->title = "changed title";

        $response = $this->actingAs($user)->put('/posts/'.$post['id'], $post->toArray());

        $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'changed title']);
    }
}
