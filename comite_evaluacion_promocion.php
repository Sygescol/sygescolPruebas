<?php  
//Este archivo permite a los docentes visualizar la información de sus asignaturas, como van a 















$roles_con_permiso = array('99', '6', '1', '2', '5', '8', '13', '3');



include_once("inc.configuracion.php");



include_once("inc.validasesion.php");



include_once("inc.funciones.php");



include_once("conexion.php");















//Conexión a la base de datos















$link = conectarse();















mysql_select_db($database_sygescol,$link);











if(isset($_GET) && count($_GET) > 1)















{



	$_POST = $_GET;



	$selParametro = "SELECT * FROM  conf_sygescol WHERE  conf_id = '$_POST[nop]'";



	$sqlParametro = mysql_query($selParametro, $link);



	$rowParametro = mysql_fetch_array($sqlParametro);



	$valoresParametro = explode("$", $rowParametro['conf_valor']);



}































if(isset($_POST['ingIntegrante']))

{

$selParametro1 = "SELECT c
FROM  `conf_sygescol` 
WHERE  `conf_id` =98";
	$sqlParametro1 = mysql_query($selParametro1, $link);
	$rowParametro1 = mysql_fetch_array($sqlParametro1);

  $array_parametroo2 = explode(",",$_POST['gruposVar']);
    $array_parametroo3 = explode(",",$_POST['gruposVar01']);
      $array_parametroo4 = explode(",",$_POST['gruposVar02']);
    $array_parametroo5 = explode(",",$_POST['gruposVar03']);
        $array_parametroo6 = explode(",",$_POST['gruposVar04']);
 $varr04=count($array_parametroo6);
 $varr03=count($array_parametroo5);
$varr02=count($array_parametroo4);
$varr01=count($array_parametroo3);
$varr=count($array_parametroo2);
 //echo $proyecion_cupos_1.'_'.$proyecion_cupos_2;
for ($i=0; $i <= $varr-2; $i++) { 
	$query_sedes121 = "SELECT grupo_nombre, gao_id FROM v_grupos where v_grupos.grupo_id = '".$array_parametroo2[$i]."'";
$sedes121 = mysql_query($query_sedes121, $link) or die(mysql_error());
  $row_sedes123 = mysql_fetch_array($sedes121);
for ($i2=0; $i2 <= $varr01-2; $i2++) { 
    $sql_registrar_integrante = "INSERT INTO com_eval_prom (id_grado,grupo_nombre, comision, cep_tipo, cep_integrante_id, cep_estado, grupos_ids, tipo) 
	VALUES ('".$row_sedes123['gao_id']."','".$row_sedes123['grupo_nombre']."','".$_POST['reporte']."','A', ".$array_parametroo3[$i2].", ".$array_parametroo2[$i].", '".$array_parametroo2[$i]."', '98') ";
	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link);
	//echo $sql_registrar_integrante.'<br>'; 
}
for ($i3=0; $i3 <= $varr02-2; $i3++) { 
    $sql_registrar_integrante = "INSERT INTO com_eval_prom (id_grado,grupo_nombre, comision, cep_tipo, cep_integrante_id, cep_estado, grupos_ids, tipo) 
	VALUES ('".$row_sedes123['gao_id']."','".$row_sedes123['grupo_nombre']."','".$_POST['reporte']."','D', ".$array_parametroo4[$i3].", ".$array_parametroo2[$i].", '".$array_parametroo2[$i]."', '98') ";
	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link);
	//echo $sql_registrar_integrante.'<br>'; 
}
for ($i4=0; $i4 <= $varr03-2; $i4++) { 
    $sql_registrar_integrante = "INSERT INTO com_eval_prom (id_grado,grupo_nombre, comision, cep_tipo, cep_integrante_id, cep_estado, grupos_ids, tipo) 
	VALUES ('".$row_sedes123['gao_id']."','".$row_sedes123['grupo_nombre']."','".$_POST['reporte']."','E', ".$array_parametroo5[$i4].", ".$array_parametroo2[$i].", '".$array_parametroo2[$i]."', '98') ";
	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link);
	//echo $sql_registrar_integrante.'<br>'; 
}
for ($i5=0; $i5 <= $varr04-2; $i5++) { 
    $sql_registrar_integrante = "INSERT INTO com_eval_prom (id_grado,grupo_nombre, comision, cep_tipo, cep_integrante_id, cep_estado, grupos_ids, tipo) 
	VALUES ('".$row_sedes123['gao_id']."','".$row_sedes123['grupo_nombre']."','".$_POST['reporte']."','P', ".$array_parametroo6[$i5].", ".$array_parametroo2[$i].", '".$array_parametroo2[$i]."', '98') ";
	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link);
	//echo $sql_registrar_integrante.'<br>'; 
}

}
header("Location: comite_evaluacion_promocion.php?per_id=&nop=98&grupo_id=&ver_procesos=1");








if ($_POST['nop'] == 146) {



$query_sedes12 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes ORDER BY sedes.sede_nombre";



$sedes12 = mysql_query($query_sedes12, $link) or die(mysql_error());



 $rows12 = mysql_num_rows($sedes12);



  if($rows12 > 0) {



      mysql_data_seek($sedes12, 0);



	  $row_sedes3 = mysql_fetch_array($sedes12);



  }



	while($row_sedes3 = mysql_fetch_array($sedes12)){



				$sel_grupos1 = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes3[sede_consecutivo]."  ORDER BY a";



				$sql_grupos11 = mysql_query($sel_grupos1, $link)or die("No se pudo consultar los grupossssssss");



				$row_sedes4 = mysql_fetch_array($sql_grupos11);







}



if ($_POST['integrante'] != '') {







   $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','P', ".$_POST['integrante'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 







}



if ($_POST['integrante1'] != '') {



	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','E', ".$_POST['integrante1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}







if ($_POST['sede1'] != '') {



	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','D', ".$_POST['sede1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}



if ($_POST['1sede'] != '') {







	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','A', ".$_POST['1sede'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}



	header("Location: comite_evaluacion_promocion.php?per_id=&nop=146&grupo_id=&ver_procesos=1");















}















if ($_POST['nop'] == 144) {



$query_sedes12 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes ORDER BY sedes.sede_nombre";



$sedes12 = mysql_query($query_sedes12, $link) or die(mysql_error());



 $rows12 = mysql_num_rows($sedes12);



  if($rows12 > 0) {



      mysql_data_seek($sedes12, 0);



	  $row_sedes3 = mysql_fetch_array($sedes12);



  }



	while($row_sedes3 = mysql_fetch_array($sedes12)){



				$sel_grupos1 = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes3[sede_consecutivo]."  ORDER BY a";



				$sql_grupos11 = mysql_query($sel_grupos1, $link)or die("No se pudo consultar los grupossssssss");



				$row_sedes4 = mysql_fetch_array($sql_grupos11);







}







if ($_POST['integrante'] != '') {



   $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','P', ".$_POST['integrante'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}







if ($_POST['integrante1'] != '') {



	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','E', ".$_POST['integrante1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 







}if ($_POST['sede1'] != '') {







	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','D', ".$_POST['sede1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}if ($_POST['1sede'] != '') {











	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','A', ".$_POST['1sede'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}



header("Location: comite_evaluacion_promocion.php?per_id=&nop=144&grupo_id=&ver_procesos=1");











}



















if ($_POST['nop'] == 147) {



$query_sedes12 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes ORDER BY sedes.sede_nombre";



$sedes12 = mysql_query($query_sedes12, $link) or die(mysql_error());



 $rows12 = mysql_num_rows($sedes12);



  if($rows12 > 0) {



      mysql_data_seek($sedes12, 0);



	  $row_sedes3 = mysql_fetch_array($sedes12);



  }



	while($row_sedes3 = mysql_fetch_array($sedes12)){



				$sel_grupos1 = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes3[sede_consecutivo]."  ORDER BY a";



				$sql_grupos11 = mysql_query($sel_grupos1, $link)or die("No se pudo consultar los grupossssssss");



				$row_sedes4 = mysql_fetch_array($sql_grupos11);







}







if ($_POST['integrante'] != '') {



   $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','P', ".$_POST['integrante'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 







}if ($_POST['integrante1'] != '') {







	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','E', ".$_POST['integrante1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 







}if ($_POST['sede1'] != '') {







	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','D', ".$_POST['sede1'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 



}if ($_POST['1sede'] != '') {











	    $sql_registrar_integrante = "INSERT INTO com_eval_prom (comision, cep_tipo, cep_integrante_id, cep_estado, id_grado, tipo) 



	VALUES ('".$_POST['grado1']."','A', ".$_POST['1sede'].", ".$_POST['sede'].", '1', ".$_POST['nop'].") ";



	$resultado_registrar_integrante = mysql_query($sql_registrar_integrante, $link) or die ("No se pudo registrar el integrante del comité " . $sql_registrar_integrante);



	//echo $sql_registrar_integrante.'<br>'; 







}







header("Location: comite_evaluacion_promocion.php?per_id=&nop=147&grupo_id=&ver_procesos=1");











}































}































































































































 















































































































	















if(isset($_GET['borrar']) && isset($_GET['cep_id']))















{















	$sql_borrar_integrante = "DELETE FROM com_eval_prom WHERE cep_id = " . $_GET['cep_id'];















	$resultado_borrar_integrante = mysql_query($sql_borrar_integrante, $link) or die ("No se pudo eliminar el integrante del comite");















}































if ($_POST[nop] == 0 || $_POST[nop] == '') {















	$whereTipo = "1=3";















}else{















	$whereTipo = "com_eval_prom.tipo = '$_POST[nop]'";















}















































//Consultamos los integrantes del comité















$sql_integrantes_comite = "SELECT CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre, 



dcne.dcne_num_docu as documento, com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre,  gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM dcne, com_eval_prom, gao, jraa 



WHERE dcne.i = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'D' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



UNION



SELECT CONCAT(acu_apellido1, ' ', acu_apellido2, ' ', acu_nombre1, ' ', acu_nombre2) as nombre, acu_num_docu as documento, com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre, 



gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM acudiente, com_eval_prom, gao, jraa



WHERE acu_id = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'P' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



UNION



SELECT admco.nombre, admco.documento, com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre, 



gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM admco, com_eval_prom, gao, jraa 



WHERE CONCAT(admco.id,'01') = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'A' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



UNION



SELECT admco.nombre, admco.documento, com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre, 



gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM admco, com_eval_prom, gao, jraa 



WHERE CONCAT(admco.id,'02') = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'A' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



UNION



SELECT CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre, 



dcne.dcne_num_docu as documento, com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre, gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM dcne, com_eval_prom, gao, jraa 



WHERE CONCAT(dcne.i,'03') = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'A' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



UNION 



SELECT concat(alumno_ape1,' ',alumno_ape2 ,' ',alumno_nom1,' ',alumno_nom2 ) as nombre, alumno_num_docu as documento, 



com_eval_prom.cep_id, com_eval_prom.comision, com_eval_prom.grupo_nombre, gao.b as grado, com_eval_prom.cep_tipo, gao.a as gradito, jraa.b as jornada, gao.semestre, cep_estado



FROM alumno INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id), com_eval_prom, gao, jraa



WHERE matri_id = com_eval_prom.cep_integrante_id AND com_eval_prom.cep_tipo = 'E' AND id_grado = gao.i AND gao.g = jraa.i AND $whereTipo



ORDER BY cep_estado, gradito, jornada, cep_tipo";



$resultado_integrantes_comite = mysql_query($sql_integrantes_comite, $link) or die ("No se pudo consultar los integrantes del comite " . $sql_integrantes_comite);



$num_integrantes_comite = mysql_num_rows($resultado_integrantes_comite);



















/////////////////////////////////////////////////////Nueva Consulta Luis ////////////////////////////////////////////////////////////////////////////////////////







/////////////////////////////////////////////////////Nueva Consulta Luis ////////////////////////////////////////////////////////////////////////////////////////







$query_sedes = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes ORDER BY sedes.sede_nombre";



$sedes = mysql_query($query_sedes, $link) or die(mysql_error());











$query_sedes1 = "SELECT DISTINCT dcne.i as id, CONCAT(dcne_ape1, ' ', dcne_ape2, ' ', dcne_nom1, ' ', dcne_nom2) as nombre 



		FROM dcne, cga



		WHERE dcne.i = cga.g



		ORDER BY nombre";



$sedes1 = mysql_query($query_sedes1, $link) or die(mysql_error());



























$sql_integrantes111 = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%rector%' ORDER BY nombre";



$sedes1234 = mysql_query($sql_integrantes111, $link) or die(mysql_error());



$sql_integrantesCor5656 = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%COORDI%' ORDER BY nombre";	



		$resultado_integrantesCor5656 = mysql_query($sql_integrantesCor5656, $link) or die("No se pudo consultar los integrantes");







/*



$row_sedes = mysql_fetch_assoc($sedes);



$totalRows_sedes = mysql_num_rows($sedes);



*/



$integrantes = '';



while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



{



	$integrantes .= ',' . $integrantes_comite['cep_docente_id'];



}



$integrantes = trim($integrantes,',');



if($integrantes == '')



{



	$integrantes = 0;



}



// Nuevo



//Nuevo



//Consultamos los grados 



/*







$sql_grupos = "SELECT DISTINCT jraa.b as 'jornada', gao.b as 'grado', gao.i as codigo, gao.semestre, gao.a



FROM gao, jraa



WHERE gao.g = jraa.i ORDER BY jraa.b, gao.ba";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



*/



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title><?php echo $nombre_sistema; ?></title>



<!--  Nuevo -->



<script type="text/javascript" src="js/mootools.js"></script>



<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>



<script type="text/javascript" src="js/utilidades.js"></script>



<script type="text/javascript" src="js/mootools.js"></script>



<script type="text/javascript" src="js/mootools/multipleselect.js"></script>



<script type='text/javascript' src='js/mootools/libs/mootoolsmore.lib.js'></script>



<script type="text/javascript" src="js/jquery/jquery-1.4.min.js"></script>



<script type="text/javascript" src="js/jquery/jquery-ui.js"></script>



<link href="js/jquery/mobiscroll-2.1-beta.custom.min.css" rel="stylesheet" type="text/css" />



<script src="js/jquery/mobiscroll-2.1-beta.custom.min.js" type="text/javascript"></script>



<link rel="stylesheet" href="js/mootools/multipleselect_demo.css">



<?php 



mysql_data_seek($sedes, 0);



while($row_grupo2 = mysql_fetch_array($sedes)){



	echo "<script>document.addEvent('domready', function() { new MultipleSelect('grupo_'+".$row_grupo2['sede_consecutivo'].")  });</script>";



}



mysql_data_seek($sedes, 0);



?>



<script type="text/javascript">



   function mostrarGrupo(valorSede){



		element = document.getElementById("sede");



		for(var i = 0; i < element.options.length; i++){



			if(element.options[i].value != valorSede && element.options[i].value != 0){



				document.getElementById("divgrupo_"+element.options[i].value).style.display='none';



			}



		}



		document.getElementById("divgrupo_"+valorSede).style.display='block';



   }



 </script>



<script type="text/javascript">



function validaFormulario1(formulario)



{		



	var grupo = new Array();



	grupo = document.getElementById('grupo_' + formulario.sede.value);



	var varios_grupos = "";



	for(y=0; y < grupo.length; y++)



	{  



		clase = document.getElementById("grupo"+formulario.sede.value+"[]_"+y).className;



		if(clase == "selected"){



			varios_grupos += grupo[y].value+".";



		}



	}



	document.getElementById("gruposVar").value=varios_grupos;



	if(formulario.coordinador.value == '')



	{



		alert("Por favor seleccione el coordinador");



		formulario.coordinador.focus();



		return false;



	}



	if(formulario.sede.value == '')



	{



		alert("Por favor seleccione la sede");



		formulario.sede.focus();



		return false;



	}



return true;



}



</script>



<script language="javascript">



	var Jq = jQuery.noConflict();



	Jq(document).ready(function() {



		Jq('#hora_ini, #hora_fin').scroller({



			preset: 'time',



			theme: 'ios',



			display: 'bubble',       		



			mode: 'clickpick',



			stepMinute : 5



		});



	});



</script>



<!--  Nuevo -->



<script type="text/javascript">



function carga_tipo(independiente1, sede, independiente2, dependiente, destino1, destino2)



{/*



	if($(independiente1).value == 'D')



	{



		$(destino1).set('html','Docente:');



	}



	if($(independiente1).value == 'P')



	{



		$(destino1).set('html','Padre de Familia:');



	}



	if($(independiente1).value == 'A')



	{



		$(destino1).set('html','Directivo o Delegado:');



	}



	if($(independiente1).value == 'E')



	{



		$(destino1).set('html','Estudiante:');



	}



	*/



	// Variables de configuración  



	var proceso = 'proceso_carga_tipo_integrante.php';



	var variables = 'tipo=' + $(independiente1).get('value') + '&sede=' + $(sede).get('value')  + '&id_grado=' + $(independiente2).get('value')  + '&dependiente=' + dependiente;



	//Objeto que realiza la petición



    var nuevoRequest = new Request({



		method: 'get',



		url: proceso,



		onRequest: function() {



			$(destino2).set('html','Cargando...');



		 },



         onSuccess: function(texto, xmlrespuesta){ $(destino2).set('html',texto);},



         onFailure: function(){



		 	$(destino2).set('html','');



		 	alert('Ocurrio un error y no se pudo cargar la información,\npor favor intentelo nuevamente');



		 }



      });



	  nuevoRequest.send(variables);



}



function cargagrado(independiente1, grado, campoGrado)



{



	// Variables de configuración  



	var proceso = 'proceso_carga_grados_acta.php';



	var variables = 'col=' + $(independiente1).get('value');



	//Objeto que realiza la petición



    var nuevoRequest = new Request({



		method: 'get',



		url: proceso,



		onRequest: function() {



			$(campoGrado).set('html','Cargando...');



		 },



         onSuccess: function(texto, xmlrespuesta){ $(campoGrado).set('html',texto);},



         onFailure: function(){



		 	$(campoGrado).set('html','');



		 	alert('Ocurrio un error y no se pudo cargar la información,\npor favor intentelo nuevamente');



		 }



      });



	  nuevoRequest.send(variables);



}



function validaFormulario(formulario)



{







	/*var grupo = new Array();



	grupo = document.getElementById('grupo_' + formulario.sede.value);



	var varios_grupos = "";



	for(y=0; y < grupo.length; y++)



	{  



		clase = document.getElementById("grupo"+formulario.sede.value+"[]_"+y).className;



		if(clase == "selected"){



			varios_grupos += grupo[y].value+",";



		}



	}



	document.getElementById("gruposVar").value=varios_grupos;*/



	if(formulario.grado.value == '')



	{



		alert("Debe seleccionar un grado");



		return false;



	}



	if(formulario.tipo.value == '')



	{



		alert("Debe seleccionar un tipo de integrante");



		return false;



	}



	if(formulario.tipo.value == 'D')



	{



		if(formulario.integrante.value == '')



		{



			alert("Debe seleccionar un docente");



			return false;



		}



	}



	else if(formulario.tipo.value == 'P')



	{



		if(formulario.integrante.value == '')



		{



			alert("Debe seleccionar un padre de familia");



			return false;



		}



	}



	return true;



}



</script>



<!-- Nuevo -->

<!--  Nuevo -->

<script type="text/javascript" src="js/mootools.js"></script>
<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>
<script type="text/javascript" src="js/utilidades.js"></script>
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/mootools/multipleselect.js"></script>
<script type='text/javascript' src='js/mootools/libs/mootoolsmore.lib.js'></script>
<link rel="stylesheet" href="js/mootools/multipleselect_demo.css">

<script type='text/javascript'>
    document.addEvent('domready', function() {
   	 
   		  new MultipleSelect('estudiante'); /*  Seleccione el docente*/
   	  new MultipleSelect('padre');/*  Seleccione el padre de familia*/
   	   new MultipleSelect('datos_matricula');/*  Seleccione el directivo*/
      new MultipleSelect('grupo');/*  Seleccione el directivo*/
      	  new MultipleSelect('acudiente'); /* estudiantes */
      	  new MultipleSelect('grado2'); /*  Seleccione el grado del padre de familia*/
        new MultipleSelect('grado');          	   	 
	 new MultipleSelect('madre');

   });
     function showContent() {
        element = document.getElementById("grupo");
        caja = document.getElementById("varios_grupos2");
        check = document.getElementById("check");
        if  (check.checked) {
      for(var i = 0; i < element.options.length; i++){
      element.options[i].selected = 'selected';
      caja.style.display = "none";
      }
        }else {
      for(var i = 0; i < element.options.length; i++){
      element.options[i].selected = '';
      }
      caja.style.display = "block";
        }
    }
</script>

<script type="text/javascript">
function validaFormulario1(formulario)
{		
	var grupo = new Array();
	grupo = document.getElementById('estudiante[]' + formulario.sede.value);
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("acudiente"+formulario.sede.value+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+".";
		}
	}
	document.getElementById("gruposVar2").value=varios_grupos;
	if(formulario.coordinador.value == '')
	{
		alert("Por favor seleccione el coordinador");
		formulario.coordinador.focus();
		return false;
	}
	if(formulario.sede.value == '')
	{
		alert("Por favor seleccione la sede");
		formulario.sede.focus();
		return false;
	}
return true;
}
</script>


