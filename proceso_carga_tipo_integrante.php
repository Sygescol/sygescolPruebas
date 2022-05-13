<?php



header("Cache-Control: no-store, no-cache, must-revalidate");



if(isset($_GET['dependiente']) )



{	



	include_once("conexion.php");



	include_once("inc.funciones.php");



	$link = conectarse();



	



	if($_GET['tipo'] == 'D')



	{



		$sql_integrantes = "SELECT DISTINCT dcne.i as id, CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre 



		FROM dcne, cga



		WHERE dcne.i = cga.g



		ORDER BY nombre";



	}



	else if($_GET['tipo'] == 'P')



	{



		$sql_integrantes = "SELECT acu_id as id, concat(acu_apellido1,' ',acu_apellido2,' ',acu_nombre1,' ',acu_nombre2) as nombre, v_grupos.grupo_nombre



		FROM acudiente



		INNER JOIN alumno ON (acudiente.alumno_id=alumno.alumno_id)



		INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id) 



		INNER JOIN v_grupos ON (v_grupos.grupo_id=matricula.grupo_id)



		WHERE matricula.matri_estado=0 



		AND matricula.grado_id ='$_GET[id_grado]'



		AND matricula.sede_id ='$_GET[sede]' 



		AND acu_apellido1!=''



		AND acu_nombre1!=''



		ORDER BY grupo_nombre, acu_nombre";



	}



	else if($_GET['tipo'] == 'A')



	{



		$sql_integrantes = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%rector%' ORDER BY nombre";



	}



	else



	{



		
$sql_integrantes = "select matri_id as id, concat(alumno_ape1,' ',alumno_ape2 ,' ',alumno_nom1,' ',alumno_nom2 ) as nombre, v_grupos.grupo_nombre



								FROM alumno 



								INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id) 



								INNER JOIN v_grupos ON (v_grupos.grupo_id=matricula.grupo_id)



								where matricula.matri_estado=0 AND grado_id ='$_GET[id_grado]'



								AND matricula.sede_id ='$_GET[sede]'  



								AND matri_id NOT IN (select matri_id from novedad_estudiante)



								ORDER BY matri_codigo";




	}



	$resultado_integrantes = mysql_query($sql_integrantes, $link) or die("No se pudo consultar los integrantes");

if ($_GET['tipo'] == 'A' or $_GET['tipo'] == 'D' or $_GET['tipo'] == 'P' or $_GET['tipo'] == 'E' or $_GET['id_grado_<?php echo $row_sedes2["sede_consecutivo]; ?>'] > '0' ) {







		



	// Comienzo a imprimir el select



	echo "<select name='$_GET[dependiente]' id='$_GET[dependiente]'>";



	echo "<option value=''>Seleccione uno...</option>";



	$nombre_anterior = '';



	$gru='';



	if($_GET['tipo'] == 'A'){



		echo "<optgroup label='Rector(a)'>";



	}



	while($datos_integrante = mysql_fetch_array($resultado_integrantes))



	{



		// Paso a HTML acentors y ñ para su correcta visualizacion



		if($_GET['tipo'] == 'A'){



			$id = ConvertirTextoHtml($datos_integrante['id'].'01');



		}else{



			$id = ConvertirTextoHtml($datos_integrante['id']);



		}



		$nombre = ConvertirTextoHtml($datos_integrante['nombre']);



		// Imprimo las opciones del select



		if($nombre_anterior != $nombre)



		{	



			if($_GET['tipo'] == 'P' || $_GET['tipo'] == 'E'){



				if($gru!=$datos_integrante['grupo_nombre']){



					echo "<optgroup label='".ConvertirTextoHtml($datos_integrante['grupo_nombre'])."'>";



					$gru=$datos_integrante['grupo_nombre'];



				}				



			}



			echo "<option value='".$id."'>".$nombre."</option>";



		}



		$nombre_anterior = $nombre;



	}	





	if($_GET['tipo'] == 'A'){



		$sql_integrantesCor = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%COORDI%' ORDER BY nombre";	



		$resultado_integrantesCor = mysql_query($sql_integrantesCor, $link) or die("No se pudo consultar los integrantes");



		



		echo "<optgroup label='DELEGADO'>";



		echo "<optgroup label='DOCENTE ADMINISTRATIVO'>";



		while($datos_integranteCor = mysql_fetch_array($resultado_integrantesCor))



		{



			$id = ConvertirTextoHtml($datos_integranteCor['id']);



			$nombre = ConvertirTextoHtml($datos_integranteCor['nombre']);



			if($nombre_anterior != $nombre)



			{	



				echo "<option value='".$id."02'>".$nombre."</option>";



			}



			$nombre_anterior = $nombre;



		}



		



		$sql_integrantesDoc = "SELECT DISTINCT dcne.i as id, CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre 



							FROM dcne, cga



							WHERE dcne.i = cga.g



							ORDER BY nombre";	



		$resultado_integrantesDoc = mysql_query($sql_integrantesDoc, $link) or die("No se pudo consultar los integrantes");



		echo "<optgroup label='DOCENTE'>";



		while($datos_integranteDoc = mysql_fetch_array($resultado_integrantesDoc))



		{



			$id = ConvertirTextoHtml($datos_integranteDoc['id']);



			$nombre = ConvertirTextoHtml($datos_integranteDoc['nombre']);



			if($nombre_anterior != $nombre)



			{	



				echo "<option value='".$id."03'>".$nombre."</option>";



			}



			$nombre_anterior = $nombre;



		}		



	}				



	echo "</select>";



}


