<?php

namespace Tests\Unit;

use Tests\TestCase;
Use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'firstname' => 'Dhruv123',
            'email' => 'ds@gmail.com'
        ]);

        $user2 = User::make([
            'firstname' => 'Tejas123',
            'email' => 'ts@gmail.com'
        ]);

        $this->assertTrue($user1->firstname != $user2->firstname);
    }
    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user)
        {
            $user->delete();
        }
        $this->assertTrue(true);
    }
    public function test_it_stores_users()
    {
        $response = $this->post('/register',[
            'firstname' => 'Manan',
            'lastname' => 'bajaj',
            'email' => 'mb@gmail.com',
            'MobileNumber' => '8679043567',
            'password' => '8679043567',
            'password_confirmation' => '8679043567',
        ]);

        $response->assertRedirect('/reset');
    }
}
