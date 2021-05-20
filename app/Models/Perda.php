<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perda extends Model
{
    use HasFactory, SoftDeletes;
    public function pelanggaran()
    {
        return $this->belongsToMany(Pelanggaran::class);
    }
}
