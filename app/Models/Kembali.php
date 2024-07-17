<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    use HasFactory;

    protected $fillable = ['id','jumlah','tanggal_kembali','nama','status','id_minjem','id_data'];

    public $timestamps = true;


    public function data() {
        return $this->belongsTo(Data::class,'id_data');
    }

    public function minjem() {
        return $this->belongsTo(Minjem::class,'id_minjem');
    }
}