<!-- Funcion 2 -->



<script type="text/javascript">



function carga_tipo2(independiente1, sede, independiente2, dependiente, destino1, destino2)







{



	if($(independiente1).value == 'D')



	{



		$(destino1).set('html','Docente:');



	}



	if($(independiente1).value == 'P')



	{



		$(destino1).set('html','Padre de Familia:');



	}



	if($(independiente1).value == 'A')



	{



		$(destino1).set('html','Directivo o Delegado:');



	}



	if($(independiente1).value == 'E')



	{



		$(destino1).set('html','Estudiante:');



	}



	if($(independiente1).value == 'O')



	{



		$(destino1).set('html','Otro:');



	}



	// Variables de configuración  



	var proceso = 'proceso_carga_tipo_integrante2.php';



	var variables = 'tipo=' + $(independiente1).get('value') + '&sede=' + $(sede).get('value')  + '&id_grado=' + $(independiente2).get('value')  + '&dependiente=' + dependiente;



	//Objeto que realiza la petición



    var nuevoRequest = new Request({



		method: 'get',



		url: proceso,



		onRequest: function() {



			$(destino2).set('html','Cargando...');



		 },



         onSuccess: function(texto, xmlrespuesta){ $(destino2).set('html',texto);},



         onFailure: function(){



		 	$(destino2).set('html','');



		 	alert('Ocurrio un error y no se pudo cargar la información,\npor favor intentelo nuevamente');



		 }



      });



	  nuevoRequest.send(variables);



}



function cargagrado(independiente1, grado, campoGrado)



{



	// Variables de configuración  



	var proceso = 'proceso_carga_grados_acta.php';



	var variables = 'col=' + $(independiente1).get('value');



	//Objeto que realiza la petición



    var nuevoRequest = new Request({



		method: 'get',



		url: proceso,



		onRequest: function() {



			$(campoGrado).set('html','Cargando...');



		 },



         onSuccess: function(texto, xmlrespuesta){ $(campoGrado).set('html',texto);},



         onFailure: function(){



		 	$(campoGrado).set('html','');



		 	alert('Ocurrio un error y no se pudo cargar la información,\npor favor intentelo nuevamente');



		 }



      });



	  nuevoRequest.send(variables);



}



function validaFormulario(formulario)



{



	/*var grupo = new Array();



	grupo = document.getElementById('grupo_' + formulario.sede.value);



	var varios_grupos = "";



	for(y=0; y < grupo.length; y++)



	{  



		clase = document.getElementById("grupo"+formulario.sede.value+"[]_"+y).className;



		if(clase == "selected"){



			varios_grupos += grupo[y].value+",";



		}



	}



	document.getElementById("gruposVar").value=varios_grupos;*/



	if(formulario.grado.value == '')



	{



		alert("Debe seleccionar un grado");



		return false;



	}



	if(formulario.tipo.value == '')



	{



		alert("Debe seleccionar un tipo de integrante");



		return false;



	}



	if(formulario.tipo.value == 'D')



	{



		if(formulario.integrante.value == '')



		{



			alert("Debe seleccionar un docente");



			return false;



		}



	}



	else if(formulario.tipo.value == 'P')



	{



		if(formulario.integrante.value == '')



		{



			alert("Debe seleccionar un padre de familia");



			return false;



		}



	}



	return true;



}



</script>







<!-- Funcion 2 -->



<!-- -->











<link href="css/basico.css" rel="stylesheet" type="text/css">















<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />















</head>















<body id="cuerpo">















<?php















include_once("inc.header.php");















?>















<script src="js/SqueezeBox/SqueezeBox.js" type="text/javascript"></script>















<script type="text/javascript">















window.addEvent('domready', function() {















	/**















	 * That CSS selector will find all <a> elements with the















	 * class boxed















	 *















	 * The example loads the options from the rel attribute















	 */















	SqueezeBox.assign($$('a.modal'), {















		parse: 'rel'















	});















	SqueezeBox.assign($$('input.modal'), {















		parse: 'rel'















	});















});















</script>















<style type="text/css">















.formulario_ver{















	border:1px solid #FF0000;















}















@font-face {















	font-family: 'icomoon';















	src:url('css/icomoon/icomoon.eot');















	src:url('css/icomoon/icomoon.eot?#iefix') format('embedded-opentype'),















		url('css/icomoon/icomoon.woff') format('woff'),















		url('css/icomoon/icomoon.ttf') format('truetype'),















		url('css/icomoon/icomoon.svg#icomoon') format('svg');















	font-weight: normal;















	font-style: normal;















}















.btn {		















	border: none;















	font-family: Arial, Helvetica, sans-serif;















	font-size: 11px;















	color: inherit;















	background: none;















	cursor: pointer;















	padding: 5px 5px;















	display: inline-block;















	margin: 5px 5px;















	text-transform: uppercase;















	letter-spacing: 1px;















	font-weight: 700;















	outline: none;















	position: relative;















	-webkit-transition: all 0.3s;















	-moz-transition: all 0.3s;















	transition: all 0.3s;















}















.btn:after {















	content: '';















	position: absolute;















	z-index: -1;















	-webkit-transition: all 0.3s;















	-moz-transition: all 0.3s;















	transition: all 0.3s;















}















/* Pseudo elements for icons */















.btn:before,















.icon-heart:after,















.icon-star:after,















.icon-plus:after,















.icon-file:before {















	font-family: 'icomoon';















	speak: none;















	font-style: normal;















	font-weight: normal;















	font-variant: normal;















	text-transform: none;















	line-height: 1;















	position: relative;















	-webkit-font-smoothing: antialiased;















}















.icon-envelope:before {















	content: "\e000";















}















.icon-cart:before {















	content: "\e007";















}















.icon-cart-2:before {















	content: "\e008";















}















.icon-heart:before {















	content: "\e009";















}















/* Filled heart */















.icon-heart:after,















.icon-heart-2:before {















	content: "\e00a";















}















.icon-star:before {















	content: "\e00b";















}















/* Filled star */















.icon-star:after,















.icon-star-2:before {















	content: "\e00c";















}















.icon-arrow-right:before {















	content: "\e00d";















}















.icon-arrow-left:before {















	content: "\e003";















}















.icon-truck:before {















	content: "\e00e";















}















.icon-remove:before {















	content: "\e00f";















}















.icon-cog:before {















	content: "\e010";















}















.icon-plus:before,















.icon-plus:after {















	content: "\e011";















}















.icon-minus:before {















	content: "\e012";















}















.bh-icon-smiley:before {















	content: "\e001";















}















.bh-icon-sad:before {















	content: "\e002";















}















.icon-file:before {















	content: "\e004";















}















.icon-remove-2:before {















	content: "\e005";















}















/* Button 3 */















.btn-3 {















	background: #339933;















	color: #fff;















}















.btn-3:hover {















	background: #339933;















}















.btn-3:active {















	background: #339933;















	top: 2px;















}















.btn-3:before {















	position: absolute;















	height: 100%;















	left: 0;















	top: 0;















	line-height: 2.5;















	font-size: 140%;















	width: 40px;















}















/* Button 3a */















.btn-3a {















	padding: 25px 60px 25px 120px;















}















.btn-3a:before {















	background: rgba(0,0,0,0.05);















}















/* Button 3b */















.btn-3b {















	padding: 25px 60px 25px 120px;















	border-radius: 10px;















}















.btn-3b:before {















	border-right: 2px solid rgba(255,255,255,0.5);















}















/* Button 3c */















.btn-3c {















	padding: 80px 20px 20px 20px;















	border-radius: 10px;















	box-shadow: 0 3px #da9622;















}















.btn-3c:active {















	box-shadow: 0 3px #dc7801;















}















.btn-3c:before {















	height: 60px;















	width: 100%;















	line-height: 60px;















	background: #fff;















	color: #f29e0d;















	border-radius: 10px 10px 0 0;















}















.btn-3c:active:before {















	color: #f58500;















}