////////// nuevo



if($_GET['tipo1'] == 'D')



	{



		$sql_integrantes1 = "SELECT DISTINCT dcne.i as id, CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre 



		FROM dcne, cga



		WHERE dcne.i = cga.g



		ORDER BY nombre";



	}



	else if($_GET['tipo1'] == 'P')



	{



		$sql_integrantes1 = "SELECT acu_id as id, concat(acu_apellido1,' ',acu_apellido2,' ',acu_nombre1,' ',acu_nombre2) as nombre, v_grupos.grupo_nombre



		FROM acudiente



		INNER JOIN alumno ON (acudiente.alumno_id=alumno.alumno_id)



		INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id) 



		INNER JOIN v_grupos ON (v_grupos.grupo_id=matricula.grupo_id)



		WHERE matricula.matri_estado=0 



		AND matricula.grado_id ='$_GET[id_grado]'



		AND matricula.sede_id ='$_GET[sede]' 



		AND acu_apellido1!=''



		AND acu_nombre1!=''



		ORDER BY grupo_nombre, acu_nombre";



	}



	else if($_GET['tipo1'] == 'A')



	{



		$sql_integrantes1 = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%rector%' ORDER BY nombre";



	}


	else



	{



		
$sql_integrantes1 = "select matri_id as id, concat(alumno_ape1,' ',alumno_ape2 ,' ',alumno_nom1,' ',alumno_nom2 ) as nombre, v_grupos.grupo_nombre



								FROM alumno 



								INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id) 



								INNER JOIN v_grupos ON (v_grupos.grupo_id=matricula.grupo_id)



								where matricula.matri_estado=0 AND grado_id ='$_GET[i1d_grado]'



								AND matricula.sede_id ='$_GET[sede]'  



								AND matri_id NOT IN (select matri_id from novedad_estudiante)



								ORDER BY matri_codigo";




	}



	$resultado_integrantes1 = mysql_query($sql_integrantes1, $link) or die("No se pudo consultar los integrantes");
// nuevo 

if ($_GET['tipo1'] == 'A' or $_GET['tipo1'] == 'D' or $_GET['tipo1'] == 'P' or $_GET['tipo1'] == 'E' or $_GET['id_grado_<?php echo $row_sedes2["sede_consecutivo]; ?>'] > '0' ) {







		



	// Comienzo a imprimir el select



	echo "<select name='$_GET[dependiente]' id='$_GET[dependiente]'>";



	echo "<option value=''>Seleccione unO...</option>";



	$nombre_anterior = '';



	$gru='';






	while($datos_integrante1 = mysql_fetch_array($resultado_integrantes1))



	{



		// Paso a HTML acentors y ñ para su correcta visualizacion



				if($_GET['tipo1'] == 'A'){



			$id = ConvertirTextoHtml($datos_integrante['id'].'01');



		}else{



			$id = ConvertirTextoHtml($datos_integrante['id']);



		}


		$nombre = ConvertirTextoHtml($datos_integrante['nombre']);



		// Imprimo las opciones del select



		if($nombre_anterior != $nombre)



		{	



			if($_GET['tipo1'] == 'E'){



				if($gru!=$datos_integrante['grupo_nombre']){



					echo "<optgroup label='".ConvertirTextoHtml($datos_integrante['grupo_nombre'])."'>";



					$gru=$datos_integrante['grupo_nombre'];



				}				



			}



			echo "<option value='".$id."'>".$nombre."</option>";



		}



		$nombre_anterior = $nombre;



	}	



	echo "</select>";



}

//nuevo

}



else{







	



}



if ($_GET['tipo'] == 'O') {



	echo "<table style='border:1px solid #DDDDDD;'>";



	echo "<th colspan=2 class='formulario' style='background-color: #3399FF;'> Ingrese Nombre </th>";



	echo "<tr><td>Documento: </	td><td><input type='text' id='documento_nuevo' name='documento_nuevo' /></td></tr>";



	echo "<tr><td>Nombre: </td><td><input type='text' id='nombre_nuevo' name='nombre_nuevo' /></td></tr>";



	echo "</table>";



}	



?>