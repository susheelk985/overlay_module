<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'targeting_rule',
        'overlay_type',
        'display_rule',
    ];
}