/* Button 3d */















.btn-3d {















	padding: 10px 20px 10px 60px;















	border-radius: 10px;















	width: 48%;















}















.btn-3d:before {















	background: #fff;















	color: #339933;















	z-index: 2;















	border-radius: 10px 0 0 10px;















}















.btn-3d:after {















	width: 20px;















	height: 20px;















	background: #fff;















	z-index: 1;















	left: 35px;















	top: 50%;















	margin: -10px 0 0 -10px;















	-webkit-transform: rotate(45deg);















	-moz-transform: rotate(45deg);















	-ms-transform: rotate(45deg);















	transform: rotate(45deg);















}















.btn-3d:active:before {















	color: #f58500;















}















.btn-3d:active {















	top: 0;















}















.btn-3d:active:after {















	left: 40px;















}















/* Button 3e */















.btn-3e {















	padding: 10px 70px 10px 20px;















	overflow: hidden;















	width: 48%;















}















.btn-3e:before {















	left: auto;















	right: 2px;















	z-index: 2;















}















.btn-3e:after {















	width: 50px;















	height: 200%;















	background: rgba(255,255,255,0.1);















	z-index: 1;















	right: 0;















	top: 0;















	margin: -5px 0 0 -5px;















	-webkit-transform-origin: 0 0;















	-webkit-transform: rotate(-20deg);















	-moz-transform-origin: 0 0;















	-moz-transform: rotate(-20deg);















	-ms-transform-origin: 0 0;















	-ms-transform: rotate(-20deg);















	transform-origin: 0 0;















	transform: rotate(-20deg);















}















.btn-3e:hover:after {















	width: 60px;















}















.btn:after, .btn:before { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }















</style>































<!--Empieza lo bueno -->































<table align="center" width="<?php echo $ancho_plantilla; ?>" class="centro" cellpadding="10">















<?php















	$sql_asignatura = "SELECT * FROM conf_sygescol WHERE  conf_id IN ('98', '144','145','146','147')";















	$resultado_asignatura = mysql_query($sql_asignatura,$link) or die ("No se pudo consultar los grados y los grupos");















	$num_asignaturas = mysql_num_rows($resultado_asignatura);















$array_asig = array(17=>"images/iconos/DimensionCognitiva.png", 18=>"images/iconos/dimensionComunicativa.png",















					19=>"images/iconos/dimensionCorporal.png", 20=>"images/iconos/dimensionEstetica.png");















?>















<tr>















<td>















	<table class="formulario" width="800" border="0" align="center">















	<tr>































		<td colspan="3">















			<p>



			<?php



			$ids_asignaturas = '';



			while($las_asignaturas = mysql_fetch_array($resultado_asignatura))



			{



				$ids_asignaturas .= '-' . $las_asignaturas['conf_id'];



				$class = ($las_asignaturas['conf_id'] == $_POST['nop'])?'formulario_ver':'';



				if($las_asignaturas['conf_id'] == $_POST['nop']){



					?>



					<button class="btn btn-3 btn-3d icon-star-2" onclick="location.href='<?php echo $_SERVER['PHP_SELF']; ?>?per_id=<?php echo $_POST['per_id'];?>&nop=<?php echo $las_asignaturas['conf_id'];?>&grupo_id=<?php echo $_POST['grupo_id'];?>&ver_procesos=1'"><?php echo $las_asignaturas['conf_nom_ver']; ?></button>



					<?php



				}else{



					?>



					<button class="btn btn-3 btn-3e icon-arrow-right" onclick="location.href='<?php echo $_SERVER['PHP_SELF']; ?>?per_id=<?php echo $_POST['per_id'];?>&nop=<?php echo $las_asignaturas['conf_id'];?>&grupo_id=<?php echo $_POST['grupo_id'];?>&ver_procesos=1'"><?php echo $las_asignaturas['conf_nom_ver']; ?></button>



					<?php



				}



			}



			?>



		</p>


		</td>


	</tr>

	</table>
<?php 







