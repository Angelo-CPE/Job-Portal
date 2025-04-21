<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'resume',
        'name', // Add the 'name' field
        'sex',  // Add the 'sex' field
        'birthdate', // Add the 'birthdate' field
        'address', // Add the 'address' field
        'school', // Add the 'school' field
        'phone', // Add the 'phone' field
        'email', // Add the 'email' field
        'salary', // Add the 'salary' field
        'time', // Add the 'time' field
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function listing(){
        return $this->belongsTo(Listing::class);
    }
}
