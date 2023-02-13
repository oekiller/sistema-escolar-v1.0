<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idalumno = $_POST['idalumno'];

    $sql = "UPDATE alumnos SET estado = 0 WHERE alumno_id  = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idalumno));

    if ($result) {
        $respuesta = array('status'=> true, 'msg'=> 'Alumno Eliminado Correctamente');
    }else {
        $respuesta = array('status'=> false, 'msg'=> 'Error al Eliminar Alumno');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>