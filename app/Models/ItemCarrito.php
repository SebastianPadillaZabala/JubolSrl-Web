<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCarrito extends Model
{
    use HasFactory;
    protected $table = 'items_carrito';
    protected $fillable = [
        'cantidad', 'usuario_id', 'producto_id'
    ];
}
