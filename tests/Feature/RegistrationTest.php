<?php

namespace Tests\Feature;

use App\Mail\ConfirmYourEmail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after_registration()
    {
        Mail::fake();
        $this->withoutExceptionHandling();

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

    public function test_an_email_is_sent_to_newly_registered_users()
    {
        Mail::fake();
        $this->withoutExceptionHandling();
        // register new user
        $this->post('/register', [
            'name' => 'celal akyüz',
            'email' => 'celal@akyuz.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->assertRedirect();
        //assert that a particular email was sent
        Mail::assertSent(ConfirmYourEmail::class);
    }
}
