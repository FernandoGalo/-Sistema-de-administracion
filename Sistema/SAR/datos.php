<?php 
$conexion=mysqli_connect('localhost','root','','bd_asociacion_creo_en_ti');
mysqli_set_charset($conexion, "utf8");
$departamento=$_POST['departamento'];
	$sql="SELECT id,
			 id_departamento,
			 id_municipio 
		from t_honduras 
		where id_departamento='$departamento'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label>SELECT 2 (departamentos)</label> 
			<select id='lista2' name='lista2'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
	

?>