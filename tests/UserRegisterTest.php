<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegisterTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * @test
     */
    public function it_registers_a_user()
    {
		factory(App\Interest::class, 3)->create();

	    $path = public_path('End.png');

	    $this->json('POST', '/register', [
			'name' => 'John Doe',
		    'email' => 'john@email.com',
		    'phone' => '4547898898',
		    'image' => new UploadedFile($path, 'End.png', 'image/png', filesize($path), null, true),
		    'interests' => [1, 2, 3],
		    'password' => 'secret',
		    'password_confirmation' => 'secret',
	    ]);



	    $this->seeInDatabase('users', [
	    	'name' => 'John Doe',
		    'email' => 'john@email.com',
	    ]);

	    $this->seeInDatabase('user_interests', [
	    	'user_id' => 1,
		    'interest_id' => 1,
	    ]);

	    $this->seeInDatabase('user_images', [
	    	'user_id' => 1
	    ]);
    }

    /**
     * @test
     */
    public function it_fails_to_register_a_user_because_no_fields_were_filled()
    {
	    factory(App\Interest::class, 3)->create();

	    $this->json('POST', '/register', [
		    'name' => '',
		    'email' => '',
		    'phone' => '',
		    'image' => '',
		    'interests' => '',
		    'password' => '',
		    'password_confirmation' => '',
	    ])->assertResponseStatus(422);
    }
}
