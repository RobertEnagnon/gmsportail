<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'client_id',
        'societe_id',
        'libelle',
        'nom_fichier',
        'date'
    ];

    public $timestamps = false;


    public function type_doc(){
        return $this->belongsTo(TypeDocument::class,'type_id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class,'societe_id');
    }
}
