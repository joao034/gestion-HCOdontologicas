<?php

namespace App\View\Components;

use App\Models\Paciente;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InfoPaciente extends Component
{
    public $paciente;
    public $antecedentes;

    public function __construct( $paciente, $antecedentes=null )
    {
        $this->paciente = $paciente;
        $this->antecedentes = $antecedentes;
    }

    public function render(): View|Closure|string
    {
        return view('components.info-paciente');
    }
}
