<?php
require_once "../../../modelo/modeloPrincipal.php"; 
require_once "../../../modelo/venta_model.php"; 

$id_venta = modeloPrincipal::decryptionId($_POST['id']);
$id = modeloPrincipal::limpiar_cadena($id_venta);


$datos_venta = modeloPrincipal::consultar("SELECT C.cedula, C.nombre, C.telefono,
    U.cedula AS empleado_cedula, U.nombre AS empleado_nombre, 
    U.apellido AS empleado_apellido, U.correo, U.telefono AS empleado_telefono, 
    V.fecha_venta, V.sub_total_dolares, V.sub_total_bs,
    V.monto_total_dolares, V.monto_total_bolivares,
    V.id_venta
    FROM venta AS V 
    INNER JOIN cliente AS C ON C.id_cliente = V.id_cliente 
    INNER JOIN usuario AS U ON U.id_usuario = V.id_usuario 
    WHERE V.id_venta = $id");


$datos_venta = mysqli_fetch_array($datos_venta);


$detalles_venta_productos = modeloPrincipal::consultar("SELECT
	P.nombre_producto AS producto,
    PS.cantidad AS presentacion, R.nombre AS representacion,
    M.nombre AS marca, 
    DV.cantidad,
    round((SELECT MAX(dolar) AS dolar FROM dolar) * P.precio_venta, 2) AS precio
    FROM detalles_venta AS DV
    INNER JOIN producto AS P ON P.id_producto = DV.id_producto
    INNER JOIN presentacion AS PS ON P.id_presentacion = PS.id 
    INNER JOIN representacion AS R ON R.id = PS.id_representacion
    INNER JOIN marca AS M ON M.id = P.id_marca
    WHERE DV.id_venta = $id");



$detalles_venta = modeloPrincipal::consultar("SELECT M.nombre_platillo, DV.cantidad_servicio,
	round((SELECT MAX(dolar) AS dolar FROM dolar) * M.precio_dolar, 2) * DV.cantidad_servicio AS precio
    FROM detalles_venta AS DV
    INNER JOIN menu AS M ON M.id_menu = DV.id_servicio
    INNER JOIN detalles_menu AS DM ON DM.id_menu = M.id_menu
    WHERE DV.id_venta = $id");



$cantidades = mysqli_fetch_array( modeloPrincipal::consultar("SELECT cantidad_servicio, cantidad 
    FROM detalles_venta WHERE id_venta = $id"));


$cant_productos = empty($cantidades['cantidad']) ? 0 : $cantidades['cantidad'];
$cant_servicios = empty($cantidades['cantidad_servicio']) ? 0 : $cantidades['cantidad_servicio'];

?>

<div class="d-flex justify-content-between small">
    <span class="fw-bold dark:text-slate-300">CLIENTE</span>
    <span class=" dark:text-slate-300">TOTAL ART.: <?= $cant_productos + $cant_servicios ?></span>
</div>
<ul class="list-unstyled small m-0">
    <li><span class="fw-bold dark:text-slate-300">RIF/C.I.:</span> 

        <span class=" dark:text-slate-500">  <?= $datos_venta['cedula']; ?>
        </span></li>
    <li><span class="fw-bold dark:text-slate-300">Razón Social:</span> 
        
        <span class=" dark:text-slate-500">  <?= $datos_venta['nombre']; ?>
        </span></li>
</ul>   

<div class="d-flex justify-content-between small mt-2">
    <span class="fw-bold dark:text-slate-300">EMPLEADO</span>
    <span class=" dark:text-slate-300">Nº FACTURA: 
        <span class=" dark:text-slate-500">  <?= venta_model::generar_numero($datos_venta['id_venta']); ?>
            
        </span>
    </span> 
</div>
<ul class="list-unstyled small m-0">
    <li>
        <span class="fw-bold dark:text-slate-300">Vendedor:</span> 
        <span class=" dark:text-slate-500">  <?= $datos_venta['empleado_nombre'].' '.$datos_venta['empleado_apellido']; ?> 
        </span>
    </li>
    <li>
        <span class="fw-bold dark:text-slate-300">Fecha/Hora:</span> 
       
        <span class=" dark:text-slate-500"> 
         <?= date ("d-m-Y g:i:a", strtotime($datos_venta['fecha_venta'])); ?>
        </span>
    </li>
</ul>

<hr class="dotted-separator">

<div class="d-flex small fw-bold">
    <span class=" dark:text-slate-300" style="width: 50%;">DESCRIPCIÓN</span>
    <span class="text-center dark:text-slate-300" style="width: 20%;">CANT</span>
    <span class="text-end dark:text-slate-300" style="width: 30%;">PRECIO (Bs)</span>
</div>

<?php while($row = mysqli_fetch_array($detalles_venta_productos)){ ?>
    <div class="d-flex justify-content-between small">
        <span class=" dark:text-slate-500" style="width: 50%;"><?= $row['producto'].' '.$row['marca'].' '.$row['presentacion'].' '.$row['representacion'] ?></span>
        <span class="text-center dark:text-slate-500" style="width: 20%;"><?= $row['cantidad']; ?></span>
        <span class="text-end dark:text-slate-500" style="width: 30%;"><?= modeloPrincipal::number_format_prices($row['precio']); ?></span>
    </div>
<?php } ?>

<?php while($row = mysqli_fetch_array($detalles_venta)){ ?>
    <div class="d-flex justify-content-between small">
        <span class=" dark:text-slate-500" style="width: 50%;"><?= $row['nombre_platillo']?></span>
        <span class="text-center dark:text-slate-500" style="width: 20%;"><?= $row['cantidad_servicio']; ?></span>
        <span class="text-end dark:text-slate-500" style="width: 30%;"><?= modeloPrincipal::number_format_prices($row['precio']); ?></span>
    </div>
<?php } ?>

<hr class="dotted-separator">

<div class="d-flex justify-content-between fs-5 fw-bold">
    <span class=" dark:text-slate-300">TOTAL A PAGAR</span>
    <span class=" dark:text-slate-300">Bs <?= modeloPrincipal::number_format_prices($datos_venta['monto_total_bolivares']); ?></span>
</div>

<hr class="dotted-separator">