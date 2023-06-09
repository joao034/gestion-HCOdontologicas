@extends('layouts.app')
@section('content')

    <form action="{{ route('hclinicas.store') }}" method="POST">
    @csrf  
    <div class="card border-primary">
        <div class="card-body">

          <div class="container">
              <!--Titulo-->
              <div class="row justify-content-center align-items-center g-2">
                  <div class="col-12">
                      <h2>Historia Clínica Odontológica</h2>
                  </div>  
              </div>
              
              <!--Datos Generales-->
              <div class="row">
                  <div class="col-md-6">
                      <div class="card text-start">
                        <div class="card-body">
                          <h5 class="card-title">Datos Personales</h5>
                          
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label for="" class="form-label">Nombres</label>
                                      <input type="text"
                                        class="form-control" name="nombres" id="" aria-describedby="helpId" placeholder="" required>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label for="" class="form-label">Apellidos</label>
                                      <input type="text"
                                        class="form-control" name="apellidos" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                              </div>
                          </div>
                          
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="mb-3">
                                      <label for="" class="form-label">Cédula</label>
                                      <input type="text"
                                        class="form-control" name="cedula" minlength="10" id="" aria-describedby="helpId" placeholder="" required>
                                    </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="mb-3">
                                      <label for="" class="form-label">Fecha de Nacimiento</label>
                                      <input type="date"
                                        class="form-control" name="fecha_nacimiento"  max="<?php echo date('Y-m-d')?>" id="fechaNacimiento" placeholder="dd/mm/aaaa" 
                                            pattern="\d{2}/\d{2}/\d{4}" onchange="calcularEdad()" required>
                                    </div>
                              </div>
                              <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">Edad</label>
                                    <input type="text"
                                      class="form-control" name="edad" id="edad" aria-describedby="helpId" placeholder="" readonly>
                                  </div>
                            </div>
                          </div>
  

                    <div class="row">
                        <div class="col-md-8">
                          <h6 class="card-title">Estado Civil</h6>
                          <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="checkSoltero" name="estado_civil" value="soltero" required>
                                                <label class="form-check-label" for="checkSoltero">Soltero/a </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="checkCasado"  name="estado_civil" value="casado">
                                                <label class="form-check-label" for="checkCasado">Casado/a</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id="checkDivorciado" name="estado_civil" value="divorciado">
                                            <label class="form-check-label" for="checkDivorciado">
                                                Divorciado/a
                                            </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id="checkViudo" name="estado_civil" value="viudo">
                                            <label class="form-check-label" for="checkViudo" >
                                                Viudo/a
                                            </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id="checkUnionLibre" name="estado_civil" value="unionlibre">
                                            <label class="form-check-label" for="checkUnionLibre">
                                            Unión Libre
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4">
                            <h6 class="card-title">Sexo</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id="checkMasculino" name="sexo" value="masculino" required>
                                            <label class="form-check-label" for="checkMasculino">
                                                Masculino
                                            </label>
                                            </div>
                                        </div>
    
                                        <div class="col-sm">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id="checkFemenino"  name="sexo" value="femenino">
                                            <label class="form-check-label" for="checkFemenino">
                                                Femenino
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>
                    </div>
                          <br>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Celular</label>
                                    <input type="text"
                                      class="form-control" name="celular" minlength="10" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Teléfono Convencional</label>
                                    <input type="text"
                                      class="form-control" name="telef_convencional" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                          </div>
                          
  
                          <div class="mb-3">
                            <label for="" class="form-label">Direción (Ciudad / Barrio)</label>
                            <input type="text"
                              class="form-control" name="direccion" id="" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Prefesión u Oficio</label>
                            <input type="text"
                              class="form-control" name="ocupacion" id="" aria-describedby="helpId" placeholder="">
                        </div>
  
  
                        </div>
                      </div>
                  </div>
      
                  <!--Antecedentes Infecciosos-->
                  <div class="col-md-6 mt-4">
                      <div class="card text-start">
                          <div class="card-body">
                            <h5 class="card-title">Antecedentes Infecciosos</h5>
                            
                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha presentado alguna enfermedad respiratoria en los últimos 4 meses?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="enfermedad_respiratoria" value="0">
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="enfermedad_respiratoria" value="1">
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha presentado fiebre los últimos 4 meses?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="fiebre" value="0">
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="fiebre" value="1">
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha sido hospitalizado por alguna razón los últimos 4 meses?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="hospitalizado" value="0">
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="hospitalizado" value="1">
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Razón de la hospitalización</label>
                                <input type="text"
                                  class="form-control" name="razon_hospitalizacion" id="" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha sido detectado usted o algún miembro de su familia con COVID-19?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="detectado_covid" value="0">
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="detectado_covid" value="1">
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Parentesco</label>
                                    <input type="text"
                                      class="form-control" name="parentesco_covid" id="" aria-describedby="helpId" placeholder="">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p>¿En su lugar de trabajo que grado de riesgo tiene de contraer COVID-19?</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="alto">
                                        <label class="form-check-label" for="">
                                            Alto
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="medio">
                                        <label class="form-check-label" for="">
                                            Medio
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="bajo">
                                        <label class="form-check-label" for="">
                                            Bajo
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          </div>
                      </div>

                  </div>
              </div>
      
              <!--Antecedentes Personales y Familiares-->
              <div class="row mt-4">
                  <div class="col-12">
                      <div class="card text-start">
                          <div class="card-body">
                            <h5 class="card-title">Antecedentes Personales y Familiares</h5>
                            <p>¿USTED, SUS PADRES O ABUELOS PADECE O HA PADECIDO ALGUNA DE LAS SIGUIENTES ENFERMEDADES?</p>
                            
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="hipertension">
                                    <label class="form-check-label" for="">
                                      Hipertensión
                                    </label>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="enfermedades cardiacas">
                                <label class="form-check-label" for="">
                                  Enfermedades Cardiacas
                                </label>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="diabetes mellitus">
                                <label class="form-check-label" for="">
                                  Diabetes Mellitus
                                </label>
                              </div>

                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="hepatitis">
                                <label class="form-check-label" for="">
                                  Hepatitis
                                </label>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="fiebre reumatica">
                                      <label class="form-check-label" for="">
                                        Fiebre Reumática
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                  <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="tuberculosis">
                                  <label class="form-check-label" for="">
                                    Tuberculosis
                                  </label>
                                </div>
                                <div class="col-md-3">
                                  <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="asma">
                                  <label class="form-check-label" for="">
                                    Asma
                                  </label>
                                </div>
  
                                <div class="col-md-3">
                                  <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="hemorragias">
                                  <label class="form-check-label" for="">
                                    Hemorragias
                                  </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="epilepsias">
                                      <label class="form-check-label" for="">
                                        Epilepsias
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                  <input class="form-check-input" type="checkbox" id="" name="enfermedades[]" value="alergias">
                                  <label class="form-check-label" for="">
                                    Alergias
                                  </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <input type="text"
                                          class="form-control" name="otra_enfermedad" id="" aria-describedby="helpId" placeholder="Otra Enfermedad">
                                      </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <input type="text"
                                          class="form-control" name="parentesco" id="" aria-describedby="helpId" placeholder="Parentesco">
                                      </div>
                                </div>
  
                            </div>
  
                            <div class="row">

                                    <div class="col-md-3">
                                        <p>¿Está Ud embarazada?</p>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="col-sm">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id=""  name="embarazada" value="0">
                                            <label class="form-check-label" for="">
                                                Sí
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="col-sm">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" id=""  name="embarazada" value="1">
                                            <label class="form-check-label" for="">
                                                No
                                            </label>
                                            </div>
                                        </div>
                                    </div>
       
                                    <div class="col-md-3">
                                            <div class="mb-3">
                                                <input type="number"
                                                    class="form-control" name="semanas_embarazo" id="" aria-describedby="helpId" placeholder="Semanas de Embarazo">
                                    </div>
                            </div>
                        

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">¿Toma algún medicamento?</label>
                                        <input type="text"
                                            class="form-control" name="medicamento" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">¿Algún otro antecedente?</label>
                                        <input type="text"
                                            class="form-control" name="otro_antecedente" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                            </div>


                            <p>HÁBITOS</p>
                            
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="tabaquismo">
                                    <label class="form-check-label" for="">
                                      Tabaquismo
                                    </label>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="alcohol">
                                <label class="form-check-label" for="">
                                  Alcohol
                                </label>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="duglucion atipica">
                                <label class="form-check-label" for="">
                                  Duglución atípica
                                </label>
                              </div>

                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="respiracion bucal">
                                <label class="form-check-label" for="">
                                  Respiración bucal
                                </label>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="bruxismo">
                                      <label class="form-check-label" for="">
                                        Bruxismo
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                  <input class="form-check-input" type="checkbox" id="" name="habitos[]" value="succion digital">
                                  <label class="form-check-label" for="">
                                    Succión Digital
                                  </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <input type="text"
                                            class="form-control" name="otro_habito" id="" aria-describedby="helpId" placeholder="Otro">
                                    </div>
                                </div>
                            </div>

                                
                      </div>
                  </div>
              </div>
                  
              <button type="submit" class="btn btn-primary mt-3">Guardar Historia Clínica</button>
                  
          </div>
          
        </div>
      </div>
    
    
    </form>

    <script>
        function calcularEdad() {
            var fechaNacimiento = document.getElementById('fechaNacimiento').value;
            var fechaActual = new Date();
            var edad = fechaActual.getFullYear() - new Date(fechaNacimiento).getFullYear();
            document.getElementById('edad').value = edad;
        }
    </script>

@endsection
