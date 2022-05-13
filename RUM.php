<?php

include("conexion.php");
$hostname_sygescol = "localhost";
$username_sygescol = "ietsagra_familia";
$password_sygescol = "sagrada2009";

$prinBD = "ietsagra_sygescol";
$linkSimple = conectarse($hostname_sygescol, $username_sygescol, $password_sygescol);


//consultar los años con informacion de la institucion
$fecha = date("Y-m-d");
$arrayFecha = explode("-", $fecha);
$añoActual = $arrayFecha[0];
$mesActual = $arrayFecha[1];
$diaActual = $arrayFecha[2];
$anioInicio = 2013;//Este año se reemplaza por el año en el que inicia la institucion

	
function buscarRUM($matricula, $rum, $informacion){
	$numExiste = 0;
	foreach ($informacion as $key => $value) {
		if($value['MATRI_ID'] != $matricula){
			if($value['ALUMNO_RUM'] == $rum){
				$numExiste++;
			}
		}
	}
	return $numExiste;
}


if(isset($_GET['q'])){
	if($_GET['anio'] == $anioInicio){
		$selAlumno = "SELECT * FROM ".$prinBD.$_GET['anio'].".alumno ORDER BY alumno_id";
		$sqlAlumno = mysql_query($selAlumno, $linkSimple)or die(mysql_error(). $selAlumno);
		$numAlu = mysql_num_rows($sqlAlumno);
		if($numAlu > 0){
			$updRUM = mysql_query("UPDATE ".$prinBD.$_GET['anio'].".alumno SET alumno_rum = '0'", $linkSimple)or die(mysql_error());
			$rumConsecutivo = 1;
			while ($rowAlu = mysql_fetch_array($sqlAlumno)) {
				$updRUM = mysql_query("UPDATE ".$prinBD.$_GET['anio'].".alumno SET alumno_rum = '".$rumConsecutivo."' WHERE alumno_id = ".$rowAlu['alumno_id']."", $linkSimple)or die(mysql_error());
				$rumConsecutivo++;
			}
		}
	}else{
		$selRUM = "SELECT * FROM ".$prinBD.$_GET['anio'].".alumno AS al INNER JOIN ".$prinBD.$_GET['anio'].".matricula AS mat ON(mat.alumno_id = al.alumno_id)
				WHERE mat.matri_estado = 0 GROUP BY mat.alumno_id, al.alumno_num_docu ORDER BY al.alumno_id";
		$sqlRUM = mysql_query($selRUM, $linkSimple)or die(mysql_error());
		$numAlu = mysql_num_rows($sqlRUM);
		if($numAlu > 0){
			$updRUM = mysql_query("UPDATE ".$prinBD.$_GET['anio'].".alumno SET alumno_rum = '0'", $linkSimple)or die(mysql_error());
			$anioAnt = $_GET['anio']-1;

			$selMax = "SELECT MAX(alumno_rum) AS 'maximo' FROM ".$prinBD.$anioAnt.".alumno";
			$sqlMax = mysql_query($selMax, $linkSimple)or die(mysql_error());
			$rowMax = mysql_fetch_array($sqlMax);
			$numMax = mysql_num_rows($sqlMax);
			if($numMax > 0){
				$rumConsecutivo = $rowMax['maximo']+1;
			}else{
				$rumConsecutivo = 1;
			}

			$selCeros = "SELECT * FROM ".$prinBD.$_GET['anio'].".alumno AS al INNER JOIN ".$prinBD.$_GET['anio'].".matricula AS mat ON(mat.alumno_id = al.alumno_id)
				WHERE mat.matri_estado = 0 AND al.alumno_rum = 0 AND mat.matri_nuevo = 'N' GROUP BY mat.alumno_id, al.alumno_num_docu ORDER BY al.alumno_id";
			$sqlCeros = mysql_query($selCeros, $linkSimple)or die(mysql_error());

			while($rowAlu = mysql_fetch_array($sqlCeros)){
				$updRUM = mysql_query("UPDATE ".$prinBD.$_GET['anio'].".alumno SET alumno_rum = '".$rumConsecutivo."' WHERE alumno_id = ".$rowAlu['alumno_id']."", $linkSimple)or die(mysql_error());
				$rumConsecutivo++;
			}
			//Actualizar matricula año anterior
			$updRUM = mysql_query("UPDATE ".$prinBD.$_GET['anio'].".alumno a
			INNER JOIN ".$prinBD.$_GET['anio'].".matricula  b ON b.alumno_id = a.alumno_id
			INNER JOIN ".$prinBD.$anioAnt.".matricula  c ON c.matri_id = b.matri_ant_id 
			INNER JOIN ".$prinBD.$anioAnt.".alumno  d ON d.alumno_id = c.alumno_id
			SET a.alumno_rum = d.alumno_rum
			WHERE b.matri_estado = 0 AND b.matri_nuevo = 'A' AND b.situa_anyo_ant_id <> 0 
			", $linkSimple)or die(mysql_error());

		}
		
	}

	//$updRUM = "UPDATE ".$prinBD.$_GET['anio'].".alumno,(SELECT @numeroConsecutivo:=0) rumNu SET alumno_rum=@numeroConsecutivo:=@numeroConsecutivo+1;";
	//$sqlRUM = mysql_query($updRUM, $linkSimple)or die(mysql_error());
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajuste de RUM</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<style type="text/css">
	#infoDetalle{
		width: 100%;
		height: 150px;
		float: left;
		opacity: 0.4;		
	}
	#generar{
	    padding: 35px;
	    color: white;
	    text-shadow: 1px 1px 1px #fff;
	    border-radius: 10px;
	    width: 20%;
	    text-align: center;
	    font-size: 40px;
	    box-shadow: 0px 4px 13px #000;
	    font-family: monospace;
	    border: solid 2px #000;
	    cursor: pointer;
	    float: left;
	    height: 60px;	    
	}
	#generar:hover{
		border: none;
	}
	#detalle{
		height: 70%;
		width: 65%;
		float: left;
		border: solid 2px #D4CFB8;
		margin: 5px 15px;
		padding: 10px;
		border-radius: 5px;
		color: white;
		font-family: monospace;
		font-size: x-large;
	}
	#infoDetalle:hover{
		opacity: 0.9;
		-webkit-transition: opacity .30s ease-in-out;
		-moz-transition: opacity .30s ease-in-out;
		-ms-transition: opacity .30s ease-in-out;
		-o-transition: opacity .30s ease-in-out;
		transition: opacity .30s ease-in-out;		
	}
	#cargando{
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    background: rgba(0, 0, 0, 0.46);		
	}
	#cargando h3{
		position: absolute;
		width: 20%;
		height: 100px;
		background: url(cargando.gif) no-repeat;
		background-position: 1px 0;
		background-size: 30%;
		left: 47%;
		top: 36%;	
	}
	#Mensaje{
		width: 80%;
		position: fixed;
		left: 9%;
		height: auto;
		min-height: 10px;
		max-height: 80%;
		overflow: auto;		
		top: 10%;
		background-color: #fff;
		border-radius: 10px;
		box-shadow: 0px 8px 21px 3px #000;	
	}
	table{
		width: 100%;
		padding: 40px 0;
		text-align: center;
		font-size: larger;
	}
	#cerrar{
	    position: absolute;
	    top: 10px;
	    right: 10px;
	    background: #000;
	    color: white;
	    padding: 7px 10px;
	    border-radius: 30px;
	    cursor: pointer;		
	}
	a{
		cursor: pointer;
	}
	a:hover{
		text-decoration: underline;
	}
	</style>
	<script type="text/javascript">
	function cambiarRum(anioBd){
		document.getElementById("cargando").style.display = "";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.write(xmlhttp.responseText);
			window.location.href = "RUM.php";
		 }
		}
		 xmlhttp.open("GET", "RUM.php?q=modifica&anio="+anioBd+"", true);
		 xmlhttp.send();
	}
	function cargando(){
		document.getElementById("cargando").style.display = "none";
	}
	function rumCero(mensaje){
		document.getElementById("Mensaje").innerHTML = mensaje+'<sapn id="cerrar" onclick="cerrar();">X</span>';
		document.getElementById("Mensaje").style.display = "";
	}
	function rumRepetido(mensaje){
		document.getElementById("Mensaje").innerHTML = mensaje+'<sapn id="cerrar" onclick="cerrar();">X</span>';
		document.getElementById("Mensaje").style.display = "";
	}
	function cerrar(){
		document.getElementById("Mensaje").style.display = "none";
	}
	</script>
