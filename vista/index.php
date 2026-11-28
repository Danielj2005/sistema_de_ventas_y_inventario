<?php 
session_start();

// importacion de la conexion a la base de datos y al modelo principal
include_once "../include/modelos_include.php"; // se incluyen los modelos necesarios para la vista

$id_usuario = $_SESSION['id_usuario']; // se obtiene el id del usuario

// validación para verificar que el usuario inicio sesion de manera correcta
model_user::verificar_intento_de_acceso_al_sistema();

include_once "../include/verificacion_primer_inicio_usuario.php"; // se incluyen los modelos necesarios para la vista

?>

<!DOCTYPE html>
<html lang="en" class="dark">

  <head>
    <!-- titulo -->
    <title>Panel de Control</title>
    <!-- metadatos -->  
    <?php include_once "../include/meta_include.php";
      // estilos y librerias css
      include_once "../include/css_include.php";
    ?>
  </head>
  
  <body class="dark:bg-gray-900 bg-gray-400/20 ">
    <?php   
      include_once "../include/header.php"; 
      include_once "../include/sliderbar.php";

      $total_ventas_del_dia = venta_model::totales_ventas_del_dia();

      $total_hoy_dolar = $total_ventas_del_dia['dolares'];
      $total_hoy_bs = $total_ventas_del_dia['bs'];
    ?>
    <main id="main" class="p-4 sm:p-6 lg:p-8 mt-16 transition-all duration-300">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Panel de Control </h1>
        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Resumen de la actividad y ventas del día.</p>
      </div> 

      <section class="space-y-6">

        <!-- Tarjetas de Totales del Día -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <!-- Total USD -->
          <div class="bg-[#fff] dark:bg-slate-800 rounded-2xl shadow-xl shadow-black/5 border border-gray-100 dark:border-slate-700/60 p-6 transition-all hover:shadow-2xl">
            <div class="flex items-center justify-between mb-4">
              <span class=" font-medium text-gray-500 dark:text-slate-400">Total Ventas en Dólares</span>
              <div class="p-2.5 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl">
                <i class="bi bi-currency-dollar text-xl"></i>
              </div>
            </div>
            <div class="flex items-baseline gap-2">
              <input type="text" class="w-full bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2 md font-bold text-gray-800 dark:text-white focus:outline-none cursor-default" disabled id="TotalUSD" readOnly value="<?= ($total_hoy_dolar == "") ? 0 : modeloPrincipal::number_format_prices($total_hoy_dolar) ?>">
              <span class="text-md font-semibold text-gray-400 dark:text-slate-500">$</span>
            </div>
          </div>

          <!-- Total Bs -->
          <div class="bg-[#fff] dark:bg-slate-800 rounded-2xl shadow-xl shadow-black/5 border border-gray-100 dark:border-slate-700/60 p-6 transition-all hover:shadow-2xl">
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm font-medium text-gray-500 dark:text-slate-400">Total Ventas en Bolívares</span>
              <div class="p-2.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-xl">
                <i class="bi bi-cash-stack text-xl"></i>
              </div>
            </div>

            <div class="flex items-baseline gap-2">
              <input type="text" class="w-full bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2 font-bold text-gray-800 dark:text-white focus:outline-none cursor-default" disabled id="TotalBS" readOnly value="<?= ($total_hoy_bs == "") ? '0' : modeloPrincipal::number_format_prices($total_hoy_bs) ?>">
              <span class="text-lg font-semibold text-gray-400 dark:text-slate-500">Bs.</span>
            </div>
          </div>

        </div>

        <!-- Sección de Ventas Recientes -->
        <div class="bg-[#fff] dark:bg-slate-800 rounded-2xl shadow-xl shadow-black/5 border border-gray-100 dark:border-slate-700/60 overflow-hidden">

          <div class="p-6 mb-4 border-b border-gray-100 dark:border-slate-700/60 flex items-center justify-between">
            <h5 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
              <i class="bi bi-receipt text-blue-600 dark:text-blue-400"></i>
              Ventas Recientes
            </h5> 
          </div>

          <div class="px-3 overflow-x-auto">
            <table class="w-full text-left dark:text-slate-300 border-collapse" id="example">
              <thead>
                <tr class="bg-gray-50 dark:bg-slate-900/50 text-gray-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider border-b border-gray-100 dark:border-slate-700/60">
                  <th class="py-4 px-6 text-center w-[5%]">N.°</th>
                  <th class="py-4 px-6 text-center">N.° de Ticket</th>
                  <th class="py-4 px-6 text-center">Cliente</th>
                  <th class="py-4 px-6 text-center w-[15%]">Total</th>
                  <th class="py-4 px-6 text-center">Fecha y Hora</th>
                  <th class="py-4 px-6 text-center ">Detalles</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 dark:divide-slate-700/40 text-sm text-gray-700 dark:text-slate-300">
                <?php venta_model::lista_ventas_diarias(); ?>
              </tbody>
            </table>
          </div>

    </div>

    </section>
    </main>
    
    <?php   
      include_once "./modal/plantillaModalCustom.php";

      include_once "../include/footer.php";
      include_once "../include/scripts_include.php";
      
      model_user::validar_sesion_activa($id_usuario);
      
      config_model::verificar_actualizacion_configuracion(); 
    ?>
  </body>
</html>
