<?php

namespace App\Listeners;

use App\UserInterest;
use App\Events\UserWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserInterests
{
	/**
	 * @var UserInterest $userInterest
	 */
	private $userInterest;

    /**
     * Create the event listener.
     *
     * @param UserInterest $userInterest
     */
    public function __construct(UserInterest $userInterest)
    {
        $this->userInterest = $userInterest;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
	    $this->userInterest->createMultiple($event->user->id, $event->data['interests']);
    }
}
