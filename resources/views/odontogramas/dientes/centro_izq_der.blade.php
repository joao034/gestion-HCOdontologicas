<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->pintarCaraDental('izquierda', $i, $odontograma->id);
?>

<!-- Cara izquierda-->
<button style="height: 25px;padding: 5px; {{ $color }}" class="btn_diente" data-bs-toggle="modal" 
    data-bs-target="#detalle_odontograma" onclick="crear( 'izquierda', {{ $i }} , {{ $odontograma->id }})"></button>


<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->pintarCaraDental('central', $i, $odontograma->id);
?>
<!-- Cara central-->
<button style="width: 35px;height: 23px;padding: 8px; {{ $color }}" class="btn_diente" 
    data-bs-toggle="modal" data-bs-target="#detalle_odontograma" onclick="crear( 'central', {{ $i }} , {{ $odontograma->id }})">
</button>

<?php
    //Encotrar el detalle del odontograma pintado
    $color = $odontograma->pintarCaraDental('derecha', $i, $odontograma->id);
?>
<!-- Cara derecha-->
<button style="height: 25px;padding: 5px; {{ $color }}" class="btn_diente" data-bs-toggle="modal" 
    data-bs-target="#detalle_odontograma" onclick="crear( 'derecha', {{ $i }} , {{ $odontograma->id }})">
</button>