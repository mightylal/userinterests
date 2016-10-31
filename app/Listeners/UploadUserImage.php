<?php

namespace App\Listeners;

use Storage;
use App\Events\UserWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadUserImage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
	    $path = $event->data['image']->store('public/images');

	    $event->user->image()->create(['path' => substr($path, 7)]);
    }
}
