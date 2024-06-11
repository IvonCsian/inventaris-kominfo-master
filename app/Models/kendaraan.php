<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class kendaraan extends Model
{
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kendaraan';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nopol',
        'jenis',
        'id_kategori',
        'stnk',
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
            ->useLogName('kendaraan');
    }
}
