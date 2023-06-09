<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mac_address',
        'hard_disk_serial',
        'active',
    ];

    public $timestamps = false;
}
