<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Model;

class VisitorEntry extends Model
{
    protected $connection = 'db_programacion';
    protected $table = 'visitor_entries';


    // UN VISITANTE PERTENECE A UNA POSICION (EJ: Visitante)
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    // UN VISITANTE TIENE UN MOTIVO DE VISITA
    public function reason()
    {
        return $this->belongsTo(VisitReason::class, 'reason_id');
    }
}