if ( $_POST['nop'] == 147) {



 ?>











<table align="center" width="800" class="centro" cellpadding="10">







<tr>



<td>



<?php



$tipo = array('D' => 'Docente', 'P' => 'Padre de Familia', 'A' => 'Directivo o Delegado', 'E' => 'Estudiante');



?>



<!-- Nuevo -->



<!-- Nuevo -->



<!-- Caso Uno y Dos -->



   <div class="container_demohrvszv_caja_1">



		<div class="accordion_example2wqzx_caja_2">



			<div class="accordion_inwerds_caja_3">



				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color:#339933;"><strong><font color="white">INTEGRANTES DEL CONSEJO DE PADRES</font> </strong></div>



				<div class="acc_contentsaponk_caja_4">



					<div class="grevdaiolxx_caja_5">



<table width="800" border="1" align="center" class="formulario" cellspacing="0">



	<tr>



		<th colspan="1" class="formulario" width="93">Tipo</th>



		<th colspan="1" class="formulario" width="134">Documento</th>



		<th colspan="1" class="formulario" width="274">Integrante</th>



		<th colspan="1" class="formulario" width="106" >Operaciones</th>



	</tr>



	<?php



	if($num_integrantes_comite > 0)



	{



	$mos='';



	$sed='';



		mysql_data_seek($resultado_integrantes_comite,0);



		while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



		{



		$sem = '';



		if($integrantes_comite['semestre'] == 1)



		{



			$sem = 'SA ';



		}



		if($integrantes_comite['semestre'] == 2)



		{



			$sem = 'SB ';



		}



		$grado2=$integrantes_comite['grado'] . '-' . $sem .' ' . $integrantes_comite['jornada'];



		if($sed!=$integrantes_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$integrantes_comite['cep_estado']." ORDER BY sedes.sede_nombre";



$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



$row_sedes2 = mysql_fetch_assoc($sedes2);



$totalRows_sedes2 = mysql_num_rows($sedes2);



			?><!--



			<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>-->



		<?php



		$sed=$integrantes_comite['cep_estado'];



		}



		if($mos!=$grado2){











		?>



	<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr><?php echo $tipo[$integrantes_comite['cep_tipo']]; ?></nobr></td>



				<td><?php echo $integrantes_comite['documento']; ?></td>



				<td><?php echo $integrantes_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $integrantes_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>	



	<?php



		}



	}







	//Consultamos los integrantes tipo OTRO







	$sel_integrantes_otros = "SELECT * FROM com_eval_prom INNER JOIN v_grados ON(v_grados.gao_id=com_eval_prom.id_grado) where com_eval_prom.cep_tipo =  'O' and $whereTipo ";



	$sql_integrantes_otros= mysql_query($sel_integrantes_otros,$link);



	$num_integrantes_comite_dos = mysql_num_rows($sql_integrantes_otros);















	if ($num_integrantes_comite_dos > 0) {







		while ($row_integrante_comite = mysql_fetch_array($sql_integrantes_otros)) {











		$grado2=$row_integrante_comite['gao_nombre'] . '-' . $sem .' ' . $row_integrante_comite['jornada_nombre'];







		if($sed!=$row_integrante_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$row_integrante_comite['cep_estado']." ORDER BY sedes.sede_nombre";



		$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



		$row_sedes2 = mysql_fetch_assoc($sedes2);



		$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



				<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$sed=$row_integrante_comite['cep_estado'];



		}



		if($mos!=$grado2){



		?>



				<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr>Otro</nobr></td>



				<td><?php echo $row_integrante_comite['documento']; ?></td>



				<td><?php echo $row_integrante_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $row_integrante_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>







			 <?php 



		}



	}



	else



	{



	?>







	<?php



	}



	?>



</table>



</div></div></div></div></div>



</td>



</tr>



<?php } ?>



<!-- Caso Uno y Dos -->



















<!-- Comite de consejo directivo -->



<!-- integrantes del consejo de academico -->















<?php 







if ( $_POST['nop'] == 144) {



 ?>











<table align="center" width="800" class="centro" cellpadding="10">







<tr>



<td>



<?php



$tipo = array('D' => 'Docente', 'P' => 'Padre de Familia', 'A' => 'Directivo o Delegado', 'E' => 'Estudiante');



?>



<!-- Nuevo -->



<!-- Nuevo -->



<!-- Caso Uno y Dos -->



   <div class="container_demohrvszv_caja_1">



		<div class="accordion_example2wqzx_caja_2">



			<div class="accordion_inwerds_caja_3">



				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color:#339933;"><strong><font color="white">INTEGRANTES DEL CONSEJO ACADEMICO</font> </strong></div>



				<div class="acc_contentsaponk_caja_4">



					<div class="grevdaiolxx_caja_5">



<table width="800" border="1" align="center" class="formulario" cellspacing="0">



	<tr>



		<th colspan="1" class="formulario" width="93">Tipo</th>



		<th colspan="1" class="formulario" width="134">Documento</th>



		<th colspan="1" class="formulario" width="274">Integrante</th>



		<th colspan="1" class="formulario" width="106" >Operaciones</th>



	</tr>



	<?php



	if($num_integrantes_comite > 0)



	{



	$mos='';



	$sed='';



		mysql_data_seek($resultado_integrantes_comite,0);



		while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



		{



		$sem = '';



		if($integrantes_comite['semestre'] == 1)



		{



			$sem = 'SA ';



		}



		if($integrantes_comite['semestre'] == 2)



		{



			$sem = 'SB ';



		}



		$grado2=$integrantes_comite['grado'] . '-' . $sem .' ' . $integrantes_comite['jornada'];



		if($sed!=$integrantes_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$integrantes_comite['cep_estado']." ORDER BY sedes.sede_nombre";



$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



$row_sedes2 = mysql_fetch_assoc($sedes2);



$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



			<!--<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>-->



		<?php



		$sed=$integrantes_comite['cep_estado'];



		}



		if($mos!=$grado2){











		?>



	<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr><?php echo $tipo[$integrantes_comite['cep_tipo']]; ?></nobr></td>



				<td><?php echo $integrantes_comite['documento']; ?></td>



				<td><?php echo $integrantes_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $integrantes_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>	



	<?php



		}



	}







	//Consultamos los integrantes tipo OTRO







	$sel_integrantes_otros = "SELECT * FROM com_eval_prom INNER JOIN v_grados ON(v_grados.gao_id=com_eval_prom.id_grado) where com_eval_prom.cep_tipo =  'O' and $whereTipo ";



	$sql_integrantes_otros= mysql_query($sel_integrantes_otros,$link);



	$num_integrantes_comite_dos = mysql_num_rows($sql_integrantes_otros);















	if ($num_integrantes_comite_dos > 0) {







		while ($row_integrante_comite = mysql_fetch_array($sql_integrantes_otros)) {











		$grado2=$row_integrante_comite['gao_nombre'] . '-' . $sem .' ' . $row_integrante_comite['jornada_nombre'];







		if($sed!=$row_integrante_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$row_integrante_comite['cep_estado']." ORDER BY sedes.sede_nombre";



		$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



		$row_sedes2 = mysql_fetch_assoc($sedes2);



		$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



			<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>



		<?php



		$sed=$row_integrante_comite['cep_estado'];



		}



		if($mos!=$grado2){



		?>



			<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr>Otro</nobr></td>



				<td><?php echo $row_integrante_comite['documento']; ?></td>



				<td><?php echo $row_integrante_comite['Nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $row_integrante_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>







			 <?php 



		}



	}



	else



	{



	?>







	<?php



	}



	?>



</table>



</div></div></div></div></div>



</td>



</tr>



<?php } ?>



<!-- Caso Uno y Dos -->







<!-- integrantes del consejo de academico -->







































<!-- integrantes del consejo de ESTUDIANTES -->







<?php 







if ( $_POST['nop'] == 146) {



 ?>











<table align="center" width="800" class="centro" cellpadding="10">







<tr>



<td>



<?php



$tipo = array('D' => 'Docente', 'P' => 'Padre de Familia', 'A' => 'Directivo o Delegado', 'E' => 'Estudiante');



?>



<!-- Nuevo -->



<!-- Nuevo -->



<!-- Caso Uno y Dos -->



   <div class="container_demohrvszv_caja_1">



		<div class="accordion_example2wqzx_caja_2">



			<div class="accordion_inwerds_caja_3">



				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color:#339933;"><strong><font color="white">INTEGRANTES DEL CONSEJO ESTUDIANTIL</font> </strong></div>



				<div class="acc_contentsaponk_caja_4">



					<div class="grevdaiolxx_caja_5">



<table width="800" border="1" align="center" class="formulario" cellspacing="0">



	<tr>



		<th colspan="1" class="formulario" width="93">Tipo</th>



		<th colspan="1" class="formulario" width="134">Documento</th>



		<th colspan="1" class="formulario" width="274">Integrante</th>



		<th colspan="1" class="formulario" width="106" >Operaciones</th>



	</tr>



	<?php



	if($num_integrantes_comite > 0)



	{



	$mos='';



	$sed='';



		mysql_data_seek($resultado_integrantes_comite,0);



		while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



		{



		$sem = '';



		if($integrantes_comite['semestre'] == 1)



		{



			$sem = 'SA ';



		}



		if($integrantes_comite['semestre'] == 2)



		{



			$sem = 'SB ';



		}



		$grado2=$integrantes_comite['grado'] . '-' . $sem .' ' . $integrantes_comite['jornada'];



		if($sed!=$integrantes_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$integrantes_comite['cep_estado']." ORDER BY sedes.sede_nombre";



$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



$row_sedes2 = mysql_fetch_assoc($sedes2);



$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



			<!--<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>-->



		<?php



		$sed=$integrantes_comite['cep_estado'];



		}



		if($mos!=$grado2){











		?>



	<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr><?php echo $tipo[$integrantes_comite['cep_tipo']]; ?></nobr></td>



				<td><?php echo $integrantes_comite['documento']; ?></td>



				<td><?php echo $integrantes_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $integrantes_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>	



	<?php



		}



	}







	//Consultamos los integrantes tipo OTRO







	$sel_integrantes_otros = "SELECT * FROM com_eval_prom INNER JOIN v_grados ON(v_grados.gao_id=com_eval_prom.id_grado) where com_eval_prom.cep_tipo =  'O' and $whereTipo ";



	$sql_integrantes_otros= mysql_query($sel_integrantes_otros,$link);



	$num_integrantes_comite_dos = mysql_num_rows($sql_integrantes_otros);















	if ($num_integrantes_comite_dos > 0) {







		while ($row_integrante_comite = mysql_fetch_array($sql_integrantes_otros)) {











		$grado2=$row_integrante_comite['gao_nombre'] . '-' . $sem .' ' . $row_integrante_comite['jornada_nombre'];







		if($sed!=$row_integrante_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$row_integrante_comite['cep_estado']." ORDER BY sedes.sede_nombre";



		$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



		$row_sedes2 = mysql_fetch_assoc($sedes2);



		$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



			<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$sed=$row_integrante_comite['cep_estado'];



		}



		if($mos!=$grado2){



		?>



				<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr>Otro</nobr></td>



				<td><?php echo $row_integrante_comite['documento']; ?></td>



				<td><?php echo $row_integrante_comite['Nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $row_integrante_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>







			 <?php 



		}



	}



	else



	{



	?>







	<?php



	}



	?>



</table>



</div></div></div></div></div>



</td>



</tr>



<?php } ?>



<!-- Caso Uno y Dos -->











<!-- integrantes del consejo de ESTUDIANTES -->















<?php 



$selParametro11 = "SELECT c



FROM  `conf_sygescol` 



WHERE  `conf_id` =98";



	$sqlParametro11 = mysql_query($selParametro11, $link);



	$rowParametro11 = mysql_fetch_array($sqlParametro11);







if ($_POST['nop'] == 98) {



 ?>



<table align="center" width="800" class="centro" cellpadding="10">



<!--



<tr>



<th scope="col" colspan="1" class="centro">INTEGRANTES DEL COMITE DE EVALUACI&Oacute;N Y PROMOCI&Oacute;N ACADEMICOS </th>



</tr>



-->



<tr>



<td>



<?php



$tipo = array('D' => 'Docente', 'P' => 'Padre de Familia', 'A' => 'Directivo o Delegado', 'E' => 'Estudiante');



?>



<!-- Nuevo -->



<!-- Nuevo -->



<!-- Caso Uno y Dos -->



   <div class="container_demohrvszv_caja_1">



		<div class="accordion_example2wqzx_caja_2">



			<div class="accordion_inwerds_caja_3">



				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color:#339933;"><strong><font color="white">INTEGRANTES DEL COMITE DE EVALUACI&Oacute;N Y PROMOCI&Oacute;N </font> </strong></div>



				<div class="acc_contentsaponk_caja_4">



					<div class="grevdaiolxx_caja_5">



	<?php



	if($num_integrantes_comite > 0)



	{



	$mos='';



	$sed='';



		mysql_data_seek($resultado_integrantes_comite,0);



		while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



		{



		$sem = '';



		if($integrantes_comite['semestre'] == 1)



		{



			$sem = 'SA ';



		}



		if($integrantes_comite['semestre'] == 2)



		{



			$sem = 'SB ';



		}



		$grado2=$integrantes_comite['grupo_nombre'] . '-' . $sem .' ' . $integrantes_comite['jornada'];



		if($sed!=$integrantes_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$integrantes_comite['cep_estado']." ORDER BY sedes.sede_nombre";
$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());
$row_sedes2 = mysql_fetch_array($sedes2);
$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



		<table width="800" border="1" align="center" class="formulario" cellspacing="0">



		<tr>



	<th colspan="1" class="formulario" width="93">Comision</th>



		<th colspan="1" class="formulario" width="93">Tipo</th>



		<th colspan="1" class="formulario" width="134">Documento</th>



		<th colspan="1" class="formulario" width="274">Integrante</th>



		<th colspan="1" class="formulario" width="106" >Operaciones</th>



	</tr>



			<tr>



				<th bgcolor="#C7D0FE" colspan="5"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>



		<?php



		$sed=$integrantes_comite['cep_estado'];



		}



		if($mos!=$grado2){



		?>



			<tr>



				<th bgcolor="#C0E2FE" colspan="5"><?php echo $grado2; ?></th>



			</tr>



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr><?php if ($integrantes_comite['comision'] > 0){ echo 'Comision '.$integrantes_comite['comision']; }?></nobr></td>



				<td><nobr><?php echo $tipo[$integrantes_comite['cep_tipo']]; ?></nobr></td>



				<td><?php echo $integrantes_comite['documento']; ?></td>



				<td><?php echo $integrantes_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $integrantes_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>



	<?php



		}



	}



	else



	{



	?>







	<?php



	}







	?>



</table>



</div></div></div></div></div>



</td>



</tr>







<?php } ?>


<!-- Caso 3 -->








<!-- integrantes del consejo de padres -->











<?php 







if ( $_POST['nop'] == 145) {



 ?>











<table align="center" width="800" class="centro" cellpadding="10">







<tr>



<td>



<?php



$tipo = array('D' => 'Docente', 'P' => 'Padre de Familia', 'A' => 'Directivo o Delegado', 'E' => 'Estudiante');



?>



<!-- Nuevo -->



<!-- Nuevo -->



<!-- Caso Uno y Dos -->



   <div class="container_demohrvszv_caja_1">



		<div class="accordion_example2wqzx_caja_2">



			<div class="accordion_inwerds_caja_3">



				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color:#339933;"><strong><font color="white">INTEGRANTES DEL CONSEJO DIRECTIVO</font> </strong></div>



				<div class="acc_contentsaponk_caja_4">



					<div class="grevdaiolxx_caja_5">



<table width="800" border="1" align="center" class="formulario" cellspacing="0">



	<tr>



		<th colspan="1" class="formulario" width="93">Tipo</th>



		<th colspan="1" class="formulario" width="134">Documento</th>



		<th colspan="1" class="formulario" width="274">Integrante</th>



		<th colspan="1" class="formulario" width="106" >Operaciones</th>



	</tr>



	<?php



	if($num_integrantes_comite > 0)



	{



	$mos='';



	$sed='';



		mysql_data_seek($resultado_integrantes_comite,0);



		while($integrantes_comite = mysql_fetch_array($resultado_integrantes_comite))



		{



		$sem = '';



		if($integrantes_comite['semestre'] == 1)



		{



			$sem = 'SA ';



		}



		if($integrantes_comite['semestre'] == 2)



		{



			$sem = 'SB ';



		}



		$grado2=$integrantes_comite['grado'] . '-' . $sem .' ' . $integrantes_comite['jornada'];



		if($sed!=$integrantes_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$integrantes_comite['cep_estado']." ORDER BY sedes.sede_nombre";



$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



$row_sedes2 = mysql_fetch_assoc($sedes2);



$totalRows_sedes2 = mysql_num_rows($sedes2);



			?>



			<!--<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>-->



		<?php



		$sed=$integrantes_comite['cep_estado'];



		}



		if($mos!=$grado2){











		?>



	<!--	<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>



-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr><?php echo $tipo[$integrantes_comite['cep_tipo']]; ?></nobr></td>



				<td><?php echo $integrantes_comite['documento']; ?></td>



				<td><?php echo $integrantes_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $integrantes_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>	



	<?php



		}



	}







	//Consultamos los integrantes tipo OTRO







	$sel_integrantes_otros = "SELECT * FROM com_eval_prom INNER JOIN v_grados ON(v_grados.gao_id=com_eval_prom.id_grado) where com_eval_prom.cep_tipo =  'O' and $whereTipo ";



	$sql_integrantes_otros= mysql_query($sel_integrantes_otros,$link);



	$num_integrantes_comite_dos = mysql_num_rows($sql_integrantes_otros);















	if ($num_integrantes_comite_dos > 0) {







		while ($row_integrante_comite = mysql_fetch_array($sql_integrantes_otros)) {











		$grado2=$row_integrante_comite['gao_nombre'] . '-' . $sem .' ' . $row_integrante_comite['jornada_nombre'];







		if($sed!=$row_integrante_comite['cep_estado']){



		$query_sedes2 = "SELECT sedes.sede_consecutivo, sedes.sede_nombre FROM sedes WHERE sedes.sede_consecutivo=".$row_integrante_comite['cep_estado']." ORDER BY sedes.sede_nombre";



		$sedes2 = mysql_query($query_sedes2, $link) or die(mysql_error());



		$row_sedes2 = mysql_fetch_assoc($sedes2);



		$totalRows_sedes2 = mysql_num_rows($sedes2);



			?><!--	



			<tr>



				<th bgcolor="#C7D0FE" colspan="4"><?php echo $row_sedes2['sede_nombre']; ?></th>



			</tr>-->



		<?php



		$sed=$row_integrante_comite['cep_estado'];



		}



		if($mos!=$grado2){



		?><!--	



			<tr>



				<th bgcolor="#C0E2FE" colspan="4"><?php echo $grado2; ?></th>



			</tr>-->



		<?php



		$mos=$grado2;



		}



	?>



			<tr>



				<td><nobr>Otro</nobr></td>



				<td><?php echo $row_integrante_comite['documento']; ?></td>



				<td><?php echo $row_integrante_comite['nombre']; ?></td>



				<td align="center"><a href="comite_evaluacion_promocion.php?borrar=1&cep_id=<?php echo $row_integrante_comite['cep_id']?>" title="Quitar del Comité"><img src="images/eliminar.gif" width="16" height="16" border="0" /></a></td>



			</tr>







			 <?php 



		}



	}



	else



	{



	?>







	<?php



	}



	?>



</table>



</div></div></div></div></div>



</td>



</tr>



<?php } ?>


<!-- iNTEGRANTES PARA EL CONSEJO ACADEMICO -->















<?php 







if ( $_POST['nop'] == 144) {



 ?>



<tr>



<td>



<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es">



<div class="container_demohrvszv_caja_tipo_param" style="width:100%;">



<div class="accordion_example2wqzx"style="width:100%;">



<div class="accordion_inwerds"style="width:100%;">



<div class="acc_headerfgd"style="width:100%;"><strong style="width:120px;margin-left: -75%;"><center><strong>CONSEJO ACADEMICO</strong></center> </strong></div>



<div class="acc_contentsaponk"style="width:;">



<div class="grevdaiolxx_caja_tipo_param"style="width:100%;;">



<div class="sin_resaltado"style="width:100%;  margin-left:">



<table width="100%" border="0" align="right" class="formulario">



<!--



	<tr>



		<th colspan="2" class="formulario">Seleccione el docente que va a agregar al Comit&eacute;  Seleccione los grupos de grado que va a agregar al Comit&eacute;  </th>



	</tr>



-->



<!-- Nuevo -->



 







<?php 



/*



<script type="text/javascript">



function validar4(){



if document.getElementById('tipo').value == 'A'{



	alert('message');



 document.getElementById("grado").disabled = true;



}



}



</script>



*/



 ?>



<!-- Nuevo -->















	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select  name="tipo" id="tipo" onclick="validar4()" onchange="carga_tipo('tipo', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante');"  style="display:none;">



	<option value="P">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>































	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select name="tipo1" id="tipo1" onclick="validar4()" onchange="carga_tipo('tipo1', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante1');" style="display:none;">



	<option value="E">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>



















<?php 



if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>











<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetasdsada"style="color:black;">Diretivo o Delegado:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrantqwwewqe">



	  <select name="1sede" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      		<optgroup label="Rector" >



      <?php



while ($row_sedes1234 = mysql_fetch_array($sedes1234)) {  



?>



      <option value="<?php echo $row_sedes1234['id'].'01'?>"><?php echo $row_sedes1234['nombre']?></option>



      <?php



} 



	?><optgroup label="Docentes Administrativo" >	<?php



while ($row_sedes5656 = mysql_fetch_array($resultado_integrantesCor5656)) {  



?>



      <option value="<?php echo $row_sedes5656['id']?>02"><?php echo $row_sedes5656['nombre']?></option>



      <?php



} 







?>



    </select>



	  </td>



	  </tr>











<?php } ?>







<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>







<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetvffva"style="color:black;">docente:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integranteopopo">



	  <select name="sede1" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes1 = mysql_fetch_array($sedes1)) {  



?>



      <option value="<?php echo $row_sedes1['id']?>"><?php echo $row_sedes1['nombre']?></option>



      <?php



} 



  $rows1 = mysql_num_rows($sedes1);



  if($rows1 > 0) {



      mysql_data_seek($sedes1, 0);



	  $row_sedes1 = mysql_fetch_array($sedes1);



  }



?>



    </select>



	  </td>



	  </tr>











	  <?php } ?>







































	<tr>



	  <td align="right" valign="top"style="color:black;"><b>Seleccione la sede del padre de familia y estudiantes:</b>&nbsp;&nbsp;</td>



	  <td height="20" align="left" valign="middle">



	  <select name="sede" id="sede" onchange="mostrarGrupo(this.value)">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes = mysql_fetch_array($sedes)) {  



?>



      <option value="<?php echo $row_sedes['sede_consecutivo']?>"><?php echo $row_sedes['sede_nombre']?></option>



      <?php



} 



  $rows = mysql_num_rows($sedes);



  if($rows > 0) {



      mysql_data_seek($sedes, 0);



	  $row_sedes = mysql_fetch_array($sedes);



  }



?>



    </select>



	  </td>



	  </tr>































<tr><td  width="387" height="20" align="left" valign="middle"> <td  width="387" height="20" align="left" valign="middle"> 



	<!--	<td  width="203" align="right" valign="top"style="color:black;"><b>Grados:</b>&nbsp;&nbsp;</td>-->



		







			<!--SEDE PRINCIPAL MAÑANA -->



			<?php



mysql_data_seek($sedes, 0);



	while($row_sedes2 = mysql_fetch_array($sedes)){



				$sel_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]."



				  ORDER BY a";



				$sql_grupos1 = mysql_query($sel_grupos, $link)or die("No se pudo consultar los grupos");



			?>



			<div id="divgrupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" style="display:none;">



<style>



	



	ul.mselect_list li, ul.mselect_list li.selected {



    background-color: #8DC5FF;



    color:#000;



}



</style><!--



			<select class="multiples" name="grupo<?php echo $row_sedes2['sede_consecutivo'];?>[]" id="grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" multiple="multiple" style="postion:relative; height:auto; width:250px;">



		<?php



			while($row_grupo = mysql_fetch_array($sql_grupos1)){



		?>



				<strong><option value="<?php echo $row_grupo['grupo_id'];?>"><?php echo $row_grupo['grupo_nombre'];?></option></strong>



				<?php



			}



				?>



		</select> 



-->	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<select name="id_grado" id="id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo', 'sede', 'id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante1');" style="    position: absolute;



    margin-top: 16%; width:35%;">



		<option  value=""><b>Seleccione...</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	







<?php } ?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



		<select name="iid_grado" id="iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo1', 'sede', 'iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante');" style="    position: absolute;



    margin-top: 3%; width:35%;">



		<option  value=""><b>Seleccione....</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>



		<?php } ?>	



		</div>



				<?php







			}



				?>



		</td>



	</tr>







	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



<tr><td  width="203" align="right" valign="top"style="color:red;"><b>Seleccione el grado del<strong style="color:green;">  estudiante  </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>







	











	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Estudiantes :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante">



	<select name="integrante1" id="integrante1" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>







<?php } ?>











	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<tr><td  width="203" align="right" valign="top" style="color:red;"><b>Seleccione el grado del <strong style="color:green;"> padre de familia </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>



	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Padres de familia :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante1">



	<select name="integrante" id="integrante" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>







	



	<tr>



	<td align="center" colspan="2">



	<input type="hidden" name="nop" value="<?php echo $_POST['nop']; ?>">



		<input type="button" style="background:red;"name="Cancelar" value="Cancelar" onclick="javascript:history.back()" />



		<input name="ingIntegrante" type="submit" id="ingIntengrante" value="Ingresar" onclick="javascript:history.reload()"/>	</td>







	</tr>



</table>



</form>



</div></div></div></div></div>



</td>



</tr>



<?php 



}



 ?>



<!-- iNTEGRANTES PARA EL CONSEJO ACADEMICO -->























<!-- iNTEGRANTES PARA EL CONSEJO DE PADRES -->











<?php 







if ( $_POST['nop'] == 146) {



 ?>



<tr>



<td>



<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es" onsubmit="return validaFormulario1(this)">



<div class="container_demohrvszv_caja_tipo_param" style="width:100%;">



<div class="accordion_example2wqzx"style="width:100%;">



<div class="accordion_inwerds"style="width:100%;">



<div class="acc_headerfgd"style="width:100%;"><strong style="width:120px;margin-left: -75%;"><center><strong>CONSEJO ESTUDIANTIL</strong></center> </strong></div>



<div class="acc_contentsaponk"style="width:;">



<div class="grevdaiolxx_caja_tipo_param"style="width:100%;;">



<div class="sin_resaltado"style="width:100%;  margin-left:">



<table width="100%" border="0" align="right" class="formulario">



<!--



	<tr>



		<th colspan="2" class="formulario">Seleccione el docente que va a agregar al Comit&eacute;  Seleccione los grupos de grado que va a agregar al Comit&eacute;  </th>



	</tr>



-->



<!-- Nuevo -->



 



			<script>



function validar4() {



if(document.getElementById('tipo').value=="A" || document.getElementById('tipo').value=="D")



{



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = true;



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").value = '';



}



else {



	document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = false;



}



}



</script>



<?php 



/*



<script type="text/javascript">



function validar4(){



if document.getElementById('tipo').value == 'A'{



	alert('message');



 document.getElementById("grado").disabled = true;



}



}



</script>



*/



 ?>



<!-- Nuevo -->















	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select  name="tipo" id="tipo" onclick="validar4()" onchange="carga_tipo('tipo', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante');"  style="display:none;">



	<option value="P">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>































	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select name="tipo1" id="tipo1" onclick="validar4()" onchange="carga_tipo('tipo1', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante1');" style="display:none;">



	<option value="E">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>



















	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetaasss"style="color:black;">docente:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrantecvdv">



	  <select name="sede1" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes1 = mysql_fetch_array($sedes1)) {  



?>



      <option value="<?php echo $row_sedes1['id']?>"><?php echo $row_sedes1['nombre']?></option>



      <?php



} 



  $rows1 = mysql_num_rows($sedes1);



  if($rows1 > 0) {



      mysql_data_seek($sedes1, 0);



	  $row_sedes1 = mysql_fetch_array($sedes1);



  }



?>



    </select>



	  </td>



	  </tr>



<?php } ?>















