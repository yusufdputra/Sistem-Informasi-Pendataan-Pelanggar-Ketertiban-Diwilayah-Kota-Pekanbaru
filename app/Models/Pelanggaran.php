<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_petugas')->withTrashed();
    }
}
