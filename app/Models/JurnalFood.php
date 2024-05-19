<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalFood extends Model
{
    use HasFactory;

    protected $table = 'jurnal_foods';

    protected $fillable = [
        'category_id',
        'food_id',
        'user_id',
        'total_serving',
        'total_calory',
    ];
}
