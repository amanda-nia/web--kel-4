<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor_data extends Model
{
    protected $table = 'sensor_data';

    protected $fillable = [
        'device_id',
        'sensor_name',
        'value'
    ];
}