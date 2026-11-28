<?php 

$permiso_proveedor = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['proveedor']);
$permiso_productos = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['producto']['productos']);
$permiso_entrada_productos = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['producto']['entrada']);

$permiso_servicio = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['servicio']);

$permiso_modulo_venta = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['venta']);
$permiso_modulo_cliente = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['cliente']);
$permiso_modulo_usuario = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['usuario']);

$permiso_modulo_rol = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['rol']);
$permiso_ajustes = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['ajustes']);
$permiso_bitacora = modeloPrincipal::verificar_permisos_requeridos($_SESSION['permisosRequeridos']['bitacora']);



if ($_SESSION['dataUsuario']["primer_inicio"] == 0) {  ?>

  <aside id="sidebar" class="sidebar fixed top-0 z-40 h-screen pt-16 bg-[#fff] border-r border-gray-200 transition-transform dark:bg-slate-900 dark:border-slate-800 flex flex-col justify-between shadow-sm">
    
    <!-- Contenedor scrolleable del menú -->
    <div class="h-full px-3 py-4 overflow-y-auto custom-scrollbar">
      <ul class="space-y-1.5 font-medium" id="sidebar-nav">
        
        <!-- Panel de Control -->
        <li>
          <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all group" href="./"> 
            <i class="bi bi-speedometer2 text-lg text-gray-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400"></i> 
            <span class="text-sm">Panel de Control</span> 
          </a>
        </li>
      
        <?php if ($permiso_productos || $permiso_proveedor) {  ?>
          <!-- Inventario (Dropdown) -->
          <li>
            <details class="group/dropdown">
              <summary class="flex items-center justify-between px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                <div class="flex items-center gap-3">
                  <i class="bi bi-box-seam-fill text-lg text-gray-500 dark:text-slate-400 group-open/dropdown:text-blue-600 dark:group-open/dropdown:text-blue-400"></i>
                  <span class="text-sm">Inventario</span>
                </div>
                <i class="bi bi-chevron-down text-xs text-gray-400 transition-transform duration-200 group-open/dropdown:rotate-180"></i>
              </summary>

              <ul class="mt-1 space-y-1 pl-3 pr-2">
                <?php if ($permiso_productos) : ?>
                  <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./gestion_productos.php">
                      <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Gestión de Productos</span>
                    </a>
                  </li>
                <?php endif; if ($permiso_entrada_productos): ?>
                  <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./entrada_de_productos.php"> 
                      <i class="bi bi-circle-fill text-[6px]"></i> 
                      <span>Registro de Compras</span> 
                    </a>
                  </li>
                <?php endif; if ($permiso_proveedor) : ?>
                  <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./proveedor.php"> 
                      <i class="bi bi-circle-fill text-[6px]"></i> 
                      <span>Gestión de Proveedores</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </details>
          </li>

        <?php } if ($permiso_servicio) { ?> <!-- Gestión de Servicios --> <li> <a href="gestion_servicios.php" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all group"> <i class="bi bi-person-workspace text-lg text-gray-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400"></i> <span class="text-sm">Gestión de Servicios</span> </a> </li> 
      <?php } if ($permiso_modulo_venta) { ?>
          <!-- Ventas (Dropdown) -->
          <li>
            <details class="group/dropdown">
              <summary class="flex items-center justify-between px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                <div class="flex items-center gap-3">
                  <i class="bi bi-currency-dollar text-lg text-gray-500 dark:text-slate-400 group-open/dropdown:text-blue-600 dark:group-open/dropdown:text-blue-400"></i>
                  <span class="text-sm">Ventas</span>
                </div>
                <i class="bi bi-chevron-down text-xs text-gray-400 transition-transform duration-200 group-open/dropdown:rotate-180"></i>
              </summary>

              <ul class="mt-1 space-y-1 pl-3 pr-2">
                <?php if (array_key_exists( "g_venta", $_SESSION['permisosRol'] )) {  ?> 
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./generar_venta.php"> 
                      <i class="bi bi-circle-fill text-[6px]"></i> 
                      <span>Generar Venta</span> 
                    </a> 
                  </li> 

                <?php } if (array_key_exists( "l_venta", $_SESSION['permisosRol'] ) || array_key_exists( "d_venta", $_SESSION['permisosRol'] ) || array_key_exists( "f_venta", $_SESSION['permisosRol'] )) {  ?>
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./venta.php"> 
                      <i class="bi bi-circle-fill text-[6px]"></i> 
                      <span>Historial de Ventas</span> 
                    </a> 
                  </li>
                <?php } ?>
              </ul>
            </details>
          </li>
        <?php } if ($permiso_modulo_cliente || $permiso_modulo_usuario || $permiso_modulo_rol) { ?>
          <!-- Usuarios y Accesos (Dropdown) -->
          <li>
            <details class="group/dropdown">
              <summary class="flex items-center justify-between px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                <div class="flex items-center gap-3">
                  <i class="bi bi-people-fill text-lg text-gray-500 dark:text-slate-400 group-open/dropdown:text-blue-600 dark:group-open/dropdown:text-blue-400"></i>
                  <span class="text-sm">Usuarios</span>
                </div>
                <i class="bi bi-chevron-down text-xs text-gray-400 transition-transform duration-200 group-open/dropdown:rotate-180"></i>
              </summary>

              <ul class="mt-1 space-y-1 pl-3 pr-2">
                <?php if ($permiso_modulo_cliente): ?>
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./cliente.php">
                      <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Clientes</span>
                    </a>
                  </li>
                <?php endif; if ($permiso_modulo_usuario): ?>
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./empleados.php">
                      <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Empleados</span>
                    </a>
                  </li>
                <?php endif; if ($permiso_modulo_rol): ?>
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./roles.php">
                      <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Gestión de Roles</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </details>
          </li>
        <?php } ?>

        <!-- Separador visual -->
        <hr class="my-3 border-gray-500 dark:border-slate-500">

        <!-- Mi Perfil -->
        <li>
          <a class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all group" href="./mi_perfil.php"> 
            <i class="bi bi-person-fill text-lg text-gray-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400"></i> 
            <span class="text-sm">Mi Perfil</span> 
          </a>
        </li>

        <?php if ($permiso_ajustes || $permiso_bitacora) { ?>
        <!-- Configuración General (Dropdown) -->
        <li>
          <details class="group/dropdown">
            <summary class="flex items-center justify-between px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
              <div class="flex items-center gap-3"> 
                <i class="bi bi-gear-fill text-lg text-gray-500 dark:text-slate-400 group-open/dropdown:text-blue-600 dark:group-open/dropdown:text-blue-400"></i>
                <span class="text-sm">Configuración</span> 
                </div>
                <i class="bi bi-chevron-down text-xs text-gray-400 transition-transform duration-200 group-open/dropdown:rotate-180"></i>
                </summary>

                <ul class="mt-1 space-y-1 pl-3 pr-2">
        <?php if ($permiso_ajustes) { ?>
        <li> 
        <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./configuracion.php">
          <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Ajustes del Sistema</span>
                    </a>
                  </li>
                <?php } if ($permiso_bitacora) {  ?>
                  <li> 
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./bitacora.php">
                      <i class="bi bi-circle-fill text-[6px]"></i>
                      <span>Bitácora</span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </details>
          </li>
        <?php } ?>

        <!-- Soporte y Ayuda -->
        <li>
          <details class="group/dropdown">
            <summary class="flex items-center justify-between px-3 py-2.5 rounded-xl text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800/60 transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
              <div class="flex items-center gap-3">
                <i class="bi bi-question-circle text-lg text-gray-500 dark:text-slate-400 group-open/dropdown:text-blue-600 dark:group-open/dropdown:text-blue-400"></i>
                <span class="text-sm">Soporte y Ayuda</span>
              </div>
              <i class="bi bi-chevron-down text-xs text-gray-400 transition-transform duration-200 group-open/dropdown:rotate-180"></i>
            </summary>

            <ul class="mt-1 space-y-1 pl-3 pr-2">
              <li> 
                <a class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 transition-all" href="./manuales/MANUAL_DE_SISTEMA_CHINITA.pdf" target="_blank"> 
                  <i class="bi bi-circle-fill text-[6px]"></i> 
                  <span>Manual de Referencia</span> 
                </a> 
              </li>
            </ul>
          </details>
        </li>
      </ul>
    </div>

        <!-- Separador visual -->
        <hr class="my-3 border-gray-500 dark:border-slate-500">
    <!-- Botón de Cerrar Sesión en la parte inferior -->
    <div class="">
      <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-slate-800/60 transition-all font-medium btn-exit-system group"> 
        <i class="bi bi-box-arrow-right text-lg"></i> 
        <span class="text-sm">Cerrar Sesión</span> 
      </button>
    </div>
  </aside>
<?php } ?>