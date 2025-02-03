<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spraying extends Model
{
    protected $fillable = ['comment', 'date', 'products', 'created_by'];
    protected $casts = [
        'products' => 'array',
    ];
}
