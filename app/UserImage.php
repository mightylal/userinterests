<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    /**
     * Table name.
     */
    protected $table = 'user_images';

	/**
	 * Fillable attributes for mass assignment.
	 */
	protected $fillable = ['user_id', 'path'];
}
