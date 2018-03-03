<?php

namespace App\Listeners;

use App\Events\ItemUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ItemsUpdated
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
     * @param  ItemUpdated  $event
     * @return void
     */
    public function handle(ItemUpdated $event)
    {
        //
    }
}
