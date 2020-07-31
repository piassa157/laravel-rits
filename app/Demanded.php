<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demanded extends Model
{
    protected $fillable = [
        'total',
        'status',
        'amount',
        'producs_ids',
        'user_id'
    ];
}
