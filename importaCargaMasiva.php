<?php
$roles_con_permiso = array('99', '6', '1', '5', '15');
include_once("inc.configuracion.php");
include_once("inc.validasesion.php");
include_once("inc.funciones.php");
include_once("conexion.php");

require_once('Connections/sygescol.php');				
mysql_select_db($database_sygescol, $sygescol);

$numEstuError = 0;
$arrayErrores = array();

$nomArchivo = explode("_", $_POST['nomArchivo']);
switch ($nomArchivo[0]) {
	case 'COMPETENCIAS':
		function codigo($grado, $asigna, $per_id, $db, $sygescol){
			mysql_select_db($db, $sygescol);
			$query_procesos = "SELECT proceso_evaluacion_banco.proeva_id, proceso_evaluacion_banco.proeva_cod, proceso_evaluacion_banco.proeva_desc, 
											proceso_evaluacion_banco.proeva_porcen 
										FROM proceso_evaluacion_banco 
										WHERE proceso_evaluacion_banco.grado_base = '".$grado."' 
											AND proceso_evaluacion_banco.per_id = '".$per_id."' 
											AND proceso_evaluacion_banco.asignatura_id = '".$asigna."' 
										ORDER BY proceso_evaluacion_banco.proeva_cod";
			$procesos = mysql_query($query_procesos, $sygescol) or die(mysql_error());
			$totalRows_procesos = mysql_num_rows($procesos);
			$totalRows_procesos += 1;
			
			return $totalRows_procesos;
		}
		$cabeceraError = "<table><tr><th>GRUPO</th><th>PERIODO</th><th>ASIGNATURA</th><th>DESCRIPOR DE LA COMPETENCIA</th></tr>";
		$numError = 0;
		for($i=1; $i<=$_POST['tot_estu']; $i++){
			if($_POST[$i.'-2'] != ""){
				$cga_id = 0;
				$grupo_id = 0;
				$sql_datos_grupo = "SELECT id_grado, nivel FROM grados WHERE nombre_grado LIKE '".$_POST[$i.'-1']."'";
				$resultado_datos_grupo = mysql_query($sql_datos_grupo, $sygescol) or die(mysql_error());
				$datos_grupo = mysql_fetch_assoc($resultado_datos_grupo);

				$selPeriodo = "SELECT * FROM periodo_fechas WHERE per_nombre LIKE  '".$_POST[$i.'-2']."' GROUP BY per_numero";
				$sqlPeriodo = mysql_query($selPeriodo, $sygescol);
				$rowPeriodo = mysql_fetch_array($sqlPeriodo);

				$sql_datos_cga = "SELECT aintrs.i AS 'asignatura_id' FROM aintrs WHERE  a LIKE  '".$_POST[$i.'-3']."'";
				$resultado_datos_cga = mysql_query($sql_datos_cga, $sygescol) or die(mysql_error());
				$datos_cga = mysql_fetch_assoc($resultado_datos_cga);
				

				$selBanco = "SELECT * FROM proceso_evaluacion_banco WHERE proeva_desc LIKE '".$_POST[$i.'-4']."' AND grado_base = '".$datos_grupo['id_grado']."' AND per_id = '".$rowPeriodo['per_numero']."'
				AND asignatura_id = '".$datos_cga['asignatura_id']."'";
				$sqlBanco = mysql_query($selBanco, $sygescol)or die(mysql_error());
				$numBanco = mysql_num_rows($sqlBanco);

				if($numBanco == 0){
					$codigo = codigo($datos_grupo['id_grado'], $datos_cga['asignatura_id'], $rowPeriodo['per_numero'], $database_sygescol, $sygescol);
					$insert = "INSERT INTO proceso_evaluacion_banco (proeva_cod, proeva_desc, dcne_id, grado_base, per_id, asignatura_id)
					VALUES ('".$codigo."', '".$_POST[$i.'-4']."', '0', '".$datos_grupo['id_grado']."', '".$rowPeriodo['per_numero']."', '".$datos_cga['asignatura_id']."')";
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
				}else{
					$cabeceraError .= "<tr><td>".$_POST[$i.'-1']."</td><td>".$_POST[$i.'-2']."</td><td>".$_POST[$i.'-3']."</td><td>".$_POST[$i.'-4']."</td></tr>";
					$numError++;
				}
			}
		}
		$cabeceraError .= "</table>";
	break;
	case 'FORTALEZAS':
		function codigo($grado, $asigna, $per_id, $tipo, $db, $sygescol){
			mysql_select_db($db, $sygescol);
			$query_procesos = "SELECT fordeb_banco.fordeb_id, fordeb_banco.fordeb_desc, fordeb_cons 
										FROM fordeb_banco 
									WHERE fordeb_banco.asignatura_id = '".$asigna."'
										AND grado_base = '".$grado."'
										AND peri_id = '".$per_id."'
										AND fordeb_banco.fordeb_tipo = '".$tipo."'
									ORDER BY fordeb_cons";
			$procesos = mysql_query($query_procesos, $sygescol) or die(mysql_error());
			$totalRows_procesos = mysql_num_rows($procesos);
			$totalRows_procesos += 1;
			
			return $totalRows_procesos;
		}
		$cabeceraError = "<table><tr><th>GRUPO</th><th>PERIODO</th><th>ASIGNATURA</th><th>DESCRIPOR DE LA FORTALEZA</th></tr>";
		$numError = 0;		
		for($i=1; $i<=$_POST['tot_estu']; $i++){
			if($_POST[$i.'-2'] != ""){
				$cga_id = 0;
				$grupo_id = 0;
				$sql_datos_grupo = "SELECT id_grado, nivel FROM grados WHERE nombre_grado LIKE '".$_POST[$i.'-1']."'";
				$resultado_datos_grupo = mysql_query($sql_datos_grupo, $sygescol) or die(mysql_error());
				$datos_grupo = mysql_fetch_assoc($resultado_datos_grupo);

				$selPeriodo = "SELECT * FROM periodo_fechas WHERE per_nombre LIKE  '".$_POST[$i.'-2']."' GROUP BY per_numero";
				$sqlPeriodo = mysql_query($selPeriodo, $sygescol);
				$rowPeriodo = mysql_fetch_array($sqlPeriodo);

				$sql_datos_cga = "SELECT aintrs.i AS 'asignatura_id' FROM aintrs WHERE  a LIKE  '".$_POST[$i.'-3']."'";
				$resultado_datos_cga = mysql_query($sql_datos_cga, $sygescol) or die(mysql_error());
				$datos_cga = mysql_fetch_assoc($resultado_datos_cga);

				$selBanco = "SELECT * FROM fordeb_banco WHERE fordeb_desc LIKE '".$_POST[$i.'-4']."' AND grado_base = '".$datos_grupo['id_grado']."' AND peri_id = '".$rowPeriodo['per_numero']."'
				AND asignatura_id = '".$datos_cga['asignatura_id']."' AND fordeb_tipo = 'F'";
				$sqlBanco = mysql_query($selBanco, $sygescol)or die(mysql_error());
				$numBanco = mysql_num_rows($sqlBanco);
				if($numBanco == 0){
					$codigo = codigo($datos_grupo['id_grado'], $datos_cga['asignatura_id'], $rowPeriodo['per_numero'],'F', $database_sygescol, $sygescol);
					$insert = "INSERT INTO fordeb_banco (fordeb_cons, fordeb_desc, dcne_id, grado_base, peri_id, asignatura_id, fordeb_tipo)
										VALUES ('".$codigo."', '".$_POST[$i.'-4']."', '0', '".$datos_grupo['id_grado']."', '".$rowPeriodo['per_numero']."', '".$datos_cga['asignatura_id']."', 'F')";
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
				}else{
					$cabeceraError .= "<tr><td>".$_POST[$i.'-1']."</td><td>".$_POST[$i.'-2']."</td><td>".$_POST[$i.'-3']."</td><td>".$_POST[$i.'-4']."</td></tr>";
					$numError++;
				}
			}
		}
	break;
	case 'DEBILIDADES':
		function codigo($grado, $asigna, $per_id, $tipo, $db, $sygescol){
			mysql_select_db($db, $sygescol);
			$query_procesos = "SELECT fordeb_banco.fordeb_id, fordeb_banco.fordeb_desc, fordeb_cons 
										FROM fordeb_banco 
									WHERE fordeb_banco.asignatura_id = '".$asigna."'
										AND grado_base = '".$grado."'
										AND peri_id = '".$per_id."'
										AND fordeb_banco.fordeb_tipo = '".$tipo."'
									ORDER BY fordeb_cons";
			$procesos = mysql_query($query_procesos, $sygescol) or die(mysql_error());
			$totalRows_procesos = mysql_num_rows($procesos);
			$totalRows_procesos += 1;
			
			return $totalRows_procesos;
		}
		$cabeceraError = "<table><tr><th>GRUPO</th><th>PERIODO</th><th>ASIGNATURA</th><th>DESCRIPOR DE LA DEBILIDAD</th></tr>";
		$numError = 0;		
		for($i=1; $i<=$_POST['tot_estu']; $i++){
			if($_POST[$i.'-2'] != ""){
				$cga_id = 0;
				$grupo_id = 0;
				$sql_datos_grupo = "SELECT id_grado, nivel FROM grados WHERE nombre_grado LIKE '".$_POST[$i.'-1']."'";
				$resultado_datos_grupo = mysql_query($sql_datos_grupo, $sygescol) or die(mysql_error());
				$datos_grupo = mysql_fetch_assoc($resultado_datos_grupo);

				$selPeriodo = "SELECT * FROM periodo_fechas WHERE per_nombre LIKE  '".$_POST[$i.'-2']."' GROUP BY per_numero";
				$sqlPeriodo = mysql_query($selPeriodo, $sygescol);
				$rowPeriodo = mysql_fetch_array($sqlPeriodo);

				$sql_datos_cga = "SELECT aintrs.i AS 'asignatura_id' FROM aintrs WHERE  a LIKE  '".$_POST[$i.'-3']."'";
				$resultado_datos_cga = mysql_query($sql_datos_cga, $sygescol) or die(mysql_error());
				$datos_cga = mysql_fetch_assoc($resultado_datos_cga);

				$selBanco = "SELECT * FROM fordeb_banco WHERE fordeb_desc LIKE '".$_POST[$i.'-4']."' AND grado_base = '".$datos_grupo['id_grado']."' AND peri_id = '".$rowPeriodo['per_numero']."'
				AND asignatura_id = '".$datos_cga['asignatura_id']."' AND fordeb_tipo = 'D'";
				$sqlBanco = mysql_query($selBanco, $sygescol)or die(mysql_error());
				$numBanco = mysql_num_rows($sqlBanco);
				if($numBanco == 0){
					$codigo = codigo($datos_grupo['id_grado'], $datos_cga['asignatura_id'], $rowPeriodo['per_numero'],'D', $database_sygescol, $sygescol);
					$insert = "INSERT INTO fordeb_banco (fordeb_cons, fordeb_desc, dcne_id, grado_base, peri_id, asignatura_id, fordeb_tipo)
										VALUES ('".$codigo."', '".$_POST[$i.'-4']."', '0', '".$datos_grupo['id_grado']."', '".$rowPeriodo['per_numero']."', '".$datos_cga['asignatura_id']."', 'D')";
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
				}else{
					$cabeceraError .= "<tr><td>".$_POST[$i.'-1']."</td><td>".$_POST[$i.'-2']."</td><td>".$_POST[$i.'-3']."</td><td>".$_POST[$i.'-4']."</td></tr>";
					$numError++;
				}
			}
		}
	break;
	case 'RECOMENDACIONES':
		function codigo($grado, $asigna, $per_id, $tipo, $db, $sygescol){
			mysql_select_db($db, $sygescol);
			$query_procesos = "SELECT fordeb_banco.fordeb_id, fordeb_banco.fordeb_desc, fordeb_cons 
										FROM fordeb_banco 
									WHERE fordeb_banco.asignatura_id = '".$asigna."'
										AND grado_base = '".$grado."'
										AND peri_id = '".$per_id."'
										AND fordeb_banco.fordeb_tipo = '".$tipo."'
									ORDER BY fordeb_cons";
			$procesos = mysql_query($query_procesos, $sygescol) or die(mysql_error());
			$totalRows_procesos = mysql_num_rows($procesos);
			$totalRows_procesos += 1;
			
			return $totalRows_procesos;
		}
		$cabeceraError = "<table><tr><th>GRUPO</th><th>PERIODO</th><th>ASIGNATURA</th><th>DESCRIPOR DE LA RECOMENDACION</th></tr>";
		$numError = 0;		
		for($i=1; $i<=$_POST['tot_estu']; $i++){
			if($_POST[$i.'-2'] != ""){
				$cga_id = 0;
				$grupo_id = 0;
				$sql_datos_grupo = "SELECT id_grado, nivel FROM grados WHERE nombre_grado LIKE '".$_POST[$i.'-1']."'";
				$resultado_datos_grupo = mysql_query($sql_datos_grupo, $sygescol) or die(mysql_error());
				$datos_grupo = mysql_fetch_assoc($resultado_datos_grupo);

				$selPeriodo = "SELECT * FROM periodo_fechas WHERE per_nombre LIKE  '".$_POST[$i.'-2']."' GROUP BY per_numero";
				$sqlPeriodo = mysql_query($selPeriodo, $sygescol);
				$rowPeriodo = mysql_fetch_array($sqlPeriodo);

				$sql_datos_cga = "SELECT aintrs.i AS 'asignatura_id' FROM aintrs WHERE  a LIKE  '".$_POST[$i.'-3']."'";
				$resultado_datos_cga = mysql_query($sql_datos_cga, $sygescol) or die(mysql_error());
				$datos_cga = mysql_fetch_assoc($resultado_datos_cga);

				$selBanco = "SELECT * FROM fordeb_banco WHERE fordeb_desc LIKE '".$_POST[$i.'-4']."' AND grado_base = '".$datos_grupo['id_grado']."' AND peri_id = '".$rowPeriodo['per_numero']."'
				AND asignatura_id = '".$datos_cga['asignatura_id']."' AND fordeb_tipo = 'R'";
				$sqlBanco = mysql_query($selBanco, $sygescol)or die(mysql_error());
				$numBanco = mysql_num_rows($sqlBanco);
				if($numBanco == 0){
					$codigo = codigo($datos_grupo['id_grado'], $datos_cga['asignatura_id'], $rowPeriodo['per_numero'],'R', $database_sygescol, $sygescol);
					$insert = "INSERT INTO fordeb_banco (fordeb_cons, fordeb_desc, dcne_id, grado_base, peri_id, asignatura_id, fordeb_tipo)
										VALUES ('".$codigo."', '".$_POST[$i.'-4']."', '0', '".$datos_grupo['id_grado']."', '".$rowPeriodo['per_numero']."', '".$datos_cga['asignatura_id']."', 'R')";
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
				}else{
					$cabeceraError .= "<tr><td>".$_POST[$i.'-1']."</td><td>".$_POST[$i.'-2']."</td><td>".$_POST[$i.'-3']."</td><td>".$_POST[$i.'-4']."</td></tr>";
					$numError++;
				}
			}
		}
	break;
	case 'ESTUDIANTES':
		$cabeceraError = "<table><tr><th>PRIMER_APELLIDO</th><th>SEGUNDO_APELLIDO</th><th>PRIMER_NOMBRE</th><th>SEGUNDO_NOMBRE</th><th>TIPO_DOCU</th><th>NUMERO_DOCUMENTO</th><th>RUM</th></tr>";
		$numError = 0;
		$contador = 10000;
		for($i=1; $i<=$_POST['tot_estu']; $i++){
			$contador++;


			if($_POST[$i.'-1'] != ""){
				$cga_id = 0;
				$grupo_id = 0;
				$sql_datos_grupo = "SELECT id,nombre FROM tipo_docum WHERE nombre LIKE '".$_POST[$i.'-5']."'";
				$resultado_datos_grupo = mysql_query($sql_datos_grupo, $sygescol) or die(mysql_error());
				$datos_grupo = mysql_fetch_assoc($resultado_datos_grupo);

				$selBanco = "SELECT * FROM alumno WHERE alumno_ape1 LIKE '".$_POST[$i.'-1']."' AND alumno_ape2 LIKE '".$_POST[$i.'-2']."' AND alumno_nom1 LIKE '".$_POST[$i.'-3']."' AND alumno_nom2 LIKE '".$_POST[$i.'-4']."' AND alumno_num_docu LIKE '".$_POST[$i.'-6']."'AND alumno_rum LIKE '".$_POST[$i.'-7']."'";
				$sqlBanco = mysql_query($selBanco, $sygescol)or die(mysql_error());
				$numBanco = mysql_num_rows($sqlBanco);
				if($numBanco == 0){


if ($_POST[$i.'-7'] > 0) {
	# code...

					$insert = "INSERT INTO alumno (alumno_ape1, alumno_ape2, alumno_nom1, alumno_nom2, tipo_docu_id, alumno_num_docu, alumno_rum)
					VALUES ('".$_POST[$i.'-1']."', '".$_POST[$i.'-2']."', '".$_POST[$i.'-3']."', '".$_POST[$i.'-4']."', '".$datos_grupo['id']."', '".$_POST[$i.'-6']."', '".$_POST[$i.'-7']."')";
					/*echo $_POST[$i.'-7'].'<br>';
					echo $insert.'<br>';*/
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
					$numBanco2 = mysql_num_rows($sql_insert);

				$selBanco1 = "SELECT * FROM alumno WHERE alumno_num_docu LIKE '".$_POST[$i.'-6']."'";
				$sqlBanco1 = mysql_query($selBanco1, $sygescol)or die(mysql_error());
				$numBanco1 = mysql_num_rows($sqlBanco1);
				$datos_grupo1 = mysql_fetch_assoc($sqlBanco1);


}
else {
	# code...

					$insert = "INSERT INTO alumno (alumno_ape1, alumno_ape2, alumno_nom1, alumno_nom2, tipo_docu_id, alumno_num_docu, alumno_rum)
					VALUES ('".$_POST[$i.'-1']."', '".$_POST[$i.'-2']."', '".$_POST[$i.'-3']."', '".$_POST[$i.'-4']."', '".$datos_grupo['id']."', '".$_POST[$i.'-6']."', '".$contador."')";
					/*echo $_POST[$i.'-7'].'<br>';
					echo $insert.'<br>';*/
					$sql_insert = mysql_query($insert, $sygescol)or die(mysql_error());
					$numBanco2 = mysql_num_rows($sql_insert);

				$selBanco1 = "SELECT * FROM alumno WHERE alumno_num_docu LIKE '".$_POST[$i.'-6']."'";
				$sqlBanco1 = mysql_query($selBanco1, $sygescol)or die(mysql_error());
				$numBanco1 = mysql_num_rows($sqlBanco1);
				$datos_grupo1 = mysql_fetch_assoc($sqlBanco1);


}

				if ($numBanco1>0){
/*
					$inserts = "INSERT INTO matricula (alumno_id, matri_anyo, matri_fecha, sede_id, grado_id, grupo_id)
					VALUES ( '".$datos_grupo1['alumno_id']."', '2016', '2016-01-18', '".$_POST[$i.'-7']."', '".$_POST[$i.'-8']."', '".$_POST[$i.'-9']."')";
					$sql_inserts = mysql_query($inserts, $sygescol)or die(mysql_error());
*/
					}
				   

				}else{
					$cabeceraError .= "<tr><td>".$_POST[$i.'-1']."</td><td>".$_POST[$i.'-2']."</td><td>".$_POST[$i.'-3']."</td><td>".$_POST[$i.'-4']."</td><td>".$_POST[$i.'-5']."</td><td>".$_POST[$i.'-6']."</td><td>".$_POST[$i.'-7']."</td></tr>";
					$numError++;
				}
			}
		}
	break;		
	default:
		$error =  "no se ha definido bien el nombre del archivo";
	break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://www.interaktonline.com/MXWidgets">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $nombre_sistema;?></title>
<script type="text/javascript" src="js/mootools.js"></script>
<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.Estilo1 {
	color: #007700;
	font-weight: bold;
}
.Estilo2 {color: #007700}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
}

.curved {
   	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	behavior:url(border-radius.htc);
}

#alert {
	width: 250px;
	background-color: #A0C7F1;
	border: #A0C7F1 solid 1px;
	clear: both;
	float: left;
}

