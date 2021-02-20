<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_phone',
        'contact_email',
    ];

    protected $hidden = ['created_at','updated_at']; 
}
