<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = [
        'fecha', 'estado', 'monto_total', 'usuario_id'
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'pedido_id');
    }
    
}
