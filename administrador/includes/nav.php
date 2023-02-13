    <!-- Sidebar menu-->

    <?php
        $nombre = $_SESSION['nombre'];
    ?>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/user.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= "BIENVENIDO ".$nombre ?></p>
                <p class="app-sidebar__user-designation"><?php echo $_SESSION['nombre_rol']; ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="lista_usuarios.php"><i class="app-menu__icon fa fa-users" aria-hidden="true"></i><span class="app-menu__label">Usuarios</span></a></li>
            <li><a class="app-menu__item" href="lista_profesores.php"><i class="app-menu__icon fa fa-street-view" aria-hidden="true"></i><span class="app-menu__label">Profesores</span></a></li>
            <li><a class="app-menu__item" href="lista_alumnos.php"><i class="app-menu__icon fa fa-child" aria-hidden="true"></i><span class="app-menu__label">Alumnos</span></a></li>
            <li><a class="app-menu__item" href="lista_grados.php"><i class="app-menu__icon fa fa-book" aria-hidden="true"></i><span class="app-menu__label">Grados</span></a></li>
            <li><a class="app-menu__item" href="lista_aulas.php"><i class="app-menu__icon fa fa-university" aria-hidden="true"></i><span class="app-menu__label">Aulas</span></a></li>
            <li><a class="app-menu__item" href="lista_materias.php"><i class="app-menu__icon fa fa-book" aria-hidden="true"></i><span class="app-menu__label">Materias</span></a></li>
            <li><a class="app-menu__item" href="lista_periodos.php"><i class="app-menu__icon fa fa-calendar" aria-hidden="true"></i><span class="app-menu__label">Periodos</span></a></li>
            <li><a class="app-menu__item" href="lista_actividades.php"><i class="app-menu__icon fa fa-trophy" aria-hidden="true"></i><span class="app-menu__label">Actividades</span></a></li>
            <li><a class="app-menu__item" href="lista_profesor_materia.php"><i class="app-menu__icon fa fa-folder" aria-hidden="true"></i><span class="app-menu__label">Proceso Profesor</span></a></li>
            <li><a class="app-menu__item" href="lista_alumno_profesor.php"><i class="app-menu__icon fa fa-folder" aria-hidden="true"></i><span class="app-menu__label">Proceso Alumnos</span></a></li>
            <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa fa-times" aria-hidden="true"></i><span class="app-menu__label">Cerrar</span></a></li>

        </ul>
    </aside>