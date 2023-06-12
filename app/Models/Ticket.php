<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'titre',
        'message',
        'date',
        'fichier',
        'client_id',
        'societe_id',
        'service_id',
        'priorite_id',
        'user_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class,'societe_id');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function priorite(){
        return $this->belongsTo(Priorite::class,'priorite_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
