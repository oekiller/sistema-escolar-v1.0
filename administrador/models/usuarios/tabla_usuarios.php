<?php 

    require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM usuarios AS u INNER JOIN rol AS r ON u.rol=r.rol_id WHERE u.estado != 0';
    $query = $pdo->prepare($sql);
    $query->execute();

    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i=0; $i < count($resultado) ; $i++) { 
        if ($resultado[$i]['estado'] == 1) {
            $resultado[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
        }else {
            $resultado[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
        }

        $resultado[$i]['acciones'] = '
        
        <button class="btn btn-primary" title="Editar" onclick="editar_usuario('.$resultado[$i]['usuario_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminar_usuario('.$resultado[$i]['usuario_id'].')">Eliminar</button>
        ';
    }

    echo json_encode($resultado,JSON_UNESCAPED_UNICODE);

?>