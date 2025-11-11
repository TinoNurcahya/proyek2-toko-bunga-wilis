<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotificationList extends Component
{
    use WithPagination;

    // Tambahkan ini untuk pagination theme
    protected $paginationTheme = 'bootstrap';

    public function delete($id)
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
            ->where('id_users', Auth::id())
            ->first();

        if ($notification) {
            $notification->delete();
            $this->dispatch('show-toast', type: 'success', message: 'Notifikasi berhasil dihapus');
            $this->dispatch('notificationUpdated');
        }
    }

    public function markAsRead($id)
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
            ->where('id_users', Auth::id())
            ->first();

        if ($notification) {
            $notification->update(['status' => 'dibaca']);
            
            $this->dispatch('show-toast', type: 'info', message: 'Notifikasi telah ditandai sebagai dibaca');
            $this->dispatch('notificationUpdated');
        }
    }

    public function markAllAsRead()
    {
        $updatedCount = Notifikasi::where('id_users', Auth::id())
            ->where('status', 'belum_dibaca')
            ->update(['status' => 'dibaca']);

        $this->dispatch(
            'show-toast',
            type: $updatedCount > 0 ? 'success' : 'warning',
            message: $updatedCount > 0
                ? "{$updatedCount} notifikasi telah ditandai sebagai dibaca"
                : "Tidak ada notifikasi baru"
        );

        $this->dispatch('notificationUpdated');
    }

    public function render()
    {
        $notifications = Notifikasi::where('id_users', Auth::id())
            ->orderByRaw("CASE WHEN status = 'belum_dibaca' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.notification-list', compact('notifications'));
    }
}