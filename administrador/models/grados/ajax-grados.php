<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idgrado = $_POST['idgrado'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        //$clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM grados WHERE nombre_grado = ? AND grado_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idgrado));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El Grado ya esta Registrado');
        }else {

            if ($idgrado == 0) {
                $sql_Insert = "INSERT INTO grados(nombre_grado,estado) VALUES (?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$estado));
                $accion = 1;
            }else {
                    $sql_Update = "UPDATE grados SET nombre_grado = ?,estado = ? WHERE grado_id  = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$estado,$idgrado));
                    $accion = 2;
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'El Grado se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'El Grado se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>