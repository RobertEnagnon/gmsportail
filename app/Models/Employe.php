<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'cin',
        'cnss',
        'site_id',
        'client_id',
        'societe_id',
    ];

    public $timestamps = false;


    public function site(){
        return $this->belongsTo(Site::class,'site_id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class,'societe_id');
    }
}
