<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggaran extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_petugas')->withTrashed();
    }

    public function perda()
    {
        return $this->hasMany(Perda::class, 'id', 'nama_perda')->withTrashed();
    }
}
