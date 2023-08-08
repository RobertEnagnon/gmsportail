<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'ticket_id',
        'content'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

    public function Ticket(){
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