#testimonials{
	width: 375px;
	padding: 6px 45px 6px 50px;
	background:url('images/iconos/quotes.gif') no-repeat 20px 20px rgba(51,153,255,0.9);
	min-height:90px;
	
	-moz-border-radius:12px;
	-webkit-border-radius:12px;
	border-radius:12px;	
	
}

#testimonials li{ display:none;}
#testimonials li:first-child{ display:block;}

#testimonials ul{ list-style:none;}
#testimonials p.text{ font-size:30px;}

#testimonials p.author{
	color: #878787;
    font-size: 14px;
    font-style: italic;
    text-align: right;
	margin-top:18px;
}

#testimonials a,
#testimonials a:visited{
	color: #FFFFFF;
}

.eventList li{
 /* The individual events */
 background:#CADDFF;
 border:8px solid rgba(0,0,0,0.3);
 list-style:none;
 margin:5px;
 padding:4px 7px;
 

 /* CSS3 rounded corners */
 -moz-border-radius:10px;
 -webkit-border-radius:10px;
 border-radius:10px;
}
.eventList li:hover{
 /* The hover state: */
 cursor:pointer;
 background:#9DBDFF;
 border:8px solid rgba(0,0,0,0.3);

} 
li.news span.icon { 	background:url(img/icons/newspaper.png) no-repeat; }
li.image span.icon { 	background:url(img/icons/camera.png) no-repeat; }
li.milestone span.icon { 	background:url(img/icons/chart.png) no-repeat; }

