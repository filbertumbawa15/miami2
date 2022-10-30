<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends MyModel
{
    use HasFactory;
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    protected $dateFormat = 'U';
}
