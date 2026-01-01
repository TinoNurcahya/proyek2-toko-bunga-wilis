@extends('admin.layouts.admin')

@section('content')
  <div class="container-fluid">

    <h4 class="fw-bold mb-3">Edit Tanaman</h4>

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

        <form action="{{ route('admin.tanaman.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data"
          id="formEditTanaman">
          @csrf
          @method('PUT')

          {{-- ================= INFORMASI TANAMAN ================= --}}
          <h5 class="fw-bold mb-3">Informasi Tanaman</h5>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Tanaman <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
              @error('nama')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Ilmiah</label>
              <input type="text" name="nama_ilmiah" class="form-control"
                value="{{ old('nama_ilmiah', $produk->detailTanaman->nama_ilmiah ?? '') }}"
                placeholder="Contoh: Monstera deliciosa">
              @error('nama_ilmiah')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Asal Tanaman</label>
              <input type="text" name="asal_tanaman" class="form-control"
                placeholder="Contoh: Meksiko & Amerika Tengah"
                value="{{ old('asal_tanaman', $produk->detailTanaman->asal_tanaman ?? '') }}">
              @error('asal_tanaman')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Ukuran Detail</label>
              <input type="text" name="ukuran_detail" class="form-control"
                placeholder="Contoh: Tinggi ±60 cm, diameter pot 17 cm"
                value="{{ old('ukuran_detail', $produk->detailTanaman->ukuran_detail ?? '') }}">
              @error('ukuran_detail')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Kategori <span class="text-danger">*</span></label>
              <select name="id_kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $item)
                  <option value="{{ $item->id_kategori }}"
                    {{ old('id_kategori', $produk->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                  </option>
                @endforeach
              </select>
              @error('id_kategori')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Foto Utama Saat Ini</label>
              <div class="border rounded p-2 bg-light">
                <img src="{{ asset($produk->foto_utama) }}" class="img-fluid rounded" style="max-height: 100px;">
                <div class="mt-1 small text-muted">
                  {{ basename($produk->foto_utama) }}
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
            <textarea name="deskripsi" class="form-control" rows="6" placeholder="Deskripsikan tanaman secara detail..."
              required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            <small class="text-muted">Gunakan paragraf untuk deskripsi yang lebih terstruktur</small>
            @error('deskripsi')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <hr>

          {{-- ================= FOTO TANAMAN ================= --}}
          <h5 class="fw-bold mb-3">Foto Tanaman</h5>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Ubah Foto Utama (Opsional)</label>
              <input type="file" name="foto_utama" class="form-control" id="fotoUtama"
                accept=".jpg,.jpeg,.png,.gif,.webp">
              <small class="text-muted">Format: JPG, PNG, GIF, WebP. Maks: 2MB. Kosongkan jika tidak ingin
                mengubah</small>
              <div class="mt-2" id="previewUtama"></div>
              @error('foto_utama')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Tambah Gallery Foto (Maksimal 3)</label>
              <input type="file" name="foto_produk[]" class="form-control" id="fotoGallery" multiple
                accept=".jpg,.jpeg,.png,.gif,.webp" max="3">
              <small class="text-muted">Pilih maksimal 3 foto baru. Format: JPG, PNG, GIF, WebP. Maks: 2MB per
                foto</small>
              <div class="mt-2" id="previewGallery"></div>
              @error('foto_produk')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
              @error('foto_produk.*')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- GALLERY FOTO SAAT INI --}}
          @if ($produk->fotoProduk->count() > 0)
            <div class="mb-3">
              <label class="form-label">Gallery Foto Saat Ini</label>
              <div class="row">
                @foreach ($produk->fotoProduk as $foto)
                  <div class="col-md-3 mb-3">
                    <div class="card border">
                      <div class="card-body p-2 text-center">
                        <img src="{{ asset($foto->foto) }}" class="img-fluid rounded"
                          style="height: 100px; object-fit: cover;">
                        <div class="mt-2">
                          <a href="{{ route('admin.tanaman.hapus-foto', $foto->id_foto_produk) }}"
                            class="btn btn-sm btn-danger" onclick="return confirm('Hapus foto ini?')">
                            <i class="fas fa-trash"></i> Hapus
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <hr>

          {{-- ================= UKURAN, HARGA & STOK ================= --}}
          <h5 class="fw-bold mb-3">Ukuran, Harga & Stok</h5>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th width="30%">Ukuran</th>
                  <th width="35%">Harga (Rp)</th>
                  <th width="35%">Stok</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ukuran as $item)
                  @php
                    $produkUkuran = $produk->produkUkuran->where('id_ukuran', $item->id_ukuran)->first();
                  @endphp
                  <tr>
                    <td>{{ $item->nama_ukuran }}</td>
                    <td>
                      <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga[{{ $item->id_ukuran }}]" class="form-control"
                          min="0" placeholder="Kosongkan jika tidak tersedia"
                          value="{{ old('harga.' . $item->id_ukuran, $produkUkuran->harga ?? '') }}">
                      </div>
                    </td>
                    <td>
                      <input type="number" name="stok[{{ $item->id_ukuran }}]" class="form-control" min="0"
                        placeholder="Kosongkan jika tidak tersedia"
                        value="{{ old('stok.' . $item->id_ukuran, $produkUkuran->stok ?? '') }}">
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <hr>

          {{-- ================= PETUNJUK PERAWATAN ================= --}}
          <h5 class="fw-bold mb-3">Petunjuk Perawatan</h5>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Penyiraman</label>
              <textarea name="penyiraman" class="form-control" rows="3" placeholder="Contoh: Siram 2-3 kali seminggu">{{ old('penyiraman', $produk->petunjukPerawatan->penyiraman ?? '') }}</textarea>
              @error('penyiraman')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Cahaya</label>
              <textarea name="cahaya" class="form-control" rows="3" placeholder="Contoh: Cahaya tidak langsung">{{ old('cahaya', $produk->petunjukPerawatan->cahaya ?? '') }}</textarea>
              @error('cahaya')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">Suhu & Kelembapan</label>
              <textarea name="suhu_dan_kelembapan" class="form-control" rows="3"
                placeholder="Contoh: Suhu 18-25°C, Kelembapan 60-80%">{{ old('suhu_dan_kelembapan', $produk->petunjukPerawatan->suhu_dan_kelembapan ?? '') }}</textarea>
              <small class="text-muted">Gabungkan informasi suhu dan kelembapan dalam satu deskripsi</small>
              @error('suhu_dan_kelembapan')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- ================= ACTION ================= --}}
          <div class="d-flex gap-2 mt-4 pt-3 border-top">
            <button type="submit" class="btn btn-primary px-4">
              <i class="fas fa-save me-2"></i>Update Tanaman
            </button>
            <a href="{{ route('admin.tanaman') }}" class="btn btn-secondary px-4">
              <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
          </div>

        </form>

      </div>
    </div>

  </div>

  {{-- Script untuk preview dan validasi --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('formEditTanaman');

      // ===== PREVIEW FOTO UTAMA =====
      const fotoUtamaInput = document.getElementById('fotoUtama');
      const previewUtama = document.getElementById('previewUtama');

      fotoUtamaInput.addEventListener('change', function(e) {
        previewUtama.innerHTML = '';
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('img-thumbnail');
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            previewUtama.appendChild(img);
          }
          reader.readAsDataURL(this.files[0]);
        }
      });

      // ===== PREVIEW GALLERY FOTO (MAKSIMAL 3) =====
      const fotoGalleryInput = document.getElementById('fotoGallery');
      const previewGallery = document.getElementById('previewGallery');

      fotoGalleryInput.addEventListener('change', function(e) {
        previewGallery.innerHTML = '';

        // Validasi jumlah file
        if (this.files.length > 3) {
          alert('Maksimal 3 foto untuk gallery!');
          this.value = ''; // Reset input
          return;
        }

        // Tampilkan preview
        if (this.files && this.files.length > 0) {
          Array.from(this.files).forEach((file, index) => {
            if (index < 3) { // Hanya tampilkan 3 pertama
              const reader = new FileReader();
              reader.onload = function(e) {
                const container = document.createElement('div');
                container.classList.add('d-inline-block', 'me-2', 'mb-2');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';

                const badge = document.createElement('span');
                badge.classList.add('badge', 'bg-secondary', 'position-absolute');
                badge.textContent = index + 1;
                badge.style.top = '5px';
                badge.style.left = '5px';

                const imgContainer = document.createElement('div');
                imgContainer.classList.add('position-relative');
                imgContainer.appendChild(img);
                imgContainer.appendChild(badge);

                container.appendChild(imgContainer);
                previewGallery.appendChild(container);
              }
              reader.readAsDataURL(file);
            }
          });

          // Tampilkan info jumlah file
          const info = document.createElement('div');
          info.classList.add('mt-2', 'text-muted', 'small');
          info.textContent = `Dipilih: ${Math.min(this.files.length, 3)} dari 3 foto`;
          previewGallery.appendChild(info);
        }
      });

      // ===== VALIDASI FORM SEBELUM SUBMIT =====
      form.addEventListener('submit', function(e) {
        // Validasi foto gallery maksimal 3
        const galleryInput = document.getElementById('fotoGallery');
        if (galleryInput.files.length > 3) {
          e.preventDefault();
          alert('Maksimal 3 foto untuk gallery!');
          galleryInput.focus();
          return false;
        }

        // Validasi ukuran file (maksimal 2MB)
        let isValid = true;
        const maxSize = 2 * 1024 * 1024; // 2MB

        // Cek foto utama
        if (fotoUtamaInput.files[0] && fotoUtamaInput.files[0].size > maxSize) {
          alert('Foto utama maksimal 2MB!');
          isValid = false;
        }

        // Cek foto gallery
        if (galleryInput.files.length > 0) {
          Array.from(galleryInput.files).forEach(file => {
            if (file.size > maxSize) {
              alert('Setiap foto gallery maksimal 2MB!');
              isValid = false;
            }
          });
        }

        if (!isValid) {
          e.preventDefault();
          return false;
        }

        return true;
      });

      // ===== CEK VALIDASI INPUT HARGA DAN STOK =====
      const hargaInputs = document.querySelectorAll('input[name^="harga"]');
      const stokInputs = document.querySelectorAll('input[name^="stok"]');

      // Cegah karakter selain angka di input harga dan stok
      const preventNonNumeric = function(e) {
        // Biarkan: backspace, delete, tab, escape, enter
        if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
          // Biarkan: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
          (e.keyCode === 65 && e.ctrlKey === true) ||
          (e.keyCode === 67 && e.ctrlKey === true) ||
          (e.keyCode === 86 && e.ctrlKey === true) ||
          (e.keyCode === 88 && e.ctrlKey === true) ||
          // Biarkan: home, end, left, right
          (e.keyCode >= 35 && e.keyCode <= 39)) {
          return;
        }

        // Pastikan hanya angka yang diinput
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
        }
      };

      hargaInputs.forEach(input => {
        input.addEventListener('keydown', preventNonNumeric);
      });

      stokInputs.forEach(input => {
        input.addEventListener('keydown', preventNonNumeric);
      });

      // ===== BIARKAN ENTER DI TEXTAREA UNTUK PARAGRAF BARU =====
      document.querySelectorAll('textarea').forEach(textarea => {
        textarea.style.whiteSpace = 'pre-wrap';
        textarea.style.wordWrap = 'break-word';
        textarea.style.minHeight = '100px';

        // Biarkan Enter di textarea
        textarea.addEventListener('keydown', function(e) {
          // Jika Ctrl+Enter, submit form
          if (e.key === 'Enter' && e.ctrlKey) {
            form.submit();
          }
          // Jika hanya Enter, biarkan untuk paragraf baru
        });
      });

      // ===== KONFIRMASI HAPUS FOTO =====
      document.querySelectorAll('.btn-hapus-foto').forEach(btn => {
        btn.addEventListener('click', function(e) {
          if (!confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            e.preventDefault();
          }
        });
      });
    });
  </script>

  <style>
    .img-thumbnail {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.25rem;
      background-color: #fff;
    }

    .position-relative {
      position: relative;
    }

    .position-absolute {
      position: absolute;
    }

    .d-inline-block {
      display: inline-block;
    }

    .me-2 {
      margin-right: 0.5rem;
    }

    .mb-2 {
      margin-bottom: 0.5rem;
    }

    .mt-2 {
      margin-top: 0.5rem;
    }

    .small {
      font-size: 0.875em;
    }

    .text-muted {
      color: #6c757d !important;
    }

    .badge {
      font-size: 0.75em;
      padding: 0.25em 0.5em;
    }

    .bg-secondary {
      background-color: #6c757d !important;
    }

    /* Style untuk textarea */
    textarea {
      resize: vertical;
    }

    /* Style untuk input number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      opacity: 1;
    }

    /* Style untuk card foto */
    .card-border {
      border: 1px solid #dee2e6;
    }
  </style>
@endsection
