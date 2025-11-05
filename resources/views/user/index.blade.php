@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Pesanan Saya</h1>

    @forelse($orders as $order)
    <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
        <!-- Header Order -->
        <div class="bg-gray-100 px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Order {{ $order->order_number }}</h2>
                <p class="text-sm text-gray-600">pada tanggal {{ $order->created_at->format('d F Y') }}</p>
            </div>
            <div>
                @if($order->status === 'selesai')
                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-md text-sm font-medium">
                        Selesai
                    </span>
                @elseif($order->status === 'pending')
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-md text-sm font-medium">
                        Pending
                    </span>
                @elseif($order->status === 'diproses')
                    <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md text-sm font-medium">
                        Diproses
                    </span>
                @else
                    <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium">
                        {{ ucfirst($order->status) }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="px-6 py-4">
            @foreach($order->items as $item)
            <div class="flex justify-between items-center py-3 border-b border-gray-200 last:border-0">
                <div class="flex-1">
                    <span class="text-gray-800">{{ $item->product_name }} x {{ $item->quantity }}</span>
                </div>
                <div class="text-right">
                    <span class="text-gray-800 font-medium">RP{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Payment Method & Total -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Metode Pembayaran</span>
                <span class="text-gray-600">Total</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold text-gray-800">{{ $order->payment_method }}</span>
                <span class="text-2xl font-bold text-gray-800">RP{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Action Button -->
        @if($order->status === 'selesai')
        <div class="px-6 py-4 bg-white border-t border-gray-200">
            <button class="w-full sm:w-auto px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md font-medium transition-colors">
                Berikan Penilaian
            </button>
        </div>
        @endif
    </div>
    @empty
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan</h3>
        <p class="text-gray-500 mb-6">Anda belum memiliki pesanan saat ini</p>
        <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-medium transition-colors">
            Mulai Belanja
        </a>
    </div>
    @endforelse

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection