<div id="modalmantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO: Formulario de Mantenimiento de identificacion -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id"/>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Raza</label>
                                <input type="text" class="form-control" id="breed" name="breed" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Fecha de Produccion</label>
                                <input type="date" class="form-control" id="production_date" name="production_date" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Cantidad de Produccion</label>
                                <input type="text" class="form-control" id="production_quantity" name="production_quantity" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Estado Huevos</label>
                                <select type="text" class="form-control form-select" name="egg_status" id="egg_status" aria-label="Seleccionar">
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="Excelente">Excelente</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Expirado">Expirado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Condicion Gallina</label>
                                <select type="text" class="form-control form-select" name="condition" id="condition" aria-label="Seleccionar">
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="Productiva">Productiva</option>
                                    <option value="Desvincular">Desvincular</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>