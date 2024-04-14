<?php

namespace App\Observers;

use App\Models\HistoriaClinica;
use App\Models\Paciente;

class PacienteObserver
{
    /**
     * Handle the Paciente "created" event.
     */
    public function created(Paciente $paciente): void
    {
        HistoriaClinica::create([
            'paciente_id' => $paciente->id,
            'odontologo_id' => null
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
