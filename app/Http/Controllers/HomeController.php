<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * @var User $user
	 */
	private $user;

    /**
     * Create a new controller instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
	    $this->user = $user;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $users = $this->user->with(['image', 'interests' => function ($query) {
		    $query->select('user_interests.user_id', 'interests.name')->join('interests', 'user_interests.interest_id', '=', 'interests.id');
	    }])->get();

        return view('home', compact('users'));
    }
}
