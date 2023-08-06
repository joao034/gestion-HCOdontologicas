<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->getColorCaraDentalAPintar('izquierda', $i, $odontograma->id);
?>
<!-- Cara izquierda-->
<button style="height: 25px;padding: 5px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}"
        class="btn_diente" data-bs-toggle="modal"  data-bs-target="#detalle_odontograma" 
        onclick="crear( 'izquierda', {{ $i }} , {{ $odontograma->id }})">
</button>


<?php
    //Encotrar el detalle del odontograma pintado
    //solo si el color del simbolo es distinto a vacio entra en la funcion
    $color = $odontograma->getColorCaraDentalAPintar('central', $i, $odontograma->id);
?>
<!-- Cara central-->
<button style="width: 35px;height: 23px;padding: 8px;{{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
    class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
    onclick="crear( 'central', {{ $i }} , {{ $odontograma->id }})">
</button>

<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->getColorCaraDentalAPintar('derecha', $i, $odontograma->id);
?>
<!-- Cara derecha-->
<button style="height: 25px;padding: 5px; {{ $color != '' ? 'background-color: ' . $color . ';' : '' }}" 
    class="btn_diente" data-bs-toggle="modal" data-bs-target="#detalle_odontograma" 
    onclick="crear( 'derecha', {{ $i }} , {{ $odontograma->id }})">
</button>
