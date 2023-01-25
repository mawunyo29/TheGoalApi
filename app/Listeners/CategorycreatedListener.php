<?php

namespace App\Listeners;

use App\Events\CategoryCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategorycreatedListener
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
     * @param  \App\Events\=CategoryCreatedEvent  $event
     * @return void
     */
    public function handle(CategoryCreatedEvent $event)
    {
        
    }
}
