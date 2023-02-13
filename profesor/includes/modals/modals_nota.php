<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_nota" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="tituloModal" style="text-align: center;">Cargar Nota</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNota" name="formNota">

                    <input type="hidden" name="identregada" id="identregada" value="<?= $ev_entregada; ?>">
                    <div class="form-group">
                        <label for="control-label" style="font-weight: bold;">Nota</label>
                        <input type="number" class="form-control" name="nota" id="nota">
                    </div>

                    <div class="form-group" style="background-color: #dc3545;">
                        <center>
                            <p style="color: white;">LOS CAMBIOS NO PODRAN SER EDITABLES</p>
                        </center>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" type="submit" id="action">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>