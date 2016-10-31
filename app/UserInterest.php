<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    /**
     * Table name.
     */
    protected $table = 'user_interests';

	/**
	 * Fillable attributes for mass assignment.
	 */
	protected $fillable = ['user_id', 'interest_id'];

	/**
	 * Create the user interests.
	 *
	 * @param integer $user_id
	 * @param array $interests
	 */
	public function createMultiple($user_id, array $interests)
	{
		foreach ($interests as $interest) {
			self::create(['user_id' => $user_id, 'interest_id' => $interest]);
		}
	}
}
