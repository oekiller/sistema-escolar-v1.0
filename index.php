<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('Location: adminstrador/');
} else if (!empty($_SESSION['activeP'])) {
    header('Location: profesor/');
} else if (!empty($_SESSION['activeA'])) {
    header('Location: alumno/');
}
?>

<div class="d-flex justify-content-center align-items-center mt-5">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>

    <div class="card">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item text-center">
                <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Administrador</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Docente</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#alumno" role="tab" aria-controls="alumno" aria-selected="true">Alumno</a>
            </li>

        </ul>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="form px-4 pt-5">
                    <form action="" method="POST" onsubmit="return validar();">
                        <input type="text" name="usuario_admin" id="usuario_admin" class="form-control" placeholder="User">
                        <input type="password" name="pass_admin" id="pass_admin" class="form-control" placeholder="Password">
                        <div id="mensaje_admin"></div>
                        <button class="btn btn-dark btn-block" id="login_admin" type="button">Login</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="form px-4 pt-5">
                    <form action="" method="POST" onsubmit="return validar();">
                        <input type="text" name="usuario_docen" id="usuario_docen" class="form-control" placeholder="User">
                        <input type="password" name="pass_docen" id="pass_docen" class="form-control" placeholder="Password">
                        <div id="mensaje_docen"></div>
                        <button class="btn btn-dark btn-block" id="login_docen" type="button">Login</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="alumno" role="tabpanel" aria-labelledby="alumno-tab">
                <div class="form px-4 pt-5">
                    <form action="" method="POST" onsubmit="return validar();">
                        <input type="text" name="usuario_alumno" id="usuario_alumno" class="form-control" placeholder="User">
                        <input type="password" name="pass_alumno" id="pass_alumno" class="form-control" placeholder="Password">
                        <div id="mensaje_alumno"></div>
                        <button class="btn btn-dark btn-block" id="login_alumno" type="button">Login</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>