</head>
<body onload="cargando();">
<div id="cargando">
	<h3></h3>
</div>
<?php 
flush();
$top = 0;
for ($i=$anioInicio; $i <= $añoActual; $i++) {
	$estiloB = 'style="';
	$estiloD = 'style="';
	$color = "#".rand(100000,999999);
	$estiloD .= 'background: '.$color.';';
	$mensaje = "";
	$tieneError = 0;
	$tieneRepetido = 0;
	$tieneCero = 0;
	$noCoincide = 0;
	$textoRumCero = "<table><tr><th>RUM</th><th>Documento</th><th>Nombre</th></tr>";
	$textoRumRepetido = "<table><tr><th>RUM</th><th>Documento</th><th>Nombre</th></tr>";
	//Validar que problemas tiene el RUM
	//validar RUM repetidos

	$selRUM = "SELECT * FROM ".$prinBD.$i.".alumno AS al INNER JOIN ".$prinBD.$i.".matricula AS mat ON(mat.alumno_id = al.alumno_id)
				WHERE mat.matri_estado = 0 GROUP BY mat.alumno_id, al.alumno_num_docu ORDER BY al.alumno_id";
	$sqlRUM = mysql_query($selRUM, $linkSimple)or die("No se pudo consultarel RUM = ". mysql_error());
	$numRUM = mysql_num_rows($sqlRUM);
	if($numRUM > 0){
		unset($contenidoEstudiante); //Eliminar toda la informacin que exista en el arreglo
		while($rowRUM = mysql_fetch_assoc($sqlRUM)){
			$RUM = $rowRUM['alumno_rum'];	
			$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNO_ID'] = $rowRUM['alumno_id'];
			$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNO_RUM'] = $rowRUM['alumno_rum'];
			$contenidoEstudiante[$rowRUM['matri_id']]['MATRI_ID'] = $rowRUM['matri_id'];
			$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNO_NUM_DOCU'] = $rowRUM['alumno_num_docu'];
			$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNONOMBRE'] = $rowRUM['alumno_ape1']. ' '.$rowRUM['alumno_ape2']. ' '.$rowRUM['alumno_nom1']. ' '.$rowRUM['alumno_nom2'];
			$contenidoEstudiante[$rowRUM['matri_id']]['MATRIANT'] = $rowRUM['matri_ant_id'];			
			//Si no tiene RUM asignado	
			if($RUM == 0 OR $RUM == ''){
				$textoRumCero .= "<tr><td>".$RUM."</td><td>".$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNO_NUM_DOCU']."</td><td>".$contenidoEstudiante[$rowRUM['matri_id']]['ALUMNONOMBRE']."</td></tr>";
				$tieneCero++;
			}
		}

		foreach ($contenidoEstudiante as $key => $value) {
			//Si el RUM ya existe
			$numExiste = buscarRUM($value['MATRI_ID'], $value['ALUMNO_RUM'], $contenidoEstudiante);
			if($numExiste > 0){
				$textoRumRepetido .= "<tr><td>".$contenidoEstudiante[$value['MATRI_ID']]['ALUMNO_RUM']."</td><td>".$contenidoEstudiante[$value['MATRI_ID']]['ALUMNO_NUM_DOCU']."</td><td>".$contenidoEstudiante[$value['MATRI_ID']]['ALUMNONOMBRE']."</td></tr>";			
				$tieneRepetido++;
			}
			if ($i != $anioInicio) {
				
			}
		}
	}

	if($tieneCero > 0){
		$textoRumCero .= "</table>";
		$mensaje .= "&#8226; <a onclick='rumCero(`".$textoRumCero."`);'>En el a&ntilde;o ".$i." se encontraron RUM sin asignar</a><br>";
		$tieneError++;
	}
	if($tieneRepetido > 0){
		$textoRumRepetido .= "</table>";
		$mensaje .= "&#8226;	<a onclick='rumRepetido(`".$textoRumRepetido."`);'>En el a&ntilde;o ".$i." se encontraron RUM repetidos</a><br>";
		$tieneError++;
	}
	
	if($tieneError > 0){
		$estiloB .= 'background: url(advertencia.png) no-repeat #000;';
		$estiloB .= 'background-position: 35px 43px;';
	}else{
		$mensaje = "&#8226; Todo Validado";
		$estiloB .= 'background: url(ok.png) no-repeat #000;';
		$estiloB .= 'background-position: 35px 43px;';
	}
	$estiloB .= '"';
	$estiloD .= '"';
	?>
	<div id="infoDetalle">
		<span id="generar" onclick="cambiarRum('<?php echo $i; ?>');" <?php echo $estiloB; ?> >RUM <?php echo $i; ?></span>
		<div id="detalle" <?php echo $estiloD; ?> > <?php echo $mensaje; ?> </div>
	</div>
	<?
	$top = $top+20;
}

?>
<div id="Mensaje" style="display: none;"><span id="cerrar" onclick="cerrar();">X</span></div>
</body>
</html>