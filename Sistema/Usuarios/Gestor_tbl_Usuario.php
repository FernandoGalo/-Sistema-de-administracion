<?php
/*
* Script: Cargar datos de lado del servidor con PHP y MySQL
* Autor: Marco Robles
* Team: Códigos de Programación
*/


require '../../conexion_BD.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['ID_Usuario', 'Usuario', 'Nombre_Usuario', 'ID_Rol', 'Correo_electronico', 'Fecha_Creacion', 'Fecha_Vencimiento', 'Estado_Usuario'];

/* Nombre de la tabla */
$table = "tbl_ms_usuario";

$id = 'ID_Usuario';
 
$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/* Limit */
$limit = isset($_POST['registros']) ? $conexion->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/**
 * Ordenamiento
 */

 $sOrder = "";
 if(isset($_POST['orderCol'])){
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';
    
    $sOrder = "ORDER BY ". $columns[intval($orderCol)] . ' ' . $oderType;
 }


/* Consulta */

$sql="SELECT SQL_CALC_FOUND_ROWS u.ID_Usuario, u.Usuario, u.Nombre_Usuario, r.Rol, u.Correo_electronico, u.Fecha_Creacion, u.Fecha_Vencimiento, u.Estado_Usuario
FROM tbl_ms_usuario u
JOIN tbl_ms_roles r ON u.ID_Rol = r.ID_Rol
WHERE u.ID_Usuario LIKE '%{$campo}%' OR u.Usuario LIKE '%{$campo}%' OR u.Nombre_Usuario LIKE '%{$campo}%' OR r.Rol LIKE '%{$campo}%' OR u.Correo_electronico LIKE '%{$campo}%' OR u.Estado_Usuario LIKE '%{$campo}%'
ORDER BY {$columns[$orderCol]} {$oderType}
LIMIT {$inicio}, {$limit}";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conexion->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conexion->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['ID_Usuario'] . '</td>';
        $output['data'] .= '<td>' . $row['Usuario'] . '</td>';
        $output['data'] .= '<td>' . $row['Nombre_Usuario'] . '</td>';
        $output['data'] .= '<td>' . $row['Rol'] . '</td>';
        $output['data'] .= '<td>' . $row['Correo_electronico'] . '</td>';
        $output['data'] .= '<td>' . $row['Fecha_Creacion'] . '</td>';  
        $output['data'] .= '<td>' . $row['Fecha_Vencimiento'] . '</td>';
        $output['data'] .= '<td>' . $row['Estado_Usuario'] . '</td>';
        $output['data'] .= '<td><a class="btn btn-warning btn-sm" href='Update_Usuarios.php?ID_Usuario=<?php echo $mostrar['ID_Usuario']; ?>' . $row['ID_Usuario'] . '">Editar</a></td>';
        $output['data'] .= "<td><a class='btn btn-danger btn-sm' href='Delete_Usuarios.php?Usuario=<?php echo $mostrar['Usuario']; ?>' . $row['ID_Usuario'] . "'>Eliminar</a></td>";
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
