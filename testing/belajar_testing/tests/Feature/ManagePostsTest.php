<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post; // Make sure to adjust the namespace based on your project's structure

class ManagePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_post()
    {
        // Simulate creating a post
        $response = $this->post('/post', [
            'title' => 'Belajar Laravel 8 at qadrLabs',
            'status' => 1,
            'content' => 'Ini adalah content tutorial belajar laravel 8 di qadrLabs'
        ]);

        // Assert the post is in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Belajar Laravel 8 at qadrLabs',
            'status' => 1,
            'content' => 'Ini adalah content tutorial belajar laravel 8 di qadrLabs'
        ]);

        // Assert redirect
        $response->assertRedirect('/post');

        // Assert the content is visible
        $this->get('/post')->assertSee('Belajar Laravel 8 at qadrLabs');
    }

    /** @test */
    public function user_can_browse_posts_index_page()
    {
        // generate 2 record baru di table `posts`
        $postOne = Post::create([
            'title' => 'Belajar Laravel 8 at qadrLabs edisi 1',
            'content' => 'ini adalah tutorial belajar laravel 8 edisi 1',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8-edisi-1'
        ]);

        $postTwo = Post::create([
            'title' => 'Belajar Laravel 8 at qadrLabs edisi 2',
            'content' => 'ini adalah tutorial belajar laravel 8 edisi 2',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8-edisi-2'
        ]);

        // user membuka halaman daftar post
        $response = $this->get('/post');

        // user melihat dua title dari data post
        $response->assertSee('Belajar Laravel 8 at qadrLabs edisi 1');
        $response->assertSee('Belajar Laravel 8 at qadrLabs edisi 2');
    }

    /** @test */
    public function user_can_edit_existing_post()
    {
        // generate 1 data post
        $post = Post::create([
            'title' => 'Belajar Laravel 8',
            'content' => 'ini content belajar laravel 8',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8'
        ]);

        // user buka halaman daftar post
        $response = $this->get('/post');

        // user click tombol edit post
        $response = $this->get("post/{$post->id}/edit");

        // lihat url yang dituju sesuai dengan post yang diedit
        $response->assertSee('form', [
            'action' => url("post/{$post->id}")
        ]);

        // user submit data post yang diupdate
        $response = $this->put("post/{$post->id}", [
            'title' => 'belajar laravel 8 [update]',
            'content' => 'Updated content', // Provide updated content
            'status' => 1, // Provide updated status
        ]);

        // check perubahan data di table post
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'belajar laravel 8 [update]',
            'content' => 'Updated content',
            'status' => 1,
        ]);

        // lihat halaman web yang ter-redirect
        $response->assertRedirect('/post');
    }


    /** @test */
    public function user_can_delete_existing_post()
    {
        // generate 1 post data
        $post = Post::create([
            'title' => 'Belajar Laravel 8',
            'content' => 'ini content belajar laravel 8',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8'
        ]);

        // post delete request
        $this->post('/post/' . $post->id, [
            '_method' => 'DELETE'
        ]);

        // check data di table post
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
    }
}
