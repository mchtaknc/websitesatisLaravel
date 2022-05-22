<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ticketReplies()
    {
        return $this->hasMany('App\Models\TicketReplies','ticket_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user','id');
    }
}
