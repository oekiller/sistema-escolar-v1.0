<?php 

require_once 'includes/header.php';
require_once 'includes/modals/modals_alumno_profesor.php';

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list" aria-hidden="true"></i> Lista de Proceso Alumnos</h1>
            <button class="btn btn-success" type="button" onclick="openModalAlumnoProfesor()">Nueva Proceso Alumno</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Proceso Alumnos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="table_alumno_profesor">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE DEL ALUMNO</th>
                      <th>NOMBRE DEL PROFESOR</th>
                      <th>GRADO</th> 
                      <th>MATERIA</th>
                      <th>PERIODO</th>
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