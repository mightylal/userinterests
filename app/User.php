<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * One to many relationship with User Interest.
	 */
	public function interests()
	{
		return $this->hasMany(UserInterest::class);
	}

	/**
	 * One to one relationship with User Image.
	 */
	public function image()
	{
		return $this->hasOne(UserImage::class);
	}
}
