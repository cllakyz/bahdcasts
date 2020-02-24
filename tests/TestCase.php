<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Config;
use Redis;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAdmin() {
        $user = factory(User::class)->create();

        Config::push('bahdcasts.administrators', $user->email);

        $this->actingAs($user);
    }

    public function flushRedis() {
        Redis::flushall();
    }
}