<?php 



if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetaASAS"style="color:black;">Diretivo o Delegado:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integranteQWQW">



	  <select name="1sede" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      		<optgroup label="Rector" >



      <?php



while ($row_sedes1234 = mysql_fetch_array($sedes1234)) {  



?>



      <option value="<?php echo $row_sedes1234['id'].'01'?>"><?php echo $row_sedes1234['nombre']?></option>



      <?php



} 



	?><optgroup label="Docentes Administrativo" >	<?php



while ($row_sedes5656 = mysql_fetch_array($resultado_integrantesCor5656)) {  



?>



      <option value="<?php echo $row_sedes5656['id']?>02"><?php echo $row_sedes5656['nombre']?></option>



      <?php



} 







?>



    </select>



	  </td>



	  </tr>



<?php } ?>























	<tr>



	  <td align="right" valign="top"style="color:black;"><b>Seleccione la sede del padre de familia y estudiantes:</b>&nbsp;&nbsp;</td>



	  <td height="20" align="left" valign="middle">



	  <select name="sede" id="sede" onchange="mostrarGrupo(this.value)">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes = mysql_fetch_array($sedes)) {  



?>



      <option value="<?php echo $row_sedes['sede_consecutivo']?>"><?php echo $row_sedes['sede_nombre']?></option>



      <?php



} 



  $rows = mysql_num_rows($sedes);



  if($rows > 0) {



      mysql_data_seek($sedes, 0);



	  $row_sedes = mysql_fetch_array($sedes);



  }



?>



    </select>



	  </td>



	  </tr>































<tr><td  width="387" height="20" align="left" valign="middle"> <td  width="387" height="20" align="left" valign="middle"> 



	<!--	<td  width="203" align="right" valign="top"style="color:black;"><b>Grados:</b>&nbsp;&nbsp;</td>-->



		







			<!--SEDE PRINCIPAL MAÑANA -->



			<?php



mysql_data_seek($sedes, 0);



	while($row_sedes2 = mysql_fetch_array($sedes)){



				$sel_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]."



				  ORDER BY a";



				$sql_grupos1 = mysql_query($sel_grupos, $link)or die("No se pudo consultar los grupos");



			?>



			<div id="divgrupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" style="display:none;">



<style>



	



	ul.mselect_list li, ul.mselect_list li.selected {



    background-color: #8DC5FF;



    color:#000;



}



</style><!--



			<select class="multiples" name="grupo<?php echo $row_sedes2['sede_consecutivo'];?>[]" id="grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" multiple="multiple" style="postion:relative; height:auto; width:250px;">



		<?php



			while($row_grupo = mysql_fetch_array($sql_grupos1)){



		?>



				<strong><option value="<?php echo $row_grupo['grupo_id'];?>"><?php echo $row_grupo['grupo_nombre'];?></option></strong>



				<?php



			}



				?>



		</select> 



-->	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<select name="id_grado" id="id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo', 'sede', 'id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante1');" style="    position: absolute;



    margin-top: 3%; width:35%;">



		<option  value=""><b>Seleccione...</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



<?php } ?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		







		<select name="iid_grado" id="iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo1', 'sede', 'iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante');" style="    position: absolute;



    margin-top: 3%; width:35%;">



		<option  value=""><b>Seleccione....</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



		<?php } ?>



		</div>



				<?php







			}



				?>



		</td>



	</tr>







	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<tr><td  width="203" align="right" valign="top" style="color:red;"><b>Seleccione el grado del <strong style="color:green;"> padre de familia </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>



	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Padres de familia :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante1">



	<select name="integrante" id="integrante" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>







	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



<tr><td  width="203" align="right" valign="top"style="color:red;"><b>Seleccione el grado del<strong style="color:green;">  estudiante  </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>







	











	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Estudiantes :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante">



	<select name="integrante1" id="integrante1" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>







<?php } ?>



















	<tr>



	<td align="center" colspan="2">



	<input type="hidden" name="nop" value="<?php echo $_POST['nop']; ?>">



		<input type="button" style="background:red;"name="Cancelar" value="Cancelar" onclick="javascript:history.back()" />



		<input name="ingIntegrante" type="submit" id="ingIntengrante" value="Ingresar" onclick="javascript:history.reload()"/>	</td>







	</tr>



</table>



</form>



</div></div></div></div></div>



</td>



</tr>



<?php 



}



 ?>











<!-- INTEGRANTES PARA EL CONSEJO DE PADRES -->






<?php 



$selParametro11 = "SELECT c



FROM  `conf_sygescol` 



WHERE  `conf_id` =98";



	$sqlParametro11 = mysql_query($selParametro11, $link);



	$rowParametro11 = mysql_fetch_array($sqlParametro11);







if ($_POST['nop'] == 98) {



 ?>





<tr>



<td>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es" onclick="return validaFormulario(this)">
<div class="container_demohrvszv_caja_tipo_param" style="width:100%;">
<div class="accordion_example2wqzx"style="width:100%;">
<div class="accordion_inwerds"style="width:100%;">
<div class="acc_headerfgd"style="width:100%;"><strong style="width:120px;margin-left: -75%;"><center><strong>COMISIONES DE EVALUACI&Oacute;N Y PROMOCI&Oacute;N</strong></center> </strong></div>
<div class="acc_contentsaponk"style="width:;">
<div class="grevdaiolxx_caja_tipo_param"style="width:100%;;">
<div class="sin_resaltado"style="width:100%;  margin-left:">

<table width="100%" border="0" align="center" class="formulario">
<tr>
      <td width="203" align="right" valign="top"><b>Seleccione La Comision:</b>&nbsp;&nbsp;</td>
      <td width="387" height="20" align="left" valign="middle">
        <select name="reporte" id="reporte"  style="width:48%;">
        <option value="0">Seleccione La Comision</option>
          <option value="1">Comision 1</option>
          <option value="2">Comision 2</option>
          <option value="3">Comision 3</option>
          <option value="4">Comision 4</option>
          <option value="5">Comision 5</option>
           <option value="6">Comision 6</option>
        </select>     
     </td>
</tr>


<?php 

$sql_grado_grupo = "SELECT DISTINCT g.i AS  'grado_grupo', jraa.b AS  'jornada', gao.ba AS  'grado', guo.ba AS  'grupo', v_grupos.grupo_sede AS  'sede'
FROM gao, guo, g, cg, jraa
INNER JOIN v_grupos ON ( i = grupo_id ) 
WHERE g.b = gao.i
AND g.a = guo.i
AND g.i = cg.b
AND gao.g = jraa.i
ORDER BY jraa.i, gao.ba, guo.b";
$resultado_grado_grupo = mysql_query($sql_grado_grupo,$link) or die ("No se pudo consultar los grados y los grupos");

 ?>
    <tr>
      <td width="203" align="right" valign="top"><b>Grupo:</b>&nbsp;&nbsp;</td>
      <td  id="varios_grupos2"  width="387" height="20" align="left" valign="middle"><select name="grupo[]" multiple="multiple" id="grupo" style="postion:relative; height:150px; width:250px;">
          <?php
	$con = 0;
	while($grado_grupo = mysql_fetch_array($resultado_grado_grupo))
	{
		if($con == 0)
		{
			$jornada = $grado_grupo['jornada'];
	?>
          <optgroup label="<?php echo $grado_grupo['jornada'] ?>">
          <?php	
		}
		if($jornada != $grado_grupo['jornada'])
		{
			$jornada = $grado_grupo['jornada']
	?>
          </optgroup>
          <optgroup label="<?php echo $grado_grupo['jornada'] ?>">
          <?php
		}
	?>
        <option style="text-align:center;" id="<?php echo $grado_grupo['grado_grupo'] ?>"value="<?php echo $grado_grupo['grado_grupo'] ?>"><?php echo $grado_grupo['grado'] . "-" . $grado_grupo['grupo']?></option>
          <?php
		$con++;
	}
	if($con > 0)
	{
	?>
          </optgroup>
          <?php
	}
	?>
        </select>      </td>
    
    <?php 

$query_sedes11 = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%rector%' ORDER BY nombre";
$sedes11 = mysql_query($query_sedes11, $link) or die(mysql_error());
$totalRows_sedes11 = mysql_num_rows($sedes11);



$query_sedes112 = "SELECT DISTINCT id, nombre FROM admco where cargo LIKE '%COORDI%' ORDER BY nombre";	
$sedes112 = mysql_query($query_sedes112, $link) or die("No se pudo consultar los integrantes");
$totalRows_sedes112 = mysql_num_rows($sedes112);

     ?>
    <tr>
      <td align="right" valign="top"><b>Directivos</b>&nbsp;&nbsp;</td>
      <td height="20" align="left" valign="middle"><select name="directivos[]" multiple="multiple" id="datos_matricula" style="postion:relative; height:150px; width:250px;">
 <optgroup label="Rector" >
 <?php
while ($row_sedes11 = mysql_fetch_array($sedes11)) {  
?>
      <option value="<?php echo $row_sedes11['id']?>01"><?php echo $row_sedes11['nombre']?></option>
      <?php
} 
	?><optgroup label="Docentes Administrativo" >	<?php
while ($row_sedes112 = mysql_fetch_array($sedes112)) {  
?>
      <option value="<?php echo $row_sedes112['id'].'02'?>"><?php echo $row_sedes112['nombre']?></option>
      <?php
} 
?>
</tr>
    <?php 

		$query_sedes22 = "SELECT * FROM  `dcne` ";
$sedes22 = mysql_query($query_sedes22, $link) or die(mysql_error());

$totalRows_sedes22 = mysql_num_rows($sedes22);
     ?>

    <tr>
      <td width="203" align="right" valign="top"><b>Docente :</b>&nbsp;&nbsp;</td>
      <td width="387" height="20" align="left" valign="middle"><select name="docente[]" multiple="multiple" id="estudiante" style="postion:relative; height:150px; width:250px;">          
		     <?php
	$con = 0;
	while($row_sedes22 = mysql_fetch_array($sedes22))
	{
	?>
         <option value="<?php echo $row_sedes22['i'] ?>"><?php echo $row_sedes22['dcne_ape1'] . " " . $row_sedes22['dcne_ape2']. " " . $row_sedes22['dcne_nom1']. " " . $row_sedes22['dcne_nom2']?></option>
          <?php
		$con++;
	}
	?>
      </select></td>
    </tr>



<!--  Grado del estudiante
    <?php 
$sql_grado_grupo = "SELECT DISTINCT * FROM gao 
				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 
				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 
				group by gao_nombre ORDER BY a";
$resultado_grado_grupo = mysql_query($sql_grado_grupo,$link) or die ("No se pudo consultar los grados y los grupos");
 ?>
    <tr>
      <td width="203" align="right" valign="top"><b>Seleccione el grado del estudiante:</b>&nbsp;&nbsp;</td>
      <td  id="varios_grupos2"  width="387" height="20" align="left" valign="middle"><select name="gradoes[]" multiple="multiple" id="grado" style="postion:relative; height:150px; width:250px;" onchange="mostrarGrupo(this.value)">
          <?php
	$con = 0;
	while($grado_grupo = mysql_fetch_array($resultado_grado_grupo))
	{
		if($con == 0)
		{
			$jornada = $grado_grupo['jornada'];
	?>
          <optgroup label="<?php echo $grado_grupo['jornada'] ?>">
          <?php	
		}
		if($jornada != $grado_grupo['jornada'])
		{
			$jornada = $grado_grupo['jornada']
	?>
          </optgroup>
          <optgroup label="<?php echo $grado_grupo['jornada'] ?>">
          <?php
		}
	?>
        <option style="text-align:center;"value="<?php echo $grado_grupo['grado_base'] ?>"><?php echo $grado_grupo['b']?></option>
          <?php
		$con++;
	}
	if($con > 0)
	{
	?>
          </optgroup>
          <?php
	}
	?>
        </select>      </td>

	
	--> <!-- Grado del estudiante-->
<?php 
$query_sedes23 = "SELECT * 
FROM alumno
INNER JOIN matricula ON ( alumno.alumno_id = matricula.alumno_id ) 
INNER JOIN v_grupos ON ( v_grupos.grupo_id = matricula.grupo_id ) 
INNER JOIN v_grados ON ( v_grados.gao_id = matricula.grado_id ) 
order by v_grupos.grupo_nombre";


$sedes23 = mysql_query($query_sedes23, $link) or die(mysql_error());
$totalRows_sedes23 = mysql_num_rows($sedes23);
?>

<script type="text/javascript">
function validaFormulario(formulario)
{		
	var grupo = new Array();
	grupo = document.getElementById('grupo');
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("grupo"+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+",";
		}
	}
	document.getElementById("gruposVar").value=varios_grupos;


	/* 2*/
	var grupo = new Array();
	grupo = document.getElementById('datos_matricula');
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("directivos"+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+",";
		}
	}
	document.getElementById("gruposVar01").value=varios_grupos;

	/*3*/
	var grupo = new Array();
	grupo = document.getElementById('estudiante');
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("docente"+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+",";
		}
	}
	document.getElementById("gruposVar02").value=varios_grupos;
	/* 4*/
	var grupo = new Array();
	grupo = document.getElementById('acudiente');
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("estudiante"+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+",";
		}
	}
	document.getElementById("gruposVar03").value=varios_grupos;
	/*5*/
	var grupo = new Array();
	grupo = document.getElementById('padre');
	var varios_grupos = "";
	for(y=0; y < grupo.length; y++)
	{  
		clase = document.getElementById("padre"+"[]_"+y).className;
		if(clase == "selected"){
			varios_grupos += grupo[y].value+",";
		}
	}
	document.getElementById("gruposVar04").value=varios_grupos;



	if(formulario.coordinador.value == '')
	{
		alert("Por favor seleccione el coordinador");
		formulario.coordinador.focus();
		return false;
	}
	if(formulario.sede.value == '')
	{
		alert("Por favor seleccione la sede");
		formulario.sede.focus();
		return false;
	}
