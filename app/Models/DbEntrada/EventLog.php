<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $connection = 'db_programacion';
    protected $table = 'events_log';

    protected $guarded = [];

    public $timestamps = false;
}
