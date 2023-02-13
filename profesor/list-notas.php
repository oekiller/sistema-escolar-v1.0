<?php

if (!empty($_GET['curso']) || !empty($_GET['alumno'])) {
    $curso = $_GET['curso'];
    $alumno = $_GET['alumno'];
} else {
    header("Location: profesor/");
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM notas as n
INNER JOIN ev_entregadas as eve ON n.ev_entregada_id = eve.ev_entregada_id
INNER JOIN alumnos as al ON eve.alumno_id = al.alumno_id
INNER JOIN evaluaciones as e ON eve.evaluacion_id = e.evaluacion_id
INNER JOIN contenidos as c ON e.contenido_id = c.contenido_id
INNER JOIN profesor_materia as pm ON c.pm_id  = pm.pm_id
WHERE al.alumno_id = $alumno";
$query = $pdo->prepare($sql);
$query->execute(array($alumno));
$row = $query->rowCount();

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list" aria-hidden="true"></i> Notas Cargadas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Notas Cargadas</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="title-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>EVALUACION</th>
                                    <th>NOTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($row > 0) {
                                    while ($data = $query->fetch()) {
                                ?>
                                        <tr>
                                            <td><span style="font-weight: bold;"><?= $data['titulo']; ?></span></td>
                                            <td><span style="font-weight: bold;"><?= $data['valor_nota']; ?></span></td>
                                        </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
                <div class="list-group">
                    <li class="list-group-item"><span class="tag tag-default tag-pill float-xs-right" style="background-color: #ffc107;"><strong>PROMEDIO: 
                    <?=formato(promedio($alumno)); ?></strong></span></li>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <a href="notas.php?curso=<?= $curso; ?>" class="btn btn-info">
            << Volver atras</a>
    </div>
</main>

<?php

require_once 'includes/footer.php';

?>