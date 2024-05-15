<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kategori extends Model
{

    use LogsActivity;
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable =[
        'id',
        'id_jenis',
        'nama',
        'status',
        'created_at',
        'updated_at',
    ];
    public function jenis()
    {
        return $this->belongsTo(JenisKategori::class,'id_jenis','id');

    }
    public function barang()
    {
        return $this->hasOne(Barang::class,'id_kategori');

    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('kategori');
    }
}
