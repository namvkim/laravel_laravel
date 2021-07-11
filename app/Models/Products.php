<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'id_type', 'description', 'unit_price', 'promotion_price', 'image', 'unit', 'new'];
}
