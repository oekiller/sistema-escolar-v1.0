<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idprofesor = $_POST['idprofesor'];

    $sql = "UPDATE profesor SET estado = 0 WHERE profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesor));

    if ($result) {
        $respuesta = array('status'=> true, 'msg'=> 'Docente Eliminado Correctamente');
    }else {
        $respuesta = array('status'=> false, 'msg'=> 'Error al Eliminar Docente');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>