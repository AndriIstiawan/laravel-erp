<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class  AuthTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_see_dashboard()
    {
        $this->withExceptionHandling();
        $this->get('/')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_see_dashboard()
    {
        create('App\User');
        $this->signIn();

        $this->get('/')
            ->assertSee('Kwadwo');
    }

    /** @test */
    public function an_auth_user_cannot_see_login_page()
    {
        create('App\User');
        $this->signIn();
        $this->get('/login')
            ->assertRedirect('/');
        $this->get('/register')
            ->assertRedirect('/');
    }

    /** @test */
    public function an_guest_can_register()
    {
        $this->withExceptionHandling();
        $this->get('/')->assertRedirect('/login');
        $user = create('App\User');
        $this->signIn($user);
        $this->get('/')->assertSee($user->name);
    }
}
