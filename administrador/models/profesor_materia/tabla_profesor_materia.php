<?php

require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM profesor_materia as pm 
    INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
    INNER JOIN grados as g ON pm.grado_id = g.grado_id 
    INNER JOIN aulas as a ON pm.aula_id = a.aula_id 
    INNER JOIN materias as m ON pm.materia_id = m.materia_id 
    INNER JOIN periodos as pe ON pm.periodo_id = pe.periodo_id WHERE pm.estadopm != 0'; 
    
    $query = $pdo->prepare($sql);
    $query->execute();

$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($resultado); $i++) {
    if ($resultado[$i]['estadopm'] == 1) {
        $resultado[$i]['estadopm'] = '<span class="badge badge-success">Activo</span>';
    } else {
        $resultado[$i]['estadopm'] = '<span class="badge badge-danger">Inactivo</span>';
    }

    $resultado[$i]['acciones'] = '
        
        <button class="btn btn-primary" title="Editar" onclick="editar_profesor_materia(' . $resultado[$i]['pm_id'] . ')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminar_profesor_materia(' . $resultado[$i]['pm_id'] . ')">Eliminar</button>
        ';
}

echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
