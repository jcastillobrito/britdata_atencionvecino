<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function read($id)
    {
        DatabaseNotification::find($id)->markAsRead();
        return redirect()->back()->with('flash','Notificación marcada como leída');
    }
}
