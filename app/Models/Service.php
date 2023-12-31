<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'email'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
}
