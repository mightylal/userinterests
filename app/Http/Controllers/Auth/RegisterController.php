<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Interest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
use Illuminate\Http\Request;
use App\Events\UserWasCreated;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

	/**
	 * @var Interest $interest
	 */
	private $interest;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @param Interest $interest
     */
    public function __construct(Interest $interest)
    {
	    $this->interest = $interest;

        $this->middleware('guest');
    }

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm()
	{
		$interests = $this->interest->all();
		return view('auth.register', compact('interests'));
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
	        'phone' => 'required|numeric',
	        'image' => 'required|mimes:jpeg,png|dimensions:max_width=800,max_height=600',
	        'interests' => 'required|array|between:1,3',
	        'interests.*' => 'exists:interests,id',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
       $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
	        'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);

	    // create user interests and upload user file
	    event(new UserWasCreated($user, $data));

	    return $user;
    }
}
