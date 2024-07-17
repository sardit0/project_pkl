<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
        protected $fillable = ['id','nama','merek','stok'];

        public function Abus()
        {
            return $this->belongsTo(Abus::class);
        }
        public function Kaluar()
        {
            return $this->belongsTo(Kaluar::class);
        }
        public function Minjem()
        {
            return $this->belongsTo(Minjem::class);
        }
        public function Kembali()
        {
            return $this->belongsTo(Kembali::class);
        }
}
