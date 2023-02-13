<?php 

require_once 'includes/header.php';
require_once 'includes/modals/modals_profesores.php';

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list" aria-hidden="true"></i> Lista de Profesores</h1>
            <button class="btn btn-success" type="button" onclick="openModalP()">Nuevo Profesor</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Profesores</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="table_profesores">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>DIRECCION</th>
                      <th>CEDULA</th>
                      <th>TELEFONO</th>
                      <th>CORREO</th>
                      <th>NIVEL DE ESTUDIO</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
                
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>