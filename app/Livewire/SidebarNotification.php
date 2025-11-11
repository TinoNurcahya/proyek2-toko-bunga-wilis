<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class SidebarNotification extends Component
{
    public $unreadCount = 0;

    protected $listeners = ['notificationUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        if (Auth::check()) {
            $this->unreadCount = Notifikasi::where('id_users', Auth::id())
                ->where('status', 'belum_dibaca')
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.sidebar-notification');
    }
}
