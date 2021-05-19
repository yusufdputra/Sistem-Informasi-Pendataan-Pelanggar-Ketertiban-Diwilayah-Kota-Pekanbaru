<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerdaPelanggaran extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'perda_pelanggarans';
  
    protected $dates = ['deleted_at'];
}
