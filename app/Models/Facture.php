<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'nom_fichier',
        'client_id',
        'societe_id',
        'date',
    ];

    public $timestamps = false;

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }
}
