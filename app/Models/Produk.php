<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama',
        'foto_utama',
        'deskripsi',
        'terjual',
        'rating',
        'jumlah_rating'
    ];

    public function detailTanaman()
    {
        return $this->hasOne(DetailTanaman::class, 'id_produk', 'id_produk');
    }

    // RELATIONSHIP UNTUK PRODUK_UKURAN
    public function produkUkuran()
    {
        return $this->hasMany(ProdukUkuran::class, 'id_produk', 'id_produk');
    }

    // RELATIONSHIP DENGAN UKURAN MELALUI PRODUK_UKURAN
    public function ukurans()
    {
        return $this->belongsToMany(Ukuran::class, 'produk_ukuran', 'id_produk', 'id_ukuran')
            ->withPivot('harga', 'stok')
            ->withTimestamps();
    }

    // ACCESSOR UNTUK HARGA TERENDAH
    public function getHargaTerendahAttribute()
    {
        return $this->produkUkuran()->min('harga');
    }

    // ACCESSOR UNTUK HARGA TERTINGGI
    public function getHargaTertinggiAttribute()
    {
        return $this->produkUkuran()->max('harga');
    }

    public function getTerjualFormattedAttribute()
    {
        return $this->terjual >= 1000
            ? floor($this->terjual / 1000) . 'rb+'
            : $this->terjual;
    }

    public function getRouteKeyName()
    {
        return 'id_produk';
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function petunjukPerawatan()
    {
        return $this->hasOne(PetunjukPerawatan::class, 'id_produk', 'id_produk');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_produk', 'id_produk');
    }

    public function fotoProduk()
    {
        return $this->hasMany(FotoProduk::class, 'id_produk', 'id_produk');
    }


    /**
     * Update rating produk berdasarkan semua review yang ada
     */
    public function updateRating()
    {
        $reviews = $this->reviews;

        if ($reviews->count() > 0) {
            $totalRating = $reviews->sum('rating');
            $averageRating = $totalRating / $reviews->count();

            $this->update([
                'rating' => round($averageRating, 2),
                'jumlah_rating' => $reviews->count(),
            ]);

            \Illuminate\Support\Facades\Log::info("Product {$this->id_produk} rating updated to: {$averageRating} from {$reviews->count()} reviews");
        } else {
            $this->update([
                'rating' => 0,
                'jumlah_rating' => 0,
            ]);

            \Illuminate\Support\Facades\Log::info("Product {$this->id_produk} rating reset to 0 (no reviews)");
        }

        return $this;
    }

    /**
     * Accessor untuk rating dinamis (selalu hitung dari database)
     * Digunakan di view untuk menghindari cache masalah
     */
    public function getRatingDinamisAttribute()
    {
        $reviews = $this->reviews;
        return $reviews->count() > 0 ? round($reviews->avg('rating'), 2) : 0;
    }

    /**
     * Accessor untuk jumlah rating dinamis
     */
    public function getJumlahRatingDinamisAttribute()
    {
        return $this->reviews()->count();
    }

    /**
     * Hitung distribusi rating (5,4,3,2,1 stars)
     */
    public function getRatingDistributionAttribute()
    {
        $distribution = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];

        foreach ($this->reviews as $review) {
            if (isset($distribution[$review->rating])) {
                $distribution[$review->rating]++;
            }
        }

        return $distribution;
    }

    /**
     * Persentase untuk setiap rating
     */
    public function getRatingPercentageAttribute()
    {
        $total = $this->reviews->count();
        $distribution = $this->rating_distribution;
        $percentage = [];

        foreach ($distribution as $rating => $count) {
            $percentage[$rating] = $total > 0 ? round(($count / $total) * 100, 1) : 0;
        }

        return $percentage;
    }

    /**
     * Rating summary untuk display
     */
    public function getRatingSummaryAttribute()
    {
        return [
            'average' => $this->rating_dinamis,
            'total' => $this->jumlah_rating_dinamis,
            'distribution' => $this->rating_distribution,
            'percentage' => $this->rating_percentage,
        ];
    }
}
