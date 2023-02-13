<?php
require_once '../includes/conexion.php';

//session_start();
$idalumno = $_SESSION['alumno_id'];
$nombre = $_SESSION['nombre_alumno'];

$sql = "SELECT * FROM alumno_profesor as ap
INNER JOIN alumnos as al ON ap.alumno_id=al.alumno_id
INNER JOIN profesor_materia as pm ON ap.pm_id=pm.pm_id
INNER JOIN grados as g ON pm.grado_id=g.grado_id
INNER JOIN aulas as a ON pm.aula_id=a.aula_id
INNER JOIN profesor as p ON pm.profesor_id=p.profesor_id
INNER JOIN materias as m ON pm.materia_id=m.materia_id
WHERE al.alumno_id = $idalumno";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();



?>

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/user.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= "BIENVENIDO " . $nombre ?></p>
            <p class="app-sidebar__user-designation">Alumno</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-home" aria-hidden="true"></i></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">Mis Cursos</span>
                <i class="treeview-indicartor fa fa-angel-right"></i>
            </a>

            <ul class="treeview-menu">
                <?php if ($row > 0) {
                    while ($data = $query->fetch()) {
                ?>
                        <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id']; ?>"><i class="icon fa fa-circle-o"></i><?= $data['nombre_materia']; ?>
                                <?= $data['nombre_grado']; ?> <? $data['nombre_aula']; ?></a></li>
                <?php }
                } ?>
            </ul>
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">Calificaciones</span>
                <i class="treeview-indicartor fa fa-angel-right"></i>
            </a>

            <ul class="treeview-menu">
                <?php if ($row > 0) {
                    while ($data = $query->fetch()) {
                ?>
                        <li><a class="treeview-item" href="notas.php?curso=<?= $data['pm_id']; ?>"><i class="icon fa fa-circle-o"></i><?= $data['nombre_materia']; ?>
                                <?= $data['nombre_grado']; ?> <? $data['nombre_aula']; ?></a></li>
                <?php }
                } ?>
            </ul>
        </li>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa fa-times" aria-hidden="true"></i><span class="app-menu__label">Cerrar</span></a></li>
    </ul>
</aside>