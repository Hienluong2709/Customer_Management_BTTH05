<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'email',
        'password',
        'status',
        'account_type',
        'last_login',
    ];
}