-->

/*ESTILO REPORTE*/
.tablaSyge {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 0px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.tablaSyge table{
    border-collapse: collapse;
	border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.tablaSyge tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.tablaSyge table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.tablaSyge table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.tablaSyge tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.tablaSyge tr:hover td{
	
}
.tablaSyge tr:nth-child(odd){ background-color:#aad4ff; }
.tablaSyge tr:nth-child(even)    { background-color:#ffffff; }.tablaSyge td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:14px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.tablaSyge tr:last-child td{
	border-width:0px 1px 0px 0px;
}.tablaSyge tr td:last-child{
	border-width:0px 0px 1px 0px;
}.tablaSyge tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.tablaSyge tr:first-child td{
		background:-o-linear-gradient(bottom, #3399ff 5%, #2969aa 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3399ff), color-stop(1, #61A9F2) );
	background:-moz-linear-gradient( center top, #3399ff 5%, #2969aa 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#3399ff", endColorstr="#2969aa");	background: -o-linear-gradient(top,#3399ff,2969aa);

	background-color:#3399ff;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Helvetica;
	font-weight:bold;
	color:#ffffff;
}
.tablaSyge tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #3399ff 5%, #2969aa 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3399ff), color-stop(1, #2969aa) );
	background:-moz-linear-gradient( center top, #3399ff 5%, #2969aa 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#3399ff", endColorstr="#2969aa");	background: -o-linear-gradient(top,#3399ff,2969aa);

	background-color:#3399ff;
}
.tablaSyge tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.tablaSyge tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>

</head>
<body id="cuerpo">
<?php include_once("inc.header.php");
$excel = "";
?>
<table align="center" width="<?php echo $ancho_plantilla; ?>" class="centro" cellpadding="10">
<tr>
<th scope="col" colspan="1" class="centro">PROCESO DE INSERCI&Oacute;N DE DATOS  </th>
</tr>
<tr>
  	<td align="center">
	    <!-- <div class="tablaSyge" >
			<table >
				<tr><td>RUM</td><td>No DOCUMENTO</td><td>APELLIDO 1</td><td>APELLIDO 2</td><td>NOMBRE 1</td><td>NOMBRE 2</td><td>DETALLE</td></tr>
				<?php 
				$excel = "RUM\tNo DOCUMENTO\tAPELLIDO 1\tAPELLIDO2\tNOMBRE1\tNOMBRE2\tDETALLE\n";
				if($numEstuError>0 AND 1==3){
					for ($i=0; $i < $numEstuError; $i++) { 
						?>
						<tr>
							<td><?php echo utf8_decode($arrayErrores[$i]['RUM']); ?></td>
							<td><?php echo utf8_decode($arrayErrores[$i]['DOCUMENTO']); ?></td>				
							<td><?php echo utf8_decode($arrayErrores[$i]['APELLIDO1']); ?></td>
							<td><?php echo utf8_decode($arrayErrores[$i]['APELLIDO2']); ?></td>
							<td><?php echo utf8_decode($arrayErrores[$i]['NOMBRE1']); ?></td>
							<td><?php echo utf8_decode($arrayErrores[$i]['NOMBRE2']); ?></td>
							<td><?php echo utf8_decode($arrayErrores[$i]['DETALLE']); ?></td>
							<?php 
							$excel.= utf8_decode($arrayErrores[$i]['RUM'])."\t".utf8_decode($arrayErrores[$i]['DOCUMENTO'])."\t".utf8_decode($arrayErrores[$i]['APELLIDO1'])."\t".utf8_decode($arrayErrores[$i]['APELLIDO2'])."\t".utf8_decode($arrayErrores[$i]['NOMBRE1'])."\t".utf8_decode($arrayErrores[$i]['NOMBRE2'])."\t".utf8_decode($arrayErrores[$i]['DETALLE'])."\n";
							?>
						</tr>
						<?php
					}
				} ?>
			</table>
		</div> -->
            
	     <ul class="eventList" style="width:100%;">
			<li class="news">
				<?php 
				if($numError > 0){
					?>
					<h3><strong>LA SIGUIENTE INFORMACION YA SE ENCONTRABA EN BASE DE DATOS</strong></h3>
					<?php
					echo $cabeceraError;
				}else{
					?>
					<strong><h3>Se ha ingresado correctamente los datos.</h3></strong>
					<?php
				}
				?>
			</li>
		</ul> 
		<!-- <form action="enviaExcel.php" method="post"  name="cargar_archivo" >
			<input type="hidden" value="<?php echo $excel; ?>" name="exportar">
			<input type="hidden" value="<?php echo $excel; ?>" name="nombreArchivo">
			<input type="submit" value="Excel">
		</form> -->
		<input name="atras" style="margin-top: 20px;" value="Volver" onclick="document.location ='cargaMasiva.php'" type="button" />
	</td>
</tr>
<tr>
<th class="footer">
<?php include_once("inc.footer.php");?>
</th>
</tr>
</table></body>
</html>