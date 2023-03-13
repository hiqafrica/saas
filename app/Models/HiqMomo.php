<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiqMomo extends Model
{
    use HasFactory;
    protected $table = 'hiq_momos';

    protected $fillable = [
        'user_id',
        'user_email',
        'phone_number',
        'payment_geteway',
        'payment_amount',
        'payment_status',
        'payment_ref',
        'payment_archive',
   ];
}
