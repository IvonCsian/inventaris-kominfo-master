<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JenisKategori extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $table = 'jenis_kategori';
    protected $fillable = [
        'id',
        'nama_jenis',
    ];
    public function kategori()
    {
        return $this->hasOne(Kategori::class,'id_jenis');

    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Jenis Kategori');
    }
}
