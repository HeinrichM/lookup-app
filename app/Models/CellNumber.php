<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'cell_number',
        'original_network',
        'current_network',
    ];
}
