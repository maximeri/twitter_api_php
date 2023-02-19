<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class TweetTest extends TestCase
{
    use RefreshDatabase; // The RefreshDatabase trait resets db after each test

     public function test_index(): void
    {
        Tweet::factory()->create();
        $response = $this->get('/api/tweets');
        $response->assertStatus(200);
    }

       public function test_show(): void
    {
        $tweet = Tweet::factory()->create();
        $response = $this->get('/api/tweets/' . $tweet->id);
        $response->assertStatus(200);
    }

     public function test_store(): void
    {
        $user = User::factory()->create();
        // $token = '5|5Yma6mdDZe6g4wn2FqWpkAt6d5dlKVGmJYFYNzfd';
        // $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/tweets', ['description' => 'The news is fake!!']);

        // $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        // ->json('post', '/api/tweets', [
        //     'description' => 'The news is fake!!'
        // ]);

        $response = $this->actingAs($user)->json('post', '/api/tweets', [
            'description' => 'The news is fake!!'
        ]);
        $response->assertStatus(201);
    }

     public function test_update(): void
    {
        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();
        $response = $this->actingAs($user)->json('put', '/api/tweets/'. $tweet->id, [
            'description' => 'The news is actually true!'
        ]);
        $response->assertStatus(200);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();
        $response = $this->actingAs($user)->json('delete', '/api/tweets/'. $tweet->id);
        $response->assertStatus(200);
    }
}
