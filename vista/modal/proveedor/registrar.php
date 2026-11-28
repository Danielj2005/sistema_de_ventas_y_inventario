<form id="modalSendForm" action="../controlador/proveedor_controller.php" method="post" class="SendFormAjax row" autocomplete="off" data-type-form="save">
    <input type="hidden" name="modulo" value="Guardar">
                          <div class="col-12 mb-2">
                            <label class="form-label  dark:text-slate-300">Cédula / RIF 
                                <span style="color:#f00;">*</span>
                            </label>
                              <div class="col-md-4 input-group">
                                  <select class="input-group-text" id="nacionalidad" name="nacionalidad" required>
                                      <option value="V-">V</option>
                                      <option value="E-">E</option>
                                      <option value="G-">G</option>
                                      <option value="J-">J</option>
                                      <option value="P-">P</option>
                                      <option value="R-">RIF</option>
                                  </select>
                                  <input type="text" class="form-control" pattern="[0-9]{7,10}" minlength="7" maxlength=10 placeholder="ingresa la cédula / RIF" name="cedula" id="cedula" required>
                              </div>
                          </div>
                          <div class="col-12 mb-2">
                              <label for="validationDefault02" class="form-label  dark:text-slate-300">Nombre <span style="color:#f00;">*</span></label>
                              <input type="text" class="form-control"  placeholder="ingresa el nombre" id="nombre_proveedor" name="nombre_proveedor" required>
                          </div>
                          <div class="col-12 mb-2">
                              <label for="validationDefault02" class="form-label  dark:text-slate-300">Correo <span style="color:#f00;">*</span></label>
                              <input type="text" class="form-control" placeholder="ingresa el correo" id="correo" name="correo" required>
                          </div>
                          <div class="col-12 mb-2">
                              <label for="validationDefault05" class="form-label  dark:text-slate-300">Teléfono <span style="color:#f00;">*</span></label>
                              <input type="text" class="form-control" maxlength="11" name="telefono" placeholder="ingresa el teléfono" id="telefono" required>
                          </div>
                          <div class="col-12 mb-2">
                              <label for="validationDefault03" class="form-label  dark:text-slate-300">Dirección <span style="color:#f00;">*</span></label>
                              <input type="text" class="form-control" name="direccion" placeholder="ingresa la dirección" id="direccion" required>
                          </div>
                          <div class="col-12 text-center  dark:text-slate-300">
                              <div class="text-start"> <p>Los campos con <span style="color:#f00;">*</span> son obligatorios</p> </div>
                          </div>
                          
                        </form>