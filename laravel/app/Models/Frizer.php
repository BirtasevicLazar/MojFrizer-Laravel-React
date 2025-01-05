<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frizer extends Model
{
    use HasFactory;

    protected $table = 'frizeri'; 

    protected $fillable = [
        'salon_id',
        'ime',
        'prezime',
        'email',
        'telefon',
    ];
}