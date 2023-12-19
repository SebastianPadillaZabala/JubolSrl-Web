<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;
    protected $table = 'detalles_pedido';
    protected $fillable = [
        'pedido_id', 'producto_id', 'precio', 'descuento', 'precio_final', 'cantidad', 'importe'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
