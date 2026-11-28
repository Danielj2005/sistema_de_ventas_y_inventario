<?php 
session_start();

require_once "../../../modelo/modeloPrincipal.php";
require_once "../../../modelo/alert_model.php";
require_once "../../../modelo/productos_model.php";

?>
											<form method="post" id="modalSendForm" action="../controlador/servicio_controlador.php" class="SendFormAjax" autocomplete="off" data-type-form="save">
												
												<input type="hidden" name="dolar" id="precioDolar" value="<?= $precio_dolar_actual; ?>">
												<input type="hidden" name="modulo" value="Guardar">
	
												<div class="col-12 mb-1">
													<div class="row mt-2">
														<div class="col-md-6">
															<label class="form-label dark:text-slate-500 ">Nombre del Servicio <span style="color:#f00;">*</span> </label>
															<div class="col-md-4 input-group">
																<input type="text" class="form-control" placeholder="ingresa el nombre del servicio" name="nombre_platillo" id="nombre_platillo" required>
															</div>
														</div>
																
														<div class="col-md-6">
															<label class="form-label dark:text-slate-500 ">Descripción <span style="color:#f00;">*</span> </label>
															<input type="text" class="form-control" placeholder="ingresa la descripción" id="descripcion" name="descripcion" required>
														</div>
													</div>
												</div>
												
												<div class="col-12 mb-3 row mt-3">
													<h5 class=" dark:text-slate-500 ">Productos del Servicio</h5>
													<div class="col-12 col-md-9">
														<select name="producto" id="producto" class="form-select select">
															<option selected>seleccione una opción</option>
															<?php producto_model::options("1"); ?>
														</select>
													</div>
													<div class="col-12 col-md-3">
														<button type="button" name="btn_producto" class="btn_add btn btn-success">
															<i class="bi bi-plus-circle me-2"></i> 
															<span>Añadir producto</span>
														</button>
													</div>
												</div>
	
												<div class="col-12 mb-3">
													<div class="table-responsive">
														<table class=" bg-[#fff] table table-hover table-sm">
															<thead>
																<tr>
																	<th class="col text-start" scope="col">Producto</th>
																	<th class="col text-center" scope="col">Cantidad a Agregar al Servicio</th>
																	<th class="col text-center" scope="col">Quitar</th>
																</tr>
															</thead>
															<tbody id="lista_producto"> </tbody>
														</table>
													</div>
												</div>
	
												<div class="col-12 mb-1 mt-1"> 
													<h5 class=" dark:text-slate-500 fw-bold mb-3">
														<i class="bi bi-currency-dollar"></i> 
														Definición del Precio de Venta
													</h5>
	
													<div class="row g-3">
														<div class="col-12 col-sm-6 text-start">
															<label class="form-label dark:text-slate-500">
																Precio de Venta (USD) 
																<span class="text-danger">*</span>
															</label>

															<input 
																type="text" 
																class="form-control text-end" 
																id="precio_dolar_servicio" 
																name="precio_dolar" 
																placeholder="0.00" 
																step="0.01" 
																min="0.01" 
																required
															>
														</div>
														<div class="col-12 col-sm-6 text-start">
															<label for="precio_bolivar_servcio" class="form-label dark:text-slate-500">
																Costo Estimado (VES)
															</label>
															<input 
																type="text" 
																class="form-control text-end bg-light fw-bold" 
																readonly 
																id="precio_bolivar_servcio" 
																name="precio_bolivar" 
																placeholder="0.00"
																value=""
																title="Este campo se calcula automáticamente en base a la tasa de cambio."
															>
														</div>
													</div>
												</div>

												<div class="col-12 mb-3 mt-3">
													<p class=" dark:text-slate-500 small fs-5">
														<span class="text-danger">*</span> Indica que el campo es obligatorio.
													</p>
												</div>
											</form>