return true;
}
</script>
<!--
<script type="text/javascript" src="js/jquery/jquery-1.4.min.js"></script>
<link href="js/jquery/js_select/select2.css" rel="stylesheet"/>
<script src="js/jquery/js_select/select2.js"></script>
<script type="text/javascript">
var jqNc = jQuery.noConflict();
jqNc(document).ready(function() {
	jqNc(".sele_mul").select2({
		placeholder: 'Seleccione uno...'
	});	
});
</script>
<script type="text/javascript">
var jqNc = jQuery.noConflict();
jqNc(document).ready(function() {
	jqNc(".mselect_list").select2({
		placeholder: 'Seleccione uno...'
	});	
});
</script>
-->
    <tr>
      <td width="203" align="right" valign="top"><b>Estudiantes:</b>&nbsp;&nbsp;</td>
      <td width="387" height="20" align="left" valign="middle"><select name="estudiante[]" class="mselect_list" multiple="multiple" id="acudiente" style="postion:relative; height:150px; width:250px;">

           <?php
	$con = 0;
	while($row_sedes23 = mysql_fetch_array($sedes23))
	{
	?>
	<optgroup  label="<p style='color:purple'><?php echo $row_sedes23['grupo_nombre'] ?></p>">
         <option value="<?php echo $row_sedes23['alumno_id'] ?>"><?php echo $row_sedes23['alumno_ape1'] . " " . $row_sedes23['alumno_ape2']. " " . $row_sedes23['alumno_nom1']. " " . $row_sedes23['alumno_nom2']?></option>
          <?php
		$con++;
	}
	?>
 </select></td>
    </tr>
<!--

    <?php 

$sql_grado_grupo2 = "SELECT DISTINCT * FROM gao 
				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 
				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 
				group by gao_nombre ORDER BY a";
$resultado_grado_grupo2 = mysql_query($sql_grado_grupo2,$link) or die ("No se pudo consultar los grados y los grupos");

 ?>
    <tr>
      <td width="203" align="right" valign="top"><b>Seleccione el grado del padre de familia:</b>&nbsp;&nbsp;</td>
      <td  id="varios_grupos2"  width="387" height="20" align="left" valign="middle"><select name="gradopa[]" multiple="multiple" id="grado2" style="postion:relative; height:150px; width:250px;">
  
          <?php
	$con = 0;
	while($grado_grupo2 = mysql_fetch_array($resultado_grado_grupo2))
	{
		if($con == 0)
		{
			$jornada = $grado_grupo2['jornada'];
	?>
          <optgroup label="<?php echo $grado_grupo['jornada'] ?>">
          <?php	
		}
		if($jornada != $grado_grupo2['jornada'])
		{
			$jornada = $grado_grupo2['jornada']
	?>
          </optgroup>
          <optgroup label="<?php echo $grado_grupo2['jornada'] ?>">
          <?php
		}
	?>
        <option style="text-align:center;"value="<?php echo $grado_grupo2['i'] ?>"><?php echo $grado_grupo2['b']?></option>
          <?php
		$con++;
	}
	if($con > 0)
	{
	?>
          </optgroup>
          <?php
	}
	?>
        </select>      </td>
        -->
    <?php 
$query_sedes24 = "SELECT * 
FROM acudiente
INNER JOIN alumno ON ( acudiente.alumno_id = alumno.alumno_id ) 
INNER JOIN matricula ON ( alumno.alumno_id = matricula.alumno_id ) 
INNER JOIN v_grupos ON ( v_grupos.grupo_id = matricula.grupo_id ) 
INNER JOIN v_grados ON ( v_grados.gao_id = matricula.grado_id ) 
order by v_grupos.grupo_nombre";
$sedes24 = mysql_query($query_sedes24, $link) or die(mysql_error());
$totalRows_sedes24 = mysql_num_rows($sedes24);
?>
    <tr>

      <td width="203" align="right" valign="top"><b>Padres de familia:</b>&nbsp;&nbsp;</td>

      <td width="387" height="20" align="left" valign="middle"><select name="padre[]" multiple="multiple" id="padre" style="postion:relative; height:150px; width:250px;">
  <?php
	$con = 0;
	while($row_sedes24 = mysql_fetch_array($sedes24))
	{
	?>
		<optgroup label="<p style='color:purple'><?php echo $row_sedes24['grupo_nombre'] ?></p>">
         <option value="<?php echo $row_sedes24['acu_id'] ?>"><?php echo $row_sedes24['acu_apellido1'] . " " . $row_sedes24['acu_apellido2']. " " . $row_sedes24['acu_nombre1']. " " . $row_sedes24['acu_nombre2']?></option>
          <?php
		$con++;
	}
	?>
    </select></td>
    </tr>


    <tr>
    <input name="gruposVar"  id="gruposVar" type="hidden"value=""/>	</td>
    <input name="gruposVar01"  id="gruposVar01" type="hidden"value=""/>	</td>
    <input name="gruposVar02"  id="gruposVar02" type="hidden"value=""/>	</td>
    <input name="gruposVar03"  id="gruposVar03" type="hidden"value=""/>	</td>
    <input name="gruposVar04"  id="gruposVar04" type="hidden"value=""/>	</td>

      <td align="center" colspan="2"><input name="ingIntegrante" type="submit" id="ingIntengrante" value="Ingresar" onclick="javascript:history.reload()"/>	</td>

    </tr>
  </table>
</form>
</div></div></div></div></div>
</td>
</tr>
<?php 
}
 ?>






<!-- iNTEGRANTES PARA EL CONSEJO DIRECTIVO -->











<?php 







if ( $_POST['nop'] == 145) {



 ?>



<tr>



<td>



<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es" onsubmit="return validaFormulario1(this)">



<div class="container_demohrvszv_caja_tipo_param" style="width:100%;">



<div class="accordion_example2wqzx"style="width:100%;">



<div class="accordion_inwerds"style="width:100%;">



<div class="acc_headerfgd"style="width:100%;"><strong style="width:120px;margin-left: -75%;"><center><strong>CONSEJO DIRECTIVO</strong></center> </strong></div>



<div class="acc_contentsaponk"style="width:;">



<div class="grevdaiolxx_caja_tipo_param"style="width:100%;;">



<div class="sin_resaltado"style="width:100%;  margin-left:">



<table width="100%" border="0" align="right" class="formulario">



<!--



	<tr>



		<th colspan="2" class="formulario">Seleccione el docente que va a agregar al Comit&eacute;  Seleccione los grupos de grado que va a agregar al Comit&eacute;  </th>



	</tr>



-->



<!-- Nuevo -->



 



			<script>



function validar4() {



if(document.getElementById('tipo').value=="A" || document.getElementById('tipo').value=="D")



{



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = true;



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").value = '';



}



else {



	document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = false;



}



}



</script>



<?php 



/*



<script type="text/javascript">



function validar4(){



if document.getElementById('tipo').value == 'A'{



	alert('message');



 document.getElementById("grado").disabled = true;



}



}



</script>



*/



 ?>



<!-- Nuevo -->















	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select  name="tipo" id="tipo" onclick="validar4()" onchange="carga_tipo('tipo', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante');"  style="display:none;">



	<option value="P">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>































	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select name="tipo1" id="tipo1" onclick="validar4()" onchange="carga_tipo('tipo1', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante1');" style="display:none;">



	<option value="E">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>















<?php 



if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>











<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetaaaa"style="color:black;">Diretivo o Delegado:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integranteeee">



	  <select name="1sede" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      		<optgroup label="Rector" >



      <?php



while ($row_sedes1234 = mysql_fetch_array($sedes1234)) {  



?>



      <option value="<?php echo $row_sedes1234['id'].'01'?>"><?php echo $row_sedes1234['nombre']?></option>



      <?php



} 



	?><optgroup label="Docentes Administrativo" >	<?php



while ($row_sedes5656 = mysql_fetch_array($resultado_integrantesCor5656)) {  



?>



      <option value="<?php echo $row_sedes5656['id']?>02"><?php echo $row_sedes5656['nombre']?></option>



      <?php



} 







?>



    </select>



	  </td>



	  </tr>



<?php } ?>















	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetaaaaa"style="color:black;">docente:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integranteeee">



	  <select name="sede1" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes1 = mysql_fetch_array($sedes1)) {  



?>



      <option value="<?php echo $row_sedes1['id']?>"><?php echo $row_sedes1['nombre']?></option>



      <?php



} 



  $rows1 = mysql_num_rows($sedes1);



  if($rows1 > 0) {



      mysql_data_seek($sedes1, 0);



	  $row_sedes1 = mysql_fetch_array($sedes1);



  }



?>



    </select>



	  </td>



	  </tr>



<?php } ?>



















	<tr>



	  <td align="right" valign="top"style="color:black;"><b>Seleccione la sede del padre de familia y estudiante:</b>&nbsp;&nbsp;</td>



	  <td height="20" align="left" valign="middle">



	  <select name="sede" id="sede" onchange="mostrarGrupo(this.value)">



      <option value="" >Seleccione una...</option>



      <?php



while ($row_sedes = mysql_fetch_array($sedes)) {  



?>



      <option value="<?php echo $row_sedes['sede_consecutivo']?>"><?php echo $row_sedes['sede_nombre']?></option>



      <?php



} 



  $rows = mysql_num_rows($sedes);



  if($rows > 0) {



      mysql_data_seek($sedes, 0);



	  $row_sedes = mysql_fetch_array($sedes);



  }



?>



    </select>



	  </td>



	  </tr>































<tr><td  width="387" height="20" align="left" valign="middle"> <td  width="387" height="20" align="left" valign="middle"> 



	<!--	<td  width="203" align="right" valign="top"style="color:black;"><b>Grados:</b>&nbsp;&nbsp;</td>-->



		







			<!--SEDE PRINCIPAL MAÑANA -->



			<?php



mysql_data_seek($sedes, 0);



	while($row_sedes2 = mysql_fetch_array($sedes)){



				$sel_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]."



				  ORDER BY a";



				$sql_grupos1 = mysql_query($sel_grupos, $link)or die("No se pudo consultar los grupos");



			?>



			<div id="divgrupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" style="display:none;">



<style>



	



	ul.mselect_list li, ul.mselect_list li.selected {



    background-color: #8DC5FF;



    color:#000;



}



</style><!--



			<select class="multiples" name="grupo<?php echo $row_sedes2['sede_consecutivo'];?>[]" id="grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" multiple="multiple" style="postion:relative; height:auto; width:250px;">



		<?php



			while($row_grupo = mysql_fetch_array($sql_grupos1)){



		?>



				<strong><option value="<?php echo $row_grupo['grupo_id'];?>"><?php echo $row_grupo['grupo_nombre'];?></option></strong>



				<?php



			}



				?>



		</select> 



-->	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<select name="id_grado" id="id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo', 'sede', 'id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante1');" style="    position: absolute;



    margin-top: 16%; width:35%;">



		<option  value=""><b>Seleccione...</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



<?php } ?>



<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		







		<select name="iid_grado" id="iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo1', 'sede', 'iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante');" style="    position: absolute;



    margin-top: 3%; width:35%;">



		<option  value=""><b>Seleccione....</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



		<?php } ?>



		</div>



				<?php







			}



				?>



		</td>



	</tr>







	



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		







<tr><td  width="203" align="right" valign="top"style="color:red;"><b>Seleccione el grado del<strong style="color:green;">  estudiante  </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>







	











	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Estudiantes :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante">



	<select name="integrante1" id="integrante1" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>















<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<tr><td  width="203" align="right" valign="top" style="color:red;"><b>Seleccione el grado del <strong style="color:green;"> padre de familia </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>



	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Padres de familia :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante1">



	<select name="integrante" id="integrante" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>







<?php 



