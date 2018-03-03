<?php

namespace App\Observers;


class ItemObserver
{

    public function saved($model)
    {
        event(new \App\Events\ItemStatusChanged($model));
    }

}