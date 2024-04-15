<?php

namespace App\Observers;

use App\Models\HistoriaClinica;
use App\Models\Odontograma;
use App\Models\Paciente;

class PacienteObserver
{
    /**
     * Handle the Paciente "created" event.
     */
    public function created(Paciente $paciente): void
    {
        $hClinica = HistoriaClinica::create([
            'paciente_id' => $paciente->id,
            'odontologo_id' => null
        ]);

        Odontograma::create([
            'total' => 0,
            'hclinica_id' => $hClinica->id
        ]);
    }

    /**
     * Handle the Paciente "updated" event.
     */
    public function updated(Paciente $paciente): void
    {
        //
    }

    /**
     * Handle the Paciente "deleted" event.
     */
    public function deleted(Paciente $paciente): void
    {
        //
    }

    /**
     * Handle the Paciente "restored" event.
     */
    public function restored(Paciente $paciente): void
    {
        //
    }

    /**
     * Handle the Paciente "force deleted" event.
     */
    public function forceDeleted(Paciente $paciente): void
    {
        //
    }
}
