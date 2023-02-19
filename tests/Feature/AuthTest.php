<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_register(): void
    {
        $response = $this->json('post', '/api/register', [
            'name' => 'afdf',
            'email' => 'afdf@mail.com',
            'password' => '123',
            'password_confirmation' => '123'
        ]);
        $response->assertStatus(201);
    }

     public function test_login(): void
    {
        User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);
        $response = $this->json('post', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);
        $response->assertStatus(201);
    }

    //  public function test_logout(): void
    // {
    //     $token = '12|dkGiuct65mJ1P4jpsLlR0t86VEEE0NwwFCE0BoZZ';
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)
    //     ->json('post', '/api/logout');
    //     $response->assertStatus(200);
    // }
}
