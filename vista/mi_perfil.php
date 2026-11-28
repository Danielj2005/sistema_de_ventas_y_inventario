<?php 
session_start();
include_once "../include/modelos_include.php";

$id_usuario = $_SESSION['id_usuario']; // se obtiene el id del usuario
// validación para verificar que el usuario inicio sesion de manera correcta
model_user::verificar_intento_de_acceso_al_sistema();

$VISTA_PRIMER_INICIO = $_SESSION['primer_inicio'] == '0' ? '' : 'toggle-sidebar';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- titulo -->
    <title>Mi Perfil</title>
    <!-- metadatos -->  
    <?php 
      include_once "../include/meta_include.php";
      // ======= estilos y librerias css ======= 
      include_once "../include/css_include.php"; 
    ?>    
  </head>
  <body class="dark:bg-gray-900 bg-gray-400/20 pt-4 <?= $VISTA_PRIMER_INICIO; ?>">

    <?php
      include_once "../include/header.php"; 
      include_once "../include/sliderbar.php";
    ?>
    
    <main id="main" class="main">
      <div class="pagetitle">
        <h1 class="display-4 fw-bold text-start mb-3 dark:text-slate-300"> <i class="bi bi-person-circle me-3 text-blue-600 dark:text-slate-300"></i> Mi Perfil de Usuario 
        </h1>
      </div>

      <section class="section dashboard">
        
            <div class="bg-[#fff] dark:bg-slate-800 rounded-2xl shadow-xl shadow-black/5 border border-gray-100 dark:border-slate-700/60 p-3 transition-all hover:shadow-2xl ">
                  <div class="card-body pb-3">
                    <div class="mi_informacion_container w-full my-3">

                      <fieldset class="row gap- mb-3">
                          <legend class="col-12 mb-3 text-lg dark:text-slate-300">
                            <i class="bi bi-person"></i> &nbsp;Información personal
                          </legend>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="flex flex-col">
                                <label class="control-label dark:text-slate-300">Cédula</label>
                                <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']['dni']; ?></span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="flex flex-col">
                              <label class="control-label dark:text-slate-300">Nombres</label>
                              <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']['nombre'] ?></span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="flex flex-col">
                              <label class="control-label dark:text-slate-300">Apellidos</label>
                              <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']['apellido']; ?></span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="flex flex-col">
                              <label class="control-label dark:text-slate-300">Correo</label>
                              <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']['correo'] ?></span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                              <div class="flex flex-col">
                                <label class="control-label dark:text-slate-300">Teléfono</label>
                                <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']['telefono'] ?></span>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                              <div class="flex flex-col">
                                  <label class="control-label dark:text-slate-300">Dirección</label>

                                  <span class="text-sm text-gray-500" ><?= $_SESSION['dataUsuario']["direccion"]  ?></span>
                              </div>
                          </div>
                          
                          <div class="col-12 mb-3 text-center d-flex justify-content-end">
                              <button type="button" modal='modificarInfoPersonalUsuario' class="btn_modal btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">
                                <i class='bi bi-person-circle'></i> Actualizar Información
                              </button>
                          </div>
                      </fieldset>

                      
                      <fieldset class="row mb-4 justify-content-center align-items-center">
                        <div class="col-12 col-md-6 mb-3 justify-content-center row">
                          <legend class=" dark:text-slate-300 text-lg">
                            <i class="bi bi-person-circle"></i> &nbsp; Datos de la Cuenta
                          </legend>
                          <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label class="control-label dark:text-slate-300">Nombre de Usuario</label>
                                <span class="text-sm text-gray-500" ><?= modeloPrincipal::ocultar_info($_SESSION['dataUsuario']['correo']); ?></span>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                              <div class="form-group">
                                  <label class="control-label dark:text-slate-300">Tipo de Usuario</label>
                                  <span class="text-sm text-gray-500" ><?= $_SESSION['nombreRolUsuario'] ?></span>
                              </div>
                          </div>
                          <div class="col-12  mb-2 text-center d-flex justify-content-center">
                              <button type="submit" modal='passwordUser' class="btn_modal btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modal">
                                <i class='bi bi-key'></i>
                                Actualizar Contraseña
                              </button>
                          </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3 justify-content-center align-items-center">
                            <h5 class="mb-3 dark:text-slate-300 text-lg">
                              <i class="bi bi-shield-fill"></i> &nbsp; 
                              Actualizar Preguntas de Seguridad
                            </h5>
                              
                            <div class="col-12 mb-2 text-center">
                                <button modal="preguntasSeguridad" class="btn_modal btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">
                                  <i class="bi bi-shield"></i> Actualizar Preguntas y Respuestas
                                </button>
                            </div>
                        </div>
                      </fieldset>

                    </div>
                  </div>
                </div>
          </div>
      </section>
    </main>

    <?php 
      include_once "./modal/plantillaModalCustom.php"; 
      
      include_once "../include/footer.php";

      include_once "../include/scripts_include.php";
    
      // if($_SESSION['dataUsuario']['primer_inicio'] == '1'){
      //   echo "<script type='text/javascript'>
      //           setTimeout(() => {
      //             Swal.fire({
      //                 title: '¡Atención!',
      //                 text: 'Es su primer inicio de sesión, por favor cambie su contraseña y sus preguntas de seguridad.',
      //                 icon: 'warning',
      //                 confirmButtonColor: '#10478e',
      //                 confirmButtonText: 'Aceptar'
      //             });
      //           }, 300);
      //       </script>";
      // }
      
      model_user::validar_sesion_activa($id_usuario);

      config_model::verificar_actualizacion_configuracion(1); 

    ?>
  </body>
</html>