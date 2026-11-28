<?php

require_once("../../../modelo/modeloPrincipal.php"); 
require_once("../../../modelo/proveedor_model.php"); 

$id_proveedor = modeloPrincipal::decryptionId($_POST["id"]);
$id_proveedor = modeloPrincipal::limpiar_cadena($id_proveedor);

if (!isset($_POST['id'])) {
    alert_model::alerta_simple("¡Ocurrio un error!","No se está recibiendo correctamente el identificador del proveedor","error");
    exit();
}

$datos_proveedor = mysqli_fetch_assoc(proveedor_model::consultar_proveedor_por_id("cedula_rif, nombre, correo, direccion, telefono",$id_proveedor));

?>
<div class="col-12 col-md-6 mb-3">
    <div class="flex flex-col">
        <label class="control-label dark:text-slate-300">Cédula / RIF</label>
        <span class="text-sm text-gray-500" ><?= $datos_proveedor['cedula_rif']; ?></span>
    </div>
</div>
<div class="col-12 col-md-6 mb-3">
    <div class="flex flex-col">
        <label class="control-label dark:text-slate-300">Nombre</label>
        <span class="text-sm text-gray-500" ><?= $datos_proveedor['nombre']; ?></span>
    </div>
</div>

<div class="col-12 col-md-6 mb-3">
    <div class="flex flex-col">
        <label class="control-label dark:text-slate-300">Correo</label>
        <span class="text-sm text-gray-500" ><?= $datos_proveedor['correo']; ?></span>
    </div>
</div>

<div class="col-12 col-md-6 mb-3">
    <div class="flex flex-col">
        <label class="control-label dark:text-slate-300">Teléfono</label>
        <span class="text-sm text-gray-500" ><?= $datos_proveedor['telefono']; ?></span>
    </div>
</div>

<div class="col-12 mb-3">
    <div class="flex flex-col">
        <label class="control-label dark:text-slate-300">Dirección</label>
        <span class="text-sm text-gray-500" ><?= $datos_proveedor['direccion']; ?></span>
    </div>
</div>

