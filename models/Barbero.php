<?php

use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    protected $table = 'barberos';
    protected $fillable = ['nombre', 'email', 'telefono', 'especialidad', 'experiencia', 'estado'];
    public $timestamps = false;
}
