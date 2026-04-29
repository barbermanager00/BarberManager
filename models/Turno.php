<?php

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turnos'; // Nombre de la tabla
    protected $fillable = ['clienteNombre', 'clienteTelefono', 'barberoId', 'fecha', 'hora', 'servicio'];
    public $timestamps = false; // Como usamos created_at por defecto en SQL, desactivamos los de Eloquent

    // Relación con Barbero
    public function barbero()
    {
        return $this->belongsTo('Barbero', 'barberoId', 'id');
    }
}

