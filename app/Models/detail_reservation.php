<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_reservation extends Model
{
    protected $fillable = [
        'reservation_id',
                'produit_id',
                'Prix_Total',
                'Date_D',
                'Date_F',
       
    ];
}
