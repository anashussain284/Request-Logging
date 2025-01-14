<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogRequestsModel extends Model
{
    protected $table = 'request_log';

    protected $fillable = [
        'method',
        'url',
        'ip',
        'response_time_ms'
    ];
}
