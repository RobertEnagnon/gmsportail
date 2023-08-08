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
        'date_fin',
        'repete', 
        'periodicite', 
        'is_done',
        'se_termine_le', 
        'se_termine_apres', 
        'client_id',
        'societe_id',
        'couleur'
    ];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class,'societe_id');
    }
}
