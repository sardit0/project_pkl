<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minjem extends Model
{
    use HasFactory;

    protected $fillable = ['id','jumlah','tanggal_minjem','tanggal_kembali','nama','status','id_data',
    ];

    public $timestamps = true;


    public function data() {
        return $this->belongsTo(Data::class,'id_data');
    }

    public function kembali() {
        return $this->hasMany(Kembali::class);
    }
}