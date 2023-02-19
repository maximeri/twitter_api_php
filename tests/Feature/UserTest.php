<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class UserTest extends TestCase
{
    use RefreshDatabase;
     public function test_index(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/'. $user->id);
        $response->assertStatus(200);
    }

      public function test_show(): void
    {
        $user = User::factory()->create();
        Tweet::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/'. $user->id .'/tweets');
        $response->assertStatus(200);
    }

      public function test_update(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->json('put', '/api/users/' . $user->id, [
            'name' => 'Harry'
        ]);
        $response->assertStatus(200);
    }
}
