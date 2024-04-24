<div id="modalStatusPayment" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo">Estado de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO: Formulario de Mantenimiento de Estado de Pago -->
            <form method="post" id="modalStatusPayment_form">
                <div class="modal-body">
                    <input type="hidden" name="purchase_id" id="purchase_id"/>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Estado</label>
                                <select type="text" class="form-control form-select" name="status_payment" id="status_payment" aria-label="Seleccionar">
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="1">Pagado</option>
                                    <option value="2">Pendiente</option>
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