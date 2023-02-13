<?php
session_start();
if (!empty($_POST)) {
    if (empty($_POST['login']) || empty($_POST['pass'])) {

        echo '<div class="alert alert-danger" style="text-align: center;"><button type="button" class="close" data-dismiss="alert">&times;</button>Todos los Campos son Necesarios</div>';
    } else {
        require_once 'conexion.php';
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        $sql = 'SELECT * FROM alumnos WHERE cedula = ?';

        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($query->rowCount() > 0) {

            date_default_timezone_set("America/Bogota");

            $fecha = date('Y-m-d H:i:s');
            $alumno_id = $result['alumno_id'];
            $sql = "UPDATE alumnos SET u_acceso = '$fecha' WHERE alumno_id = ?";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array($alumno_id));

            if ($res) {
                if (password_verify($pass, $result['clave'])) {
                    $_SESSION['activeA'] = true;
                    $_SESSION['alumno_id'] = $result['alumno_id'];
                    $_SESSION['nombre_alumno'] = $result['nombre_alumno'];
                    $_SESSION['cedula'] = $result['cedula'];
                    $_SESSION['u_acceso'] = $result['u_acceso'];

                    echo '<div class="alert alert-success" style="text-align: center;"><button type="button" class="close" data-dismiss="alert">&times;</
                    button>Redirecting</div>';
                }
            } else {
                echo '<div class="alert alert-danger" style="text-align: center;"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Password Incorrectos</div>';
            }
        } else {
            echo '<div class="alert alert-danger" style="text-align: center;"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Password Incorrectos</div>';
        }
    }
}
