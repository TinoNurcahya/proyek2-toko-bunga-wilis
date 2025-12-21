@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Kelola Tanaman</h4>
        <a href="{{ route('admin.tanaman.create') }}" class="btn btn-success">
            + Tambah Tanaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle
">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th width="100">Foto</th>
                        <th>Nama Tanaman</th>
                        <th width="200">Harga</th>
                        <th width="100">Stok</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produk as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- FOTO --}}
                        <td class="text-center">
                            <img src="{{ asset($item->foto_utama) }}"
                                 width="70"
                                 class="rounded border"
                                 onerror="this.src='{{ asset('images/default.png') }}'">
                        </td>

                        {{-- NAMA --}}
                        <td>{{ $item->nama }}</td>

                        {{-- HARGA --}}
                        <td>
                            @if($item->produkUkuran->count())
                                Rp {{ number_format($item->produkUkuran->min('harga')) }}
                                @if($item->produkUkuran->min('harga') != $item->produkUkuran->max('harga'))
                                    - {{ number_format($item->produkUkuran->max('harga')) }}
                                @endif
                            @else
                                <span class="text-muted">Belum diatur</span>
                            @endif
                        </td>

                        {{-- STOK --}}
                        <td>
                            {{ $item->produkUkuran->sum('stok') ?? 0 }}
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center align-middle">
    <div class="d-flex justify-content-center gap-2 flex-wrap">

        <a href="{{ route('admin.tanaman.show', $item->id_produk) }}"
           class="btn btn-sm btn-info px-3">
            Detail
        </a>

        <a href="{{ route('admin.tanaman.edit', $item->id_produk) }}"
           class="btn btn-sm btn-primary px-3">
            Edit
        </a>

        <form action="{{ route('admin.tanaman.destroy', $item->id_produk) }}"
              method="POST"
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-danger px-3"
                    onclick="return confirm('Hapus tanaman ini?')">
                Hapus
            </button>
        </form>

    </div>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada data tanaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
