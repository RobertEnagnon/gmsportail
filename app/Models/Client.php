<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'logo',
        'mi_affaire_id',
        'gms_affaire_id',
        'mg_affaire_id',
    ];

   
    

    
}
