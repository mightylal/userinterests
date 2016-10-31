<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserMiddlewareTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * @test
     */
    public function user_is_able_to_view_list_page()
    {
	    $user = factory(App\User::class)->create();

	    $this->actingAs($user);

	    $this->visit('/home')
	         ->seePageIs('/home');
    }

    /**
     * @test
     */
    public function guest_is_unable_to_view_list_page()
    {
		$this->visit('/home')
			 ->seePageIs('/login');
    }
}
