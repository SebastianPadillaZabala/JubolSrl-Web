<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;
    protected $table = 'paginas';
    protected $fillable = ['nombre', 'nro_visitas'];
}
