<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->getColorCaraDentalAPintar('superior', $i, $odontograma->id);
?>

<button style="width: 27px;height: 10px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
        class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
        onclick="crear( 'superior', {{ $i }} , {{ $odontograma->id }})">
</button>


