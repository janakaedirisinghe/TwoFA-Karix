<?php

namespace Tests\Feature;

use http\Client\Curl\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
     public function after_login_user_can_not_access_home_page_untill_verifired()
     {
        $user = factory(User::class)->create();
        $this->$this->actingAs($user);
        $this->get('/home')->assertRedirect('/');
     }
}