if($valoresParametro[5] == 'otro'){



	 ?>
<table style='border:1px solid #DDDDDD; margin-center; width:100%;"'>



<th colspan=2 class='formulario' style='background-color: #3399FF;'> Ingrese El otro Integrante </th>



<tr><td style='color: black;'>Documento: </td><td><input type='text' id='documento_nuevo' name='documento_nuevo' /></td></tr>



<tr><td style='color: black;'>Nombre: </td><td><input type='text' id='nombre_nuevo' name='nombre_nuevo' /></td></tr>



</table>



<?php } ?>



	<tr>



	<td align="center" colspan="2">



	<input type="hidden" name="nop" value="<?php echo $_POST['nop']; ?>">



		<input type="button" style="background:red;"name="Cancelar" value="Cancelar" onclick="javascript:history.back()" />



		<input name="ingIntegrante" type="submit" id="ingIntengrante" value="Ingresar" onclick="javascript:history.reload()"/>	</td>







	</tr>



</table>



</form>



</div></div></div></div></div>



</td>



</tr>



<?php 



}



 ?>







<!-- FIN INTEGRANTES PARA EL CONSEJO DIRECTIVO -->











































<!-- Integrantes Para el consejo de padres -->



















<?php 







if ( $_POST['nop'] == 147) {



 ?>



<tr>



<td>



<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es" onsubmit="return validaFormulario1(this)">



<div class="container_demohrvszv_caja_tipo_param" style="width:100%;">



<div class="accordion_example2wqzx"style="width:100%;">



<div class="accordion_inwerds"style="width:100%;">



<div class="acc_headerfgd"style="width:100%;"><strong style="width:120px;margin-left: -75%;"><center><strong>CONSEJO DE PADRES</strong></center> </strong></div>



<div class="acc_contentsaponk"style="width:;">



<div class="grevdaiolxx_caja_tipo_param"style="width:100%;;">



<div class="sin_resaltado"style="width:100%;  margin-left:">



<table width="100%" border="0" align="right" class="formulario">



<!--



	<tr>



		<th colspan="2" class="formulario">Seleccione el docente que va a agregar al Comit&eacute;  Seleccione los grupos de grado que va a agregar al Comit&eacute;  </th>



	</tr>



-->



<!-- Nuevo -->



 



			<script>



function validar4() {



if(document.getElementById('tipo').value=="A" || document.getElementById('tipo').value=="D")



{



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = true;



document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").value = '';



}



else {



	document.getElementById("id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>").disabled = false;



}



}



</script>



<?php 



/*



<script type="text/javascript">



function validar4(){



if document.getElementById('tipo').value == 'A'{



	alert('message');



 document.getElementById("grado").disabled = true;



}



}



</script>



*/



 ?>



<!-- Nuevo -->















	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select  name="tipo" id="tipo" onclick="validar4()" onchange="carga_tipo('tipo', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante');"  style="display:none;">



	<option value="P">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>































	<tr>



	<td width="203" align="right" valign="top"style="display:none;"><b></b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" style="display:none;">



	<select name="tipo1" id="tipo1" onclick="validar4()" onchange="carga_tipo('tipo1', 'sede', 'grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante1');" style="display:none;">



	<option value="E">Seleccione uno</option>



	<?php 



	if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>



		<option value="A">Directivo o Delegado</option>



	<?php }?>



	<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>



	<option value="D">Docente</option>



	<?php }?>



	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<option value="P">Padre de Familia</option>



	<?php }?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



	<option value="E">Estudiante</option>



	<?php }?>	



	</select>	</td>



	</tr>



















<?php 



if($valoresParametro[2] == 'directivosDocentes'   OR $valoresParametro[8] == 'directivosDocentes' OR $valoresParametro[1] == 'directivosDocentes'){



	?>







<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetascva"style="color:black;">Diretivo o Delegado:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrantasse">



	  <select name="1sede" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      		<optgroup label="Rector" >



      <?php



while ($row_sedes1234 = mysql_fetch_array($sedes1234)) {  



?>



      <option value="<?php echo $row_sedes1234['id'].'01'?>"><?php echo $row_sedes1234['nombre']?></option>



      <?php



} 



	?><optgroup label="Docentes Administrativo" >	<?php



while ($row_sedes5656 = mysql_fetch_array($resultado_integrantesCor5656)) {  



?>



      <option value="<?php echo $row_sedes5656['id']?>02"><?php echo $row_sedes5656['nombre']?></option>



      <?php



} 







?>



    </select>



	  </td>



	  </tr>



<?php } ?>



















<?php 



	if($valoresParametro[3] == 'docentes'  OR $valoresParametro[9] == 'docentes' OR $valoresParametro[2] == 'docentes'){



	?>







<tr>



	  <td width="203" align="right" valign="top"><b id="td_etiquetggbba"style="color:black;">docente:</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integranttrytte">



	  <select name="sede1" id="sede1" style="width:59%;">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes1 = mysql_fetch_array($sedes1)) {  



?>



      <option value="<?php echo $row_sedes1['id']?>"><?php echo $row_sedes1['nombre']?></option>



      <?php



} 



  $rows1 = mysql_num_rows($sedes1);



  if($rows1 > 0) {



      mysql_data_seek($sedes1, 0);



	  $row_sedes1 = mysql_fetch_array($sedes1);



  }



?>



    </select>



	  </td>



	  </tr>



<?php } ?>















	<tr>



	  <td align="right" valign="top"style="color:black;"><b>Seleccione la sede del padre de familia y estudiantes:</b>&nbsp;&nbsp;</td>



	  <td height="20" align="left" valign="middle">



	  <select name="sede" id="sede" onchange="mostrarGrupo(this.value)">



      <option value="">Seleccione una...</option>



      <?php



while ($row_sedes = mysql_fetch_array($sedes)) {  



?>



      <option value="<?php echo $row_sedes['sede_consecutivo']?>"><?php echo $row_sedes['sede_nombre']?></option>



      <?php



} 



  $rows = mysql_num_rows($sedes);



  if($rows > 0) {



      mysql_data_seek($sedes, 0);



	  $row_sedes = mysql_fetch_array($sedes);



  }



?>



    </select>



	  </td>



	  </tr>































<tr><td  width="387" height="20" align="left" valign="middle"> <td  width="387" height="20" align="left" valign="middle"> 



	<!--	<td  width="203" align="right" valign="top"style="color:black;"><b>Grados:</b>&nbsp;&nbsp;</td>-->



		







			<!--SEDE PRINCIPAL MAÑANA -->



			<?php



mysql_data_seek($sedes, 0);



	while($row_sedes2 = mysql_fetch_array($sedes)){



				$sel_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]."



				  ORDER BY a";



				$sql_grupos1 = mysql_query($sel_grupos, $link)or die("No se pudo consultar los grupos");



			?>



			<div id="divgrupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" style="display:none;">



<style>



	



	ul.mselect_list li, ul.mselect_list li.selected {



    background-color: #8DC5FF;



    color:#000;



}



</style><!--



			<select class="multiples" name="grupo<?php echo $row_sedes2['sede_consecutivo'];?>[]" id="grupo_<?php echo $row_sedes2['sede_consecutivo']; ?>" multiple="multiple" style="postion:relative; height:auto; width:250px;">



		<?php



			while($row_grupo = mysql_fetch_array($sql_grupos1)){



		?>



				<strong><option value="<?php echo $row_grupo['grupo_id'];?>"><?php echo $row_grupo['grupo_nombre'];?></option></strong>



				<?php



			}



				?>



		</select> 



-->	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<select name="id_grado" id="id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo', 'sede', 'id_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante', 'td_etiqueta', 'td_integrante1');" style="    position: absolute;



    margin-top: 3%; width:35%;">



		<option  value=""><b>Seleccione...</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



<?php } ?>







	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		



		<select name="iid_grado" id="iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>" onchange="carga_tipo('tipo1', 'sede', 'iid_grado_<?php echo $row_sedes2['sede_consecutivo']; ?>', 'integrante1', 'td_etiqueta', 'td_integrante');" style="    position: absolute;



    margin-top: 16%; width:35%;">



		<option  value=""><b>Seleccione....</b></option>



		<?php 



$sql_grupos = "SELECT DISTINCT * FROM gao 



				INNER JOIN v_grupos ON(v_grupos.gao_id=gao.i) 



				INNER JOIN sedes ON(sedes.sede_consecutivo=v_grupos.grupo_sede) 



				where sede_consecutivo=".$row_sedes2[sede_consecutivo]." group by gao_nombre ORDER BY a";



$resultado_grupos = mysql_query($sql_grupos,$link) or die ("No se pudo consultar los grados y los grupos " . $sql_grupos);



 ?>



		<?php



		while($grado_grupo = mysql_fetch_array($resultado_grupos))



			{



				$sem = '';



				if($grado_grupo['a'] == 21 || $grado_grupo['a'] == 22 || $grado_grupo['a'] == 23 || $grado_grupo['a'] == 24 || $grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)



				{



					if($grado_grupo['semestre'] == 1)



					{



						$sem = ' S-A ';



					}



					else if ($grado_grupo['semestre'] == 2)



					{



						$sem = ' S-B ';



					}



				}



				if($con == 0)







				{



					$jornada = $grado_grupo['jornada'];



				//	echo "<optgroup label='".htmlentities($grado_grupo['jornada'])."'>";	



				}



				if($jornada != $grado_grupo['jornada'])



				{



					$jornada = $grado_grupo['jornada'];



					echo "</optgroup>";



					echo "<optgroup label='".$grado_grupo['jornada']."'>";



				}



						echo "<option value='".$grado_grupo['i']."'>".$grado_grupo['b']. ' ' . $sem ."</option>";



				$con++;



			}



			mysql_data_seek($resultado_grado_grupo,0);



			if($con > 0)



			{



				echo "</optgroup>";



			}



			?>



		</select>	



		<?php } ?>



		</div>



				<?php







			}



				?>



		</td>



	</tr>







	<?php 



	if($valoresParametro[4] == 'acudientes' OR $valoresParametro[10] == 'acudientes' OR $valoresParametro[3] == 'acudientes'){



	?>	



	<tr><td  width="203" align="right" valign="top" style="color:red;"><b>Seleccione el grado del <strong style="color:green;"> padre de familia </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>



	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Padres de familia :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante1">



	<select name="integrante" id="integrante" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>



	<?php 



	if($valoresParametro[5] == 'estudiantes'  OR $valoresParametro[11] == 'estudiantes' OR $valoresParametro[4] == 'estudiantes'){



	?>		







<tr><td  width="203" align="right" valign="top"style="color:red;"><b>Seleccione el grado del<strong style="color:green;">  estudiante  </strong>integrante del comite:</b>&nbsp;&nbsp;</td></tr>







	<tr>



    <td width="203" align="right" valign="top"><b id="td_etiqueta"style="color:black;">Estudiantes :</b>&nbsp;&nbsp;</td>



    <td width="387" height="20" align="left" valign="middle" id="td_integrante">



	<select name="integrante1" id="integrante1" disabled="disabled" style="width:59%;">



	<option value="">Seleccione uno</option>



	</select>	</td>



	</tr>



<?php } ?>



	







	<tr>



	<td align="center" colspan="2">



	<input type="hidden" name="nop" value="<?php echo $_POST['nop']; ?>">



		<input type="button" style="background:red;"name="Cancelar" value="Cancelar" onclick="javascript:history.back()" />



		<input name="ingIntegrante" type="submit" id="ingIntengrante" value="Ingresar" onclick="javascript:history.reload()"/>	</td>







	</tr>



</table>



</form>



</div></div></div></div></div>



</td>



</tr>



<?php 



}



 ?>











<!-- Integrantes Para el consejo de padres -->



















































































































































































































































































































	































































<tr>















<th class="footer">















<?php















include_once("inc.footer.php");















?></th>















</tr>















</table>















<!-- Termina lo bueno-->















<script type="text/javascript" src="js/script.js"></script>















<script type="text/javascript">















	















































	var sorter = new TINY.table.sorter('sorter','table',{















		headclass:'head',















		ascclass:'asc',















		descclass:'desc',















		evenclass:'evenrow',















		oddclass:'oddrow',















		evenselclass:'evenselected',















		oddselclass:'oddselected',















		paginate:true,















		size:15,















		colddid:'columns',















		currentid:'currentpage',















		totalid:'totalpages',















		startingrecid:'startrecord',















		endingrecid:'endrecord',















		totalrecid:'totalrecords',















		hoverid:'selectedrow',















		pageddid:'pagedropdown',















		navid:'tablenav',















		sortcolumn:0,















		sortdir:1,















		/*sum:[8],















		avg:[6,7,8,9],















		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],*/















		init:true















	});















  </script>	















<!--primer ACORDEON-->







<style type="text/css">







    .container_demohrvszv_caja_1{







      width: 100%;







margin: 5px;







    }







    .grevdaiolxx_caja_5{







      color: black;







      white-space:normal;







      width:100%;







      margin-left: 10px;







    }







  </style>







<style>







.smk_Accordionqwzxasa_caja_param {







  position: relative;







  margin: 0;







  padding: 0px;







  list-style: none;















}







/**







 * --------------------------------------------------------------















 * Section







 * --------------------------------------------------------------







 */







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 {







  border: 2px solid #3399FF;







  position: relative;







  margin-top: -1px;







  overflow: hidden;







}







/**







 * --------------------------------------------------------------







 * Head







 * --------------------------------------------------------------







 */















.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_headerfgd_caja_titulo {







  position: relative;







  background: #f0f6fe; 







  padding: 10px;







  font-size: 14px;







  display: block;







  cursor: pointer;







}







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_headerfgd_caja_titulo .acc_icon_expand_caja_param {







  display: block;







  width: 18px;







  height: 18px;







  position: absolute;







  left: 10px;







  top: 50%;







  margin-top: -9px;







  background: url(images/desplagable_acordeon.png) center 0;







}







/**







 * --------------------------------------------------------------







 * Content







 * --------------------------------------------------------------







 */







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 {







  background: #E7F1FE;







  color: #7B7E85;







  padding: 10px 15px;







}







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h1:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h2:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h3:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h4:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h5:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 h6:first-of-type {















  margin-top: 15px;















}















/**















 * --------------------------------------------------------------















 * General















 * --------------------------------------------------------------







 */







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3:first-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3:first-of-type .acc_headerfgd_caja_titulo {







  border-radius: 1px 1px 0 0;







  text-align: center;







}







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3:last-of-type,







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3:last-of-type .acc_contentsaponk_caja_4 {















  border-radius: 0 0 3px 3px;







}















.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3.acc_active_caja_param > .acc_contentsaponk_caja_4 {







  display: block;







}







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3.acc_active_caja_param > .acc_headerfgd_caja_titulo {







  background:rgba(51, 153, 255, 0.5);







}







.smk_Accordionqwzxasa_caja_param .accordion_inwerds_caja_3.acc_active_caja_param > .acc_headerfgd_caja_titulo .acc_icon_expand_caja_param {







  background: url(images/desplagable_acordeon.png) center -18px;







}







