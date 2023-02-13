<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_evaluacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="tituloModal" style="text-align: center;">Nueva Evaluacion</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEvaluacion" name="formEvaluacion">
                    
                    <input type="hidden" name="idevaluacion" id="idevaluacion" value="">
                    <input type="hidden" name="idcontenido" id="idcontenido" value="<?= $contenido; ?>">
                    <div class="form-group">
                        <label for="control-label" style="font-weight: bold;">Titulo de la Evaluacion</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>

                    <div class="form-group">
                        <label for="control-label" style="font-weight: bold;">Descripcion del Contenido:</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="control-label" style="font-weight: bold;">Fecha Limite de Entrega</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>

                    <div class="form-group">
                        <label for="control-label" style="font-weight: bold;">Valor de la Evaluacion</label>
                        <input type="text" class="form-control" name="valor" id="valor">
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