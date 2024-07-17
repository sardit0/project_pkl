<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaluar extends Model
{
    use HasFactory;
    protected $fillable = ['id','jumlah','tanggal_keluar','keterangan','id_data'];

    public function Data ()
    {
        return $this->belongsTo(Data::class, 'id_data');
    }
}