.smk_Accordionqwzxasa_caja_param.acc_with_icon .accordion_inwerds_caja_3 .acc_headerfgd_caja_titulo,







.smk_Accordionqwzxasa_caja_param.acc_with_icon .accordion_inwerds_caja_3 .acc_contentsaponk_caja_4 {







  padding-left: 35px;







}







</style>















<!-- -------------------------------------------------------------- JS ACORDEON ------------------------------------------------------------------------ -->







<script type="text/javascript">















    jQuery(document).ready(function($){















      $(".accordion_example2wqzx_caja_2").smk_Accordionqwzxasa_caja_param({















        closeAble: true, //boolean















      });















    });







  </script>







  <!--smok-->







  <script>







;(function ( $ ) {







  $.fn.smk_Accordionqwzxasa_caja_param = function( options ) {







    if (this.length > 1){







      this.each(function() { 







        $(this).smk_Accordionqwzxasa_caja_param(options);







      });







      return this;







    }







    // Defaults







    var settings = $.extend({







      animation:  true,







      showIcon:   true,







      closeAble:  false,







      closeOther: true,







      slideSpeed: 150,







      activeIndex: false







    }, options );







    if( $(this).data('close-able') )    settings.closeAble = $(this).data('close-able');







    if( $(this).data('animation') )     settings.animation = $(this).data('animation');







    if( $(this).data('show-icon') )     settings.showIcon = $(this).data('show-icon');







    if( $(this).data('close-other') )   settings.closeOther = $(this).data('close-other');







    if( $(this).data('slide-speed') )   settings.slideSpeed = $(this).data('slide-speed');







    if( $(this).data('active-index') )  settings.activeIndex = $(this).data('active-index');







    // Cache current instance







    // To avoid scope issues, use 'plugin' instead of 'this'







    // to reference this class from internal events and functions.







    var plugin = this;







    //"Constructor"







    var init = function() {







      plugin.createStructure();







      plugin.clickHead();







    }







    // Add .smk_Accordionqwzxasa_caja_param class







    this.createStructure = function() {







      //Add Class







      plugin.addClass('smk_Accordionqwzxasa_caja_param');







      if( settings.showIcon ){







        plugin.addClass('acc_with_icon_caja_param');







      }







      //Create sections if they were not created already







      if( plugin.find('.accordion_inwerds_caja_3').length < 1 ){







        plugin.children().addClass('accordion_inwerds_caja_3');







      }







      //Add classes to accordion head and content for each section







      plugin.find('.accordion_inwerds_caja_3').each(function(index, elem){







        var childs = $(elem).children();







        $(childs[0]).addClass('acc_headerfgd_caja_titulo');







        $(childs[1]).addClass('acc_contentsaponk_caja_4');







      });







      //Append icon







      if( settings.showIcon ){







        plugin.find('.acc_headerfgd_caja_titulo').prepend('<div class="acc_icon_expand_caja_param"></div>');







      }







      //Hide inactive







      plugin.find('.accordion_inwerds_caja_3 .acc_contentsaponk_caja_4').not('.acc_active_caja_param .acc_contentsaponk_caja_4').hide();







      //Active index







      if( settings.activeIndex === parseInt(settings.activeIndex) ){







        if(settings.activeIndex === 0){







          plugin.find('.accordion_inwerds_caja_3').addClass('acc_active_caja_param').show();







          plugin.find('.accordion_inwerds_caja_3 .acc_contentsaponk_caja_4').addClass('acc_active_caja_param').show();







        }







        else{







          plugin.find('.accordion_inwerds_caja_3').eq(settings.activeIndex - 1).addClass('acc_active_caja_param').show();







          plugin.find('.accordion_inwerds_caja_3 .acc_contentsaponk_caja_4').eq(settings.activeIndex - 1).addClass('acc_active_caja_param').show();







        }







      }







    }







    // Action when the user click accordion head







    this.clickHead = function() {







      plugin.on('click', '.acc_headerfgd_caja_titulo', function(){







        var s_parent = $(this).parent();







        if( s_parent.hasClass('acc_active_caja_param') == false ){







          if( settings.closeOther ){







            plugin.find('.acc_contentsaponk_caja_4').slideUp(settings.slideSpeed);







            plugin.find('.accordion_inwerds_caja_3').removeClass('acc_active_caja_param');







          } 







        }







        if( s_parent.hasClass('acc_active_caja_param') ){







          if( false !== settings.closeAble ){







            s_parent.children('.acc_contentsaponk_caja_4').slideUp(settings.slideSpeed);







            s_parent.removeClass('acc_active_caja_param');







          }







        }







        else{







          $(this).next('.acc_contentsaponk_caja_4').slideDown(settings.slideSpeed);







          s_parent.addClass('acc_active_caja_param');







        }







      });







    }







    //"Constructor" init







    init();







    return this;







  };







}( jQuery ));







  </script>



<!-- primer Acordeon -->



















<!-- Segundo Acordeon -->



<!--ESTILOS ACORDEON-->































<style type="text/css">































    































    .container_demohrvszv{



 width: 100%;



margin: 5px;



    }































    .grevdaiolxx{



    color: black;







      white-space:normal;







      width:100%;







      margin-left: 10px;



    }































  </style>































































<style>































.smk_Accordionqwzxasa {



  position: relative;







  margin: 0;







  padding: 0px;







  list-style: none;







}































/**































 * --------------------------------------------------------------































 * Section































 * --------------------------------------------------------------































 */































.smk_Accordionqwzxasa .accordion_inwerds {































  border: 2px solid #3399FF;































  position: relative;































  margin-top: -1px;































  overflow: hidden;































}































/**































 * --------------------------------------------------------------































 * Head































 * --------------------------------------------------------------































 */































































 































.smk_Accordionqwzxasa .accordion_inwerds .acc_headerfgd {































  position: relative;































  background: #f0f6fe; 































  padding: 10px;































  font-size: 14px;































  display: block;































  cursor: pointer;































































}































.smk_Accordionqwzxasa .accordion_inwerds .acc_headerfgd .acc_icon_expand {































  display: block;































  width: 18px;































  height: 18px;































  position: absolute;































  left: 10px;































  top: 50%;































  margin-top: -9px;































  background: url(images/desplagable_acordeon.png) center 0;































}































/**































 * --------------------------------------------------------------































 * Content































 * --------------------------------------------------------------































 */































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk {































  background: #E7F1FE;































  color: #7B7E85;































  padding: 10px 15px;































}































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h1:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h2:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h3:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h4:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h5:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds .acc_contentsaponk h6:first-of-type {































  margin-top: 15px;































}































/**































 * --------------------------------------------------------------































 * General































 * --------------------------------------------------------------































 */































.smk_Accordionqwzxasa .accordion_inwerds:first-of-type,































.smk_Accordionqwzxasa .accordion_inwerds:first-of-type .acc_headerfgd {































  border-radius: 1px 1px 0 0;































  text-align: center;































}































.smk_Accordionqwzxasa .accordion_inwerds:last-of-type,































.smk_Accordionqwzxasa .accordion_inwerds:last-of-type .acc_contentsaponk {































  border-radius: 0 0 3px 3px;































}































.smk_Accordionqwzxasa .accordion_inwerds.acc_active > .acc_contentsaponk {































  display: block;































}































.smk_Accordionqwzxasa .accordion_inwerds.acc_active > .acc_headerfgd {































  































  background:rgba(51, 153, 255, 0.5);































}































.smk_Accordionqwzxasa .accordion_inwerds.acc_active > .acc_headerfgd .acc_icon_expand {































  background: url(images/desplagable_acordeon.png) center -18px;































}































.smk_Accordionqwzxasa.acc_with_icon .accordion_inwerds .acc_headerfgd,































.smk_Accordionqwzxasa.acc_with_icon .accordion_inwerds .acc_contentsaponk {































  padding-left: 35px;































}































  































</style>































































































































<!-- -------------------------------------------------------------- JS ACORDEON ------------------------------------------------------------------------ -->































































<script type="text/javascript">































    jQuery(document).ready(function($){































































      $(".accordion_example1").smk_Accordionqwzxasa();































































      $(".accordion_example2wqzx").smk_Accordionqwzxasa({































        closeAble: true, //boolean































      });































































      $(".accordion_example3").smk_Accordionqwzxasa({































        showIcon: false, //boolean































      });































































      $(".accordion_example4").smk_Accordionqwzxasa({































        closeAble: true, //boolean































        closeOther: false, //boolean































      });































































      $(".accordion_example5").smk_Accordionqwzxasa({closeAble: true});































































      $(".accordion_example6").smk_Accordionqwzxasa();































      































      $(".accordion_example7").smk_Accordionqwzxasa({































        activeIndex: 2 //second section open































      });































      $(".accordion_example8, .accordion_example9").smk_Accordionqwzxasa();































































 































      































    });































  </script>































































  <!--smok-->































































  <script>































































;(function ( $ ) {































































  $.fn.smk_Accordionqwzxasa = function( options ) {































    































    if (this.length > 1){































      this.each(function() { 































        $(this).smk_Accordionqwzxasa(options);































      });































      return this;































    }































    































    // Defaults































    var settings = $.extend({































      animation:  true,































      showIcon:   true,































      closeAble:  false,































      closeOther: true,































      slideSpeed: 150,































      activeIndex: false































    }, options );































































    if( $(this).data('close-able') )    settings.closeAble = $(this).data('close-able');































    if( $(this).data('animation') )     settings.animation = $(this).data('animation');































    if( $(this).data('show-icon') )     settings.showIcon = $(this).data('show-icon');































    if( $(this).data('close-other') )   settings.closeOther = $(this).data('close-other');































    if( $(this).data('slide-speed') )   settings.slideSpeed = $(this).data('slide-speed');































    if( $(this).data('active-index') )  settings.activeIndex = $(this).data('active-index');































































    // Cache current instance































    // To avoid scope issues, use 'plugin' instead of 'this'































    // to reference this class from internal events and functions.































    var plugin = this;































































    //"Constructor"































    var init = function() {































      plugin.createStructure();































      plugin.clickHead();































    }































































    // Add .smk_Accordionqwzxasa class































    this.createStructure = function() {































































      //Add Class































      plugin.addClass('smk_Accordionqwzxasa');































      if( settings.showIcon ){































        plugin.addClass('acc_with_icon');































      }































































      //Create sections if they were not created already































      if( plugin.find('.accordion_inwerds').length < 1 ){































        plugin.children().addClass('accordion_inwerds');































      }































































      //Add classes to accordion head and content for each section































      plugin.find('.accordion_inwerds').each(function(index, elem){































        var childs = $(elem).children();































        $(childs[0]).addClass('acc_headerfgd');































        $(childs[1]).addClass('acc_contentsaponk');































      });































      































      //Append icon































      if( settings.showIcon ){































        plugin.find('.acc_headerfgd').prepend('<div class="acc_icon_expand"></div>');































      }































































      //Hide inactive































      plugin.find('.accordion_inwerds .acc_contentsaponk').not('.acc_active .acc_contentsaponk').hide();































































      //Active index































      if( settings.activeIndex === parseInt(settings.activeIndex) ){































        if(settings.activeIndex === 0){































          plugin.find('.accordion_inwerds').addClass('acc_active').show();































          plugin.find('.accordion_inwerds .acc_contentsaponk').addClass('acc_active').show();































        }































        else{































          plugin.find('.accordion_inwerds').eq(settings.activeIndex - 1).addClass('acc_active').show();































          plugin.find('.accordion_inwerds .acc_contentsaponk').eq(settings.activeIndex - 1).addClass('acc_active').show();































        }































      }































      































    }































    // Action when the user click accordion head































    this.clickHead = function() {































































      plugin.on('click', '.acc_headerfgd', function(){































        































        var s_parent = $(this).parent();































        































        if( s_parent.hasClass('acc_active') == false ){































          if( settings.closeOther ){































            plugin.find('.acc_contentsaponk').slideUp(settings.slideSpeed);































            plugin.find('.accordion_inwerds').removeClass('acc_active');































          } 































        }































        if( s_parent.hasClass('acc_active') ){































          if( false !== settings.closeAble ){































            s_parent.children('.acc_contentsaponk').slideUp(settings.slideSpeed);































            s_parent.removeClass('acc_active');































          }































        }































        else{































          $(this).next('.acc_contentsaponk').slideDown(settings.slideSpeed);































          s_parent.addClass('acc_active');































        }































      });































    }































































    //"Constructor" init































    init();































    return this;































  };































































}( jQuery ));































  </script>



<!-- Segundo Acordeon -->







<style type="text/css">







input[type=button]{



 background: #2c87f5;







  -webkit-border-radius: 28;



  -moz-border-radius: 28;



  border-radius: 28px;



   font-family: Arial;



  color: #ffffff;



  font-size: 12px;



  padding: 10px 10px 10px 10px;



  text-decoration: none;



  width: 100px;



  height: 40px;



}















input[type=button] a{



  text-decoration: none;



  color: #fff;







}











input[type=button]  a:hover{



  text-decoration: none;



  color: #fff;







}











input[type=button]:hover {



  background: #3cb0fd;



 



  text-decoration: none;



  color: #fff;



}











input[type=submit]{



 background: #2c87f5;



  background-image: -webkit-linear-gradient(top, #2c87f5, #1b7ab5);



  background-image: -moz-linear-gradient(top, #2c87f5, #1b7ab5);



  background-image: -ms-linear-gradient(top, #2c87f5, #1b7ab5);



  background-image: -o-linear-gradient(top, #2c87f5, #1b7ab5);



  background-image: linear-gradient(to bottom, #2c87f5, #1b7ab5);



  -webkit-border-radius: 28;



  -moz-border-radius: 28;



  border-radius: 28px;



   font-family: Arial;



  color: #ffffff;



  font-size: 13.5px;



  padding: 10px 10px 10px 10px;



  text-decoration: none;



  width: 100px;



  height: 40px;



















}







input[type=submit] a{



  text-decoration: none;



  color: #fff;







}











input[type=submit]  a:hover{



  text-decoration: none;



  color: #fff;







}











input[type=submit]:hover {



  background: #3cb0fd;



  background-image: -webkit-linear-gradient(top, #3cb0fd, #00AAEE);



  background-image: -moz-linear-gradient(top, #3cb0fd, #00AAEE);



  background-image: -ms-linear-gradient(top, #3cb0fd, #00AAEE);



  background-image: -o-linear-gradient(top, #3cb0fd, #00AAEE);



  background-image: linear-gradient(to bottom, #3cb0fd, #00AAEE);



  text-decoration: none;



  color: #fff;



}



		</style>















</style>



</body>















</html>