@extends('admin.layout')

@section('title', 'Kelola Tanaman')

@section('content')

<style>
    .page-title {
        font-size: 32px;
        font-weight: 800;
        color: #1B5E20;
        margin-bottom: 25px;
    }

    .btn-add {
        background: #4CAF50;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 18px;
    }

    table img {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 12px;
    }

    .btn-edit {
        background: #1E88E5;
        color: white;
        padding: 8px 10px;
        border-radius: 6px;
    }
    .btn-delete {
        background: #E53935;
        color: white;
        padding: 8px 10px;
        border-radius: 6px;
    }
</style>

<h2 class="page-title">KELOLA TANAMAN</h2>

<div class="d-flex justify-content-end mb-3">
    <a href="#" class="btn btn-add"><i class="fas fa-plus-circle"></i> TAMBAH TANAMAN</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>FOTO TANAMAN</th>
                    <th>NAMA TANAMAN</th>
                    <th>HARGA</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produk as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="foto">
                        </td>

                        <td>{{ $item->nama }}</td>

                        <td>
                            Rp {{ number_format($item->harga_terendah ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            <a href="#" class="btn-edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
