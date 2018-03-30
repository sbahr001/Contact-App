<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $guarded = 'user';

    protected $casts = [
        'emails' => 'array',
        'addresses' => 'array',
        'phones' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
