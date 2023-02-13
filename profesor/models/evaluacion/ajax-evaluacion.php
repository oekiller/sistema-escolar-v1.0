<?php

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['titulo']) || empty($_POST['descripcion'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    } else {
        $idevaluacion = $_POST['idevaluacion'];
        $idcontenido = $_POST['idcontenido'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        $valor = $_POST['valor'];

        if ($idevaluacion == 0) {
            $sql_Insert = "INSERT INTO evaluaciones (titulo,descripcion,fecha,porcentaje,contenido_id) VALUES (?,?,?,?,?)";
            $query_Insert = $pdo->prepare($sql_Insert);
            $request = $query_Insert->execute(array($titulo, $descripcion, $fecha, $valor, $idcontenido));
            $accion = 1;
        } else {
            $sql_Update = "UPDATE evaluaciones SET titulo = ?,descripcion = ?,fecha = ?,porcentaje = ?,contenido_id = ? WHERE evaluacion_id = ?";
            $query_Update = $pdo->prepare($sql_Update);
            $request = $query_Update->execute(array($titulo, $descripcion, $fecha, $valor, $idcontenido, $idevaluacion));
            $accion = 2;
        }
        if ($request > 0) {
            if ($accion == 1) {
                $respuesta = array('status' => true, 'msg' => 'Evaluacion Creado Correctamente');
            } else {
                $respuesta = array('status' => true, 'msg' => 'Evaluacion Actualizada Correctamente');
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
