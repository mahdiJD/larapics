<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'disable_comment',
        'moderate_comments',
        'email_notification'
    ];

    protected $casts = [
        'email_notification' => 'array',
    ];
}
