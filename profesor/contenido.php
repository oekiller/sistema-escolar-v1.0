<?php

if (!empty($_GET['curso'])) {
    $curso = $_GET['curso'];
} else {
    header("Location: profesor/");
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
require_once 'includes/modals/modals_contenido.php';

$idprofesor = $_SESSION['profesor_id'];

$sql = "SELECT * FROM contenidos AS c INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list" aria-hidden="true"></i> Contenidos a Evaluar</h1>
            <button class="btn btn-success" type="button" onclick="openModalContenido();">Nuevo Contenido</button>
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
                                <p><button class="btn btn-info icon-btn" onclick="editarContenido(<?= $data['contenido_id']; ?>)"><i class="fa fa-pencil" aria-hidden="true"></i>Editar Contenido</button>
                                    <button class="btn btn-danger icon-btn" onclick="eliminarContenido(<?= $data['contenido_id']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar Contenido</button>
                                    <a class="btn btn-warning icon-btn" href="evaluacion.php?curso=<?= $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Asignar Evaluacion</a>
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