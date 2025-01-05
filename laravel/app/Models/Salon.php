<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'saloni';
    
    protected $hidden = [
        'lozinka',
        'created_at',
        'updated_at',
        'email',
        'telefon',
        'datum_registracije'
    ];

    protected $visible = [
        'id',
        'salon_naziv',
        'grad',
        'aktivan'
    ];
}