@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$odontograma->paciente" />

    <h3 class="text-center mt-4 mb-3 fw-bold">Odontograma de
        {{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos }}</h3>

    <h5 class="text-center mt-2 mb-4">Fecha de última actualización:
        {{ \Carbon\Carbon::parse($odontograma->updated_at)->format('d/m/Y') }}</h5>

    <!-- Botones -->
    <div class="d-flex justify-content-between mt-2 mb-2">
        <div class="mb-2">
            <a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#nuevo{{ $odontograma->id }}"> <i
                    class="fa-solid fa-plus"></i> Nuevo Odontograma </a>
        </div>

        <div class="mb-2">
            <a class="btn btn-secondary" href="{{ route('presupuestos.edit', $odontograma->id) }}"><i
                    class="fa-regular fa-file"></i> Ir al Presupuesto </a>
        </div>
    </div>

    <!-- Cuadrante Superior dentadura adulta -->
    <div class="row">
        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 18; $i > 10; $i--)
                    <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
                @endfor
            </div>

            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 18; $i > 10; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">

                        <!-- simbolos -->
                        <?php
                        $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                        $imagen = asset('assets/img/' . $ruta);
                        ?>

                        <div
                            style="width: 40px;height: auto;background: url('{{ $imagen }}');background-repeat: no-repeat;background-position: center center;background-size: cover;">
                            @include('components.diente')
                        </div>
                    </div>
                @endfor
            </div>

        </div>

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 21; $i <= 28; $i++)
                    <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 21; $i <= 28; $i++)
                    <div style="flex-grow: 1;margin-left: 5px;">

                        <!-- simbolos -->
                        <?php
                        $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                        $imagen = asset('assets/img/' . $ruta);
                        ?>

                        <div
                            style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
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
        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 58; $i > 50; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 55)
                            {{ $i }}
                        @else
                            <span style="color: transparent;">00</span>
                        @endif
                    </div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 58; $i > 50; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 55)
                            <div style="flex-grow: 1;margin-left: 5px;">

                                <!-- simbolos -->
                                <?php
                                $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                                $imagen = asset('assets/img/' . $ruta);
                                ?>

                                <!-- graficar el cuadrante III con los datos que hay en el -->
                                <div
                                    style="width: 40px;height: auto; background: url('{{ $imagen }}');background-repeat: no-repeat;background-position: center center;background-size: cover;">
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

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 61; $i < 69; $i++)
                    <div style="flex-grow: 1;margin-left: 20px;">
                        @if ($i <= 65)
                            {{ $i }}
                        @else
                            <span style="color: transparent;">00</span>
                        @endif
                    </div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 61; $i < 69; $i++)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 65)
                            <div style="flex-grow: 1;margin-left: 5px;">

                                <!-- simbolos -->
                                <?php
                                $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                                $imagen = asset('assets/img/' . $ruta);
                                ?>
                                <!-- graficar el cuadrante IV con los datos que hay en el -->

                                <div
                                    style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
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
        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 88; $i > 80; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 85)
                            {{ $i }}
                        @else
                            <span style="color: transparent;">00</span>
                        @endif
                    </div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 88; $i > 80; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 85)
                            <div style="flex-grow: 1;margin-left: 5px;">

                                <!-- simbolos -->
                                <?php
                                $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                                $imagen = asset('assets/img/' . $ruta);
                                ?>

                                <div
                                    style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
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

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 71; $i < 79; $i++)
                    <div style="flex-grow: 1;margin-left: 20px;">
                        @if ($i <= 75)
                            {{ $i }}
                        @else
                            <span style="color: transparent;">00</span>
                        @endif
                    </div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 71; $i < 79; $i++)
                    <div style="flex-grow: 1;margin-left: 5px;">
                        @if ($i <= 75)
                            <div style="flex-grow: 1;margin-left: 5px;">

                                <!-- simbolos -->
                                <?php
                                $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                                $imagen = asset('assets/img/' . $ruta);
                                ?>

                                <div
                                    style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
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
        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 48; $i > 40; $i--)
                    <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 48; $i > 40; $i--)
                    <div style="flex-grow: 1;margin-left: 5px;">

                        <!-- simbolos -->
                        <?php
                        $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                        $imagen = asset('assets/img/' . $ruta);
                        ?>

                        <div
                            style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                            @include('components.diente')
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff;">
            <div style="display: flex;background-color: #fff;padding: 10px;justify-content: center;">
                @for ($i = 31; $i < 39; $i++)
                    <div style="flex-grow: 1;margin-left: 20px;">{{ $i }}</div>
                @endfor
            </div>
            <!-- dientes -->
            <div style="display: flex;padding: 10px;justify-content: center;border-top: 1px solid #BAB9B9;">
                @for ($i = 31; $i < 39; $i++)
                    <div style="flex-grow: 1;margin-left: 5px;">

                        <!-- simbolos -->
                        <?php
                        $ruta = $odontograma->getRutaImagenSimbolo($i, $odontograma->id);
                        $imagen = asset('assets/img/' . $ruta);
                        ?>

                        <div
                            style="width: 40px;height: auto; background: url('{{ $imagen }}'); background-repeat: no-repeat;background-position: center center;background-size: cover;">
                            @include('components.diente')
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <!-- Fin Cuadrante Inferior dentadura adulta -->

    <!-- Lista de Detalles -->
    @include('presupuestos.components.add-detalle', ['presupuesto' => $odontograma])
    @include('odontogramas.index_detalle')
    @include('odontogramas.detalle_odontograma')
    @include('odontogramas.nuevo')
@endsection
