<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_receives_token_when_login_in_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => Hash::make('secret')
        ]);

        $response = $this->postJson(route('auth.login'), ['email' => 'test@gmail.com', 'password' => 'secret'])
            ->assertJsonStructure([
                'token'
            ])
            ->assertSuccessful();

        $token = $response->json('token');

        $this->getJson(route('auth.me'), ['authentication' => "bearer $token"])
            ->assertSuccessful()
            ->assertJsonFragment([
                'email' => $user->email
            ]);
    }
}
