<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $timestamp = false;

    protected $fillable = [
        'name',
        'active',
        'date_active',
        'status',
    ];


}
