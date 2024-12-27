<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['message', 'user_id', 'read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
