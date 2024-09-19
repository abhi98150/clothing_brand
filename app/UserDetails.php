<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'country', 'street_address', 
        'city', 'state', 'postcode', 'phone', 'additional_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
