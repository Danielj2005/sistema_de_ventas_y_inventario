<header id="header" class="fixed top-0 right-0 left-0 z-50 flex items-center justify-between px-4 py-3 bg-[#fff] border-b border-gray-200 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:shadow-sm dark:shadow-slate-300/20">

  <div class="flex items-center justify-between gap-4">
    <a href="./" class="flex items-center gap-2 no-underline">
      <span class=" font-bold text-gray-800 dark:text-slate-400">VENTOI</span>
    </a>
    <?php if ($_SESSION['dataUsuario']["primer_inicio"] == '0') { ?>
      <i class="bi bi-list toggle-sidebar-btn cursor-pointer text-xl text-gray-700 dark:text-slate-400"></i>
    <?php } ?>

  </div>

  <?php
    $id_usuario = $_SESSION['id_usuario'];
    
    $precio_dolar_actual = modeloPrincipal::obtener_precio_dolar();

    $_SESSION['dolar'] = $precio_dolar_actual;

    $tiempo_config = modeloPrincipal::obtener_tiempo_inactividad();

    echo '<script type="text/javascript"> const tiempo_config = '.$tiempo_config.' * 60 * 1000</script>';
  ?>

  <nav class="flex items-center ms-auto">
    <ul class="flex items-center gap-4 m-0 p-0 list-none">

      <li class="relative">
          <a id="lightModeButton" class="w-full group shadow-md hover:shadow-amber-500 bg-gray-700/80 dark:bg-slate-500 transition px-3 py-2 rounded-lg mx-3 cursor-pointer flex items-center justify-center">
              <i class="bi bi-sun-fill navicon rounded-full text-amber-400"></i> 
          </a>
      </li>
      
      <!-- Dropdown Tasa -->
      <li class="relative group/dropdown">
        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600 transition" data-bs-toggle="dropdown">
          <i class="bi bi-currency-exchange"></i>
          <span class="hidden md:block"> Tasa:</span> 
          <span id="tasa_dolar"><?= modeloPrincipal::number_format_prices((float)$precio_dolar_actual) ?></span>Bs
        </button>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications absolute right-0 mt-2 w-64 bg-[#fff] rounded-xl shadow-lg border border-gray-100 dark:bg-slate-800 dark:border-slate-700 dark:shadow-xl dark:shadow-slate-400/80 p-2 z-50">
          <li class="flex flex-col gap-2">
            <h6 class="text-center font-semibold text-gray-700 dark:text-slate-200 mb-1">Opciones de Actualización</h6>
            <div class="w-full">
              <button id="btn_update_dolar_auto" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                <i class="bi bi-arrow-repeat"></i>
                <span class="p-1">Sincronizar Tasa (Automático)</span>
              </button>
            </div>
            <div class="w-full">
              <button class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-white bg-amber-500 rounded-lg hover:bg-amber-600 transition" data-bs-toggle="modal" data-bs-target="#dolarUpdate" id="btnUpdate">
                <i class="bi bi-pencil-square"></i>
                <span class="p-1">Establecer Tasa (Manual)</span>
              </button>
            </div>
          </li>
        </ul>
      </li>

      <!-- Dropdown Perfil -->
      <li class="relative group/profile me-4">
        <button class="dark:text-slate-400 flex items-center gap-2 cursor-pointer pe-0 focus:outline-none" data-bs-toggle="dropdown">
          <span class="hidden md:block font-medium text-gray-700 dark:text-slate-300 ps-2"><?= $_SESSION['dataUsuario']['nombre']." ".$_SESSION['dataUsuario']['apellido']; ?></span>
        </button>
        
        <ul class="absolute right-0 dropdown-menu dropdown-menu-end dropdown-menu-arrow profile mt-2 w-56 bg-[#fff] rounded-xl shadow-lg border border-gray-100 dark:bg-slate-800 dark:border-slate-700 dark:shadow-xl dark:shadow-slate-400/80 p-2 z-50">
          <span class="-translate-y-5 absolute h-6 right-5 rotate-45 bg-[#fff] border-t border-l border-gray-100 dark:border-slate-700 dark:bg-slate-800 translate-x-2 w-6 hidden md:block"></span>
          
          <li class="px-3 py-2">
            <h6 class="dark:text-slate-200 font-bold mb-1 text-sm text-gray-800"><?= $_SESSION['dataUsuario']['nombre']." ".$_SESSION['dataUsuario']['apellido']; ?></h6>
            <span class="inline-block dark:text-slate-200 bg-purple-900 text-white rounded-full px-2 py-0.5 text-xs font-semibold"><?= $_SESSION['dataUsuario']['nombreRolUsuario']; ?></span>
          </li>

          <li> <hr class="my-1 border-gray-200 dark:border-slate-700"> </li>

          <li>
            <a class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:text-slate-400 dark:hover:bg-slate-700 transition" href="./mi_perfil.php">
              <i class="bi bi-person text-base"></i>
              <span>Mi Perfil</span>
            </a>
          </li>

          <li> <hr class="my-1 border-gray-200 dark:border-slate-700"> </li>

          <?php 
            $permiso_ajustes = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['ajustes']);

            if ($permiso_ajustes) { ?>
            
              <li>
                <a class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:text-slate-400 dark:hover:bg-slate-700 transition" href="./configuracion.php">
                  <i class="bi bi-gear-fill text-base"></i>
                  <span class="dark:text-slate-400">Configuración</span>
                </a>
              </li>

          <?php }  ?>

          <li> <hr class="my-1 border-gray-200 dark:border-slate-700"> </li>

          <li>
            <a class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-slate-700 dark:text-red-400 transition btn-exit-system" href="#!">
              <i class="bi bi-box-arrow-right text-base"></i>
              <span>Cerrar Sesión</span>
            </a>
          </li>

        </ul>
      </li>
    </ul>
  </nav>
</header>
<div class="msjFormSend"></div>
