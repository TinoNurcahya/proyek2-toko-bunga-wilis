<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukUkuran;
use App\Models\Kategori;
use App\Models\Ukuran;
use App\Models\FotoProduk;
use App\Models\DetailTanaman;
use App\Models\PetunjukPerawatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTanamanController extends Controller
{
    /* ================= INDEX ================= */
    public function index()
    {
        $produk = Produk::with(['produkUkuran', 'kategori'])->latest()->get();
        return view('admin.tanaman.index', compact('produk'));
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('admin.tanaman.create', [
            'kategori' => Kategori::all(),
            'ukuran'   => Ukuran::all(),
        ]);
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $request->validate([
            'nama'               => 'required|string|max:200',
            'id_kategori'        => 'required|exists:kategori,id_kategori',
            'deskripsi'          => 'required|string',
            'nama_ilmiah'        => 'nullable|string|max:100',
            'asal_tanaman'       => 'nullable|string|max:100',
            'ukuran_detail'      => 'nullable|string|max:200',
            'foto_utama'         => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto_produk.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'harga.*'            => 'nullable|numeric|min:0',
            'stok.*'             => 'nullable|integer|min:0',
            'penyiraman'         => 'nullable|string',
            'cahaya'             => 'nullable|string',
            'suhu_dan_kelembapan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // Buat folder jika belum ada
            $this->createDirectories();

            /* ===== FOTO UTAMA ===== */
            $fotoUtama = $request->file('foto_utama');
            $namaUtama = time() . '_' . Str::random(10) . '.' . $fotoUtama->getClientOriginalExtension();
            $pathUtama = 'images/products/' . $namaUtama;
            $fotoUtama->move(public_path('images/products'), $namaUtama);

            /* ===== CREATE PRODUK ===== */
            $produk = Produk::create([
                'id_kategori'   => $request->id_kategori,
                'nama'          => $request->nama,
                'foto_utama'    => $pathUtama,
                'deskripsi'     => $request->deskripsi,
                'terjual'       => 0,
                'rating'        => 0,
                'jumlah_rating' => 0,
            ]);

            /* ===== DETAIL TANAMAN ===== */
            if ($request->filled('nama_ilmiah') || $request->filled('ukuran_detail') || $request->filled('asal_tanaman')) {
                DetailTanaman::create([
                    'id_produk'     => $produk->id_produk,
                    'nama_ilmiah'   => $request->nama_ilmiah,
                    'ukuran_detail' => $request->ukuran_detail,
                    'asal_tanaman'  => $request->asal_tanaman,
                ]);
            }

            /* ===== HARGA & STOK ===== */
            if ($request->harga) {
                foreach ($request->harga as $id_ukuran => $harga) {
                    $stok = $request->stok[$id_ukuran] ?? 0;

                    // Hanya simpan jika ada harga atau stok
                    if (!is_null($harga) || $stok > 0) {
                        ProdukUkuran::create([
                            'id_produk' => $produk->id_produk,
                            'id_ukuran' => $id_ukuran,
                            'harga'     => $harga ?: 0,
                            'stok'      => $stok,
                        ]);
                    }
                }
            }

            /* ===== FOTO GALLERY ===== */
            if ($request->hasFile('foto_produk')) {
                foreach ($request->file('foto_produk') as $foto) {
                    $namaFoto = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                    $pathFoto = 'uploads/produk/' . $namaFoto;
                    $foto->move(public_path('uploads/produk'), $namaFoto);

                    FotoProduk::create([
                        'id_produk' => $produk->id_produk,
                        'foto'      => $pathFoto,
                    ]);
                }
            }

            /* ===== PETUNJUK PERAWATAN ===== */
            if ($request->filled('penyiraman') || $request->filled('cahaya') || $request->filled('suhu_dan_kelembapan')) {
                PetunjukPerawatan::create([
                    'id_produk'            => $produk->id_produk,
                    'penyiraman'          => $request->penyiraman,
                    'cahaya'              => $request->cahaya,
                    'suhu_dan_kelembapan' => $request->suhu_dan_kelembapan,
                ]);
            }
        });

        return redirect()->route('admin.tanaman')
            ->with('success', 'Tanaman berhasil ditambahkan');
    }

    /* ================= SHOW ================= */
    public function show($id)
    {
        $produk = Produk::with([
            'produkUkuran.ukuran',
            'fotoProduk',
            'detailTanaman',
            'petunjukPerawatan',
            'kategori'
        ])->findOrFail($id);

        return view('admin.tanaman.show', compact('produk'));
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $produk = Produk::with([
            'detailTanaman',
            'produkUkuran',
            'fotoProduk',
            'petunjukPerawatan'
        ])->findOrFail($id);

        return view('admin.tanaman.edit', [
            'produk'   => $produk,
            'kategori' => Kategori::all(),
            'ukuran'   => Ukuran::all(),
        ]);
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama'               => 'required|string|max:200',
            'id_kategori'        => 'required|exists:kategori,id_kategori',
            'deskripsi'          => 'required|string',
            'nama_ilmiah'        => 'nullable|string|max:100',
            'asal_tanaman'       => 'nullable|string|max:100',
            'ukuran_detail'      => 'nullable|string|max:200',
            'foto_utama'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto_produk.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'harga.*'            => 'nullable|numeric|min:0',
            'stok.*'             => 'nullable|integer|min:0',
            'penyiraman'         => 'nullable|string',
            'cahaya'             => 'nullable|string',
            'suhu_dan_kelembapan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $produk) {
            /* FOTO UTAMA */
            if ($request->hasFile('foto_utama')) {
                // Hapus foto lama
                $this->hapusFile($produk->foto_utama);

                $fotoUtama = $request->file('foto_utama');
                $namaUtama = time() . '_' . Str::random(10) . '.' . $fotoUtama->getClientOriginalExtension();
                $pathUtama = 'images/products/' . $namaUtama;
                $fotoUtama->move(public_path('images/products'), $namaUtama);

                $produk->foto_utama = $pathUtama;
            }

            /* UPDATE PRODUK */
            $produk->update([
                'nama'        => $request->nama,
                'id_kategori' => $request->id_kategori,
                'deskripsi'   => $request->deskripsi,
                'foto_utama'  => $produk->foto_utama,
            ]);

            /* DETAIL TANAMAN */
            DetailTanaman::updateOrCreate(
                ['id_produk' => $produk->id_produk],
                [
                    'nama_ilmiah'       => $request->nama_ilmiah,
                    'ukuran_detail'     => $request->ukuran_detail,
                    'asal_tanaman'      => $request->asal_tanaman,
                ]
            );

            /* UPDATE HARGA & STOK */
            if ($request->harga) {
                foreach ($request->harga as $id_ukuran => $harga) {
                    $stok = $request->stok[$id_ukuran] ?? 0;

                    // Hapus jika harga dan stok kosong
                    if (is_null($harga) && $stok == 0) {
                        ProdukUkuran::where('id_produk', $produk->id_produk)
                            ->where('id_ukuran', $id_ukuran)
                            ->delete();
                    } else {
                        ProdukUkuran::updateOrCreate(
                            [
                                'id_produk' => $produk->id_produk,
                                'id_ukuran' => $id_ukuran,
                            ],
                            [
                                'harga' => $harga ?: 0,
                                'stok'  => $stok,
                            ]
                        );
                    }
                }
            }

            /* TAMBAH FOTO BARU KE GALLERY */
            if ($request->hasFile('foto_produk')) {
                foreach ($request->file('foto_produk') as $foto) {
                    $namaFoto = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                    $pathFoto = 'uploads/produk/' . $namaFoto;
                    $foto->move(public_path('uploads/produk'), $namaFoto);

                    FotoProduk::create([
                        'id_produk' => $produk->id_produk,
                        'foto'      => $pathFoto,
                    ]);
                }
            }

            /* PETUNJUK PERAWATAN - PERBAIKAN DISINI */
            // Cari berdasarkan id_produk, bukan primary key
            if ($request->filled('penyiraman') || $request->filled('cahaya') || $request->filled('suhu_dan_kelembapan')) {
                // Cek apakah sudah ada data
                $petunjuk = PetunjukPerawatan::where('id_produk', $produk->id_produk)->first();

                if ($petunjuk) {
                    // Update data yang sudah ada
                    $petunjuk->update([
                        'penyiraman'          => $request->penyiraman,
                        'cahaya'              => $request->cahaya,
                        'suhu_dan_kelembapan' => $request->suhu_dan_kelembapan,
                    ]);
                } else {
                    // Buat data baru
                    PetunjukPerawatan::create([
                        'id_produk'            => $produk->id_produk,
                        'penyiraman'          => $request->penyiraman,
                        'cahaya'              => $request->cahaya,
                        'suhu_dan_kelembapan' => $request->suhu_dan_kelembapan,
                    ]);
                }
            } else {
                // Hapus jika semua field kosong
                PetunjukPerawatan::where('id_produk', $produk->id_produk)->delete();
            }
        });

        return redirect()->route('admin.tanaman')
            ->with('success', 'Tanaman berhasil diperbarui');
    }

    /* ================= DESTROY ================= */
    public function destroy($id)
    {
        $produk = Produk::with('fotoProduk', 'detailTanaman', 'produkUkuran', 'petunjukPerawatan')
            ->findOrFail($id);

        DB::transaction(function () use ($produk) {
            // Hapus foto utama
            $this->hapusFile($produk->foto_utama);

            // Hapus foto gallery
            foreach ($produk->fotoProduk as $foto) {
                $this->hapusFile($foto->foto);
            }

            // Hapus semua relasi
            $produk->fotoProduk()->delete();
            $produk->produkUkuran()->delete();
            $produk->detailTanaman()->delete();
            $produk->petunjukPerawatan()->delete();
            $produk->delete();
        });

        return redirect()->route('admin.tanaman')
            ->with('success', 'Tanaman berhasil dihapus');
    }

    /* ================= HAPUS FOTO GALERI ================= */
    public function hapusFoto($id)
    {
        $foto = FotoProduk::findOrFail($id);

        // Hapus file fisik
        $this->hapusFile($foto->foto);

        // Hapus dari database
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }

    /* ================= PRIVATE HELPER METHODS ================= */

    /**
     * Buat direktori jika belum ada
     */
    private function createDirectories()
    {
        $directories = [
            public_path('images/products'),
            public_path('uploads/produk'),
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }
    }

    /**
     * Hapus file fisik jika ada
     */
    private function hapusFile($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
