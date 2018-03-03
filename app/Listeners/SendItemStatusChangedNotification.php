<?php

namespace App\Listeners;

use App\Events\ItemStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendItemStatusChangedNotification
{

    public function handle(ItemStatusChanged $event)
    {
        $tags = [
            'content' => 'User ' . auth()->user()->name . ' has ' . (empty($event->item->disabled) ? 'enabled' : '') . ' the item named: ' . $event->item->name,
        ];

        Mail::send('emails.notification', $tags, function ($message) {
            $message
                ->from('no-replay@domain.com', 'Company Co.')
                ->to(env('EMAIL_NOTIFY'))
                ->subject('Item status changed.');
        });
    }
}
