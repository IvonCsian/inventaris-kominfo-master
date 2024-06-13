<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class laporan extends Model
{
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'laporan';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_kendaraan',
        'nipl',
        'tanggal',
        'isi',
        'foto',
        'is_active',
        'id_user',

    ];
    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class,'id_kendaraan','id');

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
            ->useLogName('laporan');
    }
}
