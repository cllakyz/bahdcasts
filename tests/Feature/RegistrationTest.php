<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after_registration()
    {

        $this->post('/register', [
            'name' => 'celal akyüz',
            'email' => 'celal@akyuz.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'username' => str_slug('celal akyüz')
        ]);
    }
}
