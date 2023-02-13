<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['usuario'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idusuario = $_POST['idusuario'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['listRol'];
        $estado = $_POST['listEstado'];

        $clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND usuario_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($usuario,$idusuario));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El usuario ya esta Registrado');
        }else {

            if ($idusuario == 0) {
                $sql_Insert = "INSERT INTO usuarios(nombre,usuario,clave,rol,estado) VALUES (?,?,?,?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$usuario,$clave,$rol,$estado));
                $accion = 1;
            }else {
                if (empty($clave)) {
                    $sql_Update = "UPDATE usuarios SET nombre = ?,usuario = ?,rol = ?,estado = ? WHERE usuario_id = ?";
                    $query_Update = $pdo->prepare($sql_Insert);
                    $request= $query_Update->execute(array($nombre,$usuario,$rol,$estado,$idusuario));
                    $accion = 2;
                }else {
                    $sql_Update = "UPDATE usuarios SET nombre = ?,usuario = ?,clave = ?,rol = ?,estado = ? WHERE usuario_id = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$usuario,$clave,$rol,$estado,$idusuario));
                    $accion = 3;
                }
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'El usuario se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'El usuario se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>