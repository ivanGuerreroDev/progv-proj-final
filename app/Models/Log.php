<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'os_info',
        'user_agent',
        'user_id',
        'session_duration',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
