<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerdaSangsi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perda_sangsis';
    protected $dates = ['deleted_at'];

    
}
