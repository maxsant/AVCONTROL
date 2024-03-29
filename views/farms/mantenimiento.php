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
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Ubicacion</label>
                                <input type="text" class="form-control" id="location" name="location" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Dimension (metros)</label>
                                <input type="number" class="form-control" id="size" name="size" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Gallina</label>
                                <select type="text" class="form-control form-select" name="chicken_id" id="chicken_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Alimento</label>
                                <select type="text" class="form-control form-select" name="food_id" id="food_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Produccio de Huevo</label>
                                <select type="text" class="form-control form-select" name="egg_production_record_id" id="egg_production_record_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>
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