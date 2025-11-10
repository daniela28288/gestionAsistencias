<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Model;

class VisitReason extends Model
{
    protected $connection = 'db_programacion';
    protected $table = 'visit_reasons';

    // UN MOTIVO PUEDE TENER MUCHAS ENTRADAS DE VISITANTES
    public function visitorEntries()
    {
        return $this->hasMany(VisitorEntry::class);
    }

}
