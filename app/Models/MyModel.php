<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return strtotime($date);
    }
}
