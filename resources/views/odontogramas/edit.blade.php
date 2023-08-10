@extends('layouts.app')
@section('content')

<h1 class="text-center">Odontograma Geométrico</h1>

<!-- Cuadrante Superior dentadura adulta -->
<div class="row">
    <div  class="col-lg-1 col-md-12 col-sm-12 col-xs-12"></div>
    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=18;$i>10;$i--)
                <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
            @endfor
        </div>
        
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=18;$i>10;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>
                    
                    <div style="width: 40px;height: auto;background: url('{{ $imagen }}');background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
                
            @endfor
        </div>
        
    </div>

    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=21;$i<=28;$i++)
                <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=21;$i<=28;$i++)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?> 
                    
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- Fin Cuadrante Superior dentadura adulta -->

<!-- Cuadrante Superior dentadura niño -->
<div class="row">
    <div  class="col-lg-1 col-md-12 col-sm-12 col-xs-12"></div>
    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=58;$i>50;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=55){{ $i }}@else <span style="color: transparent;">00</span> @endif
                </div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=58;$i>50;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=55)
                <div style="flex-grow: 1;margin-left: 5px;">

                   <!-- simbolos -->
                    <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                    ?>
                   
                     <!-- graficar el cuadrante III con los datos que hay en el -->
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}');background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
                    @else
                    <div style="width: 40px;height: 40px;border: 1px solid transparent;"></div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=61;$i<69;$i++)
                <div style="flex-grow: 1;margin-left: 20px;">
                @if($i<=65){{ $i }}@else <span style="color: transparent;">00</span> @endif
                </div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=61;$i<69;$i++)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=65)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>
                     <!-- graficar el cuadrante IV con los datos que hay en el -->
                    
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
                    @else
                    <div style="width: 40px;height: 40px;border: 1px solid transparent;"></div>
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- Fin Cuadrante Superior dentadura niño -->

<!-- Cuadrante Inferior dentadura niño -->
<div class="row">
    <div  class="col-lg-1 col-md-12 col-sm-12 col-xs-12"></div>
    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=88;$i>80;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=85){{ $i }}@else <span style="color: transparent;">00</span> @endif
                </div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=88;$i>80;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=85)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>

                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
                    @else
                    <div style="width: 40px;height: 40px;border: 1px solid transparent;"></div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=71;$i<79;$i++)
                <div style="flex-grow: 1;margin-left: 20px;">
                @if($i<=75){{ $i }}@else <span style="color: transparent;">00</span> @endif
                </div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=71;$i<79;$i++)
                <div style="flex-grow: 1;margin-left: 5px;">
                    @if($i<=75)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>
                    
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
                    @else
                    <div style="width: 40px;height: 40px;border: 1px solid transparent;"></div>
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- Fin Cuadrante Inferior dentadura niño -->

<!-- Cuadrante Inferior dentadura adulta -->
<div class="row">
    <div  class="col-lg-1 col-md-12 col-sm-12 col-xs-12"></div>
    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=48;$i>40;$i--)
                <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=48;$i>40;$i--)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>         
                    
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div  class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
        <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
            @for($i=31;$i<39;$i++)
                <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
            @endfor
        </div>
        <!-- dientes -->
        <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
            @for($i=31;$i<39;$i++)
                <div style="flex-grow: 1;margin-left: 5px;">

                 <!-- simbolos -->
                 <?php
                    $ruta = $odontograma->getRutaImagenSimbolo( $i, $odontograma->id);
                    $imagen = asset("assets/img/".$ruta);
                 ?>
                    
                    <div style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                        @include('components.diente')
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- Fin Cuadrante Inferior dentadura adulta -->

<!-- Diagnostico y Enfermedad Actual -->
<div class="row">
    <div class="col-md-6">
        <div class="form-floating mt-3">
            <input type="text" class="form-control" id="floatingDiagnostico" placeholder="Diagnóstico" value="{{ $odontograma->diagnostico }}">
            <label for="floatingDiagnostico">Diagnóstico</label>
          </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mt-3">
            <input type="text" class="form-control" value="{{ $odontograma->enfermedad_actual }}" id="floatingEnfermedadActual" placeholder="Enfermedad Actual">
            <label for="floatingEnfermedadActual">Enfermedad Actual</label>
          </div>
    </div>
</div>

<!-- Lista de Detalles -->
@include('odontogramas.index_detalle')
@include('odontogramas.detalle_odontograma', ['i' => $i])
@endsection