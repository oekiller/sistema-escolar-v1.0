<?php

require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM profesor_materia as pm 
  INNER JOIN grados as g ON pm.grado_id = g.grado_id 
  INNER JOIN aulas as a ON pm.aula_id = a.aula_id
  INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id  
  INNER JOIN materias as m ON pm.materia_id = m.materia_id 
  WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();


?>

<main class="app-content">
<link rel="stylesheet" type="text/css" href="css/estilos.css">

  <div class="row">
    <div class="col-md-12 border shadow p-2 bg-info text-white">
      <h3 class="display-4" style="text-align: center;">SISTEMA ESCOLAR</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h3>MIS MATERIAS</h3>
    </div>
  </div>

  <div class="row">
    <?php if ($row > 0) {
      while ($data = $query->fetch()) {

    ?>

        <div class="cold-md-4 text-center border mt-3 p-4 bg-light">
          <div class="card m-2 shadow" style="width: 23rem;">
            <center><img src="img/logo.png" class="card-img-top" id="logo-escula" alt="..."></center>
            <div class="card-body">
              <h4 class="card-title text-center"><?= $data['nombre_materia']; ?></h4>
              <h5 class="card-title">Grado <kbd class="bg-info"><?= $data['nombre_grado']; ?></kbd> - Aula <kbd class="bg-info"><?= $data['nombre_aula']; ?></kbd></h5>
              <a href="contenido.php?curso=<?= $data['pm_id']; ?>" class="btn btn-primary">Acceder</a>
              <a href="alumnos.php?curso=<?= $data['pm_id']; ?>" class="btn btn-warning">Ver Alumnos</a>
            </div>
          </div>

        </div>
    <?php }
    } ?>


  </div>


</main>

<?php require_once 'includes/footer.php'; ?>