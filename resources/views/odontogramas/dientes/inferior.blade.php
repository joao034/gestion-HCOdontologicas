<?php
    //Encotrar el detalle del odontograma pintado
    if( ($i >= 11 && $i <= 28) || ($i >= 51 && $i <= 65) )
        $cara_dental_inferior = 'palatino';
    
    if( ($i >= 31 && $i <= 48) || ($i >= 71 && $i <= 85) )
        $cara_dental_inferior = 'vestibular';
    
    $color = $odontograma->getColorCaraDentalAPintar($cara_dental_inferior, $i, $odontograma->id);
?>

<button style="width: 27px;height: 10px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
        class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
        onclick="crear( '{{ $cara_dental_inferior }}', {{ $i }} , {{ $odontograma->id }})">
</button>

