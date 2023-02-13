<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_profesor_materias" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="tituloModal">Nueva Lista de Profesor Materias</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProfesorMateria" name="formProfesorMateria">
                    <input type="hidden" name="id_profesor_materia" id="id_profesor_materia" value="">

                    <div class="form-group">
                        <label for="listProfesor">Seleccione un Profesor</label>
                        <select class="form-control" name="listProfesorM" id="listProfesorM">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listGrado">Seleccione el Grado</label>
                        <select class="form-control" name="listGrado" id="listGrado">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listAula">Seleccione el Aula</label>
                        <select class="form-control" name="listAula" id="listAula">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listMateria">Seleccione la Materia</label>
                        <select class="form-control" name="listMateria" id="listMateria">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listPeriodo">Seleccione el Periodo</label>
                        <select class="form-control" name="listPeriodo" id="listPeriodo">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listEstado">Estado</label>
                        <select class="form-control" name="listEstado" id="listEstado">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                            <!-- <option value="3">Administrador</option> -->
                        </select>
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