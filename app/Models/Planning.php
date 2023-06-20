<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 
        'detail', 
        'date', 
        'repete', 
        'periodicite', 
        'repetition',
        'se_termine',
        'se_termine_le', 
        'se_termine_apres', 
        'client_id',
        'societe_id',
        'couleur'
    ];
}
