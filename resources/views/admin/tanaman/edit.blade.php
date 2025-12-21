@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">Edit Tanaman</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tanaman.update', $produk->id_produk) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================= INFORMASI TANAMAN ================= --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Informasi Tanaman
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label>Nama Tanaman</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama', $produk->nama) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Nama Ilmiah</label>
                    <input type="text"
                           name="nama_ilmiah"
                           class="form-control"
                           value="{{ old('nama_ilmiah', $produk->detailTanaman->nama_ilmiah ?? '') }}">
                </div>

                <div class="mb-3">
                    <label>Asal Tanaman</label>
                    <input type="text"
                           name="asal_tanaman"
                           class="form-control"
                           value="{{ old('asal_tanaman', $produk->detailTanaman->asal_tanaman ?? '') }}">
                </div>

                <div class="mb-3">
                    <label>Ukuran Tanaman</label>
                    <input type="text"
                           name="ukuran_detail"
                           class="form-control"
                           value="{{ old('ukuran_detail', $produk->detailTanaman->ukuran_detail ?? '') }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

            </div>
        </div>
        <div class="mb-3">
    <label>Kategori</label>
    <select name="id_kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategori as $k)
            <option value="{{ $k->id_kategori }}"
                {{ old('id_kategori', $produk->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>


        {{-- ================= FOTO ================= --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Foto Tanaman
            </div>
            <div class="card-body">

                {{-- FOTO UTAMA --}}
                <div class="mb-3">
                    <label>Foto Utama</label><br>
                    <img src="{{ asset($produk->foto_utama) }}"
                         class="img-fluid rounded border mb-2"
                         width="200">
                    <input type="file" name="foto_utama" class="form-control">
                </div>

                {{-- GALLERY --}}
                <div class="mb-3">
                    <label>Gallery Foto</label>
                    <div class="row mb-2">
                        @foreach ($produk->fotoProduk as $foto)
                        <div class="col-md-3 mb-2 text-center">
                            <img src="{{ asset($foto->foto) }}"
                                 class="img-fluid rounded border mb-1">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="hapus_foto[]"
                                       value="{{ $foto->id }}">
                                <label class="form-check-label text-danger">
                                    Hapus
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <input type="file"
                           name="foto_produk[]"
                           class="form-control"
                           multiple>
                </div>

            </div>
        </div>

        {{-- ================= HARGA & STOK ================= --}}
        <h5 class="fw-bold mt-4">Ukuran, Harga & Stok</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ukuran</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ukuran as $u)
            @php
                $pu = $produk->produkUkuran
                        ->where('id_ukuran', $u->id_ukuran)
                        ->first();
            @endphp
            <tr>
                <td>{{ $u->nama_ukuran }}</td>
                <td>
                    <input type="number"
                           name="harga[{{ $u->id_ukuran }}]"
                           class="form-control"
                           value="{{ $pu->harga ?? 0 }}">
                </td>
                <td>
                    <input type="number"
                           name="stok[{{ $u->id_ukuran }}]"
                           class="form-control"
                           value="{{ $pu->stok ?? 0 }}">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        {{-- ================= PETUNJUK PERAWATAN ================= --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">
        Petunjuk Perawatan
    </div>
    <div class="card-body">

        <div class="mb-3">
            <label>Penyiraman</label>
            <input type="text"
                   name="penyiraman"
                   class="form-control"
                   value="{{ old('penyiraman', $produk->petunjukPerawatan->penyiraman ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Cahaya</label>
            <input type="text"
                   name="cahaya"
                   class="form-control"
                   value="{{ old('cahaya', $produk->petunjukPerawatan->cahaya ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Suhu & Kelembapan</label>
            <input type="text"
                   name="suhu"
                   class="form-control"
                   value="{{ old('suhu', $produk->petunjukPerawatan->suhu ?? '') }}">
        </div>

    </div>
</div>


        {{-- ================= ACTION ================= --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Update Tanaman
            </button>
            <a href="{{ route('admin.tanaman') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection
