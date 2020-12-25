<?php

namespace App\Listeners;

use App\Events\StatusUpdatedGlobal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\ModelStatus\Events\StatusUpdated;

class StatusUpdate
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
     * @param  StatusUpdated  $event
     * @return void
     */
    public function handle(StatusUpdated $event)
    {
        event(new StatusUpdatedGlobal());
    }
}
