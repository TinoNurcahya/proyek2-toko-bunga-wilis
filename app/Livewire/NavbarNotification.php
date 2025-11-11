<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NavbarNotification extends Component
{
    public $unreadCount = 0;
    public $recentNotifications;

    protected $listeners = ['notificationUpdated' => 'handleNotificationUpdate'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function handleNotificationUpdate()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (Auth::check()) { 
            $this->unreadCount = Notifikasi::where('id_users', Auth::id())
                ->where('status', 'belum_dibaca')
                ->count();

            $this->recentNotifications = Notifikasi::where('id_users', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } else {
            $this->unreadCount = 0;
            $this->recentNotifications = collect();
        }
    }

    public function render()
    {
        return view('livewire.navbar-notification');
    }
}