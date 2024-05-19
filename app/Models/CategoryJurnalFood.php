<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryJurnalFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
