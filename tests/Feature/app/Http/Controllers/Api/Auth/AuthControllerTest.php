<?php

namespace Tests\Feature\app\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class AuthControllerTest
 * @package Tests\Feature\app\Http\Controllers\Api\Auth
 * @author Daniel Romero - 123romerod@gmail.com
 */
class AuthControllerTest extends TestCase
{
    use WithoutMiddleware;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testRegister()
    {
        $response = $this->post(route('register'), [
            'name' => 'Test',
            'email' => 'test@test.test',
            'password' => 'test'
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
    }

    public function testLoginUnauthorized(): void
    {
        $userFactory = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $userFactory->email,
            'password' => '_incorrect',
            'remember_me' => true
        ], [
            'Accept' => 'application/json'
        ]);


        $response->assertStatus(400);
    }

    public function testLoginAndLogout(): void
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
            'remember_me' => true
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['access_token', 'token_type']);

        $token = json_decode($response->getContent(), true);

        $responseLogout = $this->actingAs($this->user)
            ->get(route('logout'),
                [
                    'Accept' => 'application/json',
                    'Authorization' => $token['token_type'] . " " . $token['access_token']
                ]);

        $responseLogout->assertStatus(200);
    }
}
