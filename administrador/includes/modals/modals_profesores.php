
<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_profesores" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable"> -->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h1 class="modal-title" id="tituloModal">Nuevo Profesor</h1></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProfesor" name="formProfesor">
                    
                <input type="hidden" name="idprofesor" id="idprofesor" value="">
                    <div class="form-group">
                        <label for="control-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Direccion:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Cedula:</label>
                        <input type="text" class="form-control" name="cedula" id="cedula">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Password:</label>
                        <input type="password" class="form-control" name="clave" id="clave">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Telefono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Email:</label>
                        <input type="text" class="form-control" name="correo" id="correo">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Nivel de Estudio:</label>
                        <input type="text" class="form-control" name="nivel" id="nivel">
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