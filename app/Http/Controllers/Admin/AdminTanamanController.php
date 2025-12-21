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

class AdminTanamanController extends Controller
{
    /* ================= INDEX ================= */
    public function index()
    {
        $produk = Produk::with('produkUkuran')->latest()->get();
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
            'nama'        => 'required',
            'id_kategori' => 'required',
            'deskripsi'   => 'required',
            'foto_utama'  => 'required|image',
        ]);

        DB::transaction(function () use ($request) {

            /* ===== FOTO UTAMA ===== */
            $namaUtama = time().'_'.$request->foto_utama->getClientOriginalName();
            $request->foto_utama->move(public_path('images'), $namaUtama);

            $produk = Produk::create([
                'id_kategori'   => $request->id_kategori,
                'nama'          => $request->nama,
                'foto_utama'    => 'images/'.$namaUtama,
                'deskripsi'     => $request->deskripsi,
                'terjual'       => 0,
                'rating'        => 0,
                'jumlah_rating' => 0,
            ]);

            /* ===== DETAIL TANAMAN ===== */
            DetailTanaman::create([
                'id_produk'     => $produk->id_produk,
                'nama_ilmiah'   => $request->nama_ilmiah,
                'ukuran_detail' => $request->ukuran_detail,
                'asal_tanaman'  => $request->asal_tanaman,
            ]);

            /* ===== HARGA & STOK ===== */
            if ($request->harga) {
                foreach ($request->harga as $id_ukuran => $harga) {
                    ProdukUkuran::create([
                        'id_produk' => $produk->id_produk,
                        'id_ukuran' => $id_ukuran,
                        'harga'     => $harga ?? 0,
                        'stok'      => $request->stok[$id_ukuran] ?? 0,
                    ]);
                }
            }

            /* ===== FOTO GALLERY ===== */
            if ($request->hasFile('foto_produk')) {
                foreach ($request->foto_produk as $foto) {
                    $namaFoto = time().'_'.$foto->getClientOriginalName();
                    $foto->move(public_path('uploads'), $namaFoto);

                    FotoProduk::create([
                        'id_produk' => $produk->id_produk,
                        'foto'      => 'uploads/'.$namaFoto,
                    ]);
                }
            }
            /* ===== PETUNJUK PERAWATAN ===== */
    PetunjukPerawatan::create([
    'id_produk'  => $produk->id_produk,
    'penyiraman' => $request->penyiraman,
    'cahaya'     => $request->cahaya,
    'suhu'       => $request->suhu,
]);

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
            'petunjukPerawatan'

        ])->findOrFail($id);

        return view('admin.tanaman.show', compact('produk'));
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $produk = Produk::with([
            'detailTanaman',
            'produkUkuran'
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
            'nama'        => 'required',
            'id_kategori' => 'required',
            'deskripsi'   => 'required',
            'foto_utama'  => 'nullable|image',
        ]);

        DB::transaction(function () use ($request, $produk) {

            /* FOTO UTAMA */
            if ($request->hasFile('foto_utama')) {
                if ($produk->foto_utama && file_exists(public_path($produk->foto_utama))) {
                    unlink(public_path($produk->foto_utama));
                }

                $namaUtama = time().'_'.$request->foto_utama->getClientOriginalName();
                $request->foto_utama->move(public_path('images'), $namaUtama);
                $produk->foto_utama = 'images/'.$namaUtama;
            }

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
                    'nama_ilmiah'   => $request->nama_ilmiah,
                    'ukuran_detail' => $request->ukuran_detail,
                    'asal_tanaman'  => $request->asal_tanaman,
                ]
            );

            /* UPDATE HARGA & STOK */
            if ($request->harga) {
                foreach ($request->harga as $id_ukuran => $harga) {
                    ProdukUkuran::updateOrCreate(
                        [
                            'id_produk' => $produk->id_produk,
                            'id_ukuran' => $id_ukuran,
                        ],
                        [
                            'harga' => $harga ?? 0,
                            'stok'  => $request->stok[$id_ukuran] ?? 0,
                        ]
                    );
                }
            }
            PetunjukPerawatan::updateOrCreate(
    ['id_produk' => $produk->id_produk],
    [
        'penyiraman' => $request->penyiraman,
        'cahaya'     => $request->cahaya,
        'suhu'       => $request->suhu,
    ]
);

        });

        return redirect()->route('admin.tanaman')
            ->with('success', 'Tanaman berhasil diperbarui');
    }

    /* ================= DESTROY ================= */
    public function destroy($id)
    {
        $produk = Produk::with('fotoProduk', 'detailTanaman', 'produkUkuran')
            ->findOrFail($id);

        DB::transaction(function () use ($produk) {

            if ($produk->foto_utama && file_exists(public_path($produk->foto_utama))) {
                unlink(public_path($produk->foto_utama));
            }

            foreach ($produk->fotoProduk as $foto) {
                if (file_exists(public_path($foto->foto))) {
                    unlink(public_path($foto->foto));
                }
            }

            $produk->fotoProduk()->delete();
            $produk->produkUkuran()->delete();
            $produk->detailTanaman()->delete();
            $produk->delete();
        });

        return redirect()->route('admin.tanaman')
            ->with('success', 'Tanaman berhasil dihapus');
    }
}
