
<!-- MODAL DE USUARIOS -->

<div class="modal fade" id="modal_usuarios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="tituloModal">Nuevo Usuario</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="formUsuario">
                    
                <input type="hidden" name="idusuario" id="idusuario" value="">
                    <div class="form-group">
                        <label for="control-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" id="usuario">
                    </div>

                    <div class="form-group">
                        <label for="control-label">Password:</label>
                        <input type="password" class="form-control" name="clave" id="clave">
                    </div>

                    <div class="form-group">
                        <label for="listRol">Rol</label>
                        <select class="form-control" name="listRol" id="listRol">
                            <option value="1">Administrador</option>
                            <option value="2">Supervisor</option>
                            <!-- <option value="3">Administrador</option> -->
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