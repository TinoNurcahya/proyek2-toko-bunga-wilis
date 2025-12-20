@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">Tambah Tanaman</h4>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.tanaman.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- ================= INFORMASI TANAMAN ================= --}}
                <h5 class="fw-bold mb-3">Informasi Tanaman</h5>

                <div class="mb-3">
                    <label class="form-label">Nama Tanaman</label>
                    <input type="text" name="nama" class="form-control"
                           value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Ilmiah</label>
                    <input type="text" name="nama_ilmiah" class="form-control"
                           value="{{ old('nama_ilmiah') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Asal Tanaman</label>
                    <input type="text" name="asal" class="form-control"
                           placeholder="Contoh: Meksiko & Amerika Tengah"
                           value="{{ old('asal') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Tanaman</label>
                    <select name="jenis" class="form-control">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Indoor Plant"
                            {{ old('jenis') == 'Indoor Plant' ? 'selected' : '' }}>
                            Indoor Plant
                        </option>
                        <option value="Outdoor Plant"
                            {{ old('jenis') == 'Outdoor Plant' ? 'selected' : '' }}>
                            Outdoor Plant
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ukuran Tanaman</label>
                    <input type="text" name="ukuran_deskripsi"
                           class="form-control"
                           placeholder="Contoh: Tinggi ±60 cm"
                           value="{{ old('ukuran_deskripsi') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}"
                                {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              required>{{ old('deskripsi') }}</textarea>
                </div>

                <hr>

                {{-- ================= FOTO TANAMAN ================= --}}
                <div class="mb-3">
    <label class="form-label">Foto Utama</label>
    <input type="file" name="foto_utama" class="form-control" required>
    <small class="text-muted">Disimpan ke folder images/</small>
</div>

<div class="mb-3">
    <label class="form-label">Gallery Foto</label>
    <input type="file" name="foto_produk[]" class="form-control" multiple>
    <small class="text-muted">Disimpan ke folder uploads/</small>
</div>

                <hr>

                {{-- ================= UKURAN, HARGA & STOK ================= --}}
                <h5 class="fw-bold mb-3">Ukuran, Harga & Stok</h5>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ukuran as $item)
                        <tr>
                            <td>{{ $item->nama_ukuran }}</td>
                            <td>
                                <input type="number"
                                       name="harga[{{ $item->id_ukuran }}]"
                                       class="form-control">
                            </td>
                            <td>
                                <input type="number"
                                       name="stok[{{ $item->id_ukuran }}]"
                                       class="form-control">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                {{-- ================= PETUNJUK PERAWATAN ================= --}}
                <h5 class="fw-bold mb-3">Petunjuk Perawatan</h5>

                <div class="mb-3">
                    <label class="form-label">Penyiraman</label>
                    <input type="text" name="penyiraman"
                           class="form-control"
                           value="{{ old('penyiraman') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Cahaya</label>
                    <input type="text" name="cahaya"
                           class="form-control"
                           value="{{ old('cahaya') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Suhu & Kelembapan</label>
                    <input type="text" name="suhu"
                           class="form-control"
                           value="{{ old('suhu') }}">
                </div>

                {{-- ================= ACTION ================= --}}
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary">
                        Simpan Tanaman
                    </button>
                    <a href="{{ route('admin.tanaman') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
