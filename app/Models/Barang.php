<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Barang extends Model
{
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'barang';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_kategori',
        'nama_barang',
        'merk',
        'ukuran',
        'bahan',
        'tahun',
        'asal_barang',
        'kondisi_barang',
        'jumlah_barang',
        'harga_barang',
        'foto_barang',
        'is_active',
        'id_user',

    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori','id');

    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');

    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontLogIfAttributesChangedOnly(['text'])
            ->logOnlyDirty()
            ->useLogName('Barang');
    }
}
