<?php
namespace App\Models;
use App\Models\empleado;
class mesa extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = array('estado','id_pedido');
}
?>