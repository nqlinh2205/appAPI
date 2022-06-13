<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailcampaign extends Model
{
    use HasFactory;

    protected $listable = [
        'subject',
        'list_email',
        'message',
        'campaign_id',
        'email'
    ];
}
