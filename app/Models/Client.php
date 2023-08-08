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

    public function user(){
        return $this->hasOne(User::class);
    }
    
    public function sites(){
        return $this->hasMany(Site::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    
}
