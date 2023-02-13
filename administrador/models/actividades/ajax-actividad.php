<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idactividad = $_POST['idactividad'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        //$clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM actividad  WHERE nombre_actividad = ? AND actividad_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idactividad));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'La Actividad ya esta Registrado');
        }else {

            if ($idactividad == 0) {
                $sql_Insert = "INSERT INTO actividad (nombre_actividad,estado) VALUES (?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$estado));
                $accion = 1;
            }else {
                    $sql_Update = "UPDATE actividad  SET nombre_actividad = ?,estado = ? WHERE actividad_id  = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$estado,$idactividad));
                    $accion = 2;
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'La Actividad se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'La Actividad se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>