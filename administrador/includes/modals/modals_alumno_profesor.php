<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_alumno_profesor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="tituloModal">Nueva Proceso Alumno</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAlumnoProfesor" name="formAlumnoProfesor">
                    <input type="hidden" name="id_alumno_profesor" id="id_alumno_profesor" value="">

                    <div class="form-group">
                        <label for="listProfesor">Seleccione un Alumno</label>
                        <select class="form-control" name="listAlumno" id="listAlumno">
                            <!-- CONTENIDO DEL AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="listProfesor">Seleccione un Profesor</label>
                        <select class="form-control" name="listProfesorA" id="listProfesorA">
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