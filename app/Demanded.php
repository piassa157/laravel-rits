<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demanded extends Model
{
    protected $fillable = [
        'status',
        'products_ids',
        'user_id'
    ];
}
