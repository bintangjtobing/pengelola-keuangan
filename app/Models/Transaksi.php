<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Gunakan BelongsTo dengan huruf kapital
use App\Models\Jenis_transaksi;
use App\Models\Kategori_transaksi;
use App\Models\suppliers_or_customers;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasUuids;
    use HasFactory;

    public function uniqueIds(): array
    {
        return ['uuid', 'uuid'];
    }

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'tanggal',
        'id',
        'jumlah',
        'kategori_transaksi_id',
        'jenis_transaksi_id',
        'suppliers_or_customers_id', // Perbaiki nama kolom
        'no_transaksi',
        'deskripsi',
        'user_id',
        'show',
        'anggaran',
    ];

    public function kategori_transaksi(): BelongsTo // Perbaiki BelongsTo
    {
        return $this->belongsTo(Kategori_transaksi::class);
    }

    public function jenis_transaksi(): BelongsTo // Perbaiki BelongsTo
    {
        return $this->belongsTo(Jenis_transaksi::class);
    }

    public function suppliers_or_customers(): BelongsTo // Perbaiki BelongsTo
    {
        return $this->belongsTo(suppliers_or_customers::class);
    }
}
