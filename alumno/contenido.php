<?php

if (!empty($_GET['curso'])) {
    $curso = $_GET['curso'];
} else {
    header("Location: alumno/");
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';


$idalumno = $_SESSION['alumno_id'];

$sql = "SELECT * FROM contenidos AS c INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list" aria-hidden="true"></i> Contenidos a Evaluar</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Contenidos a Evaluar</a></li>
        </ul>
    </div>
    <div class="row">
        <?php if ($row > 0) {
            while ($data = $query->fetch()) {

        ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile">
                            <div class="tile-title-w-btn">
                                <h3 class="title"><?= $data['titulo']; ?></h3>
                                <p><a class="btn btn-warning icon-btn" href="evaluacion.php?curso=<?= $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>" style="font-weight: bold;"><i class="fa fa-pencil" aria-hidden="true"></i>Ver Evaluacion</a>
                                </p>
                            </div>
                            <div class="tile-body">
                                <b><?= $data['descripcion']; ?></b>
                            </div>
                            <div class="title-footer mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-download" aria-hidden="true"></i></div>
                                    </div>
                                    <a class="btn btn-primary" href="BASE_URL<?= $data['material']; ?>" target="_blank">Material para Descargar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <div class="row">
        <a href="index.php" class="btn btn-info">
            << Volver atras</a>
    </div>
</main>

<?php

require_once 'includes/footer.php';

?>