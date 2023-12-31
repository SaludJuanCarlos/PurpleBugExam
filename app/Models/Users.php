<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    
    public $table = "users";
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'role'
    ];
}
