<?php 

    require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM aulas as a WHERE a.estado != 0';
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
        
        <button class="btn btn-primary" title="Editar" onclick="editar_aula('.$resultado[$i]['aula_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminar_aula('.$resultado[$i]['aula_id'].')">Eliminar</button>
        ';
    }

    echo json_encode($resultado,JSON_UNESCAPED_UNICODE);

?>