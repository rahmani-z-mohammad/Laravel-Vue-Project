<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        // Check Authenticated user through the Notification Policy
        // DatabaseNotification not a model, then we must to register it in AuthServiceProvider
        $this->authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()
            ->with('success', 'Notification marked as read');
    }
}
