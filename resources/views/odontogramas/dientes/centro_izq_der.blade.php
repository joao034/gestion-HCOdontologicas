<?php
    //Encotrar el detalle del odontograma pintado
    if( ($i >= 11 && $i <= 18) || ($i >= 41 && $i <= 48) || ($i >= 81 && $i <= 85) || ($i >= 51 && $i <= 55) )
        $cara_dental_izquierda = 'distal';
    else
        $cara_dental_izquierda = 'mesial';
    
    $color = $odontograma->getColorCaraDentalAPintar($cara_dental_izquierda, $i, $odontograma->id);
?>
<!-- Cara izquierda-->
<button style="height: 25px;padding: 5px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}"
        class="btn_diente" data-bs-toggle="modal"  data-bs-target="#detalle_odontograma" 
        onclick="crear( '{{ $cara_dental_izquierda }}', {{ $i }} , {{ $odontograma->id }})">
</button>


<?php
    //Encotrar el detalle del odontograma pintado
    //solo si el color del simbolo es distinto a vacio entra en la funcion
    $color = $odontograma->getColorCaraDentalAPintar('oclusal', $i, $odontograma->id);
?>
<!-- Cara central-->
<button style="width: 35px;height: 23px;padding: 8px;{{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
    class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
    onclick="crear( 'oclusal', {{ $i }} , {{ $odontograma->id }})">
</button>

<?php
    //Encotrar el detalle del odontograma pintado
    if( ($i >= 11 && $i <= 18) || ($i >= 41 && $i <= 48) || ($i >= 81 && $i <= 85) || ($i >= 51 && $i <= 55) )
        $cara_dental_derecha = 'mesial';
    else
        $cara_dental_derecha = 'distal';
    
    $color = $odontograma->getColorCaraDentalAPintar($cara_dental_derecha, $i, $odontograma->id);
?>
<!-- Cara derecha-->
<button style="height: 25px;padding: 5px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
    class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
    onclick="crear( '{{ $cara_dental_derecha }}', {{ $i }} , {{ $odontograma->id }})">
</button>
