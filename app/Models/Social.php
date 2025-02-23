<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class Social extends Model
{
    use HasFactory;

    protected $fillable = ['facebook','twitter','instagram','website','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
