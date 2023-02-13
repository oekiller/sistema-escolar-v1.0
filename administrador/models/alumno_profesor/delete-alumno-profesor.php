<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $id_alumno_profesor = $_POST['id'];

    $sql = "UPDATE alumno_profesor SET estadop = 0 WHERE ap_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($id_alumno_profesor));

    if ($result) {
        $respuesta = array('status'=> true, 'msg'=> 'Proceso Eliminado Correctamente');
    }else {
        $respuesta = array('status'=> false, 'msg'=> 'Error al Eliminar este Proceso');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>