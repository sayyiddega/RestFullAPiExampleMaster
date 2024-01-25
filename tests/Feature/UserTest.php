<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'username' => 'anggi',
            'password' => 'anggi',
            'name' => 'anggi astasih'
        ])->assertStatus(201)
            ->assertJson([
                "data"=> [
                    'username' => 'anggi',
                    'name' => 'anggi astasih'
                ]
            ]);
    }

    public function testRegisterFailed()
    {
        $this->post('/api/users', [
            'username' => '',
            'password' => '',
            'name' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors"=> [
                    'username' => [
                        "The username field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ],
                    'name' => [
                        "The name field is required."
                    ]
                ]
            ]);

    }

    public function testRegisterUsernameAlredyExist()
    {
        $this->testRegisterSuccess();
        $this->post('/api/users', [
            'username' => 'anggi',
            'password' => 'anggi',
            'name' => 'anggi astasih'
        ])->assertStatus(400)
            ->assertJson([
                "errors"=> [
                    'username' => [
                        "username Alredy Registered"
                    ]

                ]
            ]);

    }

    public function testloginSuccess()
    {
        $this->seed([UserSeeder::class]);
        $this->post('/api/users/login', [
            'username' => 'test',
            'password' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'test',
                    'name' => 'test'
                ]
            ]);

        $user = User::where('username', 'test')->first();
        self::assertNotNull($user->token);
    }





}
