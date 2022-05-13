<?php

session_start();

if ($_SESSION["soporte"]=="true") {

$roles_con_permiso = array('99', '6'); 

include_once("inc.configuracion.php");

include_once("inc.validasesion.php");

include_once("inc.funciones.php");

include_once("conexion.php"); 

//Conexi&oacute;n a la base de datos

$link = conectarse();

mysql_select_db($database_sygescol,$link);
$total2validar = substr($_SERVER['PHP_SELF'], 14, 1000); 
$sel_modulos1validar = "SELECT m_p_a.perfil_id perfil, m_p_a.mod_id, m_s.mod_link archivo
FROM modulos_sygescol m_s
JOIN modulos_perfil_accesos m_p_a ON ( m_s.mod_id = m_p_a.mod_id) where m_p_a.perfil_id = '".$_SESSION['perfil_id']."' AND m_s.mod_link =  '$total2validar' ";
$sql_modulos1validar= mysql_query($sel_modulos1validar, $link)or die(mysql_error());
$num_modulos1validar = mysql_num_rows($sql_modulos1validar);
//$rows_datos1 = mysql_fetch_array($sql_modulos1);
if($num_modulos1validar == 0)
{
?> 
<script type="text/javascript">
	 window.location.href='bloquear_sygescol.php';
</script>
<?php
	
}
$selSuperior = "SELECT * FROM escala_nacional WHERE esca_nac_letra = 'S'";

$sqlSuperior = mysql_query($selSuperior, $link);

$rowSuperior = mysql_fetch_array($sqlSuperior);

$notaSupMin = substr($rowSuperior['esca_nac_min'],0,3);

$notaSupMax = substr($rowSuperior['esca_nac_max'],0,3);

$selAlto = "SELECT * FROM escala_nacional WHERE esca_nac_letra = 'A'";

$sqlAlto = mysql_query($selAlto, $link);

$rowAlto = mysql_fetch_array($sqlAlto);

$notaAltoMin = substr($rowAlto['esca_nac_min'],0,3);

$notaAltoMax = substr($rowAlto['esca_nac_max'],0,3);

$selBasico = "SELECT * FROM escala_nacional WHERE esca_nac_letra = 'Bs'";

$sqlBasico = mysql_query($selBasico, $link);

$rowBasico = mysql_fetch_array($sqlBasico);

$notaBasicoMin = substr($rowBasico['esca_nac_min'],0,3);

$notaBasicoMax = substr($rowBasico['esca_nac_max'],0,3);

$selBajo = "SELECT * FROM escala_nacional WHERE esca_nac_letra = 'Bj'";

$sqlBajo = mysql_query($selBajo, $link);

$rowBajo = mysql_fetch_array($sqlBajo);

$notaBajoMin = substr($rowBajo['esca_nac_min'],0,3);

$notaBajoMax = substr($rowBajo['esca_nac_max'],0,3);

function ConsultarTextoCriterio($nombre)

{

	global $link, $database_sygescol;

	mysql_select_db($database_sygescol,$link);

	$descripcion = '';

	$sel = "SELECT * FROM criterios_promocion_texto WHERE criterio_nombre='".$nombre."'";

	$sql = mysql_query($sel, $link);

	if(mysql_num_rows($sql)>0){

		$row = mysql_fetch_assoc($sql);

		$descripcion = $row['criterio_texto'];

	}	

	return $descripcion;

}

$query_ano_sistema = "SELECT `year`.b FROM `year`";

$ano_sistema = mysql_query($query_ano_sistema, $sygescol) or die(mysql_error());

$row_ano_sistema = mysql_fetch_assoc($ano_sistema);

$totalRows_ano_sistema = mysql_num_rows($ano_sistema);

if (!function_exists("GetSQLValueString")) {

	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")

	{

	  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

	  switch ($theType) {

	    case "text":

	      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

	      break;

	    case "long":

	    case "int":

	      $theValue = ($theValue != "") ? intval($theValue) : "NULL";

	      break;

	    case "double":

	      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";

	      break;

	    case "date":

	      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

	      break;

	    case "defined":

	      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue; break;

	  }

	  return $theValue; }

 }

if(isset($_POST['actualizar']))

 {

 	$selected_radio = $_POST['colores'];

$selected_radiob = $_POST['coloresb'];

$selected_radioc = $_POST['coloresc'];

$selected_radiod = $_POST['coloresd'];

$selected_radioe = $_POST['colorese'];

$selected_radiof = $_POST['coloresf'];

$selected_radiog = $_POST['coloresg'];

$selected_radioh = $_POST['coloresh'];

$selected_radioi = $_POST['coloresi'];

$selected_radioj = $_POST['coloresj'];

$selected_radiok = $_POST['coloresk'];

$selected_radiol = $_POST['coloresl'];

$selected_radiox = $_POST['coloresx'];

$selected_radioy = $_POST['coloresy'];

$selected_radiovv = $_POST['coloresvv'];

$selected_radioww = $_POST['coloresww'];

$selected_radioppo = $_POST['coloresppo'];


//RECONOCIMIENTO DE VOZ


$rv1=$_POST["rv1"];
$rv2=$_POST["rv2"];
$rv3=$_POST["rv3"];
$rv4=$_POST["rv4"];
$rv5=$_POST["rv5"];
$rv6=$_POST["rv6"];
$rv7=$_POST["rv7"];





//INTERACCION
$t_interaccion = $_POST['tirv']; // tv  v
$t_estructura = $_POST['testruc']; // t1 t2
$t_fines = $_POST['tfines']; // f1 f2

if ($t_interaccion == 'tv') {
$t_interaccionf="tv";
}

if ($t_interaccion == 'v') {
$t_interaccionf="v";
}



if ($t_estructura == 't1') {
$t_estructuraf="t1";
}
if ($t_estructura == 't2') {
$t_estructuraf="t2";
}

if ($t_fines == 'fs') {
$t_finesf="f1";
}
if ($t_fines == 'fn') {
$t_finesf="f2";
}



$rv_final= array($rv1,$rv2,$rv3,$rv4,$rv7,$rv5,$rv6,$t_interaccionf,$t_estructuraf,$t_finesf);
$rv_final2 = implode("$", $rv_final);


global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol SET conf_valor = '$rv_final2' WHERE conf_id = 243";

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar eerwerzzzzl adic");











if ($selected_radioppo == 'rojoppo') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 18;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioppo == 'naranjappo') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 18;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radio == 'rojo') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 1;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radio == 'naranja') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 1;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiob == 'rojob') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 2;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiob == 'naranjab') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 2;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioc == 'rojoc') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 3;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioc == 'naranjac') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 3;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiod == 'rojod') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 4;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiod == 'naranjad') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 4;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioe == 'rojoe') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 5;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioe == 'naranjae') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 5;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiof == 'rojof') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 6;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiof == 'naranjaf') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 6;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiog == 'rojog') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 7;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiog == 'naranjag') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 7;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioh == 'rojoh') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 8;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioh == 'naranjah') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 8;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioi == 'rojoi') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 9;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioi == 'naranjai') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 9;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioj == 'rojoj') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 10;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioj == 'naranjaj') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 10;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiok == 'rojok') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 11;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiok == 'naranjak') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 11;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiol == 'rojol') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 12;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiol == 'naranjal') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 12;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiox == 'rojox') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 13;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiox == 'naranjax') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 13;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioy == 'rojoy') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 14;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioy == 'naranjay') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 14;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiovv == 'rojovv') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 15;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radiovv == 'naranjavv') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 15;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioww == 'rojoww') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '#64BD63' WHERE id = 16;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

if ($selected_radioww == 'naranjaww') {

global $database_sygescol, $sygescol;

$update_adic="UPDATE conf_sygescol_adic SET valor = '' WHERE id = 16;";			

$sql_update=mysql_query($update_adic, $sygescol)or die("No se pudo Modificar el adic");

}

	mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (14, 16, 17, 18,170, 19, 20, 50,152,65,93,95,96,100,109,68,73,99,123,124,156,115,161,162,14,67,76,87,111,127,132,141,149,163,56,71,88,89,92,94,97,110,102,169,117,154,157,70,122,160,98,108,112,113,116,121,129,120,135,150,155,75,90,91,101,103,107,118,119,130,131,133,134,138,139,104,105,114,140,158,128,153,159,136,151,164,142,143,144,145,146,147,166,168,165,66,137,167,223,242,240,243,241)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

	$totalRows_configuracion = mysql_num_rows($configuracion);

	$sel_actas="SELECT * FROM actas_impresion WHERE tipo_dato='PARAMETROS_GENERALES'";

	$sql_actas=mysql_query($sel_actas, $sygescol)or die("No se Pudo Consultar las Actas.");

	$num_actas=mysql_num_rows($sql_actas);

	do

	{

		if($row_configuracion['conf_id'] == 76){

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 89){ // MODULO HOMOLOGACION

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST[$row_configuracion['conf_nombre']."_estado"]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 90){ // FAMILIAS EN ACCION

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST[$row_configuracion['conf_nombre']."_nivel"]."$".$_POST[$row_configuracion['conf_nombre']."_estado"]."$".$_POST[$row_configuracion['conf_nombre']."_demo"]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 91){ // DOCUMENTOS LEGALES
				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']].",".$_POST['cons_estu'].",".$_POST['cons_matri'].",".$_POST['cons_fam'].",".$_POST['cons_cajas'].",".$_POST['cons_paz'].",".$_POST['cons_info'].",".$_POST['cons_obs'].",".$_POST['cons_ret'].",".$_POST['cons_retno'].",".$_POST['car_papel'].",".$_POST['gen_acu'].",".$_POST['gen_ins'].",".$_POST['gen_pac'].",".$_POST['cer_actual'].",".$_POST['gen_estu'].",".$_POST["primeroA_".$row_configuracion['conf_nombre']].",".$_POST["segundoA_".$row_configuracion['conf_nombre']].",".$_POST["terceroA_".$row_configuracion['conf_nombre']].",".$_POST["cuartoA_".$row_configuracion['conf_nombre']].",".$_POST["quintoA_".$row_configuracion['conf_nombre']].",".$_POST["sextoA_".$row_configuracion['conf_nombre']].",".$_POST["septimoA_".$row_configuracion['conf_nombre']].",".$_POST["octavoA_".$row_configuracion['conf_nombre']].",".$_POST["novenoA_".$row_configuracion['conf_nombre']].",".$_POST["decimoA_".$row_configuracion['conf_nombre']].",".$_POST["onceA_".$row_configuracion['conf_nombre']].",".$_POST["doceA_".$row_configuracion['conf_nombre']].",".$_POST["treceA_".$row_configuracion['conf_nombre']].",".$_POST["catorceA_".$row_configuracion['conf_nombre']].",".$_POST["quinceA_".$row_configuracion['conf_nombre']].",".$_POST['cer_anterior'].",".$_POST["onceE_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
	
				$selDocumentoAutorizado = "SELECT * FROM documentos_legales WHERE parametro=1";
				$sqlDocumentoAutorizado = mysql_query($selDocumentoAutorizado, $link)or die(mysql_error());	
				while($rowDocumentoAutorizado = mysql_fetch_array($sqlDocumentoAutorizado)){
					$sql_upd_configuracion = "UPDATE documentos_legales SET autoriza = '".$_POST["autoriza_".$row_configuracion['conf_nombre'].$rowDocumentoAutorizado['docu_legal_id']]."',firma = '".$_POST["firma_".$row_configuracion['conf_nombre'].$rowDocumentoAutorizado['docu_legal_id']]."'  WHERE docu_legal_id LIKE '".$rowDocumentoAutorizado['docu_legal_id']."'";
					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		
				}
		}elseif($row_configuracion['conf_id'] == 120){ // PROMOCION ANTICIPADA

      $sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["criterio120_".$row_configuracion['conf_nombre']]."$".$_POST['nota_minima_120']."$".$_POST['aplica_nota_comportamiento']."$".$_POST['nota_comportamiento']."$".$_POST['aplica_asistencia']."$".$_POST['porcentaje_asistencia']."$".$_POST['no_negativos']."$".$_POST['num_periodo']."$".$_POST['estado_120']."$".$_POST['periodo_fecha_inicio_120']."$".$_POST['periodo_fecha_final_120']."$".$_POST['prueba_I']."$".$_POST['obtener_V']."$".$_POST['calificacion_P']."$".$_POST['certificados_E']."$".$_POST["valorDesempate2_".$row_configuracion['conf_nombre']]."$".$_POST["valorDesempate3_".$row_configuracion['conf_nombre']]."$".$_POST['E1_']."$".$_POST['E2_']."$".$_POST['E3_']."$".$_POST['E4_']."$".$_POST['E5_']."$".$_POST['E6_']."$".$_POST['E7_']."$".$_POST['E8_']."$".$_POST['E9_']."$".$_POST['E10_']."$".$_POST['E11_']."$".$_POST['E12_']."$".$_POST['aplica_nota_comportamiento2']."$".$_POST['aplica_nota_comportamiento3']."$".$_POST["calificacion_A_".$row_configuracion['conf_nombre']]."$".$_POST['primero_S']."$".$_POST['Segundo_T']."$".$_POST['Tercero_C']."$".$_POST['Cuarto_Q']."$".$_POST['Quinto_S']."$".$_POST['Sexto_S']."$".$_POST['Semptimo_O']."$".$_POST['Octavo_N']."$".$_POST['Noveno_D']."$".$_POST['Decimo_O']."$".$_POST['valorNota_']."$".$_POST['aplica_promoanti_120']."$".$_POST['transicion_P']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";  
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 121){ // PROMOCION ANTICIPADA REPROBADOS 121
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST['aplica_promoanti_121']."$".$_POST['nota_minima_121']."$".$_POST['aplica_nota_comportamiento_121']."$".$_POST['nota_comportamiento_121']."$".$_POST['aplica_asistencia_121']."$".$_POST['porcentaje_asistencia_121']."$".$_POST['no_negativos_121']."$".$_POST['aplica_periodo_121']."$".$_POST['periodo_fecha_inicio_1211']."$".$_POST['periodo_fecha_final_1211']."$".$_POST['estado_121']."$".$_POST['aDirectiva']."$".$_POST['paraQueAreas']."$".$_POST['areasReprobadas']."$".$_POST['todasAreas']."$".$_POST['demasAreas']."$".$_POST['areas_R']."$".$_POST['todas_A']."$".$_POST['demas_A']."$".$_POST['aDirectiva2']."$".$_POST['aplica_promoanti_1211']."$".$_POST['no_negativos_1211']."$".$_POST['aplica_asistencia_1211']."$".$_POST['periodo_fecha_inicio_121']."$".$_POST['periodo_fecha_final_121']."$".$_POST['periodo_fecha_inicio_1211_2']."$".$_POST['periodo_fecha_final_1211_2']."$".$_POST['periodo_fecha_inicio_1211_2_1']."$".$_POST['periodo_fecha_final_1211_2_1']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";	
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 124){
				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["0_".$row_configuracion['conf_nombre']]."$".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."$".$_POST["4_".$row_configuracion['conf_nombre']]."$".$_POST["5_".$row_configuracion['conf_nombre']]."$".$_POST["6_".$row_configuracion['conf_nombre']]."$".$_POST["7_".$row_configuracion['conf_nombre']]."$".$_POST["8_".$row_configuracion['conf_nombre']]."$".$_POST["9_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 223){ // PROMOCION ANTICIPADA REPROBADOS 121


			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["criterio_".$row_configuracion['conf_nombre']]."$".$_POST['areas_R_1']."$".$_POST['areas_R_2']."$".$_POST['hora_cita_1']."$".$_POST['hora_cita_2']."$".$_POST['hora_citaa_1']."$".$_POST['hora_citaa_2']."$".$_POST['areas_B_1']."$".$_POST['areas_B_2']."$".$_POST['hora_citaaa_1']."$".$_POST['hora_citaaa_2']."$".$_POST['hora_citaaaa_1']."$".$_POST['hora_citaaaa_2']."$".$_POST['areas_B_3']."$".$_POST['hora_citaaa_2']."$".$_POST['hora_citaaa_3']."$".$_POST['hora_citaaaa_2']."$".$_POST['hora_citaaaa_3']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";    


			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");


		}elseif($row_configuracion['conf_id'] == 240){ // PROMOCION ANTICIPADA REPROBADOS 121
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST['aplica_semana_numero']."$".$_POST['radio_semana_numero']."' WHERE conf_id =240";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 122){ // Rotacion del horario 122

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST['horaClases']."$".$_POST['jornadaCompleta']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";	

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] ==94){
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']].",".$_POST['pla0'].",".$_POST['pla1'].",".$_POST['pla2'].",".$_POST['pla3'].",".$_POST['pla4'].",".$_POST['pla5'].",".$_POST['pla6'].",".$_POST['pla7'].",".$_POST['pla8']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 101){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["certificado_".$row_configuracion['conf_nombre']].",".$_POST["valCertificado_".$row_configuracion['conf_nombre']]."@".$_POST["constancia_".$row_configuracion['conf_nombre']].",".$_POST["valConstancia_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 105){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["select_foto_carne_acu_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']]."$".$_POST["f_".$row_configuracion['conf_nombre']]."$".$_POST["g_".$row_configuracion['conf_nombre']]."$".$_POST["h_".$row_configuracion['conf_nombre']]."$".$_POST["i_".$row_configuracion['conf_nombre']]."$".$_POST["j_".$row_configuracion['conf_nombre']]."$".$_POST["k_".$row_configuracion['conf_nombre']]."$".$_POST["l_".$row_configuracion['conf_nombre']]."$".$_POST["m_".$row_configuracion['conf_nombre']]."$".$_POST["n_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 108){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

				'".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."$".$_POST["4_".$row_configuracion['conf_nombre']]."$".$_POST["5_".$row_configuracion['conf_nombre']]."$".$_POST["6_".$row_configuracion['conf_nombre']]."$".$_POST["7_".$row_configuracion['conf_nombre']]."$".$_POST["8_".$row_configuracion['conf_nombre']]."$".$_POST["9_".$row_configuracion['conf_nombre']]."$".$_POST["10_".$row_configuracion['conf_nombre']]."$".$_POST["11_".$row_configuracion['conf_nombre']]."$".$_POST["12_".$row_configuracion['conf_nombre']]."$".$_POST["13_".$row_configuracion['conf_nombre']]."$".$_POST["14_".$row_configuracion['conf_nombre']]."$' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 117){

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cSs_".$row_configuracion['conf_nombre']]."$".$_POST["cAa_".$row_configuracion['conf_nombre']]."$".$_POST["cBsb_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

			if($_POST[$row_configuracion['conf_nombre']]=='S'){

				$query_upd_conf = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre = 'sis_cal_ref'";

				$upd_conf = mysql_query($query_upd_conf, $sygescol) or die(mysql_error());

			}

		}

		elseif($row_configuracion['conf_id'] == 236){
				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["reasignacion_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacion2_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}

////////////////////////////////////////////////////////////////////////////////////////////////camilo////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($row_configuracion['conf_id'] == 235){
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
			if($_POST[$row_configuracion['conf_nombre']]=='S'){
				$query_upd_conf = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre = 'sis_cal_ref'";
				$upd_conf = mysql_query($query_upd_conf, $sygescol) or die(mysql_error());
			}
		}
////////////////////////////////////////////////////////////////////////////////////////////////camilo////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($row_configuracion['conf_id'] == 98){

				if($_POST["valor_".$row_configuracion['conf_nombre']] == "N"){

					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

					'$".$_POST["valor_".$row_configuracion['conf_nombre']]."$".$_POST["PRE_".$row_configuracion['conf_nombre']]."$".$_POST["BP_".$row_configuracion['conf_nombre']]."$".$_POST["BS_".$row_configuracion['conf_nombre']]."$".$_POST["ME_".$row_configuracion['conf_nombre']]."$".$_POST["FC_".$row_configuracion['conf_nombre']]."$".$_POST["CI_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
					$sql_upd_configuracion1 = "UPDATE conf_sygescol SET c = 

					'".$_POST["valor_".$row_configuracion['conf_nombre']]."'";
$upd_configuracion1 = mysql_query($sql_upd_configuracion1, $sygescol) or die("No se pudo actualizar los parametros del sistema");

				}else if($_POST["valor_".$row_configuracion['conf_nombre']] == "A"){

					$selGrados = "SELECT * FROM gao GROUP BY ba ORDER BY a";

					$sqlGrados = mysql_query($selGrados, $link);					

					while ($rowGrados = mysql_fetch_array($sqlGrados)) {

						$valorInsertar .= "$".$_POST["grado98_".$rowGrados['a']]."$";

					}

					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

					'$".$_POST["valor_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']].$valorInsertar."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");					
	$sql_upd_configuracion1 = "UPDATE conf_sygescol SET c = 

					'".$_POST["valor_".$row_configuracion['conf_nombre']]."'";
$upd_configuracion1 = mysql_query($sql_upd_configuracion1, $sygescol) or die("No se pudo actualizar los parametros del sistema");
				}
				else if($_POST["valor_".$row_configuracion['conf_nombre']] == "B"){

					$selGrados = "SELECT * FROM gao GROUP BY ba ORDER BY a";

					$sqlGrados = mysql_query($selGrados, $link);					

					while ($rowGrados = mysql_fetch_array($sqlGrados)) {

						$valorInsertar .= "$".$_POST["grado98_".$rowGrados['a']]."$";

					}

					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

					'$".$_POST["valor_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']].$valorInsertar."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");					
	$sql_upd_configuracion1 = "UPDATE conf_sygescol SET c = 

					'".$_POST["valor_".$row_configuracion['conf_nombre']]."'";
$upd_configuracion1 = mysql_query($sql_upd_configuracion1, $sygescol) or die("No se pudo actualizar los parametros del sistema");
				}
else if($_POST["valor_".$row_configuracion['conf_nombre']] == "G"){

					$selGrados = "SELECT * FROM gao GROUP BY ba ORDER BY a";

					$sqlGrados = mysql_query($selGrados, $link);					

					while ($rowGrados = mysql_fetch_array($sqlGrados)) {

						$valorInsertar .= "$".$_POST["grado98_".$rowGrados['a']]."$";

					}

					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

					'$".$_POST["valor_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']].$valorInsertar."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");					
	$sql_upd_configuracion1 = "UPDATE conf_sygescol SET c = 

					'".$_POST["valor_".$row_configuracion['conf_nombre']]."'";
$upd_configuracion1 = mysql_query($sql_upd_configuracion1, $sygescol) or die("No se pudo actualizar los parametros del sistema");
				}
		}elseif($row_configuracion['conf_id'] == 132){

				if($_POST["valor_".$row_configuracion['conf_nombre']] == "N"){
					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 
					'$".$_POST["valor_".$row_configuracion['conf_nombre']]."$".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."$".$_POST["4_".$row_configuracion['conf_nombre']]."$".$_POST["5_".$row_configuracion['conf_nombre']]."$".$_POST["6_".$row_configuracion['conf_nombre']]."$".$_POST["7_".$row_configuracion['conf_nombre']]."$".$_POST["8_".$row_configuracion['conf_nombre']]."$".$_POST["FC_".$row_configuracion['conf_nombre']]."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
				}else{

					$selGrados = "SELECT * FROM gao GROUP BY ba ORDER BY a";

					$sqlGrados = mysql_query($selGrados, $link);					

					while ($rowGrados = mysql_fetch_array($sqlGrados)) {

						$valorInsertar .= "$".$_POST["grado132_".$rowGrados['a']]."$";

					}

					$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

					'$".$_POST["valor_".$row_configuracion['conf_nombre']].$valorInsertar."$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

					$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");					

				}

		}elseif($row_configuracion['conf_id'] == 133){

					$link = conectarse();

				mysql_select_db($database_sygescol,$link);

				$sel_consulta_areas = "SELECT * FROM aes ";

				$sql_consulta_areas = mysql_query($sel_consulta_areas, $link);

						//Recorremos consulta Basica primaria

						while ($row_consulta_areas = mysql_fetch_assoc($sql_consulta_areas)) {

							$valorInsertar_area .= $_POST["area_".$row_consulta_areas['i']]."_".$row_consulta_areas['i']."$";

						}

									//Recorremos consulta Basica Secundaria

								mysql_data_seek($sql_consulta_areas, 0);

						while ($row_consulta_areas2 = mysql_fetch_assoc($sql_consulta_areas)) {

							$valorInsertar_area2 .= $_POST["area2_".$row_consulta_areas2['i']]."_".$row_consulta_areas2['i']."$";

						}

									//Recorremos consulta Media decimo

								mysql_data_seek($sql_consulta_areas, 0);

						while ($row_consulta_areas3 = mysql_fetch_assoc($sql_consulta_areas)) {

							$valorInsertar_area3 .= $_POST["area3_".$row_consulta_areas3['i']]."_".$row_consulta_areas3['i']."$";

				

						}

									//Recorremos consulta Media Once

								mysql_data_seek($sql_consulta_areas, 0);

						while ($row_consulta_areas4 = mysql_fetch_assoc($sql_consulta_areas)) {

							$valorInsertar_area4 .= $_POST["area4_".$row_consulta_areas4['i']]."_".$row_consulta_areas4['i']."$";

				

						}

									//Recorremos consulta Ciclos

								mysql_data_seek($sql_consulta_areas, 0);

						while ($row_consulta_areas5 = mysql_fetch_assoc($sql_consulta_areas)) {

							$valorInsertar_area5 .= $_POST["area5_".$row_consulta_areas5['i']]."_".$row_consulta_areas5['i']."$";

						}

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

			'".$_POST["valorDesempate_".$row_configuracion['conf_nombre']]."/".$valorInsertar_area."/".$valorInsertar_area2."/".$valorInsertar_area3."/".$valorInsertar_area4."/".$valorInsertar_area5."@".$_POST["constancia_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 129){ //DM29
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["valor"]."$".$_POST["valorAsignaturas2_".$row_configuracion['conf_nombre']]."$".$_POST["valorAsignaturas_".$row_configuracion['conf_nombre']]."$".$_POST["valorEspecifico"]."$".$_POST["valorEspecifico2"]."$".$_POST["valorEspecifico3"]."$".$_POST["input_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
			//$notas = $_POST['notaDm'];
			/*if (strlen($notas) == 1) {
				$updDm = "UPDATE confDm29 SET notaMin = '1', notaMax = '$_POST[notaVDm]', estado = '1', areas='$_POST[valAreasPerdidas]' WHERE id='$_POST[dm_29]'";
				$updateDm = mysql_query($updDm, $link)or die(mysql_error());

				$updDm2 = "UPDATE confDm29 SET estado = '0', areas='$_POST[valAreasPerdidas]' WHERE id!='$_POST[dm_29]'";
				$updateDm2 = mysql_query($updDm2, $link)or die(mysql_error());				
			}else{
				$valor = explode(',',$notas); 	

				$updDm = "UPDATE confDm29 SET notaMin = '$valor[0]', notaMax = '$valor[1]', estado = '1', areas='$_POST[valAreasPerdidas]' WHERE id='$_POST[dm_29]'";
				$updateDm = mysql_query($updDm, $link)or die(mysql_error());

				$updDm2 = "UPDATE confDm29 SET estado = '0', areas='$_POST[valAreasPerdidas]' WHERE id!='$_POST[dm_29]'";
				$updateDm2 = mysql_query($updDm2, $link)or die(mysql_error());
			}*/
		}elseif($row_configuracion['conf_id'] == 113){ // EVALUACION INSTITUCION

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST['periodo_fecha_inicio_113']."$".$_POST['periodo_fecha_final_113']."$' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 118 || $row_configuracion['conf_id'] == 130 || $row_configuracion['conf_id'] == 131 || $row_configuracion['conf_id'] == 134 || $row_configuracion['conf_id'] == 138 ){ // EVALUACION INSTITUCION

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 102){
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
			if($_POST[$row_configuracion['conf_nombre']]=='S'){
				$query_upd_conf = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre = 'sis_cal_ref'";
				$upd_conf = mysql_query($query_upd_conf, $sygescol) or die(mysql_error());
			}
					
////////////////////////////////////////////////////////////////////////////////////////////////camilo////////////////////////////////////////////////////////////////////////////////////////////////
		}elseif($row_configuracion['conf_id'] == 135){ // EVALUACION INSTITUCION

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 119){ // hoja de vida parametro 43

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["docentes"]."$".$_POST["docentes_D"]."$".$_POST["administrativos"]."$".$_POST["estudiantes"]."$".$_POST["controlBoletines".$row_configuracion['conf_nombre']]."$".$_POST[$row_configuracion['conf_nombre']."_fecha_1"]."$".$_POST[$row_configuracion['conf_nombre']."_fecha_2"]."$".$_POST[$row_configuracion['conf_nombre']."_fecha_3"]."$".$_POST[$row_configuracion['conf_nombre']."_fecha_4"]."$".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 136){ 
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["conc_".$row_configuracion['conf_nombre']]."$".$_POST["cond_".$row_configuracion['conf_nombre']]."$".$_POST["cone_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 137){ 

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 139){
				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 
				'$".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."$".$_POST["4_".$row_configuracion['conf_nombre']]."$".$_POST["5_".$row_configuracion['conf_nombre']]."$".$_POST["6_".$row_configuracion['conf_nombre']]."$".$_POST["7_".$row_configuracion['conf_nombre']]."$".$_POST["8_".$row_configuracion['conf_nombre']]."$".$_POST["11_".$row_configuracion['conf_nombre']]."$".$_POST["12_".$row_configuracion['conf_nombre']]."$".$_POST["13_".$row_configuracion['conf_nombre']]."$".$_POST["14_".$row_configuracion['conf_nombre']]."$".$_POST["15_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}elseif($row_configuracion['conf_id'] == 141){ 

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 142 || $row_configuracion['conf_id'] == 143){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

				'$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']]."$".$_POST["f_".$row_configuracion['conf_nombre']]."$".$_POST["g_".$row_configuracion['conf_nombre']]."$".$_POST["h_".$row_configuracion['conf_nombre']]."$".$_POST["i_".$row_configuracion['conf_nombre']]."$".$_POST["j_".$row_configuracion['conf_nombre']]."$".$_POST["k_".$row_configuracion['conf_nombre']]."$".$_POST["l_".$row_configuracion['conf_nombre']]."$".$_POST["m_".$row_configuracion['conf_nombre']]."$".$_POST["n_".$row_configuracion['conf_nombre']]."$".$_POST["ñ_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 144){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

				'$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 145 || $row_configuracion['conf_id'] == 146 || $row_configuracion['conf_id'] == 147){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

				'$".$_POST["a_".$row_configuracion['conf_nombre']]."$".$_POST["b_".$row_configuracion['conf_nombre']]."$".$_POST["c_".$row_configuracion['conf_nombre']]."$".$_POST["d_".$row_configuracion['conf_nombre']]."$".$_POST["e_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 148){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = 

				'".$_POST["2_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 149){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["valorplanirecu_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacionRepro3_".$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 167){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["valorplanirecu_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacionRepro3_".$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 127){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 140){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["bloqueo_foto_detallado_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_huella_detallado_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_firma_detallado_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_carne_detallado_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_foto_resumen_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_huella_resumen_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_firma_resumen_".$row_configuracion['conf_nombre']]."$".$_POST["bloqueo_carne_resumen_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 150){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["criterio_".$row_configuracion['conf_nombre']]."$".$_POST["criterio2_".$row_configuracion['conf_nombre']]."$".$_POST["criterio3_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 168){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["criterio_".$row_configuracion['conf_nombre']]."$".$_POST["criterio2_".$row_configuracion['conf_nombre']]."$".$_POST["criterio3_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 151){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["reasignacion_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacion2_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 153){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["certificado_".$row_configuracion['conf_nombre']].",".$_POST["valCertificado_".$row_configuracion['conf_nombre']]."@".$_POST["constancia_".$row_configuracion['conf_nombre']].",".$_POST["valConstancia_".$row_configuracion['conf_nombre']]."@".$_POST["pali_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 154){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["valorplanirecu_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacionRepro3_".$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}

		elseif($row_configuracion['conf_id'] == 155){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["valorplanirecu_".$row_configuracion['conf_nombre']]."$".$_POST["reasignacionRepro3_".$row_configuracion['conf_nombre']]."$".$_POST["cS_".$row_configuracion['conf_nombre']]."$".$_POST["cA_".$row_configuracion['conf_nombre']]."$".$_POST["cBs_".$row_configuracion['conf_nombre']]."$".$_POST["cBj_".$row_configuracion['conf_nombre']]."$".$_POST["cBjj_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 156){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["planilla_prom_ant1_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant2_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant3_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant4_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant5_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant6_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant7_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant8_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant9_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant10_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant11_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant12_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant13_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant14_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant15_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant16_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant17_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant18_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant19_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant20_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

			}elseif($row_configuracion['conf_id'] == 157){
				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["planilla_prom_ant1_ind_1"]."$".$_POST["planilla_prom_ant1_ind_2"]."$".$_POST["planilla_prom_ant1_ind_3"]."$".$_POST["planilla_prom_ant1_ind_4"]."$".$_POST["planilla_prom_ant1_ind_5"]."$".$_POST["planilla_prom_ant1_ind_6"]."$".$_POST["planilla_prom_ant1_ind_7"]."$".$_POST["planilla_prom_ant1_ind_8"]."$".$_POST["planilla_prom_ant1_ind_9"]."$".$_POST["planilla_prom_ant10_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant11_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant12_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant13_ind_".$row_configuracion['conf_nombre']]."
                                          $".$_POST["planilla_prom_ant14_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant15_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant16_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant17_ind_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";	
                $upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar el parametro 81 del sistema");

               $sel_param_159 = "SELECT conf_valor FROM conf_sygescol WHERE conf_id = '157'";
	           $sql_param_159 = mysql_query($sel_param_159,$link);
	           $row_configuracion = mysql_fetch_array($sql_param_159);
               $num_configuracion = mysql_num_rows($sql_param_159);

		$array_parametro = explode("$",$row_configuracion['conf_valor']);/*
*/
		$proyecion_cupos_ind_1 = $array_parametro[1];
		$proyecion_cupos_ind_2 = $array_parametro[2];
		$proyecion_cupos_ind_3 = $array_parametro[3];
		$proyecion_cupos_ind_4 = $array_parametro[4];
		$proyecion_cupos_ind_5 = $array_parametro[5];
		$proyecion_cupos_ind_6 = $array_parametro[6];
        $proyecion_cupos_ind_7 = $array_parametro[7];
		$proyecion_cupos_ind_8 = $array_parametro[8];
		$proyecion_cupos_ind_9 = $array_parametro[9];
        $proyecion_cupos_ind_10 = $array_parametro[10];
		$proyecion_cupos_ind_11 = $array_parametro[11];
		$proyecion_cupos_ind_12 = $array_parametro[12];
        $proyecion_cupos_ind_13 = $array_parametro[13];
        $proyecion_cupos_ind_14 = $array_parametro[14];
		$proyecion_cupos_ind_15 = $array_parametro[15];
        $proyecion_cupos_ind_16 = $array_parametro[16];
        $proyecion_cupos_ind_17 = $array_parametro[17];
/*
print_r($array_parametro);
*/
        //a1
 $sel_param_1591 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '3'";
	           $sql_param_1591 = mysql_query($sel_param_1591,$link);
	           $row_configuracion1 = mysql_fetch_array($sql_param_1591);
               $num_configuracion1 = mysql_num_rows($sql_param_1591);

         //a2
 $sel_param_15911 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '4'";
	           $sql_param_15911 = mysql_query($sel_param_15911,$link);
	           $row_configuracion11 = mysql_fetch_array($sql_param_15911);
               $num_configuracion11 = mysql_num_rows($sql_param_15911);
              //a3
 $sel_param_159111 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '5'";
	           $sql_param_159111 = mysql_query($sel_param_159111,$link);
	           $row_configuracion111 = mysql_fetch_array($sql_param_159111);
               $num_configuracion111 = mysql_num_rows($sql_param_159111);
// ACCIONES 

 $sel_param_1591234 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '24'";
	           $sql_param_1591234 = mysql_query($sel_param_1591234,$link);
	           $row_configuracion1234 = mysql_fetch_array($sql_param_1591234);
               $num_configuracion1234 = mysql_num_rows($sql_param_1591234);

         //a2
 $sel_param_159112345 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '26'";
	           $sql_param_159112345 = mysql_query($sel_param_159112345,$link);
	           $row_configuracion112345 = mysql_fetch_array($sql_param_159112345);
               $num_configuracion112345 = mysql_num_rows($sql_param_159112345);
              //a3
 $sel_param_1591112344587543 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '25'";
	           $sql_param_1591112344587543 = mysql_query($sel_param_1591112344587543,$link);
	           $row_configuracion1112344587543 = mysql_fetch_array($sql_param_1591112344587543);
               $num_configuracion1112344587543 = mysql_num_rows($sql_param_1591112344587543);


 $sel_param_159111234496345 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '16'";
	           $sql_param_159111234459634 = mysql_query($sel_param_159111234496345,$link);
	           $row_configuracion111234459634 = mysql_fetch_array($sql_param_159111234459634);
               $num_configuracion111234459634 = mysql_num_rows($sql_param_159111234459634);


 $sel_param_159111234450011 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '17'";
	           $sql_param_159111234450011 = mysql_query($sel_param_159111234450011,$link);
	           $row_configuracion111234450011 = mysql_fetch_array($sql_param_159111234450011);
               $num_configuracion111234450011 = mysql_num_rows($sql_param_159111234450011);


 $sel_param_159111234459995 = "SELECT conf_obl_texto FROM config_planilla_oblig WHERE  conf_obl_id = '18'";
	           $sql_param_159111234459995 = mysql_query($sel_param_159111234459995,$link);
	           $row_configuracion111234459995 = mysql_fetch_array($sql_param_159111234459995);
               $num_configuracion111234459995 = mysql_num_rows($sql_param_159111234459995);
        
        $query_valida_2p = "SELECT * FROM subproceso_evaluacion WHERE subproeva_cod LIKE '".$row_configuracion1['conf_obl_texto']."'";
	$resultado_valida_2p = mysql_query($query_valida_2p, $link) or die(mysql_error());
    $rows_param_2p=mysql_fetch_array($resultado_valida_2p);
    $num_con_bol_2p = mysql_num_rows($resultado_valida_2p);
$query_valida2p = "UPDATE subproceso_evaluacion SET orden = '".$array_parametro[1]."' WHERE subproeva_cod LIKE '".$row_configuracion1['conf_obl_texto']."' ";   
$resultado_valida2p = mysql_query($query_valida2p, $link) or die(mysql_error());
    $rows_param=mysql_fetch_array($resultado_valida2p);
 $query_valida_2p1 = "SELECT * FROM subproceso_evaluacion WHERE subproeva_cod LIKE '".$row_configuracion11['conf_obl_texto']."'";
	$resultado_valida_2p1 = mysql_query($query_valida_2p1, $link) or die(mysql_error());
    $rows_param_2p1=mysql_fetch_array($resultado_valida_2p1);
    $num_con_bol_2p1 = mysql_num_rows($resultado_valida_2p1);

$query_valida2p1 = "UPDATE subproceso_evaluacion SET orden = '".$array_parametro[4]."' WHERE subproeva_cod LIKE '".$row_configuracion11['conf_obl_texto']."' ";   
$resultado_valida2p1 = mysql_query($query_valida2p1, $link) or die(mysql_error());
    $rows_param1=mysql_fetch_array($resultado_valida2p1);

     $query_valida_2p2 = "SELECT * FROM subproceso_evaluacion WHERE subproeva_cod LIKE '".$row_configuracion111['conf_obl_texto']."'";
	$resultado_valida_2p2 = mysql_query($query_valida_2p2, $link) or die(mysql_error());
    $rows_param_2p2=mysql_fetch_array($resultado_valida_2p2);
    $num_con_bol_2p2 = mysql_num_rows($resultado_valida_2p2);
$query_valida2p2 = "UPDATE subproceso_evaluacion SET orden = '".$array_parametro[7]."' WHERE subproeva_cod LIKE '".$row_configuracion111['conf_obl_texto']."' ";   
$resultado_valida2p2 = mysql_query($query_valida2p2, $link) or die(mysql_error());
    $rows_param2=mysql_fetch_array($resultado_valida2p2);
// ACTUALIZAR ORDEN DE ACCIONES EN LA PGU
     $query_valida_2p2 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion1234['conf_obl_texto']."'";
	$resultado_valida_2p2 = mysql_query($query_valida_2p2, $link) or die(mysql_error());
    $rows_param_2p2=mysql_fetch_array($resultado_valida_2p2);
    $num_con_bol_2p2 = mysql_num_rows($resultado_valida_2p2);
$query_valida2p2 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[3]."' WHERE aceva_desc LIKE '".$row_configuracion1234['conf_obl_texto']."' ";   
$resultado_valida2p2 = mysql_query($query_valida2p2, $link) or die(mysql_error());
    $rows_param222=mysql_fetch_array($resultado_valida2p2);

    // ACTUALIZAR ORDEN DE ACCIONES EN LA PGU

     $query_valida_2p21221 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion112345['conf_obl_texto']."'";
	$resultado_valida_2p21221 = mysql_query($query_valida_2p21221, $link) or die(mysql_error());
    $rows_param_2p21221=mysql_fetch_array($resultado_valida_2p21221);
    $num_con_bol_2p21221 = mysql_num_rows($resultado_valida_2p21221);
$query_valida2p2998 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[2]."' WHERE aceva_desc LIKE '".$row_configuracion112345['conf_obl_texto']."' ";   
$resultado_valida2p2998 = mysql_query($query_valida2p2998, $link) or die(mysql_error());
    $rows_param2998=mysql_fetch_array($resultado_valida2p2998);
    // ACTUALIZAR ORDEN DE ACCIONES EN LA PGU

     $query_valida_2p212211177 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion1112344587543['conf_obl_texto']."'";
	$resultado_valida_2p212211177 = mysql_query($query_valida_2p212211177, $link) or die(mysql_error());
    $rows_param_2p212211177=mysql_fetch_array($resultado_valida_2p212211177);
    $num_con_bol_2p212211177 = mysql_num_rows($resultado_valida_2p212211177);
$query_valida2p29989955 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[5]."' WHERE aceva_desc LIKE '".$row_configuracion1112344587543['conf_obl_texto']."' ";   
$resultado_valida2p29989955 = mysql_query($query_valida2p29989955, $link) or die(mysql_error());
    $rows_param29989955=mysql_fetch_array($resultado_valida2p29989955);
    // ACTUALIZAR ORDEN DE ACCIONES EN LA PGU

     $query_valida_2p212211177114433 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion111234459634['conf_obl_texto']."'";
	$resultado_valida_2p212211177114433 = mysql_query($query_valida_2p212211177114433, $link) or die(mysql_error());
    $rows_param_2p212211177114433=mysql_fetch_array($resultado_valida_2p212211177114433);
    $num_con_bol_2p212211177114433 = mysql_num_rows($resultado_valida_2p212211177114433);
$query_valida2p29989955114433 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[9]."' WHERE aceva_desc LIKE '".$row_configuracion111234459634['conf_obl_texto']."' ";   
$resultado_valida2p29989955114433 = mysql_query($query_valida2p29989955114433, $link) or die(mysql_error());
    $rows_param29989951144335=mysql_fetch_array($resultado_valida2p29989955114433);
    // ACTUALIZAR ORDEN DE ACCIONES EN LA PGU

     $query_valida_2p2122111771144339966 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion111234450011['conf_obl_texto']."'";
	$resultado_valida_2p2122111771144339966 = mysql_query($query_valida_2p2122111771144339966, $link) or die(mysql_error());
    $rows_param_2p2122111771144339966=mysql_fetch_array($resultado_valida_2p2122111771144339966);
    $num_con_bol_2p2122111771144339966 = mysql_num_rows($resultado_valida_2p2122111771144339966);
$query_valida2p299899551144339966 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[8]."' WHERE aceva_desc LIKE '".$row_configuracion111234450011['conf_obl_texto']."' ";   
$resultado_valida2p299899551144339966 = mysql_query($query_valida2p299899551144339966, $link) or die(mysql_error());
    $rows_param299899511443359966=mysql_fetch_array($resultado_valida2p299899551144339966);
    // ACTUALIZAR ORDEN DE ACCIONES EN LA PGU

     $query_valida_2p212211177114433996666 = "SELECT * FROM accion_evaluacion WHERE aceva_desc LIKE '".$row_configuracion111234459995['conf_obl_texto']."'";
	$resultado_valida_2p212211177114433996666 = mysql_query($query_valida_2p212211177114433996666, $link) or die(mysql_error());
    $rows_param_2p212211177114433996666=mysql_fetch_array($resultado_valida_2p212211177114433996666);
    $num_con_bol_2p212211177114433996666 = mysql_num_rows($resultado_valida_2p212211177114433996666);
$query_valida2p29989955114433996666 = "UPDATE accion_evaluacion SET ordenes = '".$array_parametro[7]."' WHERE aceva_desc LIKE '".$row_configuracion111234459995['conf_obl_texto']."' ";   
$resultado_valida2p29989955114433996666 = mysql_query($query_valida2p29989955114433996666, $link) or die(mysql_error());
    $rows_param29989951144335996666=mysql_fetch_array($resultado_valida2p29989955114433996666);


		}elseif($row_configuracion['conf_id'] == 159){ 

			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["aplica_reconsideracion"]."$".$_POST["habilitacion_proceso_anio".$row_configuracion['conf_nombre']]."$".$_POST["habilitacion_proceso_area".$row_configuracion['conf_nombre']]."$".$_POST["habilitacion_proceso_".$row_configuracion['conf_nombre']]."$".$_POST["habilitacion_proceso_certificado".$row_configuracion['conf_nombre']]."$".$_POST["asignatura1_"]."$".$_POST["asignatura2_"]."$".$_POST["asignatura3_"]."$".$_POST["asignatura4_"]."$".$_POST["asignatura5_"]."$".$_POST["asignatura6_"]."$".$_POST["asignatura7_"]."$".$_POST["asignatura8_"]."$".$_POST["asignatura9_"]."$".$_POST["asignatura10_"]."$".$_POST["asignatura11_"]."$".$_POST["asignatura12_"]."$".$_POST["calificacion_minima"]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}	elseif($row_configuracion['conf_id'] == 241){

$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["planilla_prom_ant1_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant2_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant3_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant4_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant5_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant6_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant7_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant8_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant9_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant10_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant11_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant12_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant13_ind_".$row_configuracion['conf_nombre']]."

                                          $".$_POST["planilla_prom_ant14_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant15_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant16_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant17_ind_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";	

			}elseif($row_configuracion['conf_id'] == 160){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '$".$_POST["planilla_prom_ant1_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant2_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant3_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant4_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant5_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant6_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant7_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant8_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant9_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant10_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant11_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant12_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant13_ind_".$row_configuracion['conf_nombre']]."

                                          $".$_POST["planilla_prom_ant14_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant15_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant16_ind_".$row_configuracion['conf_nombre']]."$".$_POST["planilla_prom_ant17_ind_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";	

                $upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar el parametro 81 del sistema");

               $sel_param_159 = "SELECT conf_valor FROM conf_sygescol WHERE conf_id = '160'";

	           $sql_param_159 = mysql_query($sel_param_159,$link);

	           $row_configuracion = mysql_fetch_array($sql_param_159);

               $num_configuracion = mysql_num_rows($sql_param_159);

	//echo $row_configuracion['conf_valor'];

	$array_parametro = explode("$",$row_configuracion['conf_valor']);

		//Consultamos el tope maximo de los estudiantes (Zona Urbana)

		$proyecion_cupos_ind_1 = $array_parametro[1];

		$proyecion_cupos_ind_2 = $array_parametro[2];

		$proyecion_cupos_ind_3 = $array_parametro[3];

		$proyecion_cupos_ind_4 = $array_parametro[4];

		$proyecion_cupos_ind_5 = $array_parametro[5];

		$proyecion_cupos_ind_6 = $array_parametro[6];

        $proyecion_cupos_ind_7 = $array_parametro[7];

		$proyecion_cupos_ind_8 = $array_parametro[8];

		$proyecion_cupos_ind_9 = $array_parametro[9];

        $proyecion_cupos_ind_10 = $array_parametro[10];

		$proyecion_cupos_ind_11 = $array_parametro[11];

		$proyecion_cupos_ind_12 = $array_parametro[12];

        $proyecion_cupos_ind_13 = $array_parametro[13];

        $proyecion_cupos_ind_14 = $array_parametro[14];

		$proyecion_cupos_ind_15 = $array_parametro[15];

        $proyecion_cupos_ind_16 = $array_parametro[16];

        $proyecion_cupos_ind_17 = $array_parametro[17];

//BASICA PRIMARIA

$update_nivel_2="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_1."' WHERE `periodo_academicos`.`nivel` = 2 AND `periodo_academicos`.`id_grado` = 1;";			

$sql_update=mysql_query($update_nivel_2, $sygescol)or die("No se pudo Modificar el nivel 2");

$update_nivel_2="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_2."' WHERE `periodo_academicos`.`nivel` = 2 AND `periodo_academicos`.`id_grado` = 2;";			

$sql_update=mysql_query($update_nivel_2, $sygescol)or die("No se pudo Modificar el nivel 2");

$update_nivel_2="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_3."' WHERE `periodo_academicos`.`nivel` = 2 AND `periodo_academicos`.`id_grado` = 3;";			

$sql_update=mysql_query($update_nivel_2, $sygescol)or die("No se pudo Modificar el nivel 2");

$update_nivel_2="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_4."' WHERE `periodo_academicos`.`nivel` = 2 AND `periodo_academicos`.`id_grado` = 4;";			

$sql_update=mysql_query($update_nivel_2, $sygescol)or die("No se pudo Modificar el nivel 2");

$update_nivel_2="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_5."' WHERE `periodo_academicos`.`nivel` = 2 AND `periodo_academicos`.`id_grado` = 5;";			

$sql_update=mysql_query($update_nivel_2, $sygescol)or die("No se pudo Modificar el nivel 2");

//BASICA SECUNDARIA

$update_nivel_3="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_6."' WHERE `periodo_academicos`.`nivel` =3 AND `periodo_academicos`.`id_grado` = 6;";			

$sql_update=mysql_query($update_nivel_3, $sygescol)or die("No se pudo Modificar el nivel 3");

$update_nivel_3="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_7."' WHERE `periodo_academicos`.`nivel` =3 AND `periodo_academicos`.`id_grado` = 7;";			

$sql_update=mysql_query($update_nivel_3, $sygescol)or die("No se pudo Modificar el nivel 3");

$update_nivel_3="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_8."' WHERE `periodo_academicos`.`nivel` =3 AND `periodo_academicos`.`id_grado` = 8;";			

$sql_update=mysql_query($update_nivel_3, $sygescol)or die("No se pudo Modificar el nivel 3");

$update_nivel_3="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_9."' WHERE `periodo_academicos`.`nivel` =3 AND `periodo_academicos`.`id_grado` = 9;";			

$sql_update=mysql_query($update_nivel_3, $sygescol)or die("No se pudo Modificar el nivel 3");

//MEDIA 

$update_nivel_4="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_10."' WHERE `periodo_academicos`.`nivel` =4 AND `periodo_academicos`.`id_grado` = 10;";			

$sql_update=mysql_query($update_nivel_4, $sygescol)or die("No se pudo Modificar el nivel 4");

$update_nivel_5="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_11."' WHERE `periodo_academicos`.`nivel` =5 AND `periodo_academicos`.`id_grado` = 11;";			

$sql_update=mysql_query($update_nivel_5, $sygescol)or die("No se pudo Modificar el nivel 5");

//CICLOS BASIA

$update_nivel_6="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_12."' WHERE `periodo_academicos`.`nivel` =6 AND `periodo_academicos`.`id_grado` = 21;";			

$sql_update=mysql_query($update_nivel_6, $sygescol)or die("No se pudo Modificar el nivel 6");

$update_nivel_6="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_13."' WHERE `periodo_academicos`.`nivel` =6 AND `periodo_academicos`.`id_grado` = 22;";			

$sql_update=mysql_query($update_nivel_6, $sygescol)or die("No se pudo Modificar el nivel 6");

$update_nivel_7="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_14."' WHERE `periodo_academicos`.`nivel` =7 AND `periodo_academicos`.`id_grado` = 23;";			

$sql_update=mysql_query($update_nivel_7, $sygescol)or die("No se pudo Modificar el nivel 7");

$update_nivel_7="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_15."' WHERE `periodo_academicos`.`nivel` =7 AND `periodo_academicos`.`id_grado` = 24;";			

$sql_update=mysql_query($update_nivel_7, $sygescol)or die("No se pudo Modificar el nivel 7");

//CICLOS MEDIA

$update_nivel_8="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_16."' WHERE `periodo_academicos`.`nivel` =8 AND `periodo_academicos`.`id_grado` = 25;";			

$sql_update=mysql_query($update_nivel_8, $sygescol)or die("No se pudo Modificar el nivel 8");

$update_nivel_8="UPDATE `periodo_academicos` SET `ind_mortalidad_repro` = '".$proyecion_cupos_ind_17."' WHERE `periodo_academicos`.`nivel` =8 AND `periodo_academicos`.`id_grado` = 26;";			

$sql_update=mysql_query($update_nivel_8, $sygescol)or die("No se pudo Modificar el nivel 8");

        }

		elseif($row_configuracion['conf_id'] == 68){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '.".$_POST[$row_configuracion['conf_nombre']].",".$_POST["G_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 66){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST['areas_Obligatorias_']."$".$_POST['areas_Tecnicas_']."$".$_POST['valorEspecifico_D1']."$".$_POST['valorEspecifico_H1']."$".$_POST['valorEspecifico_D2']."$".$_POST['valorEspecifico_H2']."$".$_POST['valorEspecifico_D3']."$".$_POST['valorEspecifico_H3']."$".$_POST['valorEspecifico_D4']."$".$_POST['valorEspecifico_H4']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

               $sel_param_66 = "SELECT conf_valor FROM conf_sygescol WHERE conf_id = '66'";
	           $sql_param_66 = mysql_query($sel_param_66,$link);
	           $row_configuracion = mysql_fetch_array($sql_param_66);
               $num_configuracion = mysql_num_rows($sql_param_66);

               $sel_esca = "SELECT * FROM escala_nacional_area_tecnica ";
	           $sql_esca = mysql_query($sel_esca,$link);
	           $row_configuracion_esca = mysql_fetch_array($sql_esca);
               $num_configuracion_esca = mysql_num_rows($sql_esca);

	    $array_parametro = explode("$",$row_configuracion['conf_valor']);

		//Consulta los valores para la escala

		$proyecion_escala_D1 = $array_parametro[3];
		$proyecion_escala_H1 = $array_parametro[4];
		$proyecion_escala_D2 = $array_parametro[5];
		$proyecion_escala_H2 = $array_parametro[6];
		$proyecion_escala_D3 = $array_parametro[7];
		$proyecion_escala_H3 = $array_parametro[8];
		$proyecion_escala_D4 = $array_parametro[9];
		$proyecion_escala_H4 = $array_parametro[10];

		if($num_configuracion_esca > 0){

		if($proyecion_escala_D1 > 0){

               $update_superior_min ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_min` = '".$proyecion_escala_D1."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 1;";			

               $sql_update = mysql_query($update_superior_min, $sygescol)or die("No se pudo Modificar 1");
		}
		if($proyecion_escala_H1 > 0){

               $update_superior_max ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_max` = '".$proyecion_escala_H1."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 1;";			

               $sql_update = mysql_query($update_superior_max, $sygescol)or die("No se pudo Modificar 1");
		}
		if($proyecion_escala_D2 > 0){

               $update_alto_min ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_min` = '".$proyecion_escala_D2."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 2;";			

               $sql_update = mysql_query($update_alto_min, $sygescol)or die("No se pudo Modificar 2");
		}
		if($proyecion_escala_H2 > 0){

               $update_alto_max ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_max` = '".$proyecion_escala_H2."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 2;";			

               $sql_update = mysql_query($update_alto_max, $sygescol)or die("No se pudo Modificar 2");
		}
		if($proyecion_escala_D3 > 0){

               $update_basico_min ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_min` = '".$proyecion_escala_D3."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 3;";			

               $sql_update = mysql_query($update_basico_min, $sygescol)or die("No se pudo Modificar el nivel 3");
		}
		if($proyecion_escala_H3 > 0){

               $update_basico_max ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_max` = '".$proyecion_escala_H3."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 3;";			

               $sql_update = mysql_query($update_basico_max, $sygescol)or die("No se pudo Modificar el nivel 3");
		}
		if($proyecion_escala_D4 > 0){

               $update_bajo_min ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_min` = '".$proyecion_escala_D4."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 4;";			

               $sql_update = mysql_query($update_bajo_min, $sygescol)or die("No se pudo Modificar el nivel 3");
		}
		if($proyecion_escala_H4 > 0){

               $update_bajo_max ="UPDATE `escala_nacional_area_tecnica` SET `esca_nac_max` = '".$proyecion_escala_H4."' WHERE `escala_nacional_area_tecnica`.`esca_nac_id` = 4;";			

               $sql_update = mysql_query($update_bajo_max, $sygescol)or die("No se pudo Modificar el nivel 3");
		    }

	     }

		}elseif($row_configuracion['conf_id'] == 67){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["P_".$row_configuracion['conf_nombre']]."$".$_POST["S_".$row_configuracion['conf_nombre']]."$".$_POST["T_".$row_configuracion['conf_nombre']]."$".$_POST["C_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 70){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["tra_".$row_configuracion['conf_nombre']]."$".$_POST["cicP_".$row_configuracion['conf_nombre']]."$".$_POST["cicB_".$row_configuracion['conf_nombre']]."$".$_POST["cicM_".$row_configuracion['conf_nombre']]."$".$_POST["gru_".$row_configuracion['conf_nombre']]."$".$_POST["nee_".$row_configuracion['conf_nombre']]."$".$_POST["ace_".$row_configuracion['conf_nombre']]."$".$_POST["pfc_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 92){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST['areas_Obligatorias92_']."$".$_POST['areas_Tecnicas92_']."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 73){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."$".$_POST["0_".$row_configuracion['conf_nombre']]."$".$_POST["1_".$row_configuracion['conf_nombre']]."$".$_POST["2_".$row_configuracion['conf_nombre']]."$".$_POST["3_".$row_configuracion['conf_nombre']]."$".$_POST["4_".$row_configuracion['conf_nombre']]."$".$_POST["5_".$row_configuracion['conf_nombre']]."$".$_POST["6_".$row_configuracion['conf_nombre']]."$".$_POST["7_".$row_configuracion['conf_nombre']]."$".$_POST["8_".$row_configuracion['conf_nombre']]."$".$_POST["9_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}elseif($row_configuracion['conf_id'] == 14){

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST["cAcc_".$row_configuracion['conf_nombre']]."$".$_POST["cPer_".$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

		}else{

				$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$_POST[$row_configuracion['conf_nombre']]."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";

				$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");

				

				$sel_consultar="SELECT * FROM actas_impresion WHERE acta_fecha=CURDATE() AND tipo_dato='PARAMETROS_GENERALES' AND tipo_id='".$row_configuracion['conf_nombre']."'";

				$sql_consultar=mysql_query($sel_consultar, $sygescol)or die("No se pudo Consultar el Acta");

				$num_consultar=mysql_num_rows($sql_consultar);

				if($num_consultar==0){

					$update="INSERT INTO actas_impresion (tipo_dato, tipo_id, acta_fecha, tipo_contenido, tipo_valor)

								VALUES ('PARAMETROS_GENERALES', '".$row_configuracion['conf_nombre']."', CURDATE(), '".$row_configuracion['conf_descri']."', '".$_POST[$row_configuracion['conf_nombre']]."')";

					$sql_update=mysql_query($update, $sygescol)or die("No se pudo Modificar los datos del Acta");

				}else{

					$update="UPDATE actas_impresion

									SET tipo_contenido='".$row_configuracion['conf_descri']."', tipo_valor = '".$_POST[$row_configuracion['conf_nombre']]."'

							WHERE acta_fecha=CURDATE() AND tipo_dato='PARAMETROS_GENERALES' AND tipo_id='".$row_configuracion['conf_nombre']."'";

					$sql_update=mysql_query($update, $sygescol)or die("No se pudo Modificar los datos del Acta");

				}

		}

	}while($row_configuracion = mysql_fetch_assoc($configuracion));

	header("Location: $_SERVER[PHP_SELF]?listo=ok");

	exit;

}

mysql_select_db($database_sygescol, $sygescol);

$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver,encabezado_parametros.titulo

							FROM conf_sygescol INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

						WHERE conf_sygescol.conf_estado = 0

						AND conf_sygescol.conf_id IN (152,65,93,95,96,100,109,66) ORDER BY encabezado_parametros.id_orden ";

$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

$row_configuracion = mysql_fetch_assoc($configuracion);

$totalRows_configuracion = mysql_num_rows($configuracion);

mysql_select_db($database_sygescol, $sygescol);

$query_usuarios = "SELECT usuarios.id, usuarios.username FROM usuarios ORDER BY usuarios.username";

$usuarios = mysql_query($query_usuarios, $sygescol) or die(mysql_error());

$row_usuarios = mysql_fetch_assoc($usuarios);

$totalRows_usuarios = mysql_num_rows($usuarios);

function cargarAnosSygescol($anno){

	global $database_sygescol, $sygescol;

	$datos_bd = explode("_", $database_sygescol);

	$dts_nom = $datos_bd[1];

	$nombre = '';

	//echo count($dts_nom);

	for($i=0; $i<strlen($dts_nom); $i++){

		if(!is_numeric($dts_nom[$i])){

			$nombre .= $dts_nom[$i];

		}

	}

	$array_annos = array();

	$recorrer = 1;

	while($recorrer == 1){

		$dat_syg = $datos_bd[0].'_'.$nombre.$anno;

		if(!(mysql_select_db($dat_syg,$sygescol)))

		{

			$recorrer = 0;

		}else{

			$array_annos["CER".$anno] = "Certificado de Estudio a&ntilde;o ".$anno;

		}

		$anno--;

	}

	return $array_annos;

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $nombre_sistema; ?></title>

<script type="text/javascript" src="js/mootools.js"></script>

<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>

<script type="text/javascript" src="js/utilidades.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="js/calendario/skins/aqua/theme.css" title="Aqua" />

<script type="text/javascript" src="js/calendario/calendar.js"></script>

<script type="text/javascript" src="js/calendario/lang/calendar-es.js"></script>

<script type="text/javascript" src="js/calendario/calendar-setup.js"></script>

<link href="css/basico.css" rel="stylesheet" type="text/css">

<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />

<!-- MI JS PARA EDITAR -->

<link href="js/jquery/jquery-ui.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery/jquery-1.4.min.js"></script>

<script type="text/javascript" src="js/jquery/jquery-ui.js"></script>

<link href="js/jquery/mobiscroll-2.1-beta.custom.min.css" rel="stylesheet" type="text/css" />

<script src="js/jquery/mobiscroll-2.1-beta.custom.min.js" type="text/javascript"></script>

<link href="js/jquery/js_select/select2.css" rel="stylesheet"/>

<script src="js/jquery/js_select/select2.js"></script>

<script type="text/javascript" src="js/jquery.jeditable.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript">

var jqNc = jQuery.noConflict();

jqNc(document).ready(function() {

	jqNc(".sele_mul").select2({

		placeholder: 'Seleccione uno...'

	});	

});

function ActivaCampo(padre,hijo)

{

	switch(padre)

	{

		case 'aplica_promoanti_120':

			if(jqNc("#"+padre).val() == "0"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;

		case 'aplica_nota_comportamiento':

			if(jqNc("#"+padre).val() == "N"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;

		case 'aplica_asistencia':

			if(jqNc("#"+padre).val() == "N"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;

			/*	case 'areasReprobadas':

			if(jqNc("#"+padre).val() == "N"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;

			case 'todasAreas':

			if(jqNc("#"+padre).val() == "N"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;

				case 'demasAreas':

			if(jqNc("#"+padre).val() == "N"){				

				jqNc("#"+hijo).attr('disabled', 'disabled')

				jqNc("#"+hijo).attr('value', '');

			}

			else{

				jqNc("#"+hijo).removeAttr('disabled');				

			}

		break;*/

	}

}

</script>

<script type="text/javascript" src="scripts/jHtmlArea-0.7.5.js"></script>

<link rel="Stylesheet" type="text/css" href="style/jHtmlArea.css" />

<script type="text/javascript" src="scripts/jHtmlArea.ColorPickerMenu-0.7.0.js"></script>

<link rel="Stylesheet" type="text/css" href="style/jHtmlArea.ColorPickerMenu.css" />

<script type="text/javascript" src="js/js.js"></script>

<!-- FIN JS -->

<script type="text/javascript">

	var BPCN,BPCS,BPEA,BPEE,BPEF,BPER,BPHM,BPMT,BPFL,BPCP,BPOB,BPIN;

	var BSCN,BSCS,BSEA,BSEE,BSEF,BSER,BSHM,BSMT,BSFL,BSCP,BSOB,BSIN;

	var MDCN,MDCS,MDEA,MDEE,MDEF,MDER,MDHM,MDMT,MDFL,MDCP,MDOB,MDIN;

	var MOCN,MOCS,MOEA,MOEE,MOEF,MOER,MOHM,MOMT,MOFL,MOCP,MOOB,MOIN;

	function cambioNivel(valorSelect){

			/*if (valorSelect.selectedIndex == 0){

					var input = document.getElementById("CN_desempate_puesto_estu").value;

					alert("A seleccionado Basica Primaria");

					alert(input);

					}

			if (valorSelect.selectedIndex == 1){

					var input2 = document.getElementById("CN_desempate_puesto_estu").value;

					alert("A seleccionado Basica Secundaria");

					alert(input2);

					}

			if (valorSelect.selectedIndex == 2){

					alert("A seleccionado Media Decimo");

			}

			if (valorSelect.selectedIndex == 3){

		alert("A seleccionado Media Once");

			}*/
		if (valorSelect == 'BP' || valorSelect == 'BS'){

			var arregloMuestra = ["CN","CS","EA","EE","EF","ER","HM","MT","OB","IN"];

			var arregloOculta  = ["FL","CP"];

		}else{

			var arregloMuestra =  ["CN","CS","EA","EE","EF","ER","HM","MT","FL","CP","OB","IN"];

			var arregloOculta  =  "";

		}

		for(var i = 0; i <= arregloMuestra.length - 1; i++){

			document.getElementById(arregloMuestra[i]+"_desempate_puesto_estu").disabled = false;

		};

		if (valorSelect == 'BP' || valorSelect == 'BS')	{

			for(var j = 0; j <= arregloOculta.length - 1; j++){

				document.getElementById(arregloOculta[j]+"_desempate_puesto_estu").disabled = true;

			}

		};

	

	}
	

	function cambiaPuesto(valor, nombre, propiedad){

		var nivelEdu;

		if (valor != " "){

			var materias = ["CN","CS","EA","EE","EF","ER","HM","MT","FL","CP","OB","IN"];

			for (var i = 0; i <= 12; i++){

				if(document.getElementById(materias[i]+"_"+nombre).value  == valor && materias[i] != propiedad){

					document.getElementById(propiedad+"_"+nombre).value = "";

				}else{

					//nivelEdu = document.getElementById("nivelesEducacion").value;

					//nivelEdu+materias[i] = "Juan";	

				}

			}

		}	

	}

	function justNumbers(e)

{

var keynum = window.event ? window.event.keyCode : e.which;

if ((keynum == 8) || (keynum == 46))

return true;

 

return /\d/.test(String.fromCharCode(keynum));

}

</script>

<script>
	
	/*cambio de color acordiones*/
    function cambiar_fondo_acor1() {
                obj = document.getElementById('parametros_promocion');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

    function cambiar_fondo_acor2() {
                obj = document.getElementById('parametros_matriculas');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

    function cambiar_fondo_acor3() {
                obj = document.getElementById('parametros_inasistencias');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }   

    function cambiar_fondo_acor4() {
                obj = document.getElementById('parametros_control_calificaciones');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }  

    function cambiar_fondo_acor5() {
                obj = document.getElementById('parametros_horarios');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }  

    function cambiar_fondo_acor6() {
                obj = document.getElementById('parametros_promocion_estudiantes');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            } 

    function cambiar_fondo_acor7() {
                obj = document.getElementById('parametros_constancias_certificados');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            } 

    function cambiar_fondo_acor8() {
                obj = document.getElementById('parametros_acudientes');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            } 

    function cambiar_fondo_acor9() {
                obj = document.getElementById('parametros_fotografica');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

    function cambiar_fondo_acor10() {
                obj = document.getElementById('parametros_modulos_nuevos');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

    function cambiar_fondo_acor11() {
                obj = document.getElementById('parametros_vigencia_tiempos');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

    function cambiar_fondo_acor12() {
                obj = document.getElementById('parametros_automatizacion_sistema');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

                function cambiar_fondo_acor13() {
                obj = document.getElementById('parametros_integrantes');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

                function cambiar_fondo_acor14() {
                obj = document.getElementById('parametros_definir_aspectos_plan_estudio');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }

                function cambiar_fondo_acor15() {
                obj = document.getElementById('parametros_cierre_año');
                obj.style.backgroundColor = (obj.style.backgroundColor == '#8E8E8E') ? 'none' : '#8E8E8E';
            }  
</script>
<style>
	
	.busqm{

	top: 130px;
	width: 800px;
	height: 100px;
	left: 9.5%;
	background-color: transparent;
	position: absolute;

	}
</style>

<link href="js/jquery/jquery-ui.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<link rel="stylesheet" type="text/css" href="sweetalert2.css">

<script src="sweetalert2.min.js"></script>
<style>
.sweet-alert {
    background-color: white;
}	

</style>

</head>

<body id="cuerpo" id="cuerpo" oncontextmenu="return false" > 

<?php

include_once("inc.header.php");

?>

<table align="center" width="<?php echo $ancho_plantilla; ?>" class="centro" cellpadding="10">

<tr><td></td>

</tr>

<tr>

<th scope="col" colspan="1" class="centro">PAR&Aacute;METROS GENERALES </th>

<tr>

<td>

<!-- BUSCADOR PARAMETROS -->

<?php 

if (isset($_POST["btn_buscarewe"])) {

$selected_tipo_bxs= $_POST['buscadortipo_wq'];
$bqusx=$_POST['buscaro_opar'];

include("conb.php");

?>

<br />
<br />
<br />
<br />
<br />
<div id="totalbusq">
<table>

<?php 

if ($selected_tipo_bxs == 'nadaresp') {
$resqx++;

}

if ($selected_tipo_bxs == 'tipobpd') {

$inimy = lcfirst($bqusx); 
$todmy = strtoupper($bqusx);
$todmi = strtolower($bqusx);

$registro=mysqli_query($conexion,"SELECT conf_sygescol.conf_id,  conf_buscador_grupo.titulo, conf_buscador_grupo.color, encabezado_parametros.id_orden, encabezado_parametros.consec, conf_buscador_grupo.ancla FROM conf_buscador_grupo JOIN encabezado_parametros ON conf_buscador_grupo.categoria=encabezado_parametros.categoriat JOIN conf_sygescol ON encabezado_parametros.id_param=conf_sygescol.conf_id where (conf_sygescol.conf_nom_ver like  _utf8 '%$bqusx%' COLLATE utf8_general_ci  OR conf_sygescol.conf_nom_ver like  _utf8 '%$inimy%' COLLATE utf8_general_ci OR conf_sygescol.conf_nom_ver like  _utf8 '%$todmy%' COLLATE utf8_general_ci OR conf_sygescol.conf_nom_ver like  _utf8 '%$todmi%' COLLATE utf8_general_ci)")
or die ("Problemas en la Consulta ".mysqli_error());

}

if ($selected_tipo_bxs == 'descripbpd') {
$inimy = lcfirst($bqusx); 
$todmy = strtoupper($bqusx);
$todmi = strtolower($bqusx);
$registro=mysqli_query($conexion,"SELECT conf_sygescol.conf_id,  conf_buscador_grupo.titulo, conf_buscador_grupo.color, encabezado_parametros.id_orden, encabezado_parametros.consec, conf_buscador_grupo.ancla FROM conf_buscador_grupo JOIN encabezado_parametros ON conf_buscador_grupo.categoria=encabezado_parametros.categoriat JOIN conf_sygescol ON encabezado_parametros.id_param=conf_sygescol.conf_id where (conf_sygescol.conf_descri like  _utf8 '%$bqusx%' COLLATE utf8_general_ci  OR conf_sygescol.conf_descri like  _utf8 '%$inimy%' COLLATE utf8_general_ci OR conf_sygescol.conf_descri like  _utf8 '%$todmy%' COLLATE utf8_general_ci OR conf_sygescol.conf_descri like  _utf8 '%$todmi%' COLLATE utf8_general_ci)")
or die ("Problemas en la Consulta ".mysqli_error());

}

if ($selected_tipo_bxs == 'descripid') {

$registro=mysqli_query($conexion,"SELECT conf_sygescol.conf_id, conf_buscador_grupo.titulo, conf_buscador_grupo.color, encabezado_parametros.id_orden, encabezado_parametros.consec, conf_buscador_grupo.ancla FROM conf_buscador_grupo JOIN encabezado_parametros ON conf_buscador_grupo.categoria=encabezado_parametros.categoriat JOIN conf_sygescol ON encabezado_parametros.id_param=conf_sygescol.conf_id where conf_sygescol.conf_id like '$bqusx'")
or die ("Problemas en la Consulta ".mysqli_error());

}

if ($selected_tipo_bxs == 'descripconsec') {

$registro=mysqli_query($conexion,"SELECT conf_sygescol.conf_id,  conf_buscador_grupo.titulo, conf_buscador_grupo.color, encabezado_parametros.id_orden, encabezado_parametros.consec, conf_buscador_grupo.ancla FROM conf_buscador_grupo JOIN encabezado_parametros ON conf_buscador_grupo.categoria=encabezado_parametros.categoriat JOIN conf_sygescol ON encabezado_parametros.id_param=conf_sygescol.conf_id where encabezado_parametros.consec like '$bqusx'")
or die ("Problemas en la Consulta ".mysqli_error());

}

?>

<?php 
if ($descripw!="") {
?>

<tr>
	
		<td>
			<div  style='color:black; text-decoration:none; font-weight:bolder;text-transform:uppercase;font-size:18px;'>B&uacute;squeda:</div>
		</td>
		<td>
			<a href="#" onclick="<?php echo $descripw['color']?>" style='color:red; text-decoration:none; font-size:18px; font-weight:bolder;text-transform:uppercase;'><?php echo $bqusx ?></a>
		</td>
	</tr>
<?php
}

while ($descripw=mysqli_fetch_array($registro)){
?>

	<tr>

		<td>
			<div  style='color:black; text-decoration:none; font-weight:bolder;'>Clasificacion:</div>
		</td>
		<td>
			<a href="#<?php echo $descripw['ancla']?>" onclick="<?php echo $descripw['color']?>" style='color:#0660CE; text-decoration:none; font-weight:bolder;'><?php echo $descripw['titulo']?></a>
		</td>
	</tr>
	<tr>
		<td>
<div  style='color:black; text-decoration:none; font-weight:bolder;'> Consecutivo:</div>
		</td>
		<td>
<a href="#Parametro<?php echo $descripw['consec']?>" style='color:#0660CE; text-decoration:none; font-weight:bolder;'><?php echo $descripw['consec']?></a>
		</td>
	</tr>
	<tr>
		<td>
<div  style='color:black; text-decoration:none; font-weight:bolder;'>ID Parametro:</div>
		</td>
		<td>
<a href="#Parametro<?php echo $descripw['consec']?>" style='color:#0660CE; text-decoration:none; font-weight:bolder;'><?php echo $descripw['conf_id']?></a>

		</td>
	</tr>

	<tr>
		<td>
<br />
		</td>
		<td>
<br />

		</td>
	</tr>

<?php 

}

?>

</table>
</div>

<?php 

 }

 ?>

<!-- FIN BUSCADOR PARAMETROS -->
<script>

function ocultarvbb(){
   var elElemento=document.getElementById("busqm");
   if(elElemento.style.display == 'block') {
      elElemento.style.display = 'none';
   } else {
      elElemento.style.display = 'block';
   }
}
</script>
</td>

</tr>

</tr>

<tr>

<td>

<br />
<br />
<br />

<?php 

include ("conb.php");$registros=mysqli_query($conexion,"select * from conf_sygescol_adic where id=1")or die("Problemas en la Consulta".mysqli_error());while ($reg=mysqli_fetch_array($registros)){$coloracord=$reg['valor'];}

?>

<form id="formprinpargen" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="grado_grupo" lang="es" onsubmit="return seRepiteArea()">

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion" style="background-color: <?php echo $coloracord ?>"><strong>PAR&Aacute;METROS PARA ESTABLECER CRITERIOS DE EVALUACI&Oacute;N Y PROMOCI&Oacute;N</strong><br /><center><input type="radio" value="rojo" name="colores">Si&nbsp;&nbsp;<input type="radio" value="naranja" name="colores">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table   width="50%" class="centro" cellpadding="10"  border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	$consecutivo=0;

	do

	{

		$consecutivo++;

	?>

	

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div class="sin_resaltado">

<div  class="textarea"align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div></div>

</div></div></div></div></div>

<style type="text/css">
	
	.sin_resaltado{

outline: none;

}

</style>

</strong>

</td>

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

      <?php echo $row_configuracion['conf_descri']; ?>

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

			case 65:	

		$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="criterios_evaluacion.php" target="_blank" style="color:#3399FF">Ir a criterios de evaluacion</a>

				  </td>

				 </tr>

			

			</table> 

		

<?php

	

		break;

	

	case 152:	

		$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="proceso_evaluacion.php" target="_blank" style="color:#3399FF">Ir a procesos de evaluacion</a>

				  </td>

				 </tr>

			

			</table> 

		

<?php

	

		break;

	case 93:	

		$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	  	<a href="criterios_promocion.php" target="_blank" style="color:#3399FF">Ir a criterios de promocion</a>

				  </td>

				 </tr>

			

			</table> 

		

<?php

	

		break;

//aca va el caso 95,96,100,109,

		case 95:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<div class="cajaparametrogenerales"><a href="configuracion_periodos_numero.php" target="_blank" style="color:#3399FF">Ir a numero de periodos academicos</a></div>

					<style>

				.cajaparametrogenerales {
						    width: 300px;
						    float: right;
						}
					
					</style>

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

		case 96:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  		<div class="cajaparametrogenerales"><a href="periodos_estudiante.php" target="_blank" style="color:#3399FF">Ir de fechas de periodos academicos</a></div>

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

case 100:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<div class="cajaparametrogenerales"><a href="configuracion_comportamiento.php" target="_blank" style="color:#3399FF">Ir a configuracion de comportamiento</a></div>

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

		case 109:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="configuracion_boletines.php" target="_blank" style="color:#3399FF">Ir a configuracion de boletines</a>

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

	case 66: //Ingresar notas despues del cierre de areas
		?>

			<?php

			$estado = '';
			if(strpos($row_configuracion['conf_valor'],"$")>0)
			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);
				$parametro = $array_parametro[0];
				$areasObligatorias = $array_parametro[1];

				$areasTecnicas = $array_parametro[2];

				$valorEspecifico_D1 = $array_parametro[3];

				$valorEspecifico_H1 = $array_parametro[4];
				$valorEspecifico_D2 = $array_parametro[5];
				$valorEspecifico_H2 = $array_parametro[6];
				$valorEspecifico_D3 = $array_parametro[7];

				$valorEspecifico_H3 = $array_parametro[8];

				$valorEspecifico_D4 = $array_parametro[9];
				$valorEspecifico_H4 = $array_parametro[10];
			}
			else
				$parametro = $row_configuracion['conf_valor'];

		?>
		<br><br>
		<table >
	        		<tr><b>Aplica</b>
				  	  <select class="sele_mul op" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" onclick="validar4()">
							<option value="S" <?php if (!(strcmp("S", $parametro['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

							<option value="N" <?php if (!(strcmp("N", $parametro['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

						  </select>

                	</tr>

</div>

</div>

</div>

</div>

	</div>

<script>

function validar4(){

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("parametro44_1").disabled = false;

document.getElementById("parametro44_2").disabled = false;

document.getElementById("valorEspecifico_D1").disabled = false;

document.getElementById("valorEspecifico_D2").disabled = false;

document.getElementById("valorEspecifico_D3").disabled = false;

document.getElementById("valorEspecifico_D4").disabled = false;

document.getElementById("valorEspecifico_H1").disabled = false;

document.getElementById("valorEspecifico_H2").disabled = false;

document.getElementById("valorEspecifico_H3").disabled = false;

document.getElementById("valorEspecifico_H4").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

document.getElementById("parametro44_1").disabled = true;

document.getElementById("parametro44_2").disabled = true;

document.getElementById("valorEspecifico_D1").disabled = true;

document.getElementById("valorEspecifico_D2").disabled = true;

document.getElementById("valorEspecifico_D3").disabled = true;

document.getElementById("valorEspecifico_D4").disabled = true;

document.getElementById("valorEspecifico_H1").disabled = true;

document.getElementById("valorEspecifico_H2").disabled = true;

document.getElementById("valorEspecifico_H3").disabled = true;

document.getElementById("valorEspecifico_H4").disabled = true;

}

}

      

	addEvent('load', validar4); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

       

</script>

		<br>

		<br>

		

        <br><hr>      	

		<br>

		<td> 

<div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

  

     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>&Iacute;tem</strong> </div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

			<table  border="1" style="border:1px solid black">

			<tr >

 

				<td style="text-align:center;">Para las Asignaturas de las areas fundamentales obligatorias</td>

				<td><input type="text"style="width:50px;" onkeypress="return justNumbers(event);" id="parametro44_1"value="<?php echo $areasObligatorias; ?>" name="areas_Obligatorias_" class="parametro4"></td>

			</tr>

			<tr>

				<td style="text-align:center;">Para asignaturas para areas tecnicas</td>

				<td><input type="text"style="width:50px;"  onkeypress="return justNumbers(event);" id="parametro44_2"value="<?php echo $areasTecnicas; ?>" name="areas_Tecnicas_" class="parametro4"></td>

			</tr>

		</table> 

	</td>

		</table>

<div class="accordion_example2wqzx">

        <div class="accordion_inwerds">

		<div class="acc_headerfgd"><strong>Escala</strong> </div>

        <div class="acc_contentsaponk">

		 <div class="grevdaiolxx">

		<table border="1" style="width: 370px;text-align: center;margin-top: 15px;">

				<tr><td colspan="3">Escala Nacional para areas tecnicas</td></tr>

				<tr><td><label>Desempe&ntilde;o Nal.</label></td><td><label>Desde</label></td><td><label>Hasta</label></td></tr>

				<tr style="text-align: left;">

					<td>

						<label>

							Superior<br>

						</label>	  

					</td>

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_D1" name="valorEspecifico_D1" class="parametro4" value="<?php echo $valorEspecifico_D1; ?>">

						</label>	

					</td>

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_H1" name="valorEspecifico_H1" value="<?php echo $valorEspecifico_H1; ?>">

						</label>	

					</td>						

				</tr>

				<tr style="text-align: left;">

					<td>

						<label>

							Alto<br>

						</label>	

					</td>

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_D2" name="valorEspecifico_D2" value="<?php echo $valorEspecifico_D2; ?>">

						</label>	

					</td>	

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_H2" name="valorEspecifico_H2" value="<?php echo $valorEspecifico_H2; ?>">

						</label>	

					</td>					

				</tr>

				<tr style="text-align: left;">

					<td>

						<label>

							Basico<br>

						</label>	

					</td>

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_D3" name="valorEspecifico_D3" value="<?php echo $valorEspecifico_D3; ?>">

						</label>	

					</td>

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_H3" name="valorEspecifico_H3" value="<?php echo $valorEspecifico_H3; ?>">

						</label>	

					</td>						

				</tr>

				<tr style="text-align: left;">

					<td>

						<label>

							Bajo<br>

						</label>	

					</td>

					<td>

						<label>

			
							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_D4" name="valorEspecifico_D4" value="<?php echo $valorEspecifico_D4; ?>">

						</label>	

					</td>	

					<td>

						<label>

							<input style="width: 15%;" onkeypress="return justNumbers(event);" id="valorEspecifico_H4" name="valorEspecifico_H4" value="<?php echo $valorEspecifico_H4; ?>">

						</label>	

					</td>					

				</tr>																

			</table>

		<?php

		break;

	}

	?>

	</td>

	</tr>

	<?php

	}while($row_configuracion = mysql_fetch_assoc($configuracion));

	?>
</table>

</div>
</div>

</div>
</div>

</div>

<?php

// esta es la tabla 2
if($totalRows_configuracion)

{
	mysql_data_seek($configuracion,0);
mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo
								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id
							WHERE conf_sygescol.conf_estado = 0
								AND conf_sygescol.conf_id IN (68,73,99,123,124,156,115,161,167,242,241)  ORDER BY encabezado_parametros.id_orden ";
	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());
	$row_configuracion = mysql_fetch_assoc($configuracion);
// aca inicia la otra tabla
}?>

<?php 
include ("conb.php");$registrosb=mysqli_query($conexion,"select * from conf_sygescol_adic where id=2")or die("Problemas en la Consulta".mysqli_error());while ($regb=mysqli_fetch_array($registrosb)){$coloracordb=$regb['valor'];}
?>
<div class="container_demohrvszv_caja_1">
		<div class="accordion_example2wqzx_caja_2">
			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_matriculas" style="background-color: <?php echo $coloracordb ?>"><center><strong>PAR&Aacute;METROS PARA MATRICULAS</strong></center><br /><center><input type="radio" value="rojob" name="coloresb">Si&nbsp;&nbsp;<input type="radio" value="naranjab" name="coloresb">No</div></center>
				<div class="acc_contentsaponk_caja_4">
					<div class="grevdaiolxx_caja_5">
					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>
	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>
	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>
	<?php
	do

	{

		$consecutivo++;
	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>
	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>
<div class="container_demohrvszv_caja_tipo_param">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx_caja_tipo_param">
<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>
      <td valign="top" width="80%">
     <div class="container_demohrvszv" >
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>
				<div class="acc_contentsaponk">

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

      <?php echo $row_configuracion['conf_descri']; ?>
      </div>

					</div>
				</div>
			</div>

		</div>
</div>

 </td>

	<td align="center">
<?php
	switch($row_configuracion['conf_id'])

	{//este es el inicio
case 156:
		$array_parametro = explode("$",$row_configuracion['conf_valor']);

		//Consultamos el tope maximo de los estudiantes (Zona Urbana)
		$proyecion_cupos_1 = $array_parametro[1];

		$proyecion_cupos_2 = $array_parametro[2];
		$proyecion_cupos_3 = $array_parametro[3];

		$proyecion_cupos_4 = $array_parametro[4];
		$proyecion_cupos_5 = $array_parametro[5];
		$proyecion_cupos_6 = $array_parametro[6];
		$proyecion_cupos_7 = $array_parametro[7];
		$proyecion_cupos_8 = $array_parametro[8];
		$proyecion_cupos_9 = $array_parametro[9];

		$proyecion_cupos_10 = $array_parametro[10];
		$proyecion_cupos_11 = $array_parametro[11];
		$proyecion_cupos_12 = $array_parametro[12];

		//Consultamos el tope maximo de los estudiantes (Zona Rural)

		$proyecion_cupos_13 = $array_parametro[13];

		$proyecion_cupos_14 = $array_parametro[14];

		$proyecion_cupos_15 = $array_parametro[15];

		$proyecion_cupos_16 = $array_parametro[16];

		$proyecion_cupos_17 = $array_parametro[17];

		$proyecion_cupos_18 = $array_parametro[18];

		$proyecion_cupos_19 = $array_parametro[19];

		$proyecion_cupos_20 = $array_parametro[20];

		?>

		

<!-- parametro 78 -->

<!-- ZONA URBANA -->

		<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"><strong>Zona Urbana</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

	<table width="100%" class="formulario" align="center" style="float:left;">

			

			<tr>

				<th class="formulario">NIVEL</th>

				<th class="formulario">TOPE DE ESTUDIANTES</th>

			</tr>

			<tr class="fila2">

				<td>Preescolar</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant1_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_1; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant2_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_2; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

			<tr class="fila1">

				<td>Primaria</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant3_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_3; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant4_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_4; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

			<tr class="fila2">

				<td>Secundaria y Media Academica</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant5_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_5; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant6_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_6; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

			<tr class="fila1">

				<td>Media T&eacute;cnica</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant7_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_7; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant8_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_8; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

			<tr class="fila2">

				<td>Ciclos Secundaria</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant9_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_9; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant10_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_10; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

			<tr class="fila1">

				<td>Ciclos Media</td>

				<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant11_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_11; ?>" style="border-radius: 10px; width: 18%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant12_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_12; ?>" style="border-radius: 10px; width: 18%;" /></td>

			</tr>

</table>

</div>

</div>

</div>

</div>

</div>

<!-- FIN ZONA URBANA -->

&nbsp;

<!-- ZONA RURAL --> 

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">Zona Rural</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">		

<table width="100%" class="formulario" align="center" style="float:left;">

			

	

		<tr>

			<th class="formulario">NIVEL</th>

			<th class="formulario">TOPE DE ESTUDIANTES</th>

		</tr>

		<tr class="fila2">

			<td>Preescolar</td>

			<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant13_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_13; ?>" style="border-radius: 10px; width: 20%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant14_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_14; ?>" style="border-radius: 10px; width: 20%;" /></td>

		</tr>

		<tr class="fila1">

			<td>Primaria</td>

			<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant15_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_15; ?>" style="border-radius: 10px; width: 20%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant16_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_16; ?>" style="border-radius: 10px; width: 20%;"/></td>

		</tr>

		<tr class="fila2">

			<td  valign="top" >Secundaria y Media Academica</td>

			<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant17_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_17; ?>" style="border-radius: 10px; width: 20%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant18_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_18; ?>" style="border-radius: 10px; width: 20%;" /></td>

		</tr>

		<tr class="fila1">

			<td>Media T&eacute;cnica</td>

			<td><input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant19_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_19; ?>" style="border-radius: 10px; width: 20%;" />-<input type="text" onkeypress="return justNumbers(event);" 

name="planilla_prom_ant20_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_20; ?>" style="border-radius: 10px; width: 20%;" /></td>

		</tr>

</div>

</div>

</div>

</div>

</div>

	</table>

<!-- FIN ZONA RURAL -->

	

		<?php

		break;

			case 68: //forma_ing_fallas

		?>

		<table>

		<tr>

			<td><b>Aplica</b>

			 <select class="sele_mul"  onclick="validar6()" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

				<option value="Y" <?php if (strpos($row_configuracion['conf_valor'],"Y") == true)  {echo "selected=\"selected\"";} ?>>Si</option>

				<option value="N" <?php if (strpos($row_configuracion['conf_valor'],"N") == true) {echo "selected=\"selected\"";} ?>>No</option>

			  </select>

			</td>		

		</tr>

		<tr>

			<td><b>Si aplica defina grado en que se dejar&#225; al estudiante:</b></td>

		 	<td>

			  <select class="sele_mul" name="G_<?php echo $row_configuracion['conf_nombre']; ?>" id="G_<?php echo $row_configuracion['conf_nombre']; ?>">

			  <option value="0" <?php if (strpos($row_configuracion['conf_valor'],"0") == true) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

				<option value="GA" <?php if (strpos($row_configuracion['conf_valor'],"GA") == true) {echo "selected=\"selected\"";} ?>>Grado No Promovido</option>

				<option value="GS" <?php if (strpos($row_configuracion['conf_valor'],"GS") == true) {echo "selected=\"selected\"";} ?>>Grado Siguiente</option>

			  </select>

			</td>

		 </tr>

		 </table>

		<script>

function validar6(){

if(document.getElementById("<?php echo $row_configuracion['conf_nombre']; ?>").value=="Y"){

document.getElementById("G_<?php echo $row_configuracion['conf_nombre']; ?>").disabled=false;

}

if(document.getElementById("<?php echo $row_configuracion['conf_nombre']; ?>").value=="N"){

document.getElementById("G_<?php echo $row_configuracion['conf_nombre']; ?>").disabled=true;

}

}

	addEvent('load', validar6); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

		<?php

		break;

/*FIN CAMBIO1*/

	case 73: //forma_ing_fallas

		$valoresP73 = explode("$", $row_configuracion['conf_valor']);

		?>

        <div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

  

     <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem </div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">
		<table>			

			<tr><td><input onclick="validar73_1()"name="<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[0] == 0) {echo 'checked="checked"';} ?> value="0" type="radio"></td><td>Toda la informaci&oacute;n de la inscripci&oacute;n<br>

			<table>

				<tr><td><input id="73_1"type="checkbox" name="0_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[1] == "a") {echo 'checked="checked"';} ?> value="a"></td><td>Informaci&oacute;n de la Matricula</td></tr>

				<tr><td><input id="73_22"type="checkbox" name="1_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[2] == 1) {echo 'checked="checked"';} ?> value="1"></td><td>Informaci&oacute;n B&aacute;sica Estudiante</td></tr>

				<tr><td><input id="73_3"type="checkbox" name="2_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[3] == 2) {echo 'checked="checked"';} ?> value="2"></td><td>Informaci&oacute;n Localizaci&oacute;n Estudiante</td></tr>

				<tr><td><input id="73_4"type="checkbox" name="3_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[4] == 3) {echo 'checked="checked"';} ?> value="3"></td><td>Estudiante Victima de Conflicto</td></tr>

				<tr><td><input id="73_5"type="checkbox" name="4_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[5] == 4) {echo 'checked="checked"';} ?> value="4"></td><td>Informaci&oacute;n Salud del Estudiante</td></tr>

				<tr><td><input id="73_6"type="checkbox" name="5_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[6] == 5) {echo 'checked="checked"';} ?> value="5"></td><td>Informaci&oacute;n del Acudiente</td></tr>

				<tr><td><input id="73_7"type="checkbox" name="6_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[7] == 6) {echo 'checked="checked"';} ?> value="6"></td><td>Informaci&oacute;n de la madre</td></tr>

				<tr><td><input id="73_8"type="checkbox" name="7_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[8] == 7) {echo 'checked="checked"';} ?> value="7"></td><td>Informaci&oacute;n del padre</td></tr>

				<tr><td><input id="73_9"type="checkbox" name="8_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[9] == 8) {echo 'checked="checked"';} ?> value="8"></td><td>Cuadro acumulativo de matricula</td></tr>

				<tr><td><input id="73_10"type="checkbox" name="9_<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[10] == 9) {echo 'checked="checked"';} ?> value="9"></td><td>Prerrequisitos de matr&iacute;cula</td></tr>

			</table>

			</td></tr>

			<tr><td><input onclick="validar73()" name="<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[0] == 1) {echo 'checked="checked"';} ?> value="1" type="radio"></td><td>Cargar &#250;nicamente la renovaci&#243;n de la matr&#237;cula, lo que implica manejar un libro virtual y de todas formas imprimir anualmente.</td></tr>

			<tr><td><input onclick="validar73()"name="<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[0] == 2) {echo 'checked="checked"';} ?> value="2" type="radio"></td><td>Dejar el mismo modelo del a&ntilde;o anterior</td></tr>

		</table>

<script type="text/javascript">

	

function validar73() {

    document.getElementById("73_1").checked = false;

     document.getElementById("73_22").checked = false;

      document.getElementById("73_3").checked = false;

       document.getElementById("73_4").checked = false;

        document.getElementById("73_5").checked = false;

         document.getElementById("73_6").checked = false;

          document.getElementById("73_7").checked = false;

           document.getElementById("73_8").checked = false;

            document.getElementById("73_9").checked = false;

             document.getElementById("73_10").checked = false;

        document.getElementById("73_1").disabled = true;

     document.getElementById("73_22").disabled = true;

      document.getElementById("73_3").disabled = true;

       document.getElementById("73_4").disabled = true;

        document.getElementById("73_5").disabled = true;

         document.getElementById("73_6").disabled = true;

          document.getElementById("73_7").disabled = true;

           document.getElementById("73_8").disabled = true;

            document.getElementById("73_9").disabled = true;

             document.getElementById("73_10").disabled = true;

}

function validar73_1() {

    document.getElementById("73_1").disabled = false;

     document.getElementById("73_22").disabled = false;

      document.getElementById("73_3").disabled = false;

       document.getElementById("73_4").disabled = false;

        document.getElementById("73_5").disabled = false;

         document.getElementById("73_6").disabled = false;

          document.getElementById("73_7").disabled = false;

           document.getElementById("73_8").disabled = false;

            document.getElementById("73_9").disabled = false;

             document.getElementById("73_10").disabled = false;

}

			//-->

</script>

				</div>

</div>

</div>

</div>

</div>

 

		 <!-- <select name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" class="sele_mul" style="width:320px;">

			<option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Toda la Informaci&#243;n de la Inscripci&#243;n</option>

			<option value="1" <?php if (!(strcmp("1", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Cargar &#250;nicamente la renovaci&#243;n de la matr&#237;cula, lo que implica manejar un libro virtual y de todas formas imprimir anualmente.</option>

		  </select>-->

		<?php

		break;

		//aca va el caso 99 

		case 99:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[2];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

case 242:

break;

			case 123	: //Actualizacion Hoja de vida

		?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				

				  </td>

				 </tr>

			

			</table> 

		<?php

		break;
case 124: //forma_ing_fallas
		$valoresP73 = explode("$", $row_configuracion['conf_valor']);
		?>
        <div class="container_demohrvszv">
    <div class="accordion_example2wqzx">
     <div class="accordion_inwerds">
        <div class="acc_headerfgd">&Iacute;tem </div>
        <div class="acc_contentsaponk">
          <div class="grevdaiolxx">
		<table>			
		
			<tr><td><input onclick="validar12494()" id="p124_1"name="<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[0] == 1) {echo 'checked="checked"';} ?> value="1" type="radio"></td><td>Existe RUM (Registro &Uacute;nico de Matr&iacute;cula)</td></tr>
			<tr><td><input id="p124_2"onclick="validar12494()"name="<?php echo $row_configuracion['conf_nombre']; ?>" <?php if ($valoresP73[0] == 2) {echo 'checked="checked"';} ?> value="2" type="radio"></td><td>Hacer carga masiva del RUM (Registro &Uacute;nico de Matr&iacute;cula)</td></tr>
		</table>
	</div>
</div>
</div>
</div>
</div>
<?php
break;
		// aca va el caso 115,161,162

		case 161:	

		$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="proyeccion_cupos_decreto.php" target="_blank" style="color:#3399FF">Ir a proyecci&oacute;n de cupos</a>

				  </td>

				 </tr>

			

			</table> 

		

<?php

		break;
		case 241: 

$array_parametro = explode("$",$row_configuracion['conf_valor']);
		//Consultamos el tope maximo de los estudiantes (Zona Urbana)
		$proyecion_cupos_ind_1 = $array_parametro[1];
		$proyecion_cupos_ind_2 = $array_parametro[2];
		$proyecion_cupos_ind_3 = $array_parametro[3];
		$proyecion_cupos_ind_4 = $array_parametro[4];
		$proyecion_cupos_ind_5 = $array_parametro[5];
		$proyecion_cupos_ind_6 = $array_parametro[6];
		$proyecion_cupos_ind_7 = $array_parametro[7];
		$proyecion_cupos_ind_8 = $array_parametro[8];
		$proyecion_cupos_ind_9 = $array_parametro[9];
        $proyecion_cupos_ind_10 = $array_parametro[10];
		$proyecion_cupos_ind_11 = $array_parametro[11];
        $proyecion_cupos_ind_12 = $array_parametro[12];
        $proyecion_cupos_ind_13 = $array_parametro[13];
        $proyecion_cupos_ind_14 = $array_parametro[14];
        $proyecion_cupos_ind_15 = $array_parametro[15];
        $proyecion_cupos_ind_16 = $array_parametro[16];
        $proyecion_cupos_ind_17 = $array_parametro[17];
		?>
<!-- PARAMETRO 82 -->
		<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd">&Iacute;tem</div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
		<table width="100%" class="formulario" align="center" style="float:left;">
						<th class="formulario" colspan="3"><center>SEG&Uacute;D DECRETO 3011</center></th>
			<tr>
				<th class="formulario"><center>De</center></th>
				<th class="formulario"><center>Para:</center></th>
				<th class="formulario"><center>Edad minima</center></th>

			</tr>
			<tr class="fila1">
				<td>Primero <br />a <br />Tercero</td>
				<td>Ciclo 1</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" id="18241_1"name="planilla_prom_ant1_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_1; ?>" style="border-radius: 10px; width: 18%;" /></td>
				
			</tr>
           <tr class="fila2">
					<td>Cuarto <br />a <br />Quinto</td>
				<td>Ciclo 2</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant2_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_2; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
				<td>Sexto <br />a <br />S&eacute;ptimo</td>
				<td>Ciclo 3</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant3_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_3; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila2">
					<td>Octavo<br />a <br />Noveno</td>
				<td>Ciclo 4</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant4_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_4; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
					<td>D&eacute;cimo</td>
				<td>Ciclo 5</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant5_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_5; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
			<tr class="fila2">
					<td>Und&eacute;cimo</td>
				<td>Ciclo 6</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant6_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_6; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
          
		</table>	
		
		</div>
</div>
</div>
</div>
</div>
<!-- FIN PARAMETRO 82 -->
		<?php
		break;
		case 167:
		$array_parametro = explode("$",$row_configuracion['conf_valor']);
					$reasignacionRepro_ = $array_parametro[1];
					$reasignacionRepro2_ = $array_parametro[2];
					$reasignacionRepro4_ = $array_parametro[3];
					$reasignacionRepro5_ = $array_parametro[4];
					$reasignacionRepro6_ = $array_parametro[5];
					$reasignacionRepro7_ = $array_parametro[6];
		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	
			$e1111= $valoresP43[5];	
	$parametro = $array_parametro[0];
?>
<div class="container_demohrvszv">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>Si aplica defina:</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx">
		<table>
				<tr>
<td> <input id="p19_1111" type="radio" <?php if (!(strcmp("A", $array_parametro[1]))) {echo "checked=checked";} ?> value="A" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td>Con pines e inscripci&oacute;n (matricula individual y matricula por biometria)<br /><br /></td> 

</tr>

<tr>
<td> <input id="p19_2222" type="radio" <?php if (!(strcmp("B", $array_parametro[1]))) {echo "checked=checked";} ?> value="B" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td> por estado academico a&ntilde;o anterior (matricula por promoci&oacute;n a&ntilde;o anterior)</td> 
				</tr>
			</table>
</div>
</div>
</div>
</div>
</div>
<?php
break;

case 115:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<div class="cajaparametrogenerales"><a href="grados_y_grupos.php" target="_blank" style="color:#3399FF">Ir a proyecci&oacute; de sedes, grados y grupos </a></div>

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!-- ---------------------------------- ACORDEON PARAMETROS PARA REGISTRO DE INASISTENCIAS -------------------------------------- -->

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (14,67,76,87,111,127,132,141,149,163,236)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosc=mysqli_query($conexion,"select * from conf_sygescol_adic where id=3")or die("Problemas en la Consulta".mysqli_error());while ($regc=mysqli_fetch_array($registrosc)){$coloracordc=$regc['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_inasistencias" style="background-color: <?php echo $coloracordc ?>"><center><strong>PAR&Aacute;METROS PARA REGISTRO DE INASISTENCIAS</strong></center><br /><center><input type="radio" value="rojoc" name="coloresc">Si&nbsp;&nbsp;<input type="radio" value="naranjac" name="coloresc">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do

	{

		$consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

	<td align="center">

	

<?php

	switch($row_configuracion['conf_id'])

	{//este es el inicio

	case 14: //forma_ing_fallas

		$valorP14 = explode("$", $row_configuracion['conf_valor']);

		?>

		<label>

		<h4>Control de Permanencia</h4>

		  <select class="sele_mul"  style="width: 70%;" name="cAcc_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

		
		  	<option value="A" <?php if (!(strcmp("A", $valorP14[0]))) {echo "selected=\"selected\"";} ?>>Seleccione uno ... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

			<option value="G" <?php if (!(strcmp("G", $valorP14[0]))) {echo "selected=\"selected\"";} ?>>General</option>

			<option value="D" <?php if (!(strcmp("D", $valorP14[0]))) {echo "selected=\"selected\"";} ?>>Detallado</option>

			<option value="C" <?php if (!(strcmp("C", $valorP14[0]))) {echo "selected=\"selected\"";} ?>>Combinado</option>

		  </select>

		</label>

		<hr>

		<label>

		<h4>Control de Acceso</h4>

		  <select class="sele_mul"  style="width: 70%;" name="cPer_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

<option value="0" <?php if (!(strcmp("0", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

		  	<option value="C" <?php if (!(strcmp("C", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			<option value="B" <?php if (!(strcmp("B", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>Registro por Biometr&iacute;a de control de acceso </option>

			<option value="A" <?php if (!(strcmp("A", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>Registro por Biometr&iacute;a de Control de Entrada y Salida</option>

			<option value="H" <?php if (!(strcmp("H", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>Primer y Segundo Periodo, con biometr&iacute;a por Control de Acceso de Entrada</option>

			<option value="I" <?php if (!(strcmp("I", $valorP14[1]))) {echo "selected=\"selected\"";} ?>>Tercer y Cuarto Periodo, con biometr&iacute;a por Control de Acceso Entrada y Salida</option>

		  </select>

		</label>		

		<?php

		break;

case 67: //forma_ing_fallas

		$arrayFecha = explode("$", $row_configuracion['conf_valor']);

		?>

		<table border="1" style="text-align: center;">

			<tr>

				<th>1&ordm; PERIODO</th><th>2&ordm; PERIODO</th><th>3&ordm; PERIODO</th><th>4&ordm; PERIODO</th>

			</tr>

			<tr>

				<td>

					<input name="P_<?php echo $row_configuracion['conf_nombre']; ?>" id="P_<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="7" readonly="readonly" value="<?php echo $arrayFecha[0]; ?>" />

		  			<button name="a_<?php echo $row_configuracion['conf_nombre']; ?>" id="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>

				</td>

				<td>

					<input name="S_<?php echo $row_configuracion['conf_nombre']; ?>" id="S_<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="7" readonly="readonly" value="<?php echo $arrayFecha[1] ?>" />

		  			<button name="b_<?php echo $row_configuracion['conf_nombre']; ?>" id="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>					

				</td>

				<td>

					<input name="T_<?php echo $row_configuracion['conf_nombre']; ?>" id="T_<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="7" readonly="readonly" value="<?php echo $arrayFecha[2] ?>" />

		  			<button name="c_<?php echo $row_configuracion['conf_nombre']; ?>" id="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>					

				</td>

				<td>

					<input name="C_<?php echo $row_configuracion['conf_nombre']; ?>" id="C_<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="7" readonly="readonly" value="<?php echo $arrayFecha[3] ?>" />

		  			<button name="d_<?php echo $row_configuracion['conf_nombre']; ?>" id="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>					

				</td>

			</tr>

		</table>

		<?php

		break;

case 76:

	?>

		<table width="100%" style="margin-bottom: 10px;text-align: center;">

		 	<tr>

		 		<td>

		 			<select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

						<option value="S" <?php if (!(strcmp("S", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Aplica</option>

						<option value="N" <?php if (!(strcmp("N", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

		  			</select>

		  		</td>

		  	</tr>

	  	</table>

	  	<a href="tipo_inasistencia.php" target="_blank">Ir a la edici&oacute;n del parametro</a>

	<?php

	break;

case 87:

		?>

			<label>

			  <select name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" class="sele_mul" style="width:320px;">

			  <option value="6" <?php if (!(strcmp("6", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

				<option value="1" <?php if (!(strcmp("1", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Inasistencia Registrada por el Docente</option>

				<option value="2" <?php if (!(strcmp("2", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Inasistencia Registrada por Coordinaci&oacute;n de Convivencia</option>

				<option value="3" <?php if (!(strcmp("3", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Registro por Biometria Control de Entrada</option>

				<option value="4" <?php if (!(strcmp("4", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Registro Manual</option>

				<option value="5" <?php if (!(strcmp("5", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Las 3 Opciones Anteriores</option>

				

			  </select>

			</label>

		<?php

	break;

	

case 111:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

/*--------------------------------------------------------------------CASO 111--------------------------------------------------------------------*/

		case 127:

		?>

		<label>

		  <select  class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

		    
			<option value="3" <?php if (!(strcmp("3", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No aplica &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

			<option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Registro en la planilla de calificaciones</option>

			<option value="1" <?php if (!(strcmp("1", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>En la planilla de inasistencia virtual</option>

			<option value="2" <?php if (!(strcmp("2", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No registra inasistencias</option>

		  </select>

		</label>

		<?php

		break;

case 132:
		$selGrados = "SELECT * FROM gao GROUP BY ba ORDER BY a";
		$sqlGrados = mysql_query($selGrados, $link);
		?>
	<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd">NIVELES</div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
						<table>
							<tr>
								<td>
								   <input type="radio" id="valida132" onclick="validar132_1()" <?php if (strpos($row_configuracion['conf_valor'],"N") == true) {echo "checked='checked'";} ?> name="valor_<?php echo $row_configuracion['conf_nombre']; ?>" value="N"> 
								</td>
								<th style="text-align: left;">Niveles</th>
							</tr>
							<tr>
								<td>
									<table>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_1"<?php if (strpos($row_configuracion['conf_valor'],"1") == true){echo "checked='checked'";} ?>   name="1_<?php echo $row_configuracion['conf_nombre']; ?>" value="1">Preescolar
										    </td>
									    </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_2"<?php if (strpos($row_configuracion['conf_valor'],"2") == true) {echo "checked='checked'";} ?>   name="2_<?php echo $row_configuracion['conf_nombre']; ?>"  value="2">B&aacute;sica Primaria
										    </td>
									    </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_3"<?php if (strpos($row_configuracion['conf_valor'],"3") == true) {echo "checked='checked'";} ?>   name="3_<?php echo $row_configuracion['conf_nombre']; ?>"  value="3">B&aacute;sica Secundaria
										    </td>
									    </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_4"<?php if (strpos($row_configuracion['conf_valor'],"4") == true)  {echo "checked='checked'";} ?>  name="4_<?php echo $row_configuracion['conf_nombre']; ?>"   value="4">Media Decimo
										    </td>
									    </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_5"<?php if (strpos($row_configuracion['conf_valor'],"5") == true)  {echo "checked='checked'";} ?>  name="5_<?php echo $row_configuracion['conf_nombre']; ?>"   value="5">Media Once
										    </td>
									    </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_6"<?php if (strpos($row_configuracion['conf_valor'],"6") == true)  {echo "checked='checked'";} ?>  name="6_<?php echo $row_configuracion['conf_nombre']; ?>"   value="6">Ciclos Basica Primaria</td>
										    </tr>
									    </tr>
							            <tr>
							                <td>
							                    <input type="checkbox" id="niveles_132_7"<?php if (strpos($row_configuracion['conf_valor'],"7") == true)  {echo "checked='checked'";} ?>  name="7_<?php echo $row_configuracion['conf_nombre']; ?>"   value="7">Ciclos Basica Secundaria</td>
							                </tr>
							               </tr>
							            <tr>
							                <td>
							                    <input type="checkbox" id="niveles_132_8"<?php if (strpos($row_configuracion['conf_valor'],"8") == true)  {echo "checked='checked'";} ?>  name="8_<?php echo $row_configuracion['conf_nombre']; ?>"   value="8">Ciclos Media</td>
							                </tr>
							               </tr>
										<tr>
										    <td>
										        <input type="checkbox" id="niveles_132_9"<?php if (strpos($row_configuracion['conf_valor'],"FC") == true) {echo "checked='checked'";} ?>   name="FC_<?php echo $row_configuracion['conf_nombre']; ?>"  value="FC">Formaci&oacute;n Complementaria
										    </td>
									    </tr>
									</table>
						</table>
		           </div>
                </div>
            </div>
        </div>
    </div>
	<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd">GRADOS</div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
		               <table>
							<tr>
								<td>
								     <input type="radio" id="valida1322" onclick="validar132()" <?php if (strpos($row_configuracion['conf_valor'],"G") == true) {echo "checked='checked'";} ?> name="valor_<?php echo $row_configuracion['conf_nombre']; ?>" value="G"> 
							    </td>
								<th style="text-align: left;">Grados</th>
							</tr>
							<tr>
							   <td>
							   </td>
							   <td>
								<table>
									<tr>
							<?php
							$i = 0;
							$q=0;
							while ($rowGrados = mysql_fetch_array($sqlGrados)) 
							{
				            $q++;
								if ($i == 2)
								{
								?>
										<td>
										    <input type="checkbox"  id="grados_132_<?php echo $q; ?>"<?php if (strpos($row_configuracion['conf_valor'],$rowGrados['ba']) == true){echo "checked='checked'";} ?>  name="grado132_<?php echo $rowGrados['a']; ?>" value="<?php echo $rowGrados['ba'];?>"><?php echo $rowGrados['ba'];?>
									   </td>
								    </tr>
								   	<tr>
								<?php
									$i = 0;
								}
								else
								{
									?>
						                <td>
						                    <input type="checkbox" id="grados_132_<?php echo $q; ?>"<?php if (strpos($row_configuracion['conf_valor'],$rowGrados['ba']) == true){echo "checked='checked'";} ?>  name="grado132_<?php echo $rowGrados['a']; ?>" value="<?php echo $rowGrados['ba'];?>"><?php echo $rowGrados['ba'];?>
						                </td>
									<?php
									$i++;
								}
							}//luis garcia
							?>
								  </tr>
								</table>
							</tr>
						</td>
					</table>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

function validar132()
{
    document.getElementById("niveles_132_1").checked = false;
     document.getElementById("niveles_132_2").checked = false;
      document.getElementById("niveles_132_3").checked = false;
       document.getElementById("niveles_132_4").checked = false;
        document.getElementById("niveles_132_5").checked = false;
         document.getElementById("niveles_132_6").checked = false;
          document.getElementById("niveles_132_7").checked = false;
          document.getElementById("niveles_132_8").checked = false;
          document.getElementById("niveles_132_9").checked = false;
    document.getElementById("niveles_132_1").disabled = true;
     document.getElementById("niveles_132_2").disabled = true;
      document.getElementById("niveles_132_3").disabled = true;
       document.getElementById("niveles_132_4").disabled = true;
        document.getElementById("niveles_132_5").disabled = true;
         document.getElementById("niveles_132_6").disabled = true;
         document.getElementById("niveles_132_7").disabled = true;
         document.getElementById("niveles_132_8").disabled = true;
         document.getElementById("niveles_132_9").disabled = true;
    document.getElementById("grados_132_1").disabled = false;
     document.getElementById("grados_132_2").disabled = false;
      document.getElementById("grados_132_3").disabled = false;
       document.getElementById("grados_132_4").disabled = false;
        document.getElementById("grados_132_5").disabled = false;
         document.getElementById("grados_132_6").disabled = false;
             document.getElementById("grados_132_7").disabled = false;
     document.getElementById("grados_132_8").disabled = false;
      document.getElementById("grados_132_9").disabled = false;
       document.getElementById("grados_132_10").disabled = false;
        document.getElementById("grados_132_11").disabled = false;
         document.getElementById("grados_132_12").disabled = false;
             document.getElementById("grados_132_13").disabled = false;
     document.getElementById("grados_132_14").disabled = false;
      document.getElementById("grados_132_15").disabled = false;
       document.getElementById("grados_132_16").disabled = false;
        document.getElementById("grados_132_17").disabled = false;
         document.getElementById("grados_132_18").disabled = false;
             document.getElementById("grados_132_19").disabled = false;
     document.getElementById("grados_132_20").disabled = false;
}

function validar132_1() 
{
        document.getElementById("niveles_132_1").disabled = false;
     document.getElementById("niveles_132_2").disabled = false;
      document.getElementById("niveles_132_3").disabled = false;
       document.getElementById("niveles_132_4").disabled = false;
        document.getElementById("niveles_132_5").disabled = false;
         document.getElementById("niveles_132_6").disabled = false;
             document.getElementById("niveles_132_7").disabled = false;
             document.getElementById("niveles_132_8").disabled = false;
             document.getElementById("niveles_132_9").disabled = false;
    document.getElementById("grados_132_1").disabled = true;
     document.getElementById("grados_132_2").disabled = true;
      document.getElementById("grados_132_3").disabled = true;
       document.getElementById("grados_132_4").disabled = true;
        document.getElementById("grados_132_5").disabled = true;
         document.getElementById("grados_132_6").disabled = true;
             document.getElementById("grados_132_7").disabled = true;
     document.getElementById("grados_132_8").disabled = true;
      document.getElementById("grados_132_9").disabled = true;
       document.getElementById("grados_132_10").disabled = true;
        document.getElementById("grados_132_11").disabled = true;
         document.getElementById("grados_132_12").disabled = true;
             document.getElementById("grados_132_13").disabled = true;
     document.getElementById("grados_132_14").disabled = true;
      document.getElementById("grados_132_15").disabled = true;
       document.getElementById("grados_132_16").disabled = true;
        document.getElementById("grados_132_17").disabled = true;
         document.getElementById("grados_132_18").disabled = true;
             document.getElementById("grados_132_19").disabled = true;
     document.getElementById("grados_132_20").disabled = true;
    document.getElementById("grados_132_1").checked = false;
     document.getElementById("grados_132_2").checked = false;
      document.getElementById("grados_132_3").checked = false;
       document.getElementById("grados_132_4").checked = false;
        document.getElementById("grados_132_5").checked = false;
         document.getElementById("grados_132_6").checked = false;
             document.getElementById("grados_132_7").checked = false;
     document.getElementById("grados_132_8").checked = false;
      document.getElementById("grados_132_9").checked = false;
       document.getElementById("grados_132_10").checked = false;
        document.getElementById("grados_132_11").checked = false;
         document.getElementById("grados_132_12").checked = false;
             document.getElementById("grados_132_13").checked = false;
     document.getElementById("grados_132_14").checked = false;
      document.getElementById("grados_132_15").checked = false;
       document.getElementById("grados_132_16").checked = false;
        document.getElementById("grados_132_17").checked = false;
         document.getElementById("grados_132_18").checked = false;
             document.getElementById("grados_132_19").checked = false;
     document.getElementById("grados_132_20").checked = false;
}
</script>
		<?php 

		break;

case 141:

		$valoresP65 = explode("$",$row_configuracion['conf_valor']);

		?>

		<table>

		<tr><td><strong>Aplica</strong></td><td>

			<select id="menu141"class="sele_mul" name="1_<?php echo $row_configuracion['conf_nombre']; ?>" onclick="validar141()">

				<option value="S" <?php if (!(strcmp("S", $valoresP65[0]))) {echo "selected=\"selected\"";} ?>>Si</option>

				<option  value="N" <?php if (!(strcmp("N", $valoresP65[0]))) {echo "selected=\"selected\"";} ?>>No</option>

			</select></td>

		</tr>

		<tr>

			<th class="fila1">Injustificadas:</th>

			<td><input id="141a"type="text" onkeypress="return justNumbers(event);" class="141"name="2_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP65[1];?>" style="border-radius: 10px; width: 25%;">%</td>

		</tr>

		<tr>

			<th class="fila1">Justificadas:</th>

			<td><input id="141b"type="text" onkeypress="return justNumbers(event);" class="141"name="3_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP65[2];?>" style="border-radius: 10px; width: 25%;" >%</td>

		</tr>

		</table>

    <script>

function validar141() {

if(document.getElementById('menu141').value=="S")

{

 document.getElementById("141a").disabled = false;

document.getElementById("141b").disabled = false;

}

if(document.getElementById('menu141').value=="N")

{

 document.getElementById("141a").disabled = true;

document.getElementById("141b").disabled = true;

}

   

}

	addEvent('load', validar141); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

		<?php

		break;	

	case 149:

		$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$reasignacionRepro_ = $array_parametro[1];

					$reasignacionRepro2_ = $array_parametro[2];

					$reasignacionRepro4_ = $array_parametro[3];

					$reasignacionRepro5_ = $array_parametro[4];

					$reasignacionRepro6_ = $array_parametro[5];
					$reasignacionRepro7_ = $array_parametro[6];

		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	

			$e1111= $valoresP43[5];	

	$parametro = $array_parametro[0];
?>

	
<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Si aplica defina:</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

						

		<table>

				<tr>

<td> <input id="p19_1111" type="radio" <?php if (!(strcmp("A", $array_parametro[1]))) {echo "checked=checked";} ?> value="A" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td>El &aacute;rea va a la lista de Nivelacion fin de a&ntilde;o, mientras <b style="color:red;">EL ESTUDIANTE</b> no acumule el n&uacute;mero total de areas establecidas <b style="color:red;">POR LA INSTITUCION</b>, para la  reprobaci&oacute;n del a&ntilde;o</td> <br />

</tr>

				<tr>
<td> <input id="p19_2222" type="radio" <?php if (!(strcmp("B", $array_parametro[1]))) {echo "checked=checked";} ?> value="B" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td> Con <b style="color:red;">El estudiante va a la lista de Reprobados, sin importar cu&aacute;ntas &aacute;reas tenga acumuladas para su reprobaci&oacute;n.</td> 

				</tr>

 	             <tr>

			 		<td></td><td>El estudiante que repruebe por inasistencia injustificada o justificada, la nota definitiva que registrar&aacute; el sistema ser&aacute; de:<input id="p19_222222" type="text" style="width: 10%;"onkeypress="return justNumbers(event);"  value="<?php echo $array_parametro[2]; ?>" name="reasignacionRepro3_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> 
			

				</tr>
			</table>

</div>

</div>

</div>

</div>

</div>

<?php

break;

case 163:	

		$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b><strong>Aplica</strong></b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="biometrico_control.php" target="_blank" style="color:#3399FF">Ir a control biometrico</a>

				  </td>

				 </tr>

			

			</table> 

		

<?php

	

		break;

case 236:
		$reasignacion2_ = explode("$",$row_configuracion['conf_valor']);
		?>
	<div class="container_demohrvszv">
	<div class="accordion_example2wqzx">
	<div class="accordion_inwerds">
	<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>
	<div class="acc_contentsaponk">
	<div class="grevdaiolxx">
		<table>
		<p style="text-align: left; margin:15px;">
		<input type="radio" onclick="javascript:determinarEstadoCampos170();"<?php if (strpos($row_configuracion['conf_valor'],"1")==true) {echo "checked='checked'";} ?> value="1" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" /> Retirado <br> 

		<input type="radio" onclick="javascript:determinarEstadoCampos170();" <?php if (strpos($row_configuracion['conf_valor'],"2")==true) {echo "checked='checked'";} ?> value="2" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />Traslado<br> 

		<input type="radio" onclick="javascript:determinarEstadoCampos170();"<?php if (strpos($row_configuracion['conf_valor'],"3")==true) {echo "checked='checked'";} ?> value="3" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />Deserto<br> 

        <input type="radio" onclick="javascript:determinarEstadoCampos170();"<?php if (strpos($row_configuracion['conf_valor'],"4")==true) {echo "checked='checked'";} ?> value="4" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />No Esta Asistiendo<br> <br>
        Numero de Dias Consecutivos : <input type="text" class="p119" onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 10%;" name="reasignacion2_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $reasignacion2_[2];?>"> <br>

		</p>

		</table>

		</div>

</div>
</div>
</div>
</div>

<script type="text/javascript">

function determinarEstadoCampos170(){

				const AREAS_ESPECIFICAS = "4"; // determina el valor de la opcion que se debe elegir para activar los campos que este caso es areas especificas en la solucion del parametro 159
				// obtiene el conjunto de input type radio que contienen las diferentes opciones de la seccion de areas a tener en cuenta de la solucion del parametro 159
				var opciones = document.getElementsByName( "reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" ); 
				for( var i = 0; i < opciones.length; i++ ){ // recorro el conjunto de input type radio que contienen las opciones
					if(opciones[i].checked == true){ // determino cual opcion esta seleccionada

						campos = document.getElementsByName("reasignacion2_<?php echo $row_configuracion['conf_nombre']; ?>"); // obtengo el conjunto de los 12 campos de las asignaturas especificas

 // termino else
					} // termino if
				} // termino for
</script>
		<?php
		break;


		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (56,71,88,89,92,94,97,110,102,117,154,157,114,235,240)  ORDER BY encabezado_parametros.id_orden ";
	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosd=mysqli_query($conexion,"select * from conf_sygescol_adic where id=4")or die("Problemas en la Consulta".mysqli_error());while ($regd=mysqli_fetch_array($registrosd)){$coloracordd=$regd['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_control_calificaciones" style="background-color: <?php echo $coloracordd ?>"><center><strong>PAR&Aacute;METROS PARA EL CONTROL Y REGISTRO DE CALIFICACIONES</strong></center><br /><center><input type="radio" value="rojod" name="coloresd">Si&nbsp;&nbsp;<input type="radio" value="naranjad" name="coloresd">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do

	{

		$consecutivo++;

	?>

	

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

 

<td align="center">

	

<?php

switch($row_configuracion['conf_id'])

{

	case 114:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

//* ------------------ 114  -----------------------------------

case 56: //Ingresar notas despues del cierre de areas

		?>

		<label>

		  Aplica<select class="sele_mul"  name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="S" <?php if (!(strcmp("S", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

			<option value="N" <?php if (!(strcmp("N", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

		  </select>

		</label>

		<?php

		break;

		case 71: //Ingresar notas despues del cierre de areas

			$row_configuracion['conf_valor'] = trim($row_configuracion['conf_valor'], "-");

			$valores = explode("@", $row_configuracion['conf_valor']);

			$val2 = explode("-", $valores[1]);

		?>

		<script language="javascript">

			function trim(stringToTrim) {

				return stringToTrim.replace(/^\s+|\s+$/g,"");

			}

			function cambiarContenido(valor){

				if(valor == 1){

					var checkbox = $('valores').value;

					var elementos = checkbox.split(",");

					var arrays = '';

					for(i=0; i<elementos.length; i++){

						$('per_' + elementos[i]).checked=0;

						$('per_' + elementos[i]).disabled=true;

						arrays += elementos[i] + '/' + '1-';

					}

					$('<?php echo $row_configuracion['conf_nombre']; ?>').value= valor + '@' + arrays;

				}else{

					var checkbox = $('valores').value;

					var elementos = checkbox.split(",");

					var arrays = '';

					for(i=0; i<elementos.length; i++){

						$('per_' + elementos[i]).disabled=false;

						arrays += elementos[i] + '/' + '1-';

					}

					$('<?php echo $row_configuracion['conf_nombre']; ?>').value= valor + '@' + arrays;

				}

			}

			function cambiarChec(){

				var checkbox = $('valores').value;

				var elementos = checkbox.split(",");

				var arrays = '';

				for(i=0; i<elementos.length; i++){

					if($('per_' + elementos[i]).checked == 0){

						arrays += elementos[i] + '/' + '1-';

					}else{

						arrays += elementos[i] + '/' + '2-';

					}

				}

				$('<?php echo $row_configuracion['conf_nombre']; ?>').value= $('PlanillaVer').value + '@' + arrays;

			}

		</script>

		<center><select class="sele_mul" name="PlanillaVer" id="PlanillaVer" onclick="validar8()" onchange="cambiarContenido(this.value)">

			<option <?php if($valores[0]==1){ echo 'selected="selected"';}?> value="1">No</option>

			<option <?php if($valores[0]==2){ echo 'selected="selected"';}?> value="2">Si</option>

		</select></center>

		<table width="100%" style="border:1px solid #666666; margin-top:5px;">

			<tr>

				<?php for($i=0; $i<count($val2); $i++){

					$val3 = explode("/", $val2[$i]);

				?>

					<th style="color:#FFFFFF; background-color:#3399FF;" title="Periodo <?php echo $val3[0];?>">P.<?php echo $val3[0];?></th>

				<?php } ?>

			</tr>

			<script>

function validar8() {

if(document.getElementById('PlanillaVer').value=="2")

{

document.getElementById("per_<?php echo $val3[0];?>").disabled = false;

}

if(document.getElementById('PlanillaVer').value=="1")

{

document.getElementById("per_<?php echo $val3[0];?>").disabled = true;

}

    

}

  function validar8alcargar(){ 

        const en_las_areas_de = "2"; // determinia el valor del input type radio que representa la opcion de areas epecificas

        var opcion = "PlanillaVer"; // obtengo el valor guardado en la BD que determina la opcion que fue seleccionada y guardad

        var campos = document.getElementsByClassName("p"); // obtengo el conjunto de los 12 campos de las areas especificas

        if (opcion == en_las_areas_de){ // si el valor traido es igual al valor que identifica la opcion areas especificas

          setDisabledCampos(campos, false); // activo los 12 campos

        }else{ // si el valor tradio es diferente fue porque se selecciono otra opcion diferente a areas especificas

          setDisabledCampos(campos, true); // desactivo los 12 campos

        }

         

      }

</script>

			<tr>

				<?php

				$valor2='';

				$disabled='';

				if($valores[0]==1){

					$disabled='disabled="disabled"';

				}

				for($i=0; $i<count($val2); $i++){

					$val3 = explode("/", $val2[$i]);

					$valor2.=$val3[0].',';

				?>

				<td style="border:1px solid #CCCCCC;">

					<input onchange="cambiarChec()" <?php echo $disabled;?> <?php if($val3[1]==2 and $disabled==''){ echo 'checked="checked"'; }?> type="checkbox" value="<?php echo $val3[0];?>" id="per_<?php echo $val3[0];?>" name="per_<?php echo $val3[0];?>" class="p"/>

				</td>

				<?php } ?>

			</tr>

		</table>

		<input type="hidden" name="valores" id="valores" value="<?php echo trim($valor2, ",");?>" />

		<input name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="hidden" size="12" value="<?php echo $row_configuracion['conf_valor']; ?>" />

		 <?php

		break;

case 88:

		$row_configuracion['conf_valor'] = trim($row_configuracion['conf_valor'], "-");

		$select = explode("@", $row_configuracion['conf_valor']);

		$valores = explode("-", $select[0]);

		$val2 = explode("-", $select[1]);

		?>

		<script language="javascript">

			function trim(stringToTrim) {

				return stringToTrim.replace(/^\s+|\s+$/g,"");

			}

			function cambiarContenido2(valor){

				var habiten = $("habilitar_en").value;

				if(valor == 1){

					var checkbox = $('valoresindice').value;

					var elementos = checkbox.split(",");

					$("habilitar_en").disabled=true;

					var arrays = '';

					for(i=0; i<elementos.length; i++){

						$('per_indice_' + elementos[i]).value="";

						$('per_indice_' + elementos[i]).disabled=true;

						arrays += elementos[i] + '/' + $('per_indice_' + elementos[i]).value +'-';

					}

					$('<?php echo $row_configuracion['conf_nombre']; ?>').value= valor + "-" + habiten + '@' + arrays;

				}else{

					var checkbox = $('valoresindice').value;

					var elementos = checkbox.split(",");

					$("habilitar_en").disabled=false;

					var arrays = '';

					for(i=0; i<elementos.length; i++){

						$('per_indice_' + elementos[i]).value = ""

						$('per_indice_' + elementos[i]).disabled=false;

						arrays += elementos[i] + '/' + $('per_indice_' + elementos[i]).value + '-';

					}

					$('<?php echo $row_configuracion['conf_nombre']; ?>').value= valor + "-" + habiten + '@' + arrays;

				}

			}

			function cambiarDatos(){

				var checkbox = $('valoresindice').value;

				var habiten = $("habilitar_en").value;

				var elementos = checkbox.split(",");

				var arrays = '';

				for(i=0; i<elementos.length; i++){

					//if($('per_' + elementos[i]).checked == 0){

						arrays += elementos[i] + '/' + $('per_indice_' + elementos[i]).value + '-';

					//}else{

					//	arrays += elementos[i] + '/' + '2-';

					//}

				}

				$('<?php echo $row_configuracion['conf_nombre']; ?>').value= $('controlindice').value + "-" + habiten + '@' + arrays;

			}

		</script>

		<?php

		$valor2='';

		$disabled='';

		if($valores[0]==1){

			$disabled='disabled="disabled"';

		}

		?>

		<center>

		

		<strong>Habilitar</strong>

		<select class="sele_mul" name="controlindice" id="controlindice" onchange="cambiarContenido2(this.value)">

			<option <?php if($valores[0]==1){ echo 'selected="selected"';}?> value="1">No</option>

			<option <?php if($valores[0]==2){ echo 'selected="selected"';}?> value="2">Si</option>

	</select>

	<br />

	<nobr><strong>En la Planilla de :</strong>

	<select class="sele_mul" name="habilitar_en" id="habilitar_en" <?php echo $disabled;?>  onchange="cambiarDatos()">

		<option <?php if($valores[1]==1){ echo 'selected="selected"';}?> value="1">Calificaciones</option>

		<option <?php if($valores[1]==2){ echo 'selected="selected"';}?> value="2"><?php echo $_SESSION['PLANILLA'][ 10 ]['NOMBRE_VER'];?> por Periodos</option>

	</select>

	</nobr>

	</center>

	<table width="100%" style="border:1px solid #666666; margin-top:5px;">

		<tr>

			<?php for($i=0; $i<count($val2); $i++){

				$val3 = explode("/", $val2[$i]);

			?>

					<th style="color:#FFFFFF; background-color:#3399FF;" title="Periodo <?php echo $val3[0];?>">P.<?php echo $val3[0];?></th>

			<?php } ?>

		</tr>

		<tr>

			<?php				

			for($i=0; $i<count($val2); $i++){

				$val3 = explode("/", $val2[$i]);

				$valor2.=$val3[0].',';

			?>

			<td style="border:1px solid #CCCCCC;">

				<input onkeypress="return justNumbers(event);"style="border-radius: 10px;"<?php echo $disabled;?> type="text"  onchange="cambiarDatos()" size="4" value="<?php echo $val3[1];?>" id="per_indice_<?php echo $val3[0];?>" name="per_indice_<?php echo $val3[0];?>" />%

			</td>

			<?php } ?>

		</tr>

	</table>

	<input type="hidden"  onchange="cambiarDatos()" name="valoresindice" id="valoresindice" value="<?php echo trim($valor2, ",");?>" />

	<input name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="hidden"  onchange="cambiarDatos()" size="12" value="<?php echo $row_configuracion['conf_valor']; ?>" />

 <?php

break;

case 89: //Modulo Homologacion Matricula Extraordinaria

?>

<?php

$estado = '';

if(strpos($row_configuracion['conf_valor'],"$")>0)

{

	$array_parametro = explode("$",$row_configuracion['conf_valor']);

	$parametro = $array_parametro[0];

	$estado = $array_parametro[1];

}

else

$parametro = $row_configuracion['conf_valor'];

?>

<table  width="90%" >

<tr>

<th><b>Aplica</b></th>

<td>

<select style="width:420px;" class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

		<option value="0" <?php if (!(strcmp("0", $parametro))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

		<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Las asignaturas con calificacion <b>DESEMPE&Ntilde;O BAJO,</b><b style="background:red;">SI</b> seran homologadas en el proceso,<b style="background:red;">Y NO</b> seran remitidas al docente responsable.</option>

		<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>Las asignaturas con calificacion <b>DESEMPE&Ntilde;O BAJO,</b><b style="background:red;">NO</b> seran homologadas en el proceso,<b style="background:red;">Y SI</b> seran remitidas al docente responsable para su correspondiente nivelacion.</option>

		<option value="L" <?php if (!(strcmp("L", $parametro))) {echo "selected=\"selected\"";} ?>>Este parametro <b>NO</b> aplica para la institucion educativa.</option>

</select>

</td>

</tr>

</table>

<?php

break;

/*-----------------------------------------------------------------------------------------CASO 92---------------------------------------------*/

	case 92: //Ingresar notas despues del cierre de areas

		?>

		

       

						

			<?php

			$estado = '';

			if(strpos($row_configuracion['conf_valor'],"$")>0)

			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);

				$parametro = $array_parametro[0];

				$areasObligatorias = $array_parametro[1];

				$areasTecnicas = $array_parametro[2];

			

			}

			else

				$parametro = $row_configuracion['conf_valor'];

		?>

		<br><br>

		<table >

		

	        		<tr><b>Aplica</b>

				  	  <select class="sele_mul op" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" onclick="validar92()">

							<option value="S" <?php if (!(strcmp("S", $parametro['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

							<option value="N" <?php if (!(strcmp("N", $parametro['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

						  </select>

                	</tr>

</div>

</div>

</div>

</div>

	</div>

<script>

function validar92(){

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("parametro92_1").disabled = false;

document.getElementById("parametro92_2").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

 document.getElementById("parametro92_1").disabled = true;

document.getElementById("parametro92_2").disabled = true;

}

}

      

	addEvent('load', validar92); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

       

</script>

		<br>

		<br>

		

        <br><hr>      	

		<br>

		<td> 

<div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

  

     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>&Iacute;tem</strong> </div>

        <div class="acc_contentsaponk">

          <div class="grevdaiolxx">

			<table  border="1" style="border:1px solid black">

			<tr >

 

				<td style="text-align:center;">Autoevaluaci&oacute;n</td>

				<td width="90%"><input type="text"style="width:94%;" id="parametro92_1"value="<?php echo $areasObligatorias; ?>" name="areas_Obligatorias92_" class="parametro4"></td>

			</tr>

			<tr>

				<td style="text-align:center;">Coevaluacion</td>

				<td width="90%"><input type="text"style="width:94%;" id="parametro92_2"value="<?php echo $areasTecnicas; ?>" name="areas_Tecnicas92_" class="parametro4"></td>

			</tr>

		</table> 

	</td>

		</table>

		<?php

		break;
case 94:
$estado = '';
$array_parametro = explode(",",$row_configuracion['conf_valor']);
$parametro = $array_parametro[0];	
?>
		<b>Aplica</b>
				 <select class="sele_mul" onclick="validar1999()"name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
					<option value="S" <?php if ($parametro == 'S') {echo "selected=\"selected\"";} ?>>Si</option>
					<option value="N" <?php if ($parametro == 'N') {echo "selected=\"selected\"";} ?>>No</option>
				 </select>
<div class="container_demohrvszv">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>Si aplica defina:</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx">
		<table>
                 <tr>
			 		<td><input id="p19_1"type="radio"  <?php if (strpos($row_configuracion['conf_valor'],"0") == true) {echo "checked='checked'";} ?> value="0" name="pla0"></td>
				 	<td>Plantilla Carga masiva para descriptores de Competencias</td>
				 </tr>
 <tr>
<td>
<b>&Oacute;</b>
</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_2"type="radio"  <?php if (strpos($row_configuracion['conf_valor'],"1") == true) {echo "checked='checked'";} ?> value="1" name="pla0"></td>
				 	<td>Plantilla Carga masiva para descriptores de Logros</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_3"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"2") == true) {echo "checked='checked'";} ?> value="2" name="pla2"></td>
				 	<td>Plantilla Carga masiva para descriptores de Dimensiones de la Competencia</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_4"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"3") == true) {echo "checked='checked'";} ?> value="3" name="pla3"></td>
				 	<td>Plantilla Carga masiva para descriptores de Indicadores de Logro</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_5"type="checkbox" <?php if (strpos($row_configuracion['conf_valor'],"4") == true) {echo "checked='checked'";} ?> value="4" name="pla4"></td>
				 	<td>Plantilla Carga masiva para descriptores de Fortalezas, Debilidades y Recomendaciones</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_6"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"5") == true) {echo "checked='checked'";} ?> value="5" name="pla5"></td>
				 	<td>Plantilla Carga masiva para descriptores de Comportamiento</td>
				 </tr>
				 <tr>
				 	<td><input id="p19_7"type="checkbox"<?php if (strpos($row_configuracion['conf_valor'],"6") == true) {echo "checked='checked'";} ?> value="6" name="pla6"></td>
				 	<td>Plantilla Carga masiva para descriptores de Desempe&ntilde;os de Preescolar</td>
				 </tr>
				  <tr>
				 	<td><input id="p19_8"type="checkbox"<?php if (strpos($row_configuracion['conf_valor'],"7") == true) {echo "checked='checked'";} ?> value="7" name="pla7"></td>
				 	<td id="p19_9">Plantilla Carga masiva para cargar el RUM (Registro &Uacute;nico de Matr&iacute;cula)</td>
				 </tr>
			</table>
</div>
</div>
</div>
</div>
</div>
<script>
function validar1999() {
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")
{
 document.getElementById("p19_1").disabled = false;
  document.getElementById("p19_2").disabled = false;
   document.getElementById("p19_3").disabled = false;
    document.getElementById("p19_4").disabled = false;
     document.getElementById("p19_5").disabled = false;
      document.getElementById("p19_6").disabled = false;
       document.getElementById("p19_7").disabled = false;
       // document.getElementById("p19_8").disabled = false;
         document.getElementById("p19_9").disabled = false;
}
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")
{
  document.getElementById("p19_1").disabled = true;
  document.getElementById("p19_2").disabled = true;
   document.getElementById("p19_3").disabled = true;
    document.getElementById("p19_4").disabled = true;
     document.getElementById("p19_5").disabled = true;
      document.getElementById("p19_6").disabled = true;
       document.getElementById("p19_7").disabled = true;
        //document.getElementById("p19_8").disabled = true;
         document.getElementById("p19_9").disabled = true;
}
}
addEvent('load', validar1999); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
<script type="text/javascript">
	function validar12494(){
		if(document.getElementById('p124_1').checked==true)
		{
        document.getElementById("p19_8").style.display = 'none';
                document.getElementById("p19_9").style.display = 'none';
		}
if(document.getElementById('p124_2').checked==true){
        document.getElementById("p19_8").style.display = 'inline';
                document.getElementById("p19_9").style.display = 'inline';
		}
	}
	addEvent('load', validar12494); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
<?php
break;

/*-----------------------------------------------------------------------------------------CASO 97---------------------------------------------*/

	case 97:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

			

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

/*-----------------------------------------------------------------------------------------CASO 110---------------------------------------------*/

case 110:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

/*-----------------------------------------------------------------------------------------CASO 102---------------------------------------------*/

case 117:

		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	
            $e1111= $valoresP43[5];
			
		?>

	

			 <table  width="90%">

				 <tr>

				 <td><b>Aplica</b>

				<select class="sele_mul" onclick="validar117()"name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $valoresP43[0]))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $valoresP43[0]))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				 </td>

				 <td style="text-align: center;">

				 

				  </td>

				 </tr>

</table>

				 		<div class="container_demohrvszv">

		<!-- Accordion begin -->

		<div class="accordion_example2wqzx">

			<!-- Section 1 -->

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">Si Aplica defina:</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

<center>

				 	<table style="text-align: left;" >

				 		<tr style="text-align:center;">

			
<!-- INICIO PHP MIGUEL Y EDICION DE CODIGO MIGUEL -->
<?php
mysql_select_db($database_sygescol, $sygescol);
$query_escala_nacional = "SELECT escala_nacional.esca_nac_max FROM escala_nacional";
$escala_nacional = mysql_query($query_escala_nacional, $sygescol) or die(mysql_error());
$row_escala_nacional = mysql_fetch_assoc($escala_nacional);
$query_escala_nacional_minima = "SELECT escala_nacional.esca_nac_min FROM escala_nacional WHERE escala_nacional.esca_nac_id = '4'";
$escala_nacional_minima = mysql_query($query_escala_nacional_minima, $sygescol) or die(mysql_error());
$row_escala_nacional_minima = mysql_fetch_assoc($escala_nacional_minima);
?>

<!-- FIN PHP MIGUEL -->

				 			<th>Desempe&ntilde;os</th>

				 		</tr>
				<tr><td><input id="p117"type="checkbox" onchange="abilitarCamposPromedio('p117', 'p1018')" name="cS_<?php echo $row_configuracion['conf_nombre'];?>"  <?php if ($valoresP43[1]=="S")  {echo "checked='checked'";} ?>  value="S"> Superior</td>
						<td class="izq"> Nota:<input  id="p1018" title="DEBE INSERTAR NUMEROS DECIMALES" maxlength="3" onkeyup="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>');insertar_nota_mac(this)" onchange="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>');insertar_nota_mac(this)" step="0.1" max="5.0" class="determinarcampo1177" onkeypress="return justNumbers(event);"style="width:15%;"  name="cSs_<?php echo $row_configuracion['conf_nombre'];?>" value="<?php echo $valoresP43[5]; ?>"  <?php if ($valoresP43[1]=="S")  {echo "";} else {echo"disabled='disabled'";} ?>></td>
				 		</tr>
				 		<tr><td><input id="p119"type="checkbox" onChange="abilitarCamposPromedio('p119', 'p120')" name="cA_<?php echo $row_configuracion['conf_nombre'];?>"  <?php if ($valoresP43[2]=="A")  {echo "checked='checked'";} ?>  value="A"> Alto</td>    
						<td class="izq"> Nota:<input  id="p120" title="DEBE INSERTAR NUMEROS DECIMALES" maxlength="3" onkeyup="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" onchange="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" step="0.1" max="5.0" class="determinarcampo1177"onkeypress="return justNumbers(event);"style="width:15%;" name="cAa_<?php echo $row_configuracion['conf_nombre'];?>" value="<?php echo $valoresP43[6]; ?>" <?php if ($valoresP43[2]=="A")  {echo "";} else {echo"disabled='disabled'";} ?>></td>
				 		</tr>
				 		<tr><td><input id="p121"type="checkbox" onChange="abilitarCamposPromedio('p121', 'p122')" name="cBs_<?php echo $row_configuracion['conf_nombre'];?>" <?php if ($valoresP43[3]=="Bs") {echo "checked='checked'";} ?>  value="Bs"> Basico</td> 
						<td class="izq"> Nota:<input id="p122" title="DEBE INSERTAR NUMEROS DECIMALES" maxlength="3" onkeyup="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" onchange="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" step="0.1" max="5.0" class="determinarcampo1177"onkeypress="return justNumbers(event);"style="width:15%;" name="cBsb_<?php echo $row_configuracion['conf_nombre'];?>" value="<?php echo $valoresP43[7]; ?>"
						<?php if ($valoresP43[3]=="Bs")  {echo "";} else {echo"disabled='disabled'";} ?>></td>
				 		</tr>
				 		<tr><td><input id="p123"type="checkbox" onChange="abilitarCamposPromedio('p123', 'p124')" name="cBj_<?php echo $row_configuracion['conf_nombre'];?>" <?php if ($valoresP43[4]=="Bj") {echo "checked='checked'";} ?>  value="Bj"> Bajo</td>
				 		<td class="izq"> Nota:<input id="p124" title="DEBE INSERTAR NUMEROS DECIMALES" maxlength="3" onkeyup="validaFloatMAC(this, '1.0','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" onchange="validaFloatMAC(this, '1','<?php echo $row_escala_nacional_minima["esca_nac_min"] ?>','<?php echo $row_escala_nacional["esca_nac_max"] ?>')" step="0.1" max="5.0" class="determinarcampo1177"onkeypress="return justNumbers(event);"style="width:15%;" name="cBjj_<?php echo $row_configuracion['conf_nombre'];?>" value="<?php echo $valoresP43[8]; ?>" <?php if ($valoresP43[4]=="cBj")  {echo "";} else {echo"disabled='disabled'";} ?> ></td>   </tr>


				 	</table>

				 	</center>
<style>
td.izq {
    width: 400px;
    padding-left: 100px;
}
</style>
<script>

function validaFloatMAC(campo, decimales)
{


var numero = campo.value;
	longitud = numero.length;
	
	nota_max = parseFloat(<?php echo $row_escala_nacional["esca_nac_max"];?>);
	nota_min = parseFloat(<?php echo $row_escala_nacional_minima['esca_nac_min'];?>);
	if (nota_min=="0") 
	{
	nota_min="0.1";
	}	
	//Validación de que sea un numero float
	if (!/^([1-9])*[.]?[1-9]*$/.test(numero) || parseFloat(numero) > parseFloat(nota_max) || numero < parseFloat(nota_min))
	{
		
		campo.value = numero.substring(0,longitud - 1);
		campo.focus();
	}
	//hay que guardarla en conf_sygescol
	//Validamos que no sobrepase la cantidad de decimales establecidos
	arreglo_numero = numero.split('.');
	if(arreglo_numero.length > 1 )
	{
		if(arreglo_numero[1].length > decimales)
		{
			campo.value = numero.substring(0,longitud - 1);
			campo.focus();
		}
	}
}
</script>
				 		 </div>

</div>

</div>

</div>

</div>
	<?php if($valoresP43[4]=="Bj"){ 

					$ckech='checked="checked"';

					$bloq='';

				}else{ 

					$ckech='';

					$bloq='disabled="disabled"';

				} ?> 

<!-- <?php if ($valoresP43[4]=="Bj") {echo "checked='checked'";} ?> -->
<script type="text/javascript" language="javascript">

			function abilitarCamposPromedio(campo1, campo2){	
				if($(campo1).checked==false){
					$desactiva= "";
					$(campo2).disabled=true;
					$(campo2).value='';
				} else {
					$(campo2).disabled=false;
				}
			}

		</script>

	

			<script type="text/javascript">

function validar117() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("p117").disabled = false;

  document.getElementById("p119").disabled = false;

   document.getElementById("p121").disabled = false;

    document.getElementById("p123").disabled = false;
}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

document.getElementById("p117").disabled = true; document.getElementById("p117").checked = false;
document.getElementById("p1018").disabled = true; document.getElementById("p1018").value = "";
  document.getElementById("p119").disabled = true; document.getElementById("p119").checked = false;
  document.getElementById("p120").disabled = true; document.getElementById("p120").value = "";
   document.getElementById("p121").disabled = true; document.getElementById("p121").checked = false;
  document.getElementById("p122").disabled = true; document.getElementById("p122").value = "";
    document.getElementById("p123").disabled = true; document.getElementById("p123").checked = false;
    document.getElementById("p124").disabled = true; document.getElementById("p124").value = "";


}

}

	addEvent('load', validar117); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

 

		

		<?php

		break;

/*-----------------------------------------------------------------------------------------CASO 117---------------------------------------------*/
case 102:
		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	
			$e1111= $valoresP43[5];	
		?>
			 <table  width="90%">
				 <tr>
				 <td><b>Aplica</b>
				<select class="sele_mul" onclick="validar102()" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
					<option value="S" <?php if (!(strcmp("S", $valoresP43[0]))) {echo "selected=\"selected\"";} ?>>Si</option>
					<option value="N" <?php if (!(strcmp("N", $valoresP43[0]))) {echo "selected=\"selected\"";} ?>>No</option>
				  </select>
				 </td>
				 <td style="text-align: center;">
				  </td>
				 </tr>
				 		<tr><td id="p102"> <a href="recontextualizar_texto1.php" target="_blank" style="color:#3399FF">Ir a la interfaz de asignacion</a></td>   </tr>
				 	</table>
				 	</center>
			<script>
function validar102(){
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")
{
 document.getElementById("p102").style.display = "";
}
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")
{
 document.getElementById("p102").style.display = "none";
}
}
	addEvent('load', validar102); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
		<?php
		break;

////////////////////////////////////////////////////////////////////////////////////////////camilo////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 235:
		$valoresP433 = explode("$",$row_configuracion['conf_valor']);	
			$ee1111= $valoresP433[5];	
		?>
			 <table  width="90%">
				 <tr>
				 <td><b>Aplica</b>
				<select class="sele_mul" onclick="validar169()" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
					<option value="S" <?php if (!(strcmp("S", $valoresP433[0]))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $valoresP433[0]))) {echo "selected=\"selected\"";} ?>>No</option>
				  </select>
				 </td>
				 <td style="text-align: center;">

				  </td>
				 </tr>
				 		<tr><td> Porcentaje:<input id="p169"type="text" maxlength="2" class="determinarcampo1177"onkeypress="return justNumbers(event);"style="width:10%;"  name="cBjj_<?php echo $row_configuracion['conf_nombre'];?>" <?php if ($valoresP433[5]=="Bjj")?>  value="<?php echo $ee1111; ?>"></td>   </tr>
				 	</table>
				 	</center>	
			<script>
function validar169(){
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")
{
 document.getElementById("p169").disabled = false;
}
if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")
{
 document.getElementById("p169").disabled = true;
}
}
	addEvent('load', validar169); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
		<?php
		break;
////////////////////////////////////////////////////////////////////////////////////////////camilo////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


case 240:
$array_parametro_240 = explode("$",$row_configuracion['conf_valor']);

$aplica_semana_240 = $array_parametro_240[0];

$checkbox_semana_240 = $array_parametro_240[1];

?>



Aplica
 <select onclick="aplica_semana_numero_f()" id="aplica_semana_numero_id" name="aplica_semana_numero">
<option value="S" <?php if (!(strcmp("S", $array_parametro_240[0]))) {echo "selected=\"selected\"";} ?>>Si</option>
<option value="N" <?php if (!(strcmp("N", $array_parametro_240[0]))) {echo "selected=\"selected\"";} ?>>No</option>
 </select>

 <table>
<tr><td>
<img id="image_semana_1" src="imagenes_param_240/Numero/1.PNG"  width=40;></td>
<td>
<img id="image_semana_2" src="imagenes_param_240/Numero/2.PNG"  width=40;></td>
<td>
<img id="image_semana_3" src="imagenes_param_240/Numero/3.PNG"  width=40;></td>
<td>
<img id="image_semana_4" src="imagenes_param_240/Numero/4.PNG"  width=40;></td>
<td>
<img id="image_semana_5" src="imagenes_param_240/Numero/5.PNG"  width=40;></td>
</tr>
<tr>
<td><center>
<input type="radio" id="radio_imagen_240_1" <?php if ($checkbox_semana_240 == "1") {echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td>
<td><center>
<input type="radio" id="radio_imagen_240_2" <?php if ($checkbox_semana_240 == "2") {echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td>
<td><center>
<input type="radio" id="radio_imagen_240_3" <?php if ($checkbox_semana_240 == "3")  {echo "checked=checked";} ?>  name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio"  id="radio_imagen_240_4" <?php if ($checkbox_semana_240 == "4") {echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio"  id="radio_imagen_240_5" <?php if ($checkbox_semana_240 == "5") {echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td>
</tr>
<tr>
<td>
<img id="image_semana_6" src="imagenes_param_240/Numero/6.PNG"  width=40;></td>
<td>
<img id="image_semana_7" src="imagenes_param_240/Numero/7.PNG"  width=40;></td>
<td>
<img id="image_semana_8" src="imagenes_param_240/Numero/8.PNG"  width=40;></td>
<td>
<img id="image_semana_9" src="imagenes_param_240/Numero/9.png"  width=40;></td>
<td>
<img id="image_semana_10" src="imagenes_param_240/Numero/10.png"  width=40;></td></tr>
<tr>
<td><center>
<input type="radio" id="radio_imagen_240_6" <?php if ($checkbox_semana_240 == "6") {echo "checked=checked";} ?>  name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio" id="radio_imagen_240_7" <?php if ($checkbox_semana_240 == "7") {echo "checked=checked";} ?>  name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio" id="radio_imagen_240_8" <?php if ($checkbox_semana_240 == "8") {echo "checked=checked";} ?>  name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio"  id="radio_imagen_240_9" <?php if ($checkbox_semana_240 == "9") {echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td><td><center>
<input type="radio"  id="radio_imagen_240_10" <?php if ($checkbox_semana_240 == "10"){echo "checked=checked";} ?> name="radio_semana_numero" value="" onclick="cambiar_imagen_param_semana()"></center></td></tr>
</table>



<script>



function aplica_semana_numero_f(){

if(document.getElementById('aplica_semana_numero_id').value=="N"){

document.getElementById("radio_imagen_240_1").checked = false;
document.getElementById("radio_imagen_240_2").checked = false;
document.getElementById("radio_imagen_240_3").checked = false;
document.getElementById("radio_imagen_240_4").checked = false;
document.getElementById("radio_imagen_240_5").checked = false;
document.getElementById("radio_imagen_240_6").checked = false;
document.getElementById("radio_imagen_240_7").checked = false;
document.getElementById("radio_imagen_240_8").checked = false;
document.getElementById("radio_imagen_240_9").checked = false;
document.getElementById("radio_imagen_240_10").checked = false;

document.getElementById("radio_imagen_240_1").disabled = true;
document.getElementById("radio_imagen_240_2").disabled = true;
document.getElementById("radio_imagen_240_3").disabled = true;
document.getElementById("radio_imagen_240_4").disabled = true;
document.getElementById("radio_imagen_240_5").disabled = true;
document.getElementById("radio_imagen_240_6").disabled = true;
document.getElementById("radio_imagen_240_7").disabled = true;
document.getElementById("radio_imagen_240_8").disabled = true;
document.getElementById("radio_imagen_240_9").disabled = true;
document.getElementById("radio_imagen_240_10").disabled = true;

document.getElementById("radio_imagen_240_1").value = "";
document.getElementById("radio_imagen_240_2").value = "";
document.getElementById("radio_imagen_240_3").value = "";
document.getElementById("radio_imagen_240_4").value = "";
document.getElementById("radio_imagen_240_5").value = "";
document.getElementById("radio_imagen_240_6").value = "";
document.getElementById("radio_imagen_240_7").value = "";
document.getElementById("radio_imagen_240_8").value = "";
document.getElementById("radio_imagen_240_9").value = "";
document.getElementById("radio_imagen_240_10").value = "";


document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}

if(document.getElementById('aplica_semana_numero_id').value=="S"){

document.getElementById("image_semana_1").src = "imagenes_param_240/Numero/1.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/Numero/2.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/Numero/3.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/Numero/4.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/Numero/5.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/Numero/6.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/Numero/7.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/Numero/8.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/Numero/9.png";
document.getElementById("image_semana_10").src = "imagenes_param_240/Numero/10.png";

if(document.getElementById('radio_imagen_240_1').checked==true){

document.getElementById("image_semana_1").src = "imagenes_param_240/Numerox/1x.PNG";

document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}

if(document.getElementById('radio_imagen_240_2').checked==true){

document.getElementById("image_semana_2").src = "imagenes_param_240/Numerox/2x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_3').checked==true){

document.getElementById("image_semana_3").src = "imagenes_param_240/Numerox/3x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_4').checked==true){

document.getElementById("image_semana_4").src = "imagenes_param_240/Numerox/4x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_5').checked==true){

document.getElementById("image_semana_5").src = "imagenes_param_240/Numerox/5x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_6').checked==true){

document.getElementById("image_semana_6").src = "imagenes_param_240/Numerox/6x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_7').checked==true){

document.getElementById("image_semana_7").src = "imagenes_param_240/Numerox/7x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_8').checked==true){

document.getElementById("image_semana_8").src = "imagenes_param_240/Numerox/8x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_9').checked==true){

document.getElementById("image_semana_9").src = "imagenes_param_240/Numerox/9x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_10').checked==true){

document.getElementById("image_semana_10").src = "imagenes_param_240/Numerox/10x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";

}

document.getElementById("radio_imagen_240_1").value = "1";
document.getElementById("radio_imagen_240_2").value = "2";
document.getElementById("radio_imagen_240_3").value = "3";
document.getElementById("radio_imagen_240_4").value = "4";
document.getElementById("radio_imagen_240_5").value = "5";
document.getElementById("radio_imagen_240_6").value = "6";
document.getElementById("radio_imagen_240_7").value = "7";
document.getElementById("radio_imagen_240_8").value = "8";
document.getElementById("radio_imagen_240_9").value = "9";
document.getElementById("radio_imagen_240_10").value = "10";


document.getElementById("radio_imagen_240_1").disabled = false;
document.getElementById("radio_imagen_240_2").disabled = false;
document.getElementById("radio_imagen_240_3").disabled = false;
document.getElementById("radio_imagen_240_4").disabled = false;
document.getElementById("radio_imagen_240_5").disabled = false;
document.getElementById("radio_imagen_240_6").disabled = false;
document.getElementById("radio_imagen_240_7").disabled = false;
document.getElementById("radio_imagen_240_8").disabled = false;
document.getElementById("radio_imagen_240_9").disabled = false;
document.getElementById("radio_imagen_240_10").disabled = false;
}




}
function  cambiar_imagen_param_semana(){
if(document.getElementById('radio_imagen_240_1').checked==true){

document.getElementById("image_semana_1").src = "imagenes_param_240/Numerox/1x.PNG";

document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}

if(document.getElementById('radio_imagen_240_2').checked==true){

document.getElementById("image_semana_2").src = "imagenes_param_240/Numerox/2x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_3').checked==true){

document.getElementById("image_semana_3").src = "imagenes_param_240/Numerox/3x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_4').checked==true){

document.getElementById("image_semana_4").src = "imagenes_param_240/Numerox/4x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_5').checked==true){

document.getElementById("image_semana_5").src = "imagenes_param_240/Numerox/5x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_6').checked==true){

document.getElementById("image_semana_6").src = "imagenes_param_240/Numerox/6x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_7').checked==true){

document.getElementById("image_semana_7").src = "imagenes_param_240/Numerox/7x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_8').checked==true){

document.getElementById("image_semana_8").src = "imagenes_param_240/Numerox/8x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_9').checked==true){

document.getElementById("image_semana_9").src = "imagenes_param_240/Numerox/9x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_10").src = "imagenes_param_240/blanco.PNG";

}


if(document.getElementById('radio_imagen_240_10').checked==true){

document.getElementById("image_semana_10").src = "imagenes_param_240/Numerox/10x.PNG";

document.getElementById("image_semana_1").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_3").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_4").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_5").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_6").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_7").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_8").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_9").src = "imagenes_param_240/blanco.PNG";
document.getElementById("image_semana_2").src = "imagenes_param_240/blanco.PNG";

}}

 addEvent('load', cambiar_imagen_param_semana);// activamos la funcion para que cambie las fotos
  addEvent('load', aplica_semana_numero_f);// activamos la funcion que activa o desactiva los radios
	</script>

<?php

break;




			case 154:

		$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$reasignacionRepro_ = $array_parametro[1];

					$reasignacionRepro2_ = $array_parametro[2];

					$reasignacionRepro4_ = $array_parametro[3];

					$reasignacionRepro5_ = $array_parametro[4];

					$reasignacionRepro6_ = $array_parametro[5];
					$reasignacionRepro7_ = $array_parametro[6];

		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	

			$e1111= $valoresP43[5];	

	$parametro = $array_parametro[0];
?>

		<b>Aplica</b>

				 <select class="sele_mul" onclick="validar154()"name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" >
<?php

mysql_select_db($database_sygescol, $sygescol);

$query_planillasemestral = "SELECT conf_sygescol.conf_valor FROM conf_sygescol WHERE conf_sygescol.conf_nombre LIKE 'planilla_reconsideracionsemestral'";

$planillasemestral = mysql_query($query_planillasemestral, $sygescol) or die(mysql_error());

$row_reconsideracionsemestral = mysql_fetch_assoc($planillasemestral);

$totalRows_semestral = mysql_num_rows($planillasemestral);

if ($row_reconsideracionsemestral['conf_valor'] == 'N') {
	$prueba2='No';
}
else 
{
	$prueba2='Si';
}

?>

					<option value="<?php echo $row_reconsideracionsemestral['conf_valor']; ?>" ><?php echo $prueba2 ?></option>

				 </select>

		

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Si aplica defina:</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

						

		<table>

				<tr>

			 		<td> <input id="p19_111" type="radio" onclick="validar1544()"<?php if (!(strcmp("A", $array_parametro[1]))) {echo "checked=checked";} ?> value="A" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td>Habilitar la planilla, Solo para casos de reprobaci&oacute;n de la asignatura Desempe&ntilde;o Bajo (CONTROLADO)</td> 

				</tr>

 		       <tr>

			 		<td></td><td>Valor m&aacute;ximo permitido en la planilla<input id="p19_222" type="text" style="width: 10%;"onkeypress="return justNumbers(event);"  value="<?php echo $array_parametro[2]; ?>" name="reasignacionRepro3_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> 
			

				</tr>

				<tr>

			 		<td> <input id="p19_333" type="radio" onclick="validar15444()"<?php if (!(strcmp("B", $array_parametro[1]))) {echo "checked=checked";} ?> value="B" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td> Con <b style="color:red;">Habilitar la planilla, para los desempe&ntilde;os. (CONTROLADO)</td> 

				</tr>

 		       

				 </tr>

				<tr><td><input id="p19_444"type="checkbox" name="cS_<?php echo $row_configuracion['conf_nombre'];?>"  <?php if ($reasignacionRepro4_=="S")  {echo "checked='checked'";} ?>  value="S"></td> <td> Superior</td></tr>

				 		<tr><td><input id="p19_555"type="checkbox"  name="cA_<?php echo $row_configuracion['conf_nombre'];?>"  <?php if ($reasignacionRepro5_=="A")  {echo "checked='checked'";} ?>  value="A"></td> <td> Alto</td>    </tr>

				 		<tr><td><input id="p19_666"type="checkbox" name="cBs_<?php echo $row_configuracion['conf_nombre'];?>" <?php if ($reasignacionRepro6_=="Bs") {echo "checked='checked'";} ?>  value="Bs"></td> <td> Basico</td> </tr>

				 		<tr><td><input id="p19_777"type="checkbox" onclick="javascript:determinarcampo117check();"name="cBj_<?php echo $row_configuracion['conf_nombre'];?>" <?php if ($reasignacionRepro7_=="Bj") {echo "checked='checked'";} ?>  value="Bj"></td> <td> Bajo</td>   </tr>
				 	

				

				

			</table>

</div>

</div>

</div>

</div>

</div>

<script>

function validar154() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("p19_111").disabled = false;

  document.getElementById("p19_222").disabled = false;

   document.getElementById("p19_333").disabled = false;

    document.getElementById("p19_444").disabled = false;

     document.getElementById("p19_555").disabled = false;

      document.getElementById("p19_666").disabled = false;

       document.getElementById("p19_777").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

 document.getElementById("p19_111").disabled = true;

  document.getElementById("p19_222").disabled = true;

   document.getElementById("p19_333").disabled = true;

    document.getElementById("p19_444").disabled = true;

     document.getElementById("p19_555").disabled = true;

      document.getElementById("p19_666").disabled = true;

       document.getElementById("p19_777").disabled = true;

}

}

      

	addEvent('load', validar154); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

</script>

<script type="text/javascript">
	

function validar15444() {
 { 

 	document.getElementById("p19_222").disabled = true;

 	document.getElementById("p19_444").disabled = false;

 	document.getElementById("p19_555").disabled = false;

 	document.getElementById("p19_666").disabled = false;
 	 	document.getElementById("p19_777").disabled = false;

 }

  
}

function validar1544() {
 { 

 	document.getElementById("p19_222").disabled = false;

 	document.getElementById("p19_444").disabled = true;

 	document.getElementById("p19_555").disabled = true;

 	document.getElementById("p19_666").disabled = true;

 	 	document.getElementById("p19_777").disabled = true;
 }

  
}
</script>

				

<?php

break;

 case 157:
		$array_parametro = explode("$",$row_configuracion['conf_valor']);
		//Consultamos el tope maximo de los estudiantes (Zona Urbana)
		$proyecion_cupos_ind_0 = $array_parametro[0];
		$proyecion_cupos_ind_1 = $array_parametro[1];
		$proyecion_cupos_ind_2 = $array_parametro[2];
		$proyecion_cupos_ind_3 = $array_parametro[3];
		$proyecion_cupos_ind_4 = $array_parametro[4];
		$proyecion_cupos_ind_5 = $array_parametro[5];
		$proyecion_cupos_ind_6 = $array_parametro[6];
		$proyecion_cupos_ind_7 = $array_parametro[7];
		$proyecion_cupos_ind_8 = $array_parametro[8];
		$proyecion_cupos_ind_9 = $array_parametro[9];
        $proyecion_cupos_ind_10 = $array_parametro[10];
		$proyecion_cupos_ind_11 = $array_parametro[11];
        $proyecion_cupos_ind_12 = $array_parametro[12];
        $proyecion_cupos_ind_13 = $array_parametro[13];
        $proyecion_cupos_ind_14 = $array_parametro[14];
        $proyecion_cupos_ind_15 = $array_parametro[15];
        $proyecion_cupos_ind_16 = $array_parametro[16];
        $proyecion_cupos_ind_17 = $array_parametro[17];
//Consultamos las dimensiones o indicadores de logros predeterminados para cada colegio
$sele_accciones_eval = "SELECT * FROM config_planilla_oblig ";
$sql_acciones = mysql_query($sele_accciones_eval,$link);
?>
<div class="container_demohrvszv">
    <div class="accordion_example2wqzx">
     <div class="accordion_inwerds">
        <div class="acc_headerfgd"><strong>Orden Procesos de Evaluacion</strong> </div>
        <div class="acc_contentsaponk">
          <div class="grevdaiolxx">
<?php 
$conta=0;
while($row_proceso_eval2113 = mysql_fetch_array($sql_acciones))	 {
$conta++;

if ($row_proceso_eval2113['conf_obl_equ'] == '1') {
?>
<table class='formulario' style='width: 100%; float: left; border-color: #0079B2;'>
<th colspan='2' id="dimensioncss" class='formulario'><center>Dimension</center></th>
<tr>
<td style='text-align:center; font-family: sans-serif;'> 
<?php
echo $row_proceso_eval2113['conf_obl_texto']."<br>";  
?>
<style>
	
#dimensioncss{
	    background-color: #0079B2;
    color: #FFFFFF;
    font-weight: bold;
    height: 25px;
    vertical-align: middle;
   
}
#accionescss{
	    background-color: #4BC2FB;
    color: #FFFFFF;
    font-weight: bold;
    height: 25px;
    vertical-align: middle;
}

</style>
</td>
<td style='text-align:center;'><center><input type="text" onkeypress="return justNumbers(event);" name="planilla_prom_ant1_ind_<?php echo $conta; ?>" value="<?php echo $proyecion_cupos_ind_.$array_parametro[$conta]; ?>" style="border-radius: 10px; width: 18%;float:right;" /></center></td>

</tr></table>
<?php } ?>
	
<?php
$sele_proceso_eval = "SELECT * FROM config_planilla_oblig where conf_obl_cual = '".$row_proceso_eval2113['conf_obl_id']."'";
$sql_proceso_eval = mysql_query($sele_proceso_eval,$link);
	while($row_proceso_eval = mysql_fetch_array($sql_proceso_eval))	 {
$conta++;
 ?>
<?php 
//echo $row_proceso_eval2113['conf_obl_texto'].'= ='.$row_proceso_eval['conf_obl_texto'];
if ($row_proceso_eval2113['conf_obl_id'] == $row_proceso_eval['conf_obl_cual']) {
	?>
	<table class='formulario' style='width: 100%; float: left;border-color:  #4BC2FB;'>
<th colspan='2'  id="accionescss" class='formulario'><center>Accion</center></th>
<tr>
<td style='text-align:center; font-family: sans-serif; 	'> 
<?php
echo $row_proceso_eval['conf_obl_texto']."<br>";
?>
</td>
<td style='text-align:center;'><center><input type="text" onkeypress="return justNumbers(event);" name="planilla_prom_ant1_ind_<?php echo $conta; ?>" value="<?php echo $proyecion_cupos_ind_.$array_parametro[$conta]; ?>" style="border-radius: 10px; width: 18%;float:right;" /></center></td>
</tr>
</table>
<?php
}
 ?>

<?php 
}
?>
<?php
}
 ?>

</div></div></div></div></div>
<?php
break;

} 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!-- ------------------------------------------ PARAMETROS HORARIOS -------------------------------------- -->

<?php

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

    mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (70,122,223)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

}

?>

<?php 

include ("conb.php");$registrose=mysqli_query($conexion,"select * from conf_sygescol_adic where id=5")or die("Problemas en la Consulta".mysqli_error());while ($rege=mysqli_fetch_array($registrose)){$coloracorde=$rege['valor'];}

?>

<div class="container_demohrvszv_caja_1">
<div class="accordion_example2wqzx_caja_2">
			<div class="accordion_inwerds_caja_3">
				<div class="acc_headerfgd_caja_titulo" id="parametros_horarios" style="background-color: <?php echo $coloracorde ?>"><center><strong>PAR&Aacute;METROS PARA HORARIOS</strong></center><br /><center><input type="radio" value="rojoe" name="colorese">Si&nbsp;&nbsp;<input type="radio" value="naranjae" name="colorese">No</div></center>
				<div class="acc_contentsaponk_caja_4">
<div class="grevdaiolxx_caja_5">

<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do

	{

		$consecutivo++;

	?>
	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{
			case 70: //tot_sem_clase

		$valoresP70 = explode("$", $row_configuracion['conf_valor']);

		?>	

		<!-- ---------------------------------------------------------- PARAMETRO 7 ---------------------------------------------------------------------------- -->

        <div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

  

     <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem </div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

<!--el contenido va aca-->

		<table>

		<tr><td><strong>Tradicional: </strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="tra_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[0]; ?>" /></td></tr>

		<tr><td><strong>Ciclo Primaria:</strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="cicP_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[1]; ?>" /></td></tr>

		<tr><td><strong>Ciclo Basica:</strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="cicB_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[2]; ?>" /></td></tr>

		<tr><td><strong>Ciclo Media:</strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="cicM_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[3]; ?>" /></td></tr>

		<tr><td><strong>Grupos Juveniles: </strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="gru_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[4]; ?>" /></td></tr>

		<tr><td><strong>N.E.E.: </strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="nee_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[5]; ?>" /></td></tr>

		<tr><td><strong>Aceleraci&oacute;n A.: </strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="ace_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[6]; ?>" /></td></tr>

		<tr><td><strong>P.F.C.: </strong></td><td><input style="border-radius: 10px;" onkeypress="return justNumbers(event);"name="pfc_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" type="text" size="2" value="<?php echo $valoresP70[7]; ?>" /></td></tr>

		</table>	

</div>

</div>

</div>

</div>

</div>

		<?php

		break;

      case 223:

        $array_parametro = explode("$",$row_configuracion['conf_valor']);
              $array_parametro = explode("$",$row_configuracion['conf_valor']);
        $aplica_promoanti_121 = $array_parametro[0];
        $nota_minima_121 = $array_parametro[1];
        $aplica_nota_comportamiento_121 = $array_parametro[2];
        $nota_comportamiento_121 = $array_parametro[3];
        $aplica_asistencia_121 = $array_parametro[4];
        $porcentaje_asistencia_121 = $array_parametro[5];
        $no_negativos_121 = $array_parametro[6];
        $aplica_periodo_121 = $array_parametro[7];
        $fecha_inicio_121 = $array_parametro[8];
        $fecha_final_121 = $array_parametro[9];
        $estado = $array_parametro[10];
        $paraQueAreas = $array_parametro[12];
        $areasReprobadas=$array_parametro[13];
        $todasAreas=$array_parametro[14];
        $demasAreas=$array_parametro[15];
        $areas_R=$array_parametro[16];
        $todas_A=$array_parametro[17];
        $demas_A=$array_parametro[18];
          $aplica_promoanti_1211 = $array_parametro[20];
          $no_negativos_1211 = $array_parametro[21];
          $aplica_asistencia_1211 = $array_parametro[22];
              $fecha_inicio_121_2 = $array_parametro[25];
        $fecha_final_121_2 = $array_parametro[26];
        $fecha_inicio_121_2_1 = $array_parametro[27];
        $fecha_final_121_2_1 = $array_parametro[28];
        $parametro = $row_configuracion['conf_valor'];

        //documentar//
    /*    
print_r($array_parametro);
  //documentar//
*/
     ?>

           <script>
function validar45223() {
if(document.getElementById('criterio223').value=="S"){
document.getElementById("style1").style.display = "";
document.getElementById("style2").style.display = "";
}
if(document.getElementById('criterio223').value=="N")
{
document.getElementById("style1").style.display = "none";
document.getElementById("style2").style.display = "none";
}
}
  addEvent('load', validar45223); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
<link href="js/jquery/mobiscroll-2.1-beta.custom.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery/mobiscroll-2.1-beta.custom.min.js" type="text/javascript"></script>
<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_cita_1').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_cita_2').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_cita_3').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<!----------------------------------------------   2  ---------------------------------------------->

<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_citaa_1').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_citaa_2').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<script language="javascript">
	var RELO = jQuery.noConflict();
	RELO(document).ready(function() {
		RELO('#hora_citaa_3').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<!----------------------------------------------   3  ---------------------------------------------->
<script language="javascript">
	var RELOOO = jQuery.noConflict();
	RELOOO(document).ready(function() {
		RELOOO('#hora_citaaa_1').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>

<script language="javascript">
	var RELOOO = jQuery.noConflict();
	RELOOO(document).ready(function() {
		RELOOO('#hora_citaaa_2').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>

<script language="javascript">
	var RELOOO = jQuery.noConflict();
	RELOOO(document).ready(function() {
		RELOOO('#hora_citaaa_3').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
<!----------------------------------------------   4  ---------------------------------------------->

<script language="javascript">
	var RELOOOO = jQuery.noConflict();
	RELOOOO(document).ready(function() {
		RELOOOO('#hora_citaaaa_1').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>

<script language="javascript">
	var RELOOOO = jQuery.noConflict();
	RELOOOO(document).ready(function() {
		RELOOOO('#hora_citaaaa_2').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>

<script language="javascript">
	var RELOOOO = jQuery.noConflict();
	RELOOOO(document).ready(function() {
		RELOOOO('#hora_citaaaa_3').scroller({
			preset: 'time',
			theme: 'android-ics',
			display: 'modal',
			mode: 'clickpick'
		});
	});
</script>
     <table  style="border:0px solid #666666; margin-top:5px;">
     	<tr>
                    <td colspan="2">
                     <label>
		  <select class="sele_mul" name="criterio_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio223" onclick="validar45223()">
			<option value="S" <?php if (!(strcmp("S", $aplica_promoanti_121['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $aplica_promoanti_121['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>
		  </select>
		</label> </tr>
     </table>
<?php
$query_sedes12 = "SELECT * 
FROM v_grados
INNER JOIN jraa ON ( v_grados.jornada_id = jraa.i ) 
WHERE gao_codigo =  'TR'
order by v_grados.jornada_id";
$sedes12 = mysql_query($query_sedes12, $link) or die(mysql_error());
 $rows12 = mysql_num_rows($sedes12);

 $query_sedes121 = "SELECT * FROM v_grados WHERE gao_codigo in (01,02,03,04,05)
group by jornada_codigo";
$sedes121 = mysql_query($query_sedes121, $link) or die(mysql_error());
 $rows121 = mysql_num_rows($sedes121);

?>





<div id="style1">
      <div class="container_demohrvszv">
    <div class="accordion_example2wqzx">
      <div class="accordion_inwerds">
        <div class="acc_headerfgd"><strong>PREESCOLAR</strong></div>
        <div class="acc_contentsaponk">
          <div class="grevdaiolxx">
        <table  width="90%" style="border:1px solid #666666; margin-top:5px;">
<?php 
$cp1 = 0;
$nmid = 0;

$nmid1 = 2;
$nmid11 = 4;
while($rowParametro1 = mysql_fetch_array($sedes12)){
	$nmid++;
 $cp1++;
$nmid1++;
 $nmid11++;
 ?>
 <tr>
 	<td>
 		<strong><?php echo 'Jornada '.$rowParametro1['jornada_nombre']; ?></strong>
 	</td>
 </tr>
<tr>
<td><tr>

            <td><input  id="radiop_11_<?php echo $cp1?>" name="areas_R_<?php echo $cp1?>"  type="radio" value="1" <?php if  ($array_parametro[$nmid]=='1') {echo "checked='checked'";} ?> >Atendido por docentes</td>
          </tr>

          <tr>
          <td>&nbsp;</td>
          </tr>
             <tr>

            <td><input  id="radiop_22_<?php echo $cp1?>" name="areas_R_<?php echo $cp1?>"  type="radio" value="3" <?php if ($array_parametro[$nmid]=='3')
            {echo "checked='checked'";} ?> >Atendido por Coordinador</td>
          </tr>
  <tr>
                     <td>
            <table >
              <tr style="text-align: center;" class="fila1">
                <td  colspan="2">Hora de inicio</td>
                <td  colspan="2">Hora de terminaci&oacute;n</td>
              </tr>
              <tr>
<td> <input  class="p2 form-control ac_input"  type="time"  name="hora_cita_<?php echo $cp1?>" id="hora_cita_<?php echo $cp1?>" placeholder="HORA DE LA CITACI&Oacute;N" value="<?php echo $array_parametro[$nmid1]; ?>" /></td>
<td ></td>
<td > <input  class="p2 form-control ac_input"  type="time"  name="hora_citaa_<?php echo $cp1?>" id="hora_citaa_<?php echo $cp1?>" placeholder="HORA DE LA CITACI&Oacute;N" value="<?php echo $array_parametro[$nmid11]; ?>"/></td>
<td></td>
              </tr>
  </table>
                      </td>
                  </tr>
                  <?php } ?>
         </table> </div></div></div></div></div></div>
         <br /><br /><br />
         <div id="style2">
        <div class="container_demohrvszv">
    <div class="accordion_example2wqzx">
      <div class="accordion_inwerds">
        <div class="acc_headerfgd"><strong>B&Aacute;SICA PRIMARIA</strong></div>
        <div class="acc_contentsaponk">
          <div class="grevdaiolxx">
        <table  width="90%" style="border:1px solid #666666; margin-top:5px;">
<?php 
$cp11 = 0;
$nmid1 = 6;

$nmid11 = 8;
$nmid111 = 10;
while($rowParametro11 = mysql_fetch_array($sedes121)){
	$nmid1++;
 $cp11++;
$nmid11++;
 $nmid111++;

 ?>
  <tr>
 	<td>
 		<strong><?php echo 'Jornada '.$rowParametro11['jornada_nombre']; ?></strong>
 	</td>
 </tr>
<tr>
<td><tr>
            <td><input  id="radiop_112_<?php echo $cp11?>" name="areas_B_<?php echo $cp11?>"  type="radio" value="1" <?php if  ($array_parametro[$nmid1]=='1') {echo "checked='checked'";} ?> >Atendido por docentes</td>
          </tr>

          <tr>
          <td>&nbsp;</td>
          </tr>
             <tr>

            <td><input  id="radiop_222_<?php echo $cp11?>" name="areas_B_<?php echo $cp11?>"  type="radio" value="3" <?php if  ($array_parametro[$nmid1]=='3') {echo "checked='checked'";} ?> >Atendido por Coordinador</td>
          </tr>
  <tr>
                     <td>
            <table >
              <tr style="text-align: center;" class="fila1">
                <td  colspan="2">Hora de inicio</td>
                <td  colspan="2">Hora de terminaci&oacute;n</td>
              </tr>
              <tr>
<td> <input  class="p2 form-control ac_input"  type="time"  name="hora_citaaa_<?php echo $cp11?>" id="hora_citaaa_<?php echo $cp11?>" placeholder="HORA DE LA CITACI&Oacute;N"value="<?php echo $array_parametro[$nmid11]; ?>"/></td>
								<td ></td>
							  	<td>  <input  class="p2 form-control ac_input"  type="time"  name="hora_citaaaa_<?php echo $cp11?>" id="hora_citaaaa_<?php echo $cp11?>" placeholder="HORA DE LA CITACI&Oacute;N" value="<?php echo $array_parametro[$nmid111]; ?>"/></td>
							  	<td></td>
              </tr>
  </table>
                      </td>
                  </tr>
                  <?php } ?>
         </table> </div></div></div></div></div></div>

    <?php
		break;
			case 122:

			$estado = '';

			if(strpos($row_configuracion['conf_valor'],"$")>0)

			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);

				$horaClases = $array_parametro[0];

				$jornadaCompleta = $array_parametro[1];

	

		

			} //forma_ing_fallas

		?>

		<p><label><b>Horas y Clases<b></label></p>

		<label>

		  <select style="max-width: 400px;" class="sele_mul" name="horaClases" id="horaClases">
	<option value="0" <?php if (!(strcmp("0", $horaClases))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

			<option value="1" <?php if (!(strcmp("1", $horaClases))) {echo "selected=\"selected\"";} ?>>Se corre el d&iacute;a y sus asignaturas</option>

			<option value="2" <?php if (!(strcmp("2", $horaClases))) {echo "selected=\"selected\"";} ?>>El d&iacute;a siguiente conserva su horario de clases normal</option>

			<option value="3" <?php if (!(strcmp("3", $horaClases))) {echo "selected=\"selected\"";} ?>>El d&iacute;a y sus asignaturas rotaran indefinidamente, hasta terminar el periodo acad&eacute;mico</option>

		  </select>

		</label>

			<p><label><b>Jornada Completa</b></label></p>

			<label>

		  <select style="max-width: 400px;" class="sele_mul" name="jornadaCompleta" id="jornadaCompleta">
	<option value="0" <?php if (!(strcmp("0", $horaClases))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

			<option value="4" <?php if (!(strcmp("4", $jornadaCompleta))) {echo "selected=\"selected\"";} ?>>Se corre el d&iacute;a y sus asignaturas</option>

			<option value="5" <?php if (!(strcmp("5", $jornadaCompleta))) {echo "selected=\"selected\"";} ?>>El d&iacute;a siguiente conserva su horario de clases normal</option>

			<option value="6" <?php if (!(strcmp("6", $jornadaCompleta))) {echo "selected=\"selected\"";} ?>>El d&iacute;a y sus asignaturas rotaran indefinidamente, hasta terminar el periodo acad&eacute;mico</option>

		  </select>

		</label>

		<?php

		break;

  
		}// este es el fin 
?>
	</td>
</tr>
<?php
}while($row_configuracion = mysql_fetch_assoc($configuracion));
?>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
// esta es la tabla 2
if($totalRows_configuracion)
{
	mysql_data_seek($configuracion,0);
mysql_select_db($database_sygescol, $sygescol);
	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo
								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id
							WHERE conf_sygescol.conf_estado = 0
								AND conf_sygescol.conf_id IN (108,112,113,116,155,121,129,120,135,150)  ORDER BY encabezado_parametros.id_orden ";
	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());
	$row_configuracion = mysql_fetch_assoc($configuracion);
// aca inicia la otra tabla
}?>
<?php 
include ("conb.php");$registrosf=mysqli_query($conexion,"select * from conf_sygescol_adic where id=6")or die("Problemas en la Consulta".mysqli_error());while ($regf=mysqli_fetch_array($registrosf)){$coloracordf=$regf['valor'];}
?>
<div class="container_demohrvszv_caja_1">
		<div class="accordion_example2wqzx_caja_2">
						<div class="accordion_inwerds_caja_3">
				<div class="acc_headerfgd_caja_titulo" id="parametros_promocion_estudiantes" style="background-color: <?php echo $coloracordf ?>"><center><strong>PAR&Aacute;METROS PARA  CASOS DE PROMOCI&Oacute;N DE ESTUDIANTES</strong></center><br /><center><input type="radio" value="rojof" name="coloresf">Si&nbsp;&nbsp;<input type="radio" value="naranjaf" name="coloresf">No</div></center>
				<div class="acc_contentsaponk_caja_4">
					<div class="grevdaiolxx_caja_5">
					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">
<tr>
	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>
	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>
	<th class="formulario" >Tipo de Par&aacute;metro</th>
    <th class="formulario" >Detalle del Par&aacute;metro</th>
	<th class="formulario">Selecci&oacute;n</th>
	</tr>
	<?php
	do
	{
		$consecutivo++;
	?>
	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>
	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>
<td valign="top"><strong>
<div class="container_demohrvszv_caja_tipo_param">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx_caja_tipo_param">
<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>
</div></div></div></div></div>
</strong>
</td>
      <td valign="top" width="80%">
     <div class="container_demohrvszv" >	  
		<div class="accordion_example2wqzx">			 
			<div class="accordion_inwerds">
				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">
      <?php echo $row_configuracion['conf_descri']; ?>
      </div>
					</div>
				</div>
			</div>
		</div>
</div>
 </td>
	<td align="center">
	<?php
	switch($row_configuracion['conf_id'])
	{
		case 108:

		$valoresP34 = explode("$",$row_configuracion['conf_valor']);		

				$parametro108 = $array_parametro108[0];

				$areasObligatorias108 = $array_parametro108[1];

				$areasTecnicas108 = $array_parametro108[2];

		?>

		<!-- ---------------------------------------------------------------- PRIMERA TABLA -------------------------------------------------------------------- -->

   

<div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">
     

      <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem 1</div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

     <b>Aplica</b>  

  <select class="sele_mul" onclick="validar32()"name="7_<?php echo $row_configuracion['conf_nombre']; ?>" id="case451081">

            <option value="S" <?php if (!(strcmp("S",  $valoresP34[6]))) {echo "selected=\"selected\"";} ?>>Si</option>

            <option value="N" <?php if (!(strcmp("N",  $valoresP34[6]))) {echo "selected=\"selected\"";} ?>>No</option>

            </select><br><br><br>

<p style="text-align: left;margin: 0px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;"><b>1.)</b> Un estudiante que <b style="color: red;" > DESPUES DEL CIERRE DE AREAS </b>, registre <b style="color: red">UN &Aacute;REA PERDIDA</b> con una valoraci&oacute;n entre 

     <input type="text" onkeypress="return justNumbers(event);" 

id="p32_1"max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="1_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[0];?>"> y 

     <input type="text" onkeypress="return justNumbers(event);" 

 id="p32_2"max="5.0" min="1.0"style="text-align: center; border-radius: 10px;width: 45px;" name="2_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[1];?>"> 

    ,  pero el promedio 

    en todas las &aacute;reas, es mayor o igual a 

    <input type="text" onkeypress="return justNumbers(event);" 

id="p32_3"max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="13_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[12];?>">; el sistema cambiar&aacute; la calificaci&oacute;n del &aacute;rea reprobada, por 

    <input type="text" onkeypress="return justNumbers(event);" 

 id="p32_4"max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="14_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[13];?>"> y <b>LA OBTENCION DE LA NUEVA NOTA</b> se har&aacute; <b>REDONDEANDO</b> la asignatura reprobada sin que las asignaturas promovidas del &aacute;rea se modifiquen en sus valoraciones.

    </p>

  </div>

        </div>

      </div>

      </div>

      </div>

    <script>

function validar32() {

if(document.getElementById('case451081').value=="S")

{

document.getElementById("p32_1").disabled = false;

	document.getElementById("p32_2").disabled = false;

		document.getElementById("p32_3").disabled = false;

			document.getElementById("p32_4").disabled = false;

}

if(document.getElementById('case451081').value=="N")

{

document.getElementById("p32_1").disabled = true;

	document.getElementById("p32_2").disabled = true;

		document.getElementById("p32_3").disabled = true;

			document.getElementById("p32_4").disabled = true;

}

    

}

addEvent('load', validar32); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

    <!-- ------------------------------ SEGUNDA TABLA -------------------------- -->

        <div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

    <!-- Section 2 -->

      <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem 2</div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

<b>Aplica</b>

          <select class="sele_mul" onclick="validar322()"name="8_<?php echo $row_configuracion['conf_nombre']; ?>" id="case451082">

            <option value="S" <?php if (!(strcmp("S", $valoresP34[7]))) {echo "selected=\"selected\"";} ?>>Si</option>

            <option value="N" <?php if (!(strcmp("N", $valoresP34[7]))) {echo "selected=\"selected\"";} ?>>No</option>

            </select>

          <br><br><br>

       

    <p style="text-align: left;margin: 0px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

    <b>2.)</b> Un estudiante que al cierre de <b style="color: red" >SUPERACION DE DIFICULTADES FIN DE A&Ntilde;O</b>, registre <b style="color: red">UN &Aacute;REA PERDIDA</b> con una valoraci&oacute;n entre 

    <input  type="text" onkeypress="return justNumbers(event);" id="p322_1" max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="3_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[2];?>"> y 

    <input type="text" onkeypress="return justNumbers(event);" 

id="p322_2"  max="5.0" min="1.0" style="text-align: center; border-radius: 10px; width: 45px;" name="4_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[3];?>">,  pero el promedio 

    en todas las &aacute;reas, es mayor o igual a 

    <input type="text" onkeypress="return justNumbers(event);" id="p322_3" max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="5_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[4];?>">; el sistema cambiar&aacute; la calificaci&oacute;n del &aacute;rea reprobada, por 

    <input type="text" onkeypress="return justNumbers(event);" id="p322_4"  max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="6_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[5];?>"> y <b>LA OBTENCION DE LA NUEVA NOTA</b> se har&aacute; <b>REDONDEANDO</b> la asignatura reprobada sin que las asignaturas promovidas del &aacute;rea se modifiquen en sus valoraciones.

   </p>

  <script>

function validar322() {

if(document.getElementById('case451082').value=="S")

{

 document.getElementById("p322_1").disabled = false;

	document.getElementById("p322_2").disabled = false;

		document.getElementById("p322_3").disabled = false;

			document.getElementById("p322_4").disabled = false;

}

if(document.getElementById('case451082').value=="N")

{

 document.getElementById("p322_1").disabled = true;

	document.getElementById("p322_2").disabled = true;

		document.getElementById("p322_3").disabled = true;

			document.getElementById("p322_4").disabled = true;

}

    

}

addEvent('load', validar322); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

  </div>

  </div>

  </div>

  </div>

  </div>

<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 3</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

    <br> <br> <br>

    Si el docente registra en la planilla de <b>SUPERACION DE DIFICULTADES FIN DE A&Ntilde;O</b> (NP) no se present&oacute;, el parametro invalidar&aacute; el cambio de valoracion.

    <br><br>

    EJEMPLO: 

  

    <table border="1">

      <tr>

        <td>&Aacute;rea /Asignatura</td>

        <td><b>Nota Cierre</b></td>

        <td><b>Nueva Nota</b></td>

      </tr>

      <tr>

        <td>Area de humanidades</td>

        <td>2.75</td>

        <td>3.0</td>

      </tr>

      <tr>

        <td>Asignatura: Lengua castellana </td>

        <td>3.50 </td>

        <td>3.5</td>

      </tr>

      <tr>

        <td>Asignatura: Ingl&eacute;s  </td>

        <td>2.00</td>

        <td>2.5</td>

      </tr>

    </table>

</div>

</div>

</div>

</div>

</div>

   

    <!-- ---------------------------------------- TABLA 3 ----------------------------------- -->

  

<div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

    <!-- Section 3 -->

      <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem 4</div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

<b>Aplica</b>

          <select class="sele_mul" onclick="validar323()" name="12_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

            <option value="S" <?php if (!(strcmp("S", $valoresP34[11]))) {echo "selected=\"selected\"";} ?>>Si</option>

            <option value="N" <?php if (!(strcmp("N", $valoresP34[11]))) {echo "selected=\"selected\"";} ?>>No</option>

            </select>

            <br><br><br>

    <p style="text-align: left;margin: 0px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

    <b>3.)</b> para estudiantes con  <b style="color: red"> 1 area perdida de la tecnica reprobada</b> despues del cierre de areas; si su promedio del a&ntilde;o es igual o mayor a 

    <input type="text" onkeypress="return justNumbers(event);" 

id="p323_1" max="5.0" min="1.0" style="text-align: center; border-radius: 10px;width: 45px;" name="10_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[9];?>"> el sistema reemplazara la calificacion del desempe&ntilde;o bajo del area reprobada por la calificacion

    <input type="text" onkeypress="return justNumbers(event);" 

id="p323_2" max="5.0" min="1.0" style="text-align: center; border-radius: 10px; width: 45px;" name="11_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $valoresP34[10];?>"> y el estado academico del estudiante pasara a <b>promovido</b> al grado siguiente. 

    

    </p>

    </div>

    </div>

    </div>

    </div>

    </div>

<script>

function validar323() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("p323_1").disabled = false;

document.getElementById("p323_2").disabled = false;

document.getElementById("p323_3").disabled = false;

document.getElementById("p323_4").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

 document.getElementById("p323_1").disabled = true;

document.getElementById("p323_2").disabled = true;

document.getElementById("p323_3").disabled = true;

document.getElementById("p323_4").disabled = true;

}

}

addEvent('load', validar323); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

    
</script>

 

 <!-- ---------------------------------------- TABLA 4 ----------------------------------- -->

        <div class="container_demohrvszv">

      

    <div class="accordion_example2wqzx">

    <!-- Section 4 -->

      <div class="accordion_inwerds">

        <div class="acc_headerfgd">&Iacute;tem 5</div>

        <div class="acc_contentsaponk">

          

          <div class="grevdaiolxx">

          <b>Aplica</b>

          <select class="sele_mul" name="9_<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

            <option value="S" <?php if (!(strcmp("S", $valoresP34[8]))) {echo "selected=\"selected\"";} ?>>Si</option>

            <option value="N" <?php if (!(strcmp("N", $valoresP34[8]))) {echo "selected=\"selected\"";} ?>>No</option>

            </select><br><br><br>

           

    <p style="text-align: left;margin: 0px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

    <b>4.)</b> El estudiante que durante <b style="color: red;">dos</b> (2) a&ntilde;os consecutivos, registre la <b>reprobaci&oacute;n</b> del <b style="color: red;">MISMO</b> grado, el sistema no le asignar&aacute; 

    cupo para el a&ntilde;o siguiente.      

    </p>

</div>

</div>

</div>

</div>

</div>

		<?php

		break;

/*----------------------------------------------------------case 112-----------------------------------------------------------------------------*/

		case 113:

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$fecha_inicio_113 = $array_parametro[1];

					$fecha_final_113 = $array_parametro[2];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" onclick="validar37()"name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  </td>

				 </tr>

				 </table>

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

<table>                 <tr>

                   	<td>Intervalo</td>

                     <td>

						<table>

						

							<tr style="text-align: center;" class="fila1"> 

								<td  colspan="2">Fecha de Inicio</td>

								<td  colspan="2">Fecha Terminaci&oacute;n</td>

							</tr>

							<tr>

								<td><input name="periodo_fecha_inicio_113" id="periodo_fecha_inicio113" type="text" size="8" readonly="readonly" value="<?php echo $fecha_inicio_113; ?>" /></td>

								<td ><button name="pi_<?php echo $row_configuracion['conf_nombre']; ?>" id="pi_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>

							  	<td ><input name="periodo_fecha_final_113" id="periodo_fecha_final113" type="text" size="8" readonly="readonly" value="<?php echo $fecha_final_113; ?>" /></td>

							  	<td><button name="pf_<?php echo $row_configuracion['conf_nombre']; ?>" id="pf_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>

							</tr>

						</table>

                      </td>

				 </tr>	

			</table>

</div>

</div>

</div>

</div>

</div>

<script>

function validar37() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("pi_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

document.getElementById("pf_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

 document.getElementById("pi_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;

document.getElementById("pf_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;

}

    

}

	addEvent('load', validar37); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>

		<?php

		break;

		case 112:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  </td>

				 </tr>

			

			</table> 

		<?php

		break;

/*----------------------------------------case 116----------------------------------------------------------------------------------------*/

		case 116:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

  </td>

	 </tr>

	</table> 

<?php

		break;

		case 155:

		$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$reasignacionRepro_ = $array_parametro[1];

					$reasignacionRepro2_ = $array_parametro[2];

					$reasignacionRepro4_ = $array_parametro[3];

					$reasignacionRepro5_ = $array_parametro[4];

					$reasignacionRepro6_ = $array_parametro[5];
					$reasignacionRepro7_ = $array_parametro[6];

		$valoresP43 = explode("$",$row_configuracion['conf_valor']);	

			$e1111= $valoresP43[5];	

	$parametro = $array_parametro[0];
?>

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Si aplica defina:</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

						

		<table>

				<tr>

			 		<td> <input id="pp19_111" type="radio" onclick="vvalidar1544()"<?php if (!(strcmp("A", $array_parametro[1]))) {echo "checked=checked";} ?> value="A" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td>Numero De Areas:</td> 

			 		<td></td><td><input id="pp19_222" type="text" style="width: 10%;"onkeypress="return justNumbers(event);"  value="<?php echo $array_parametro[2]; ?>" name="reasignacionRepro3_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td></tr>

<tr>
			 		<td> <input id="pp19_333" type="radio" onclick="vvalidar15444()"<?php if (!(strcmp("B", $array_parametro[1]))) {echo "checked=checked";} ?> value="B" name="valorplanirecu_<?php echo $row_configuracion['conf_nombre']; ?>"/> </td> <td>Todas Las Area:</td> 

				</tr>

			</table>

</div>

</div>

</div>

</div>

</div>

<script>

function vvalidar15444() {
 { 

 	document.getElementById("pp19_222").disabled = true;

 
 }

  
}

function vvalidar1544() {
 { 

 	document.getElementById("pp19_222").disabled = false;

 }

  
}
</script>

				

<?php

break;
case 121:
		
				$array_parametro = explode("$",$row_configuracion['conf_valor']);
				$aplica_promoanti_121 = $array_parametro[0];
				$nota_minima_121 = $array_parametro[1];
				$aplica_nota_comportamiento_121 = $array_parametro[2];
				$nota_comportamiento_121 = $array_parametro[3];
				$aplica_asistencia_121 = $array_parametro[4];
				$porcentaje_asistencia_121 = $array_parametro[5];
				$no_negativos_121 = $array_parametro[6];
				$aplica_periodo_121 = $array_parametro[7];
				$fecha_inicio_121 = $array_parametro[8];
				$fecha_final_121 = $array_parametro[9];			
				$estado = $array_parametro[10];
				$paraQueAreas = $array_parametro[12];
				$areasReprobadas=$array_parametro[13];
				$todasAreas=$array_parametro[14];
				$demasAreas=$array_parametro[15];
				$areas_R=$array_parametro[16];
				$todas_A=$array_parametro[17];
				$demas_A=$array_parametro[18];
			    $aplica_promoanti_1211 = $array_parametro[20];
			    $no_negativos_1211 = $array_parametro[21];
			    $aplica_asistencia_1211 = $array_parametro[22];
	            $fecha_inicio_121_2 = $array_parametro[25];
				$fecha_final_121_2 = $array_parametro[26];
				$fecha_inicio_121_2_1 = $array_parametro[27];
				$fecha_final_121_2_1 = $array_parametro[28];
				$parametro = $row_configuracion['conf_valor'];
	/*
	echo $row_configuracion['conf_valor']."<br/><br/>";

echo "p0 => ".$array_parametro[0]."<br>"  ; 
echo "p1 => ".$array_parametro[1]."<br>"  ; 
echo "p2 => ".$array_parametro[2]."<br>"  ; 
echo "p3 => ".$array_parametro[3]."<br>"  ; 
echo "p4 => ".$array_parametro[4]."<br>"  ; 
echo "p5 => ".$array_parametro[5]."<br>"  ; 
echo "p6 => ".$array_parametro[6]."<br>"  ; 
echo "p7 => ".$array_parametro[7]."<br>"  ; 
echo "p8 => ".$array_parametro[8]."<br>"  ; 
echo "p9=> ".$array_parametro[9]."<br>"  ; 
echo "p10 => ".$array_parametro[10]."<br>";
echo "p11 => ".$array_parametro[11]."<br>";
echo "p12 => ".$array_parametro[12]."<br>";
echo "p13 => ".$array_parametro[13]."<br>";
echo "p14=> ".$array_parametro[14]."<br>";
echo "p15=> ".$array_parametro[15]."<br>";
echo "p16=> ".$array_parametro[16]."<br>";
echo "p17=> ".$array_parametro[17]."<br>";
echo "p18 => ".$array_parametro[18]."<br>";
echo "p19 => ".$array_parametro[19]."<br>";
echo "p20 => ".$array_parametro[20]."<br>";
echo "p21 => ".$array_parametro[21]."<br>";
echo "p22 => ".$array_parametro[22]."<br>";
*/
		 ?>
			<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd"><strong> Aplica solo si se hace al final del periodo </strong></div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
        <table  width="90%" style="border:1px solid #666666; margin-top:5px;">		
<tr>
                  	<td colspan="2">
                  	
                  		<select class="sele_mul" id="criterio1211" name="aDirectiva" onclick="validar491211()">
                  			<option value="T1" <?php if (strpos($row_configuracion['conf_valor'],"T1") == true)  {echo "selected=\"selected\"";} ?>>Si</option>
                  			<option value="F1" <?php if (strpos($row_configuracion['conf_valor'],"F1") == true)  {echo "selected=\"selected\"";} ?>>No</option>
                  		</select></tr>
    
               <tr class="fila1">
     <td colspan="2" align="center"><div align="justify" class="text" ><b>Definici&oacute;n del periodo de recolecci&oacute;n de datos a tener en cuenta para la promoci&oacute;n anticipada a estudiantes reprobados </b></div></td>
                  </tr>
                  		<tr>
                  		 <td>Intervalo</td>
                     <td>
						<table >
							<tr style="text-align: center;" class="fila1"> 
								<td  >Fecha de Inicio</td><td style="background:#E7F1FE;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td  >Fecha Terminaci&oacute;n</td>
							</tr>
							<?php 
	$select_periodo="SELECT *  FROM `periodo_academicos` limit 0,1";
	$query_periodo=mysql_query($select_periodo, $link) or die($select_periodo);
	$row_configuracionperiodos = mysql_fetch_assoc($query_periodo);
	$num_registros_periodos=mysql_num_rows($query_periodo);
							 ?>
							<tr>
			<td><input name="periodo_fecha_inicio_121" id="periodo_fecha_inicio1211" type="text" size="8" readonly="readonly" value="<?php echo $row_configuracionperiodos['inicio_ing_notas']; ?>" /></td>
<td style="background:#E7F1FE;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td ><input name="periodo_fecha_final_121" id="periodo_fecha_final1211" type="text" size="8" readonly="readonly" value="<?php echo $row_configuracionperiodos['fin_ing_notas']; ?>" /></td>
							  	
							</tr>
							
						</table>
                      </td>
                  	
                  </tr>

               <tr class="fila1">
                     <td colspan="2" align="center"><div align="justify" class="text" id="nota_minima_exigida_121"><b><?php echo ConsultarTextoCriterio('nota_minima_exigida_121'); ?></b></div></td>
                  </tr>
                  <tr>
                  	<td></td>
                     <td>
                     <select class="sele_mul" style="width:150px;" name="aplica_promoanti_1211" id="aplica_promoanti_1211" onchange="ActivaCampo('aplica_promoanti_121','nota_minima_121')">
                        <option value="11" <?php if (!(strcmp("11", $aplica_promoanti_1211))) {echo "selected=\"selected\"";} ?>>No aplica</option>
                        <option value="21" <?php if (!(strcmp("21", $aplica_promoanti_1211))) {echo "selected=\"selected\"";} ?>>Si aplica</option>
                       
                      </select>
                      </td>
				 </tr>
				    <tr>
						<td></td>
				 		<td><input  id="radiop_1" name="areas_R" onclick="valida_check_param_121_1()" type="checkbox" value="1" <?php if  (strlen($areas_R)>0) {echo "checked='checked'";} ?> >Por cada &aacute;rea.</td>
				 	</tr>
	                   <tr>
                     <td></td><td><strong>&Oacute;</strong></td>
				 </tr>
				     <tr>
				      	<td></td>
						<td><input  id="radiop_2" name="demas_A" onclick="valida_check_param_121_2()" type="checkbox" value="3" <?php if (strlen($demas_A)>0) {echo "checked='checked'";} ?> >Por promedio del primer periodo.</td>
					</tr>
				
                 <tr>
                     <td>Calificaci&oacute;n</td>
                     <td><input onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 25%;" id="nota_minima_1211" name="nota_minima_121" value=""/></td>
				 </tr>
               <tr class="fila1">
                     <td colspan="2" align="center"><div align="justify" class="text" id="calificacion_comportamiento_121"><b><?php echo ConsultarTextoCriterio('calificacion_comportamiento_121'); ?></b></div></td>
                 </tr>
  	  <tr>
                 <td>	</td>
                     <td >
                     <select class="sele_mul" name="aplica_nota_comportamiento_121" id="aplica_nota_comportamiento_121" onchange="ActivaCampo('aplica_nota_comportamiento_121','nota_comportamiento_121')">
                        <option value="S" <?php if (!(strcmp("S", $aplica_nota_comportamiento_121))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N" <?php if (!(strcmp("N", $aplica_nota_comportamiento_121))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>
                 <tr>
                 	<td>Calificaci&oacute;n: </td>
                     <td><input onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 25%;" id="nota_comportamiento_121" name="nota_comportamiento_121" value="<?php echo $nota_comportamiento_121; ?>" /></td>
				 </tr>
				   <tr class="fila1">
                     <td colspan="2" align="center"><b><?php echo ConsultarTextoCriterio('no_negativos_121'); ?></b></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                     <select class="sele_mul" name="no_negativos_1211" id="no_negativos_1211">
                        <option value="S1" <?php if (!(strcmp("S1", $no_negativos_1211))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N1" <?php if (!(strcmp("N1", $no_negativos_1211))) {echo "selected=\"selected\"";} ?>>No aplica</option>
                      </select>
                      </td>
				 </tr>   
                 <tr class="fila1">
                     <td colspan="2" align="center"><div align="justify" class="text" id="asistencia_periodo_121"><b><?php echo ConsultarTextoCriterio('asistencia_periodo_121'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td>
                     <select class="sele_mul" name="aplica_asistencia_1211" id="aplica_asistencia_1211" onchange="ActivaCampo('aplica_asistencia_121','porcentaje_asistencia_121')">
                        <option value="S1" <?php if (!(strcmp("S1", $aplica_asistencia_1211))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N1" <?php if (!(strcmp("N1", $aplica_asistencia_1211))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>
                 <tr>
                 	<td>Porcentaje: </td>
                     <td><input onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 25%;" id="porcentaje_asistencia_1211" name="porcentaje_asistencia_121" value="<?php echo $porcentaje_asistencia_121;?>" />%</td>
				 </tr> 

				   <tr class="fila1">
     <td colspan="2" align="center"><div align="justify" class="text" ><b>Definici&oacute;n del periodo de tiempo para el ingreso de calificaciones en la planilla promoci&oacute;n anticipada para estudiantes reprobados  </b></div></td>
                  </tr>
                  	
     
  <tr>	
                     <td>Intervalo</td>
                     <td>
						<table >
							<tr style="text-align: center;" class="fila1"> 
								<td  colspan="2">Fecha de inicio</td>
								<td  colspan="2">Fecha terminaci&oacute;n</td>
							</tr>
							<tr>
<td><input name="periodo_fecha_inicio_1211_2_1" id="periodo_fecha_inicio121_2_1" type="text" size="8" readonly="readonly" value="<?php echo $fecha_inicio_121_2_1; ?>" /></td>
<td ><button name="pi_2_1<?php echo $row_configuracion['conf_nombre']; ?>" id="pi_2_1<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
<td ><input name="periodo_fecha_final_1211_2_1" id="periodo_fecha_final121_2_1" type="text" size="8" readonly="readonly" value="<?php echo $fecha_final_121_2_1; ?>" /></td>
<td><button name="pf_2_1<?php echo $row_configuracion['conf_nombre']; ?>" id="pf_2_1<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
							</tr>
	</table>
                      </td>           
                  </tr>
				 </table> </div></div></div></div></div>
	<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd"><strong>Aplica solo si se promueve antes de finalizar al periodo</strong></div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
        <table  width="90%" style="border:1px solid #666666; margin-top:5px;">	
 <tr>
                  	<td colspan="2">
                  	
                  		<select class="sele_mul" id="criterio121" name="aDirectiva2" >
                  			<option value="T2" <?php if (strpos($row_configuracion['conf_valor'],"T2") == true)  {echo "selected=\"selected\"";} ?>>Si</option>
                  			<option value="F2" <?php if (strpos($row_configuracion['conf_valor'],"F2") == true)  {echo "selected=\"selected\"";} ?>>No</option>
                  		</select></tr>
  <tr class="fila1">
     <td colspan="2" align="center"><div align="justify" class="text" ><b>Definici&oacute;n del periodo de tiempo para la  recolecci&oacute;n de datos a tener en cuenta para la promoci&oacute;n anticipada a estudiantes reprobados </b></div></td>
                  </tr>
                     <td>Intervalo</td>
                     <td>
						<table >
							<tr style="text-align: center;" class="fila1"> 
								<td  colspan="2">Fecha de Inicio</td>
								<td  colspan="2">Fecha Terminaci&oacute;n</td>
							</tr>
							<tr>
								<td><input name="periodo_fecha_inicio_1211" id="periodo_fecha_inicio121" type="text" size="8" readonly="readonly" value="<?php echo $fecha_inicio_121; ?>" /></td>
								<td ><button name="pi_<?php echo $row_configuracion['conf_nombre']; ?>" id="pi_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
							  	<td ><input name="periodo_fecha_final_1211" id="periodo_fecha_final121" type="text" size="8" readonly="readonly" value="<?php echo $fecha_final_121; ?>" /></td>
							  	<td><button name="pf_<?php echo $row_configuracion['conf_nombre']; ?>" id="pf_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
							</tr>
							
						</table>
                      </td>
                  	
                  </tr>
                      <tr class="fila1">
                     <td colspan="2" align="center"><div align="justify" class="text" id="nota_minima_exigida_121"><b><?php echo ConsultarTextoCriterio('nota_minima_exigida_121'); ?></b></div></td>
                  </tr> <tr>
                  	<td></td>
                     <td>
                     <select class="sele_mul" style="width:150px;" name="aplica_promoanti_121" id="aplica_promoanti_121" onchange="ActivaCampo('aplica_promoanti_121','nota_minima_121')">
                        <option value="12" <?php if (!(strcmp("12", $aplica_promoanti_121))) {echo "selected=\"selected\"";} ?>>No aplica</option>
                        <option value="22" <?php if (!(strcmp("22", $aplica_promoanti_121))) {echo "selected=\"selected\"";} ?>>Si aplica</option>
                       
                      </select>
                      </td>
				 </tr>
      <tr>
				      	<td></td>
						<td><input name="todas_A" id="checkbox_121_2" type="checkbox" value="2" <?php if  (strlen($todas_A)>0) {echo "checked='checked'";} ?> >Por &aacute;rea Reprobada.</td>
					 </tr>
     <tr>
                     <td>Calificaci&oacute;n</td>
                     <td><input onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 25%;" id="nota_minima_121" name="nota_minima_121" value="<?php echo $nota_minima_121; ?>" /></td>
				 </tr>
                 
                <tr class="fila1">
                     <td colspan="2" align="center"><b><?php echo ConsultarTextoCriterio('no_negativos_121'); ?></b></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                     <select class="sele_mul" name="no_negativos_121" id="no_negativos_121">
                        <option value="S2" <?php if (!(strcmp("S2", $no_negativos_121))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N2" <?php if (!(strcmp("N2", $no_negativos_121))) {echo "selected=\"selected\"";} ?>>No aplica</option>
                      </select>
                      </td>
				 </tr>   
			   <tr class="fila1">
                     <td colspan="2" align="center"><div align="justify" class="text" id="asistencia_periodo_121"><b><?php echo ConsultarTextoCriterio('asistencia_periodo_121'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td>
                     <select class="sele_mul" name="aplica_asistencia_121" id="aplica_asistencia_121" onchange="ActivaCampo('aplica_asistencia_121','porcentaje_asistencia_121')">
                        <option value="S2" <?php if (!(strcmp("S2", $aplica_asistencia_121))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N2" <?php if (!(strcmp("N2", $aplica_asistencia_121))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>
                 <tr>
                 	<td>Porcentaje: </td>
                     <td><input onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 25%;" id="porcentaje_asistencia_121" name="porcentaje_asistencia_121" value="<?php echo $porcentaje_asistencia_121;?>" />%</td>
				 </tr>  
				   <tr class="fila1">
     <td colspan="2" align="center"><div align="justify" class="text" ><b>Definici&oacute;n del periodo de tiempo para el ingreso de calificaciones en la planilla promoci&oacute;n anticipada para estudiantes reprobados  </b></div></td>
                  </tr>
                  	
       <tr>	
                     <td>Intervalo</td>
                     <td>
						<table >
							<tr style="text-align: center;" class="fila1"> 
								<td  colspan="2">Fecha de inicio</td>
								<td  colspan="2">Fecha terminaci&oacute;n</td>
							</tr>
							<tr>
<td><input name="periodo_fecha_inicio_1211_2" id="periodo_fecha_inicio121_2" type="text" size="8" readonly="readonly" value="<?php echo $fecha_inicio_121_2; ?>" /></td>
<td ><button name="pi_2<?php echo $row_configuracion['conf_nombre']; ?>" id="pi_2<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
<td ><input name="periodo_fecha_final_1211_2" id="periodo_fecha_final121_2" type="text" size="8" readonly="readonly" value="<?php echo $fecha_final_121_2; ?>" /></td>
<td><button name="pf_2<?php echo $row_configuracion['conf_nombre']; ?>" id="pf_2<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
							</tr>
							
						</table>
                      </td>           
                  </tr>
			</table></div></div></div></div></div>
<script type="text/javascript">
	
	function valida_check_param_121_1(){   document.getElementById('radiop_2').checked = false;}
function valida_check_param_121_2(){   document.getElementById('radiop_1').checked = false;}
</script>
      <script>
function validar491211() {
if(document.getElementById('criterio1211').value=="T1"){
document.getElementById("periodo_fecha_final121").value = "";
document.getElementById("periodo_fecha_inicio121").value = "";	
document.getElementById("periodo_fecha_final1211").value = "<?php echo $row_configuracionperiodos['fin_ing_notas']; ?>";
document.getElementById("periodo_fecha_inicio1211").value = "<?php echo $row_configuracionperiodos['inicio_ing_notas']; ?>";	
document.getElementById("porcentaje_asistencia_1211").value = "<?php echo $porcentaje_asistencia_121; ?>";
document.getElementById("porcentaje_asistencia_121").value = "";
document.getElementById("no_negativos_1211").disabled = false;
document.getElementById("aplica_asistencia_1211").disabled = false;
document.getElementById("checkbox_121_2").disabled = true;
document.getElementById("criterio121").value ="F2";
document.getElementById("no_negativos_121").disabled = true;
document.getElementById("nota_minima_1211").value = "<?php echo $nota_minima_121; ?>";
document.getElementById("nota_minima_121").value = "";
document.getElementById("nota_minima_121").disabled = true;
document.getElementById("nota_minima_1211").disabled = false;
document.getElementById("nota_comportamiento_121").value = "<?php echo $nota_comportamiento_121; ?>";
document.getElementById("nota_comportamiento_121").disabled = false;
document.getElementById("nota_comportamiento_121").disabled = false;
document.getElementById("porcentaje_asistencia_1211").disabled = false;
document.getElementById("porcentaje_asistencia_121").disabled = true;
document.getElementById("aplica_promoanti_121").disabled = true;
document.getElementById("aplica_promoanti_1211").disabled = false;
document.getElementById("aplica_nota_comportamiento_121").disabled = false;
document.getElementById("aplica_asistencia_121").disabled = true;
document.getElementById("radiop_1").disabled = false;
document.getElementById("radiop_2").disabled = false;
document.getElementById("pi_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("pf_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("pi_2<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("pf_2<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("pi_2_1<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("pf_2_1<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("periodo_fecha_final121_2").value = "";
document.getElementById("periodo_fecha_inicio121_2").value = "";
document.getElementById("periodo_fecha_final121_2_1").value = "<?php echo $fecha_final_121_2_1; ?>";
document.getElementById("periodo_fecha_inicio121_2_1").value = "<?php echo $fecha_inicio_121_2_1; ?>";
}
if(document.getElementById('criterio1211').value=="F1")
{
document.getElementById("pi_2_1<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("pf_2_1<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;	
document.getElementById("periodo_fecha_final121_2_1").value = "";
document.getElementById("periodo_fecha_inicio121_2_1").value = "";	
document.getElementById("periodo_fecha_final121_2").value = "<?php echo $fecha_final_121_2; ?>";
document.getElementById("periodo_fecha_inicio121_2").value = "<?php echo $fecha_inicio_121_2; ?>";
document.getElementById("periodo_fecha_inicio1211").value = "";
document.getElementById("periodo_fecha_final1211").value = "";
document.getElementById("periodo_fecha_final121").value = "<?php echo $fecha_final_121; ?>";
document.getElementById("periodo_fecha_inicio121").value = "<?php echo $fecha_inicio_121; ?>";	
document.getElementById("porcentaje_asistencia_1211").value = "";
document.getElementById("porcentaje_asistencia_121").value = "<?php echo $porcentaje_asistencia_121; ?>";
document.getElementById("nota_comportamiento_121").disabled = true;	
document.getElementById("nota_comportamiento_121").value = "";
document.getElementById("aplica_promoanti_1211").disabled = true;
document.getElementById("porcentaje_asistencia_121").disabled = false;
document.getElementById("no_negativos_1211").disabled = true;
document.getElementById("aplica_asistencia_1211").disabled = true;
document.getElementById("checkbox_121_2").disabled = false;
document.getElementById("criterio121").value ="T2";
document.getElementById("no_negativos_121").disabled = false;
document.getElementById("nota_minima_1211").value = "";
document.getElementById("nota_minima_121").value = "<?php echo $nota_minima_121; ?>";
document.getElementById("nota_minima_1211").disabled = true;
document.getElementById("nota_minima_121").disabled = false;
document.getElementById("nota_comportamiento_121").disabled = true;
document.getElementById("radiop_1").disabled = true;
document.getElementById("radiop_2").disabled = true;
document.getElementById("porcentaje_asistencia_1211").disabled = true;
document.getElementById("aplica_promoanti_121").disabled = false;
document.getElementById("aplica_nota_comportamiento_121").disabled = true;
document.getElementById("aplica_asistencia_121").disabled = false;
document.getElementById("pi_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("pf_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("pi_2<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("pf_2<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
}
}
  addEvent('load', validar491211); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script>
		<?php
		break;
	case 129:
/*
<option value="S" <?php if (!(strcmp("S", $crii))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $crii))) {echo "selected=\"selected\"";} ?>>No</option>*/

					$array_parametro = explode("$",$row_configuracion['conf_valor']);
	                $cri = $array_parametro[0];
					$valorEspecifico = $array_parametro[3];	
					$valorEspecifico2 = $array_parametro[4];
					$valorEspecifico3 = $array_parametro[5];		
		?>
		<table>
			<tr> <td></td><td><select class="sele_mul" name="valor" id="parametro50129"onclick="valida45();">
				<option value="S" <?php if (!(strcmp("S", $cri))) {echo "selected=\"selected\"";} ?>>Aplica</option>
				<option value="N" <?php if (!(strcmp("N", $cri))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
			</select></td></tr>
		</table>

		<table>

				<tr>
					<td>
						<label>
							<input type="radio" id="rad51q_1"onclick="determinar1291();"<?php  if (strpos($row_configuracion['conf_valor'],"17")==true) {echo "checked=checked";} ?> value="17" name="input_<?php echo $row_configuracion['conf_nombre']; ?>" >Para el a&ntilde;o lectivo con reconsideraci&oacute;n exclusiva del docente<br>
						</label>	  
					</td>
				</tr>
				<tr>	
					<td>
						<label>
							<input type="radio" id="rad51q_2"onclick="determinar1292();"<?php if (strpos($row_configuracion['conf_valor'],"18")==true) {echo "checked='checked'";} ?> value="18" name="input_<?php echo $row_configuracion['conf_nombre']; ?>">Para el a&ntilde;o lectivo con reconsideraci&oacute;n de la comisi&oacute;n de Evaluaci&oacute;n y Promoci&oacute;n al cierre de las &aacute;reas<br>
						</label>	
					</td>
				</tr>
				<tr>					
					<td>
						<label>
							<input type="radio" onclick="determinar1293();"<?php if (strpos($row_configuracion['conf_valor'],"19")==true) {echo "checked='checked'";} ?> value="19" name="input_<?php echo $row_configuracion['conf_nombre']; ?>" id="input_<?php echo $row_configuracion['conf_nombre']; ?>">Para el a&ntilde;o siguiente con planilla de actividades plan de apoyo<br>
						</label>	
					</td>	
				</tr>
				<tr>					
					<td>
						<label>
							Total areas perdidas:</label><input onkeypress="return justNumbers(event);" id="rad51k" style="width: 5%;height: 12px;" name="valorEspecifico3" value="<?php echo $valorEspecifico3; ?>">
						</label>	
					</td>	
				</tr>

		</table>

				
			<table border="1" style="width: 370px;text-align: center;margin-top: 15px;">
				<tr><td colspan="2">Nota m&aacute;xima permitida en la planilla de reconsideraci&oacute;n</td></tr>
				<tr><td><label>Desempe&ntilde;o Nal.</label></td><td><label>Rango num&eacute;rico</label></td></tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51a" <?php  if (strpos($row_configuracion['conf_valor'],"a")==true) {echo "checked=checked";} ?> value="a" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>" >Superior<br>
						</label>	  
					</td>
					<td>
						<label>
							<input type="radio" id="rad51b"<?php if (strpos($row_configuracion['conf_valor'],"b")==true) {echo "checked='checked'";} ?> value="b" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 5.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51c"<?php if (strpos($row_configuracion['conf_valor'],"c")==true) {echo "checked='checked'";} ?> value="c" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Alto<br>
						</label>	
					</td>
					<td>
						<label>
							<input type="radio" id="rad51d"<?php if (strpos($row_configuracion['conf_valor'],"d")==true) {echo "checked='checked'";} ?> value="d" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 4.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51e"<?php if (strpos($row_configuracion['conf_valor'],"e")==true) {echo "checked='checked'";} ?> value="e" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Basico<br>
						</label>	
					</td>
					<td>
						<label>
							<input type="radio" id="rad51f"<?php if (strpos($row_configuracion['conf_valor'],"f")==true) {echo "checked='checked'";} ?> value="f" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 3.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" type="radio" id="rad51g"<?php if (strpos($row_configuracion['conf_valor'],"g")==true) {echo "checked='checked'";} ?> value="g" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>">Bajo<br>
						</label>	
					</td>
					<td>
						<label>
								
							<input type="radio" <?php if (strpos($row_configuracion['conf_valor'],"h")==true) {echo "checked='checked'";} ?> value="h" name="valorAsignaturas2_<?php echo $row_configuracion['conf_nombre']; ?>" >Valor espec&iacute;fico:<br>
							<input style="width: 15%;" id="valorEspecifico2" name="valorEspecifico2" value="<?php echo $valorEspecifico2; ?>">
						</label>	
					</td>					
				</tr>																
			</table>
			</br>
	
		

		
			<!--/////////NOTA MAXIMA PERMITIDA EN LA PLAMILLA DE RECONSIDERACION PARA LAS ASIGNATURAS DE LA TECNICA///////////////////// -->

		

				<table border="1" style="width: 370px;text-align: center;margin-top: 15px;">
				<tr><td colspan="2">Nota m&aacute;xima permitida en la planilla de reconsideraci&oacute;n para las <b>asignaturas de la t&eacute;cnica</b></td></tr>
				<tr><td><label>Desempe&ntilde;o Nal.</label></td><td><label>Rango num&eacute;rico</label></td></tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51i"<?php if (strpos($row_configuracion['conf_valor'],"i")==true) {echo "checked='checked'";} ?> value="i" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>" >Superior<br>
						</label>	
					</td>
					<td>
						<label>
							<input type="radio" id="rad51j"<?php if (strpos($row_configuracion['conf_valor'],"j")==true) {echo "checked='checked'";} ?> value="j" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 5.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51k"<?php if (strpos($row_configuracion['conf_valor'],"k")==true) {echo "checked='checked'";} ?> value="k" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Alto<br>
						</label>	
					</td>
					<td>
						<label>
							<input type="radio" id="rad51l"<?php if (strpos($row_configuracion['conf_valor'],"l")==true) {echo "checked='checked'";} ?> value="l" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 4.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51m"<?php if (strpos($row_configuracion['conf_valor'],"m")==true) {echo "checked='checked'";} ?> value="m" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Basico<br>
						</label>	
					</td>
					<td>
						<label>
							<input type="radio" id="rad51n"<?php if (strpos($row_configuracion['conf_valor'],"n")==true) {echo "checked='checked'";} ?> value="n" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Hasta 3.0<br>
						</label>	
					</td>					
				</tr>
				<tr style="text-align: left;">
					<td>
						<label>
							<input type="radio" id="rad51o"<?php if (strpos($row_configuracion['conf_valor'],"o")==true) {echo "checked='checked'";} ?> value="o" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Bajo<br>
						</label>	
					</td>
					<td>
						<label>
										
							<input type="radio" onclick="activaAreas();"<?php if (strpos($row_configuracion['conf_valor'],"p")==true) {echo "checked='checked'";} ?> value="p" name="valorAsignaturas_<?php echo $row_configuracion['conf_nombre']; ?>">Valor espec&iacute;fico:<br>
							<input style="width: 15%;" id="valorEspecifico" name="valorEspecifico" value="<?php echo $valorEspecifico; ?>" >
						</label>	
					</td>					
				</tr>																
			</table>
			</br>
<script>
function valida45() {
if(document.getElementById('parametro50129').value=="S")
{
 document.getElementById("rad51q_1").disabled = false;
 document.getElementById("rad51q_2").disabled = false;
  document.getElementById("input_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
 document.getElementById("rad51a").disabled = false;
 document.getElementById("rad51b").disabled = false;
 document.getElementById("rad51c").disabled = false;
 document.getElementById("rad51d").disabled = false;
 document.getElementById("rad51e").disabled = false;
 document.getElementById("rad51f").disabled = false;
 document.getElementById("rad51g").disabled = false;
 document.getElementById("rad51i").disabled = false;
 document.getElementById("rad51j").disabled = false;
 document.getElementById("rad51k").disabled = false;
 document.getElementById("rad51l").disabled = false;
 document.getElementById("rad51m").disabled = false;
 document.getElementById("rad51n").disabled = false;
 document.getElementById("rad51o").disabled = false;
  document.getElementById("valorEspecifico2").disabled = false;
  document.getElementById("valorEspecifico").disabled = false;
}
if(document.getElementById('parametro50129').value=="N")
{
  document.getElementById("rad51q_1").disabled = true;
 document.getElementById("rad51q_2").disabled = true;
  document.getElementById("input_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
 document.getElementById("rad51a").disabled = true;
 document.getElementById("rad51b").disabled = true;
 document.getElementById("rad51c").disabled = true;
 document.getElementById("rad51d").disabled = true;
 document.getElementById("rad51e").disabled = true;
 document.getElementById("rad51f").disabled = true;
 document.getElementById("rad51g").disabled = true;
 document.getElementById("rad51i").disabled = true;
 document.getElementById("rad51j").disabled = true;
 document.getElementById("rad51k").disabled = true;
 document.getElementById("rad51l").disabled = true;
 document.getElementById("rad51m").disabled = true;
 document.getElementById("rad51n").disabled = true;
 document.getElementById("rad51o").disabled = true;
 document.getElementById("valorEspecifico2").disabled = true;
 document.getElementById("valorEspecifico").disabled = true;
}
}
addEvent('load', valida45); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
<script type="text/javascript">
function determinar1291() {

    document.getElementById("rad51k").disabled = true;
}

</script>
<script type="text/javascript">
function determinar1292() {

    document.getElementById("rad51k").disabled = true;
}

</script>
<script type="text/javascript">
function determinar1293() {

    document.getElementById("rad51k").disabled = false;
}

</script>

		<?php 
		break;
		
	case 120: //REQUISITOS SIE 120
		
				$array_parametro = explode("$",$row_configuracion['conf_valor']);
			    $cri = $array_parametro[0];
				$nota_minima_120 = $array_parametro[1];
				$aplica_nota_comportamiento = $array_parametro[2];
				$nota_comportamiento = $array_parametro[3];
				$aplica_asistencia = $array_parametro[4];
				$porcentaje_asistencia = $array_parametro[5];
				$no_negativos = $array_parametro[6];				
				$num_periodo = $array_parametro[7];
				$vigenciarpI = $array_parametro[9];
				$vigenciarpF = $array_parametro[10];
				$prueba_I=$array_parametro[11];
				$obtener_V=$array_parametro[12];
				$calificacion_P=$array_parametro[13];
				$certificados_E=$array_parametro[14];
				$e1=$array_parametro[17];
				$e2=$array_parametro[18];
				$e3=$array_parametro[19];
				$e4=$array_parametro[20];
				$e5=$array_parametro[21];
				$e6=$array_parametro[22];
				$e7=$array_parametro[23];
				$e8=$array_parametro[24];
				$e9=$array_parametro[25];
				$e10=$array_parametro[26];
				$e11=$array_parametro[27];
				$e12=$array_parametro[28];
				$aplica_nota_comportamiento2 = $array_parametro[29];
				$aplica_nota_comportamiento3 = $array_parametro[30];
				$primero_S = $array_parametro[32];
				$Segundo_T = $array_parametro[33];
				$Tercero_C = $array_parametro[34];
				$Cuarto_Q = $array_parametro[35];
				$Quinto_S = $array_parametro[36];
				$Sexto_S = $array_parametro[37];
				$Semptimo_O = $array_parametro[38];
				$Octavo_N = $array_parametro[39];
				$Noveno_D = $array_parametro[40];
				$Decimo_O = $array_parametro[41];
				$valorNota = $array_parametro[42];
			    $aplica_promoanti_120_area_promedio = $array_parametro[43];
	    $transcicion_P = $array_parametro[44];
				 $parametro = $row_configuracion['conf_valor'];

		?>

<script type="text/javascript" src="js/highslide/highslide-with-html.js"></script>
<script type="text/javascript" src="js/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<script type="text/javascript">
	hs.showCredits = false;
	hs.align = 'right';
	hs.wrapperClassName = 'draggable-header';
    hs.graphicsDir = 'js/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

	<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd">&Iacute;tem</div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
        <table  width="90%" style="border:1px solid #666666; margin-top:5px;">		
        <tr class="fila1">
	        	<td colspan="5" style="text-align: left;"><div align="justify"   id="nota_minima_exigida_120"><b>Vigencia para registro de procesos:</b></div></td>
	        </tr>
	        <tr>
	          <script>
function valida44() {

if(document.getElementById('criterio120_<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")
{
document.getElementById("bb_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("cc_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;
document.getElementById("nota_minima_120").disabled = false;
document.getElementById("nota_comportamiento").disabled = false;
document.getElementById("porcentaje_asistencia").disabled = false;
document.getElementById("v120").disabled = false;
document.getElementById("v121").disabled = false;
document.getElementById("v122").disabled = false;
document.getElementById("v123").disabled = false;
document.getElementById("v124").disabled = false;
document.getElementById("v125").disabled = false;
document.getElementById("v126").disabled = false;
document.getElementById("v127").disabled = false;
document.getElementById("v128").disabled = false;
document.getElementById("v129").disabled = false;
document.getElementById("v130").disabled = false;
document.getElementById("v131").disabled = false;
document.getElementById("v132").disabled = false;
document.getElementById("v133").disabled = false;
document.getElementById("aplica_promoanti_120").disabled = false;
document.getElementById("aplica_nota_comportamiento").disabled = false;
document.getElementById("no_negativos").disabled = false;
document.getElementById("aplica_asistencia").disabled = false;
document.getElementById("aplica_nota_comportamiento3").disabled = false;
document.getElementById("validarradio501201").disabled = false;
document.getElementById("validarradio501202").disabled = false;
document.getElementById("validarradio501203").disabled = false;
document.getElementById("validarradio501204").disabled = false;
document.getElementById("validarradio501205").disabled = false;
document.getElementById("validarradio501206").disabled = false;
document.getElementById("validarradio501207").disabled = false;
document.getElementById("num_periodo").disabled = false;
document.getElementsByClassName("areas").disabled = false;
}
if(document.getElementById('criterio120_<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")
{
document.getElementById("bb_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("cc_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
document.getElementById("nota_minima_120").disabled = true;
document.getElementById("nota_comportamiento").disabled = true;
document.getElementById("porcentaje_asistencia").disabled = true;
document.getElementById("v120").disabled = true;
document.getElementById("v121").disabled = true;
document.getElementById("v122").disabled = true;
document.getElementById("v123").disabled = true;
document.getElementById("v124").disabled = true;
document.getElementById("v125").disabled = true;
document.getElementById("v126").disabled = true;
document.getElementById("v127").disabled = true;
document.getElementById("v128").disabled = true;
document.getElementById("v129").disabled = true;
document.getElementById("v130").disabled = true;
document.getElementById("v131").disabled = true;
document.getElementById("v132").disabled = true;
document.getElementById("v133").disabled = true;
document.getElementById("aplica_promoanti_120").disabled = true;
document.getElementById("aplica_nota_comportamiento").disabled = true;
document.getElementById("no_negativos").disabled = true;
document.getElementById("aplica_asistencia").disabled = true;
document.getElementById("aplica_nota_comportamiento3").disabled = true;
document.getElementById("obtener_V").disabled = true;
document.getElementById("validarradio501201").disabled = true;
document.getElementById("validarradio501202").disabled = true;
document.getElementById("validarradio501203").disabled = true;
document.getElementById("validarradio501204").disabled = true;
document.getElementById("validarradio501205").disabled = true;
document.getElementById("validarradio501206").disabled = true;
document.getElementById("validarradio501207").disabled = true;
document.getElementById("num_periodo").disabled = true;
document.getElementsByClassName("areas").disabled = true;
}
}
addEvent('load', valida44); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>
	        	<td colspan="5">
	        		<table>
  					<td>
	        		<br><label><b>Aplica </b></label> 
				  	 <select class="sele_mul" name="criterio120_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio120_<?php echo $row_configuracion['conf_nombre']; ?>"onclick="valida44()">
			<option value="S" <?php if (!(strcmp("S", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>
                </select> </td>
	        			<tr class="fila1" style="text-align: center;"><td>Desde</td><td>Hasta</td></tr>
					<tr><td><input name="periodo_fecha_inicio_120" id="periodo_fecha_inicio" type="text" size="8" readonly="readonly" value="<?php echo $vigenciarpI; ?>" />
					<button name="bb_<?php echo $row_configuracion['conf_nombre']; ?>" id="bb_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td>
				  	<td><input name="periodo_fecha_final_120" id="periodo_fecha_final" type="text" size="8" readonly="readonly" value="<?php echo $vigenciarpF; ?>" />
				  	<button name="cc_<?php echo $row_configuracion['conf_nombre']; ?>" id="cc_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button></td></tr>

	        		</table> <br>
	        	</td>
	        </tr>
                 <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="nota_minima_exigida_120"><b><?php echo ConsultarTextoCriterio('nota_minima_exigida_120'); ?></b></div></td>
                  </tr>
                  <tr>
                  	<td>
                     <select class="sele_mul" style="width:150px;" name="aplica_promoanti_120" id="aplica_promoanti_120" onchange="ActivaCampo('aplica_promoanti_120','nota_minima_120')">
                        <option value="1" <?php if (!(strcmp("1", $aplica_promoanti_120_area_promedio))) {echo "selected=\"selected\"";} ?>>Por Cada &Aacute;rea</option>
                        <option value="2" <?php if (!(strcmp("2", $aplica_promoanti_120_area_promedio))) {echo "selected=\"selected\"";} ?>>Promedio Primer Periodo</option>
                        <option value="0" <?php if (!(strcmp("0", $aplica_promoanti_120_area_promedio))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>
                 <tr>
                     <td>Calificaci&oacute;n
                     <input id="nota_minima_120" onkeypress="return justNumbers(event);"name="nota_minima_120" value="<?php echo $nota_minima_120; ?>" style="border-radius: 10px; width: 25%;" /></td>
				 </tr>
                 <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="calificacion_comportamiento_120"><b><?php echo ConsultarTextoCriterio('calificacion_comportamiento_120'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td>
                     <select class="sele_mul" name="aplica_nota_comportamiento" id="aplica_nota_comportamiento" onchange="ActivaCampo('aplica_nota_comportamiento','nota_comportamiento')">
                        <option value="S" <?php if (!(strcmp("S", $aplica_nota_comportamiento))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N" <?php if (!(strcmp("N", $aplica_nota_comportamiento))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>
                 <tr>
                 	<td> Calificaci&oacute;n: 
                     <input onkeypress="return justNumbers(event);"style="border-radius: 10px; width: 25%;" id="nota_comportamiento" name="nota_comportamiento" value="<?php echo $nota_comportamiento; ?>" /></td>
				 </tr>

                 <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="asistencia_periodo_120"><b><?php echo ConsultarTextoCriterio('asistencia_periodo_120'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td>
                     <select class="sele_mul" name="aplica_asistencia" id="aplica_asistencia" onchange="ActivaCampo('aplica_asistencia','porcentaje_asistencia')">
                        <option value="S" <?php if (!(strcmp("S", $aplica_asistencia))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N" <?php if (!(strcmp("N", $aplica_asistencia))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>

                      </td>
				 </tr>
                 <tr>
                 	<td>Porcentaje:&nbsp;&nbsp;&nbsp; 
                    <input onkeypress="return justNumbers(event);"style="border-radius: 10px; width: 25%;" id="porcentaje_asistencia" name="porcentaje_asistencia" value="<?php echo $porcentaje_asistencia;?>" />%</td>
				 </tr>
                 <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="no_negativos_120"><b><?php echo ConsultarTextoCriterio('no_negativos_120'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td>
                     <select class="sele_mul" name="no_negativos" id="no_negativos">
                        <option value="S" <?php if (!(strcmp("S", $no_negativos))) {echo "selected=\"selected\"";} ?>>Aplica</option>
                        <option value="N" <?php if (!(strcmp("N", $no_negativos))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
                      </select>
                      </td>
				 </tr>                 
                 <tr class="fila1">
  <td colspan="5" align="center"><div align="justify"  id="inicio_periodo_promocion_120"><b><?php echo ConsultarTextoCriterio('inicio_periodo_promocion_120'); ?></b></div></td>
                 </tr>
                 <tr>
                     <td>Periodo: 
                     <select class="sele_mul" name="num_periodo" id="num_periodo">
                        <option value="2" <?php if ($num_periodo == 2) {echo "selected=\"selected\"";} ?>>2</option>
                      </select>
                      </td>
				 </tr>                 
                   <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="inicio_periodo_promocion_120"><b>En qu&eacute; grados se dara la promocion anticipada</b></div></td>
                 </tr>
         		<td><table>
                   <tr>
                 	<td> </td>
                 </tr>
                  <tr>
                 	<td style="width:50%;" >De Transici&oacute;n a Primero:  <td><input name="transicion_P" id="v119" type="checkbox" value="355" <?php if (strlen($transcicion_P)>0) {echo "checked='checked'";} ?>  type="checkbox"></td></td>
                 </tr>
                 <tr>
                 	<td style="width:50%;" >De Primero a Segundo :  <td><input name="primero_S" id="v120"type="checkbox" value="1" <?php if (strlen($primero_S)>0) {echo "checked='checked'";} ?>  type="checkbox"></td></td>
                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Segundo a Tercero : <td><input name="Segundo_T" id="v121"type="checkbox" value="2" <?php if (strlen($Segundo_T)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Tercero a Cuarto :  <td><input name="Tercero_C" id="v122"type="checkbox" value="3" <?php if (strlen($Tercero_C)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Cuarto a Quinto :  <td><input name="Cuarto_Q" id="v123"type="checkbox" value="4" <?php if (strlen($Cuarto_Q)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Quinto a Sexto :  <td><input name="Quinto_S" id="v124"type="checkbox" value="5" <?php if (strlen($Quinto_S)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>

                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Sexto a Septimo :  <td><input name="Sexto_S" id="v125"type="checkbox" value="6" <?php if (strlen($Sexto_S)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                   <tr>

                 	<td style="width:50%;" >De Septimo a Octavo :  <td><input name="Semptimo_O" id="v126"type="checkbox" value="7" <?php if (strlen($Semptimo_O)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>

                 </tr>
                   <tr>
                 	<td style="width:50%;" >De Octavo a Noveno : <td><input name="Octavo_N" id="v127"type="checkbox" value="8" <?php if (strlen($Octavo_N)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                   <tr>
                 	<td style="width:20%;" >De Noveno a Decimo :  <td><input name="Noveno_D" id="v128"type="checkbox" value="9" <?php if (strlen($Noveno_D)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                  <tr>
                 	<td style="width:20%;" >De Decimo a Once :  <td><input name="Decimo_O" id="v129"type="checkbox" value="10" <?php if (strlen($Decimo_O)>0) {echo "checked='checked'";} ?> type="checkbox"></td></td>
                 </tr>
                  <tr class="fila1">
                     <td colspan="5" align="center"><div align="justify"  id="inicio_periodo_promocion_120"><b>PRUEBA DE SUFICIENCIA</b></div></td>
                 </tr>  
                 <td>
	        		<br><label><b>Aplica </b></label> 
				  	  <select class="sele_mul" name="aplica_nota_comportamiento3" id="aplica_nota_comportamiento3" onclick="validar501202()">
                        <option value="S" <?php if (!(strcmp("S", $aplica_nota_comportamiento3))) {echo "selected=\"selected\"";} ?>>Si</option>
                        <option value="N" <?php if (!(strcmp("N", $aplica_nota_comportamiento3))) {echo "selected=\"selected\"";} ?>>No</option>
                </select> </td>
                   <tr>
                     <td><input type="radio" id="v130"<?php if (!(strcmp("1", $array_parametro[15]))) {echo "checked='checked'";} ?>onclick="javascript:determinarcampo();" value="1" name="valorDesempate2_<?php echo $row_configuracion['conf_nombre']; ?>">En todas las &aacute;reas</td>
                 </tr>
                 <tr>
                     <td><input type="radio" id="v131"<?php if (!(strcmp("2", $array_parametro[15]))) {echo "checked='checked'";} ?>onclick="javascript:determinarcampo();" value="2" name="valorDesempate2_<?php echo $row_configuracion['conf_nombre']; ?>">Solo &aacute;reas t&eacute;cnicas </td>
         </tr>
          <tr>
                     <td><input type="radio" id="v132"<?php if (!(strcmp("3", $array_parametro[15]))) {echo "checked='checked'";} ?>onclick="javascript:determinarcampo();"  value="3" name="valorDesempate2_<?php echo $row_configuracion['conf_nombre']; ?>">En las &aacute;rea de:  <br>
                      <a href='javascript:void(0)' onClick="return hs.htmlExpand(this, { headingText: 'Banco De Areas'})">Banco de Areas<img src="images/iconos/folio.gif" width="24" /></a>
								<div class='highslide-maincontent' align="center" style="width: 1053px;height: 638px;">
								<iframe scrolling="no" width="100%" height="800px" src="./select_banco_areas_parametros.php"></iframe>
								</div>
</td>
         </tr> 
       </table>
      </td>
	          <script>

function validar501202() {

if(document.getElementById('aplica_nota_comportamiento3').value=="S")
{
document.getElementById("validarradio501203").checked = false;
document.getElementById("validarradio501201").disabled = false;
document.getElementById("validarradio501202").disabled = false;
document.getElementById("operraccionnn").disabled = false;
document.getElementById("resulltaaddoo").disabled = false;
document.getElementById("obtener_V").disabled = false;
document.getElementById("v130").disabled = false;
document.getElementById("v131").disabled = false;
document.getElementById("v132").disabled = false;
document.getElementById("v133").disabled = false;
document.getElementById("p50120i1").disabled = false;
document.getElementById("p50120i2").disabled = false;
document.getElementById("p50120i3").disabled = false;
document.getElementById("p50120i4").disabled = false;
document.getElementById("p50120i5").disabled = false;
document.getElementById("p50120i6").disabled = false;
document.getElementById("p50120i7").disabled = false;
document.getElementById("p50120i8").disabled = false;
document.getElementById("p50120i9").disabled = false;
document.getElementById("p50120i10").disabled = false;
document.getElementById("p50120i11").disabled = false;
document.getElementById("p50120i12").disabled = false;
document.getElementById("p50120i1").disabled = false;
document.getElementById("p50120i2").disabled = false;
document.getElementById("p50120i3").disabled = false;
document.getElementById("p50120i4").disabled = false;
document.getElementById("p50120i5").disabled = false;
document.getElementById("p50120i6").disabled = false;
document.getElementById("p50120i7").disabled = false;
document.getElementById("p50120i8").disabled = false;
document.getElementById("p50120i9").disabled = false;
document.getElementById("p50120i10").disabled = false;
document.getElementById("p50120i11").disabled = false;
document.getElementById("p50120i12").disabled = false;
}

if(document.getElementById('aplica_nota_comportamiento3').value=="N")
{
document.getElementById("operraccionnn").disabled = true;
document.getElementById("resulltaaddoo").disabled = true;
document.getElementById("operraccionnn").value = "";
document.getElementById("resulltaaddoo").value = "";
document.getElementById("obtener_V").disabled = true;
document.getElementById("obtener_V").checked = false;
document.getElementById("validarradio501201").disabled = true;
document.getElementById("validarradio501202").disabled = true;
document.getElementById("validarradio501201").checked = false;
document.getElementById("validarradio501202").checked = false;
document.getElementById("validarradio501203").disabled = false;
document.getElementById("v133").value = "";
document.getElementById("validarradio501203").checked = true;
document.getElementById("v130").disabled = true;
document.getElementById("v131").disabled = true;
document.getElementById("v132").disabled = true;
document.getElementById("v133").disabled = true;
document.getElementById("p50120i1").disabled = true;
document.getElementById("p50120i2").disabled = true;
document.getElementById("p50120i3").disabled = true;
document.getElementById("p50120i4").disabled = true;
document.getElementById("p50120i5").disabled = true;
document.getElementById("p50120i6").disabled = true;
document.getElementById("p50120i7").disabled = true;
document.getElementById("p50120i8").disabled = true;
document.getElementById("p50120i9").disabled = true;
document.getElementById("p50120i10").disabled = true;
document.getElementById("p50120i11").disabled = true;
document.getElementById("p50120i12").disabled = true;
document.getElementById("p50120i1").disabled = true;
document.getElementById("p50120i2").disabled = true;
document.getElementById("p50120i3").disabled = true;
document.getElementById("p50120i4").disabled = true;
document.getElementById("p50120i5").disabled = true;
document.getElementById("p50120i6").disabled = true;
document.getElementById("p50120i7").disabled = true;
document.getElementById("p50120i8").disabled = true;
document.getElementById("p50120i9").disabled = true;
document.getElementById("p50120i10").disabled = true;
document.getElementById("p50120i11").disabled = true;
document.getElementById("p50120i12").disabled = true;
}

}
addEvent('load', validar501202); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>

         <tr><td>

<!--PARAMETRO 44 CONSULTA CODIGO DE LAS MATERIAS-->

          <table style="width: 95%;">
          <tr>
              <div>
   <table>
     <tr><td><input type = "text"  id="p50120i1" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e1; ?>" name="E1_"></td><td><input type = "text" id="p50120i2" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e2; ?>" name="E2_"></td><td><input type = "text" id="p50120i3" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e3; ?>" name="E3_"></td><td><input type = "text" id="p50120i4" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e4; ?>" name="E4_"></td></tr>
              <tr><td><input type = "text"  id="p50120i5" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e5; ?>" name="E5_"></td><td><input type = "text" id="p50120i6" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e6; ?>" name="E6_"></td><td><input type = "text"  id="p50120i7" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e7; ?>" name="E7_"></td><td><input type = "text" id="p50120i8" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e8; ?>" name="E8_"></td></tr>
              <tr><td><input type = "text"  id="p50120i9" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e9; ?>" name="E9_"></td><td><input type = "text"  id="p50120i10" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e10; ?>" name="E10_"></td><td><input type = "text"  id="p50120i11" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e11; ?>" name="E11_"></td><td><input type = "text" id="p50120i12" onkeypress="return justNumbers(event);"class="areas" style="width:90%;" value="<?php echo $e12; ?>" name="E12_"></td></tr>

      </div>
          </p>
        </tr>
         </tr>   </table> </td></tr>
         <script type="text/javascript">
 // permite determinar el estado de los campos de la seccion asignaturas a tener en cuenta en la solucion del parametro 44
 function setDisabledCampos(campos, valor){ // obtengo el conjunto de campos (array) y el valor (false o true)
        for(var j = 0; j < campos.length; j++){ // recorro el conjunto de campos
          campos[j].disabled = valor; // le asigno el valor que me pasaron por parametro a cada campo del conjunto de campos
        }
      }
      function determinarcampo( ){
        const EN_LAS_AREAS_DE = "3"; // determina el valor de la opcion que se debe elegir para activar los campos que este caso es areas especificas en la solucion del parametro 44
        // obtiene el conjunto de input type radio que contienen las diferentes opciones de la seccion de areas a tener en cuenta de la solucion del parametro 159
        var opciones = document.getElementsByName( "valorDesempate2_<?php echo $row_configuracion['conf_nombre']; ?>" ); 
        for( var i = 0; i < opciones.length; i++ ){ // recorro el conjunto de input type radio que contienen las opciones
          if(opciones[i].checked == true){ // determino cual opcion esta seleccionada
            campos = document.getElementsByClassName("areas"); // obtengo el conjunto de los 12 campos de las asignaturas especificas
            if(opciones[i].value == EN_LAS_AREAS_DE){ // determino si la opcion seleccionada es la de en las areas de
              setDisabledCampos(campos,false); // activo los 12 campos para que ingrese las areas especificas
            }else{ // la opcion seleccionada no es la de areas especificas
              setDisabledCampos(campos,true); // desactivo los 12 campos de areas especificas
            } // termino else
          } // termino if
        } // termino for
      }
        function determinarCamposAlCargarr(){ 
        const en_las_areas_de = "3"; // determinia el valor del input type radio que representa la opcion de areas epecificas
        var opcion = "<?php echo $array_parametro[15]?>"; // obtengo el valor guardado en la BD que determina la opcion que fue seleccionada y guardad
        var campos = document.getElementsByClassName("areas"); // obtengo el conjunto de los 12 campos de las areas especificas
        if (opcion == en_las_areas_de){ // si el valor traido es igual al valor que identifica la opcion areas especificas
          setDisabledCampos(campos, false); // activo los 12 campos
        }else{ // si el valor tradio es diferente fue porque se selecciono otra opcion diferente a areas especificas
          setDisabledCampos(campos, true); // desactivo los 12 campos
        }

      }
      		function seRepiteAreaa(){
				var campos = document.getElementsByClassName("areas"); // esta variable almacena el arreglo de los campos
				// determina si se repite algun area y si es asi muestra una alerta
				for(var i = 0; i < campos.length - 1; i++){ 
					for(var j = i + 1; j < campos.length; j++){
						if(campos[i].value == campos[j].value && campos[i].value != 0){
							sweetAlert("ERROR", "Revise que en el parametro 44 no se repitan areas", "warning");
							return false;

						}
					}
				}
			}
      </script>
				 <tr>
				 	<td><input type="checkbox" id="obtener_V"name="obtener_V" type="checkbox" value="2" <?php if  (strlen($obtener_V)>0) {echo "checked='checked'";} ?>> Obtener una valoraci&oacute;n M&iacute;nima de <input id="v133"style="width: 10%;" value="<?php echo $valorNota; ?>" name="valorNota_"  > en todas las &aacute;reas del grado que est&aacute; cursando</td>
				 </tr>
				 <tr class="fila1">
                     <td colspan="5" align="center"><div align="center"  id="inicio_periodo_promocion_120"><b>PROCEDIMIENTO PARA REGISTRO DE CALIFICACIONES <br> <br>  PARA CERTIFICADOS</b></div></td>
                 </tr>
                 <tr>
				 	<td><input type="radio" id="validarradio501201"<?php if (!(strcmp("A", $array_parametro[16]))) {echo "checked=checked";} ?> value="A" name="valorDesempate3_<?php echo $row_configuracion['conf_nombre']; ?>"> El certificado de estudios para la PROMOCI&Oacute;N ANTICIPADA saldr&aacute; del promedio de las calificaciones registradas en la prueba de suficiencia y la calificaci&oacute;n registrada en el periodo anterior a la promoci&oacute;n (1er periodo). 
<!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI.png":"images/ModProAnti/certificadoPROMANTI.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI.png":"images/ModProAnti/certificadoPROMANTI.png";									
						?>
<!--Acevedo-->
				 	</td>
            
                    
				 </tr>
				 <tr>
				 	<td><input type="radio" id="validarradio501202"<?php if (!(strcmp("B", $array_parametro[16]))) {echo "checked=checked";} ?> value="B" name="valorDesempate3_<?php echo $row_configuracion['conf_nombre']; ?>"> El certificado de estudios de la PROMOCI&Oacute;N ANTICIPADA saldr&aacute; con los resultados de las calificaciones obtenidas en la prueba de SUFICIENCIA y las obtenidas en las &aacute;reas fundamentales obligatorias del grado actual. 		&nbsp;		&nbsp;		&nbsp;
                   
                   <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI2.png":"images/ModProAnti/certificadoPROMANTI2.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI2.png":"images/ModProAnti/certificadoPROMANTI2.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
					<tr>
				 	<td><input type="radio" id="validarradio501203"<?php if (!(strcmp("C", $array_parametro[16]))) {echo "checked=checked";} ?> value="C" name="valorDesempate3_<?php echo $row_configuracion['conf_nombre']; ?>"> El certificado de estudios de la promoci&oacute;n anticipada por m&eacute;ritos, tomar&aacute; las calificaciones del registro efectuado durante el primer periodo del a&ntilde;o lectivo escolar.
                       <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI3.png":"images/ModProAnti/certificadoPROMANTI3.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/certificadoPROMANTI3.png":"images/ModProAnti/certificadoPROMANTI3.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
				  <tr class="fila1">
                     <td colspan="5" align="center"><div align="center"  id="inicio_periodo_promocion_120"><b>PARA CALIFICACIONES DEL PERIODO</b></div></td>
                 </tr>
				 <tr>
				 	<td><input type="radio" id="validarradio501204"<?php if (!(strcmp("A", $array_parametro[31]))) {echo "checked=checked";} ?> value="A" name="calificacion_A_<?php echo $row_configuracion['conf_nombre']; ?>"> Las calificaciones del primer periodo en el nuevo grado al cual ser&aacute; promovido el estudiante, corresponder&aacute;n a las registradas en el primer periodo del grado anterior y en el caso de no haber correspondencia de pensum, esas &aacute;reas ser&aacute;n HOMOLOGADAS tomando como base, las que se le registren en el segundo periodo del grado al cual ha sido promovido.
                        
                      <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
				 <tr>
				 	<td><input type="radio" id="validarradio501205"<?php if (!(strcmp("B", $array_parametro[31]))) {echo "checked=checked";} ?> value="B" name="calificacion_A_<?php echo $row_configuracion['conf_nombre']; ?>"> Las calificaciones del primer periodo en el nuevo grado al cual ser&aacute; promovido el estudiante, corresponder&aacute;n a las registradas en el primer periodo del grado anterior.
    <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
				 <tr>
				 	<td><input type="radio" id="validarradio501206"<?php if (!(strcmp("C", $array_parametro[31]))) {echo "checked=checked";} ?> value="C" name="calificacion_A_<?php echo $row_configuracion['conf_nombre']; ?>"> Las calificaciones del primer periodo en el nuevo grado al cual ser&aacute; promovido el estudiante, corresponder&aacute;n a las registradas en el primer periodo del grado anterior y en el caso de no haber correspondencia de pensum, esas &aacute;reas ser&aacute;n tomandas de la prueba de suficiencia.
                     
   <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
		 <tr>
				 	<td><input type="radio" id="validarradio501207"<?php if (!(strcmp("D", $array_parametro[31]))) {echo "checked=checked";} ?> value="D" name="calificacion_A_<?php echo $row_configuracion['conf_nombre']; ?>"> Las calificaciones del primer periodo en el nuevo grado al cual ser&aacute; promovido el estudiante, corresponder&aacute;n a las registradas en el segundo periodo del nuevo grado.
                    
                   <!--Acevedo-->
                    <?php		

					
  						    $title = "Vista Previa";
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";
							?>
							<a href="javascript:void(0)"  title="<?php echo $title;?>" onclick="return hs.expand(this, {src:'<?php echo $url;?>', wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
							Vista Previa
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
				  			<?php				
							$url = ($row_config_planilla['conf_pla_subje'] == 1)?"images/ModProAnti/boletinesPROMANTI.png":"images/ModProAnti/boletinesPROMANTI.png";									
						?>
<!--Acevedo-->
				 	</td>
				 </tr>
			 </table> 
</div>
</div>
</div>
</div>
</div>
		<?php
		break;

		case 135:

		$valoresP59 = explode("$", $row_configuracion['conf_valor']);		

		?>

<!-- --------------------------------------------------------------------------------------------- PARAMETRO 57 ---------------------------------------------------- -->

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem </div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		<table>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"a") == true)  {echo "checked=checked";} ?> value="a" name="a_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por m&eacute;ritos</b> (ver condiciones en el par&aacute;metro No <b>50/120</b></td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"b") == true)  {echo "checked=checked";} ?> value="b" name="b_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n anticipada para Retirados:</b> V&aacute;lido para  estudiantes que se retiran antes de finalizar el a&ntilde;o, con un abono del 75% de avance acad&eacute;mico y el certificado se genera, solo al final del a&ntilde;o.</td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"c") == true)  {echo "checked=checked";} ?> value="c" name="c_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por Reprobaci&oacute;n de Grados;</b> disponible para estudiantes Reprobados a&ntilde;o anterior.</td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"d") == true)  {echo "checked=checked";} ?> value="d" name="d_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por Casu&iacute;stica:</b> Proceso habilitado para casos de: solo al corte del tercer periodo debidamente finalizado 75%, con un abono del 75% de avance acad&eacute;mico y el certificado se genera, solo al final del a&ntilde;o.</td></tr>

		</table>

</div>

</div>

</div>

</div>

</div>

<!-- ---------------------------------------------------------------------------------------- FIN PARAMETRO 57 -------------------------------------------------------------------- -->

		<?php

		break;

		case 150: //Ingresar notas despues del cierre de areasObligatorias
		?>

			<?php
			if(strpos($row_configuracion['conf_valor'],"$")>0)
			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);
				$cri = $array_parametro[0];

				$cri2 = $array_parametro[1];

				$cri3 = $array_parametro[2];

			}


			else

				$cri = $row_configuracion['conf_valor'];
		?>
		<label>

		  <select class="sele_mul" name="criterio_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio_<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="S" <?php if (!(strcmp("S", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

		  </select> 

		</label>  <br><br>  <hr>

		<br><br><br>

	<label>

<?php 
$query_consulta_humanidades = "SELECT * FROM aes WHERE b LIKE '%humanidades%'";
$consulta_humanidades = mysql_query($query_consulta_humanidades, $link);
$row_consulta_humanidades = mysql_fetch_assoc($consulta_humanidades);

if ($row_consulta_humanidades == "")
{
?>
<label>NO APLICA</label>
<?php
}
else{
?>
		  <select class="sele_mul" name="criterio2_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio2_<?php echo $row_configuracion['conf_nombre']; ?>">
			<option value="S" <?php if (!(strcmp("S", $cri2['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>
			<option value="N" <?php if (!(strcmp("N", $cri2['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>
		  </select> 

<?php
}
?>

		</label> <br><br> <hr>

			<br><br>

			<label>

		  <select class="sele_mul" name="criterio3_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio3_<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="S" <?php if (!(strcmp("S", $cri3['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

			<option value="N" <?php if (!(strcmp("N", $cri3['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

		  </select> 

		</label>

		<?php

		break;
		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (75,90,101,103,107,118,119,130,131,133,134,138,139)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosg=mysqli_query($conexion,"select * from conf_sygescol_adic where id=7")or die("Problemas en la Consulta".mysqli_error());while ($regg=mysqli_fetch_array($registrosg)){$coloracordg=$regg['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_constancias_certificados" style="background-color: <?php echo $coloracordg ?>"><center><strong>PAR&Aacute;METROS PARA CONTROL DE REPORTES, CONSTANCIAS Y CERTIFICADOS</strong></center><br /><center><input type="radio" value="rojog" name="coloresg">Si&nbsp;&nbsp;<input type="radio" value="naranjag" name="coloresg">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 75: //forma_ing_fallas

		?>

		<div style="text-align: left;"	>

		<p>Para cambiar el estado acad&eacute;mico del estudiante, la Instituci&oacute;n educativa, <b>AUTORIZA</b>:</p>

		<table>

		<tr><td><input type="radio" <?php echo ($row_configuracion['conf_valor'] == 0)?'checked="checked"':'';?> value="0" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>No aplica</td></tr>

		<tr><td><input type="radio" <?php echo ($row_configuracion['conf_valor'] == 1)?'checked="checked"':'';?> value="1" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Reprobando &aacute;reas promovidas del estudiante</td></tr>

		<tr><td><input type="radio" <?php echo ($row_configuracion['conf_valor'] == 2)?'checked="checked"':'';?> value="2" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Eliminando de la Base de Datos "TODA" la informaci&oacute;n acad&eacute;mica y administrativa del afectado, en el a&ntilde;o correspondiente.</td></tr>

		</table>

		</div>

		<?php

		break;

		case 90: //MAS FAMILIAS EN ACCION

		?>

		<?php

			$estado = '';

			if(strpos($row_configuracion['conf_valor'],"$")>0)

			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);

				$parametro = $array_parametro[0];

				$nivel = $array_parametro[1];

				$estado = $array_parametro[2];

				$demo=$array_parametro[3];

			}

			else

				$parametro = $row_configuracion['conf_valor'];

		?>

			<!-- PARAMETRO 15 -->

			<table width="90%">

			 	<tr>

			 		

			 		<td><b> Aplica</b>

			 			<select class="sele_mul" onclick="validar5690()" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

							<option value="S" id="90m"<?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

							<option value="N" id="90o"<?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

			  			</select>

			  		</td>

			  	</tr>

</table>

 

     <div id="90">

			

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"><h4>Si aplica defina:</h4></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

						

			<table width="90%">

				<tr>

				 	 <td><h4>Si aplica defina:</h4></td></a>

				 	<td>

							

						 <select id="<?php echo $row_configuracion['conf_nombre']."_ingreso"; ?>"  name="<?php echo $row_configuracion['conf_nombre']."_nivel"; ?>" onchange="myFunction(this)" class="sele_mul" style="width: 250px;">

				<option <?php echo ($nivel == '0')?'selected="selected"':''; ?>  value="0">Seleccione uno ... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

							<option <?php echo ($nivel == '1')?'selected="selected"':''; ?>  value="1">Activar control del reporte por biometr&iacute;a desde el 	DD/MM/AA</option>

							<option <?php echo ($nivel == '2')?'selected="selected"':''; ?> value="2">Emplear la planilla de Inasistencia Virtual</option>

							<option <?php echo ($nivel == '3')?'selected="selected"':''; ?> value="3">Habilite el perfil &#8220;Auxiliar Registro de Inasistencias&#8221;, 	proceso que dejar&aacute; inhabilitado en captura de datos la planilla virtual de inasistencias.</option>

							<!--<option <?php echo ($nivel == '4')?'selected="selected"':''; ?> value="4">Las 3 Opciones Anteriores</option> -->

						</select>

						

						<input id="<?php echo $row_configuracion['conf_nombre']."_demo"; ?>" type="date" value="<?php echo $demo; ?>" name="<?php echo $row_configuracion['conf_nombre']."_demo"; ?>" <?php echo ($nivel == '1')?'style="display: block;"':'style="display: none;"'; ?> >

							<script>

							function myFunction(coleto) {

								if (coleto.value == 1) {

									document.getElementById("<?php echo $row_configuracion['conf_nombre']."_demo"; ?>").style.display = "block";

								}else{

									document.getElementById("<?php echo $row_configuracion['conf_nombre']."_demo"; ?>").style.display = "none";

								}

							}

							</script>

 <script>

function validar5690() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

 document.getElementById("<?php echo $row_configuracion['conf_nombre'].'_ingreso'; ?>").disabled = false;

document.getElementById("<?php echo $row_configuracion['conf_nombre'].'_demo'; ?>").disabled = false;

}

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")

{

 document.getElementById("<?php echo $row_configuracion['conf_nombre'].'_ingreso'; ?>").disabled = true;

document.getElementById("<?php echo $row_configuracion['conf_nombre'].'_demo'; ?>").disabled = true;

}

    

}

	addEvent('load', validar5690); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

</script>

					</td>

				</tr>

				</table>

	</div>

				</div>

			</div>

			</div>

	</div>

</div>

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"><b style="color: red;">NOTA IMPORTANTE:</b></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		

<table width="90%">

				<tr>

					<td colspan="2" style="border: solid 2px #CE6767;border-radius: 10px;">

						<b style="color: red;">NOTA IMPORTANTE:</b> <br><p style="line-height: 20px;"><b>CICLOS DE TIEMPO PARA LA GENERACI&oacute;N DEL REPORTE: </b><br>

						Administre los tiempos de generaci&oacute;n del reporte, de acuerdo a lo establecido por la Alcald&iacute;a o el ente regulador que solicita esta informaci&oacute;n, ingresando las fechas correspondientes a cada ciclo, desde la ruta: <b><u>PERFIL SECRETARIA ACAD&eacute;MICA / Sistema / tablas b&aacute;sicas / Ciclos de Familias en Acci&oacute;n.</u></b>

						<b style="color: red;"><u>TENGA EN CUENTA QUE:</u></b> Para el reporte del <b style="color: red;">PRIMER CICLO</b> de <i><b>&#8220;M&aacute;s Familias en Acci&oacute;n&#8221;</b></i>, el sistema generar&aacute; la certificaci&oacute;n, despu&eacute;s de verificar que el <b>ESTADO DE MATR&iacute;CULA del estudiante</b> est&eacute; <b>ACTIVO</b>. Para los <b style="color: red;">ciclos siguientes</b>, verificar&aacute; que la asistencia del estudiante corresponda al <b>80%</b> del ciclo consultado.</p>

					</td>

				</tr>

			</table>

	</div>

				</div>

			</div>

			</div>

	</div>

			<!-- FIN PARAMETRO 15 -->

		<?php

		break;

			case 101:

			$variablesSep = explode("@",$row_configuracion['conf_valor']);

			$valoresCertificados = explode(",",$variablesSep[0]); // Certificados

			$valoresConstancias = explode(",",$variablesSep[1]); // Constancias

		?>

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd">Certificados de estudio</div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<table >

			<tr>

				<td colspan="2"><h3><u>Certificados de estudio, iniciar en:</u></h3></td>

			</tr>

			<tr>

				<td><input type="radio" <?php if($valoresCertificados[0]==I){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="I"></td>

				<td>Consecutivo al inicio  (Ej: <b style="color: red">0001</b>-CER).</td>

			</tr>

			<tr>

				<td><input type="radio" <?php if($valoresCertificados[0]==F){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="F"></td>

				<td>Consecutivo al final   (Ej: CER-<b style="color: red">0001</b>).</td>

			</tr>	

			

			</table>

			</div></div></div></div></div>

<div class="container_demohrvszv"> 

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd">Constancias</div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

					<table>

			<tr>

				<td colspan="2"><h3><u>Constancias, iniciar en:</u></h3></td>

			</tr>

			<tr>

				<td><input type="radio" <?php if($valoresConstancias[0]==I){ echo 'checked="checked"'; }?> name="constancia_<?php echo $row_configuracion['conf_nombre']; ?>" value="I"></td>

				<td>Consecutivo al inicio  (Ej: <b style="color: red">0001</b>-CON).</td>

			</tr>

			<tr>

				<td><input type="radio" <?php if($valoresConstancias[0]==F){ echo 'checked="checked"'; }?> name="constancia_<?php echo $row_configuracion['conf_nombre']; ?>" value="F"></td>

				<td>Consecutivo al final   (Ej: CON-<b style="color: red">0001</b>).</td>

			</tr>	
		</table>

		</div></div></div></div></div>

		<?php 

		break;

case 103:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

case 107:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				 

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

case 118:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	

				  </td>

				 </tr>

			

			</table> 

					<?php

		break;

		//* ---------------------------------------------------------- caso  103  -----------------------------------------------------------------------

		//* ----------------------------------------------------------  caso 107  --------------------------------------------------------------------

				//* ---------------------------------------------------------- caso 118 -----------------------------------------------------

		case 119: //Hoja de vida

		

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					

					$docentes = $array_parametro[1];

					$docentes_D = $array_parametro[2];

					$administrativos = $array_parametro[3];

					$estudiantes = $array_parametro[4];

					$_fecha_1 = $array_parametro[6];

					$_fecha_2 = $array_parametro[7];

					$_fecha_3 = $array_parametro[8];

					$_fecha_4 = $array_parametro[9];

					$parametro = $array_parametro[10];			

				?>

<b>Aplica</b>

				

				 <select class="sele_mul" onclick="validar119()"name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

			 <table  width="90%" >

				 <tr>

					<td><input  id="p119_1" name="docentes" type="checkbox" value="1" <?php if (strlen($docentes)>0) {echo "checked='checked'";} ?>> Para <b>Docentes</b> a partir de :<td>

					<input name="<?php echo $row_configuracion['conf_nombre']."_fecha_1"; ?>" id="<?php echo $row_configuracion['conf_nombre']."_fecha_1"; ?>" type="text" size="7" readonly="readonly" value="<?php echo $_fecha_1; ?>" /><td>

		  			<button name="aaa_<?php echo $row_configuracion['conf_nombre']; ?>" id="aaa_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>

				</td></td></td>

				 </tr>

				  <tr>

				<td><input id="p119_2" name="docentes_D" type="checkbox" value="2" <?php if (strlen($docentes_D)>0) {echo "checked='checked'";} ?>> Para <b>Docentes Directivos</b> a partir de :			<td>

					<input name="<?php echo $row_configuracion['conf_nombre']."_fecha_2"; ?>" id="<?php echo $row_configuracion['conf_nombre']."_fecha_2"; ?>" type="text" size="7" readonly="readonly" value="<?php echo $_fecha_2; ?>" /><td>

		  			<button name="bbb_<?php echo $row_configuracion['conf_nombre']; ?>" id="bbb_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>

				</td></td></td>

				 </tr>

				  <tr>

				<td><input  id="p119_3" name="administrativos" type="checkbox" value="3" <?php if (strlen($administrativos)>0) {echo "checked='checked'";} ?>> Para <b>Administrativos</b> a partir de :	<td>

					<input name="<?php echo $row_configuracion['conf_nombre']."_fecha_3"; ?>" id="<?php echo $row_configuracion['conf_nombre']."_fecha_3"; ?>" type="text" size="7" readonly="readonly" value="<?php echo $_fecha_3; ?>" /><td>

		  			<button name="ccc_<?php echo $row_configuracion['conf_nombre']; ?>" id="ccc_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>

				</td></td></td>

				 </tr>

				  <tr>

				<td><input  id="p119_4" name="estudiantes" type="checkbox" value="4" <?php if (strlen($estudiantes)>0) {echo "checked='checked'";} ?>> Para <b>Estudiantes</b> a partir de :<td>

					<input name="<?php echo $row_configuracion['conf_nombre']."_fecha_4"; ?>" id="<?php echo $row_configuracion['conf_nombre']."_fecha_4"; ?>" type="text" size="7" readonly="readonly" value="<?php echo $_fecha_4; ?>" /><td>

		  			<button name="ddd_<?php echo $row_configuracion['conf_nombre']; ?>" id="ddd_<?php echo $row_configuracion['conf_nombre']; ?>" value="">.</button>

				</td></td></td>

				 </tr>

				  <tr>

				<td><input id="p119_5" type="radio" <?php if (strpos($row_configuracion['conf_valor'],"1")==true) {echo "checked='checked'";} ?> value="1" name="controlBoletines<?php echo $row_configuracion['conf_nombre']; ?>" > Con control de entrega de boletines </td>

				 </tr>

				  <tr>

				<td><input  id="p119_6" type="radio" <?php if (strpos($row_configuracion['conf_valor'],"2")==true) {echo "checked='checked'";} ?> value="2" name="controlBoletines<?php echo $row_configuracion['conf_nombre']; ?>" > Sin control de entrega de boletines </td>

		

			</table>

</div>

</div>

</div>

</div>

</div>

  <script>

function validar119() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S")

{

document.getElementById("p119_1").disabled = false;

document.getElementById("p119_2").disabled = false;

document.getElementById("p119_3").disabled = false;

document.getElementById("p119_4").disabled = false;

document.getElementById("p119_5").disabled = false;

document.getElementById("p119_6").disabled = false;

 document.getElementById("aaa_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

document.getElementById("bbb_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

document.getElementById("ccc_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

document.getElementById("ddd_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = false;

}

if(document.getElementById("<?php echo $row_configuracion['conf_nombre']; ?>").value=="N")

{

document.getElementById("p119_1").disabled = true;

document.getElementById("p119_2").disabled = true;

document.getElementById("p119_3").disabled = true;

document.getElementById("p119_4").disabled = true;

document.getElementById("p119_5").disabled = true;

document.getElementById("p119_6").disabled = true;

 document.getElementById("aaa_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;

	document.getElementById("bbb_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;

		document.getElementById("ccc_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;

			document.getElementById("ddd_<?php echo $row_configuracion['conf_nombre']; ?>").disabled = true;
}
}

	addEvent('load', validar119); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>

		<?php

		break;

		case 130:

		?>

		<table><td></td> <td>

		  <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		  	<option value="ECCF" <?php if (!(strcmp("ECCF", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Estudiante con copia y filigrama</option>

			<option value="PDEC" <?php if (!(strcmp("PDEC", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Para dos estudiantes sin copia</option>			

		  </select>

		</td></table>

		<?php

		break;

		case 131:

		?>

		<table><td></td> <td>

		  <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

		<option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		  	<option value="1" <?php if (!(strcmp("1", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Una hoja por estudiante</option>

			<option value="2" <?php if (!(strcmp("2", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Dos Estudiantes por hoja </option>			

		  </select>

		</td></table>

		<?php

		break;		

	case 133:

				//explode para Basica Primaria

     			$arrayAsignaturas = array();

     			$valoreParametro = explode("/", $row_configuracion['conf_valor']);

				$array_parametro = explode("$",$valoreParametro[1]);

$variablesSep = explode("@",$row_configuracion['conf_valor']);

			$valoresCertificados = explode(",",$variablesSep[0]); // Certificados

			$valoresConstancias = explode(",",$variablesSep[1]); // Constancias

				for ($i=0; $i <= count($array_parametro) ; $i++) { 

					$valoresDetalle = explode("_", $array_parametro[$i]);

					$arrayAsignaturas[$valoresDetalle[1]] = $valoresDetalle[0];

				}

				//explode para Basica Secundaria

     			$arrayAsignaturas2 = array();

     			$valoreParametro2 = explode("/", $row_configuracion['conf_valor']);

				$array_parametro2 = explode("$",$valoreParametro2[2]);

		

				for ($i=0; $i <= count($array_parametro2) ; $i++) { 

					$valoresDetalle2 = explode("_", $array_parametro2[$i]);

					

					$arrayAsignaturas2[$valoresDetalle2[1]] = $valoresDetalle2[0];

				

				}

				//explode para Media Decimo

     			$arrayAsignaturas3 = array();

     			$valoreParametro3 = explode("/", $row_configuracion['conf_valor']);

				$array_parametro3 = explode("$",$valoreParametro3[3]);

				for ($i=0; $i <= count($array_parametro3) ; $i++) { 

					$valoresDetalle3 = explode("_", $array_parametro3[$i]);

					$arrayAsignaturas3[$valoresDetalle3[1]] = $valoresDetalle3[0];

					//ECHO '______'.$arrayAsignaturas3[$valoresDetalle3[3]] = $valoresDetalle3[0];

				}

				//explode para Media Once

     			$arrayAsignaturas4 = array();

     			$valoreParametro4 = explode("/", $row_configuracion['conf_valor']);

				$array_parametro4 = explode("$",$valoreParametro4[4]);

				for ($i=0; $i <= count($array_parametro4) ; $i++) { 

					$valoresDetalle4 = explode("_", $array_parametro4[$i]);

					$arrayAsignaturas4[$valoresDetalle4[1]] = $valoresDetalle4[0];

				}

				//explode para Ciclos

     			$arrayAsignaturas5 = array();

     			$valoreParametro5 = explode("/", $row_configuracion['conf_valor']);

				$array_parametro5 = explode("$",$valoreParametro5[5]);

				for ($i=0; $i <= count($array_parametro5) ; $i++) { 

					$valoresDetalle5 = explode("_", $array_parametro5[$i]);

					$arrayAsignaturas5[$valoresDetalle5[1]] = $valoresDetalle5[0];

				}

				$link = conectarse();

				mysql_select_db($database_sygescol,$link);

				$sel_consulta_areas = "SELECT * FROM aes ";

				$sql_consulta_areas = mysql_query($sel_consulta_areas, $link);

		?>

		<script type="text/javascript">

				function pagoOnChange(sel) {

				      if (sel.value=="primaria"){

				           divC = document.getElementById("basica_Primaria");

				           divC.style.display = "";

				           divT = document.getElementById("basica_Secundaria");

				           divT.style.display = "none";

				           divA = document.getElementById("media_decimo");

				           divA.style.display = "none";

				           divB = document.getElementById("media_once");

				           divB.style.display = "none";

				            divD = document.getElementById("ciclos_adultos");

				           divD.style.display = "none";

				      }else if(sel.value=="secundaria"){

				      divC = document.getElementById("basica_Primaria");

				           divC.style.display = "none";

				           divT = document.getElementById("basica_Secundaria");

				           divT.style.display = "";

				           divA = document.getElementById("media_decimo");

				           divA.style.display = "none";

				           divB = document.getElementById("media_once");

				           divB.style.display = "none";

				            divD = document.getElementById("ciclos_adultos");

				           divD.style.display = "none";

				      }else if(sel.value=="decimo"){

				       divC = document.getElementById("basica_Primaria");

				           divC.style.display = "none";

				           divT = document.getElementById("basica_Secundaria");

				           divT.style.display = "none";

				           divA = document.getElementById("media_decimo");

				           divA.style.display = "";

				           divB = document.getElementById("media_once");

				           divB.style.display = "none";

				            divD = document.getElementById("ciclos_adultos");

				           divD.style.display = "none";

				      }else if(sel.value=="once"){

				            divC = document.getElementById("basica_Primaria");

				           divC.style.display = "none";

				           divT = document.getElementById("basica_Secundaria");

				           divT.style.display = "none";

				           divA = document.getElementById("media_decimo");

				           divA.style.display = "none";

				           divB = document.getElementById("media_once");

				           divB.style.display = "";

				            divD = document.getElementById("ciclos_adultos");

				           divD.style.display = "none";

				      }else if(sel.value=="ciclos"){

				      	   divC = document.getElementById("basica_Primaria");

				           divC.style.display = "none";

				           divT = document.getElementById("basica_Secundaria");

				           divT.style.display = "none";

				           divA = document.getElementById("media_decimo");

				           divA.style.display = "none";

				           divB = document.getElementById("media_once");

				           divB.style.display = "none";

				            divD = document.getElementById("ciclos_adultos");

				           divD.style.display = "";

				      }

				}

		</script>

<div class="container_demohrvszv">		  

<div class="accordion_example2wqzx">			 

<div class="accordion_inwerds">

<div class="acc_headerfgd">&Iacute;tem </div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<table class="formulario55">

			<tr>   

				<th>Si aplica defina:</th><td>

					<div id="scroll" style="overflow: scroll; height: 421px;">

					<table >

						<tr><td><input type="radio" id="radio1534a" <?php if($valoresCertificados[0]==I){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="I"></td><td>Tener en cuenta solo el promedio (permite la duplicidad del puesto)</td></tr>

						

						<tr ><td><input type="radio" id="radio1533a"<?php if($valoresCertificados[0]==F){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="F"><td>Incluir en el filtro el desempate con las &aacute;reas de:</td> </tr>

							<th colspan="2">Niveles</th>

							<tr> <th colspan="2" >

								<select class="sele_mul"  onChange="pagoOnChange(this)" >

									

									<!--<option>Seleccione Uno...</option>-->

									<option value="primaria">Basica Primaria</option>

									<option value="secundaria">Basica Secundaria</option>

									<option value="decimo">Media Decimo</option>

									<option value="once">Media Once</option>

									<option value="ciclos">Ciclos</option>

								</select>

								</th>

							</tr>

						<tr>

						<?php 

							//areas para Basica primaria

							echo '<tr><td colspan="2"><div id="basica_Primaria" style="display:;">';

							mysql_data_seek($sql_consulta_areas, 0);

							while ($row_consulta_areas = mysql_fetch_assoc($sql_consulta_areas)) {

										echo '<input type="text" onkeypress="return justNumbers(event);" 

name="area_'.$row_consulta_areas[i].'" value="'.$arrayAsignaturas[$row_consulta_areas[i]].'" style="border-radius: 10px; width: 8%;"> '.$row_consulta_areas['b'].'<br>';

								

							}

							echo '</div></td></tr>';

							//areas para Basica secundaria

							echo '<tr><td colspan="2"><div id="basica_Secundaria" style="display:none;">';

							mysql_data_seek($sql_consulta_areas, 0);

							while ($row_consulta_areas2 = mysql_fetch_assoc($sql_consulta_areas)) {

								

										echo '<input type="text" onkeypress="return justNumbers(event);" 

name="area2_'.$row_consulta_areas2[i].'" value="'.$arrayAsignaturas2[$row_consulta_areas2[i]].'" style="border-radius: 10px; width: 8%;"> '.$row_consulta_areas2['b'].'<br>';

								

							}

							echo '</div></td></tr>';

							//areas para Media Decimo

							echo '<tr><td colspan="2"><div id="media_decimo" style="display:none;">';

							mysql_data_seek($sql_consulta_areas, 0);

							while ($row_consulta_areas3 = mysql_fetch_assoc($sql_consulta_areas)) {

						

										echo '<input type="text" onkeypress="return justNumbers(event);" 

name="area3_'.$row_consulta_areas3[i].'" value="'.$arrayAsignaturas3[$row_consulta_areas3[i]].'" style="border-radius: 10px; width: 8%;"> '.$row_consulta_areas3['b'].'<br>';

								

							}

							echo '</div></td></tr>';

							//areas para Media Once

							echo '<tr><td colspan="2"><div id="media_once" style="display:none;">';

							mysql_data_seek($sql_consulta_areas, 0);

							while ($row_consulta_areas4 = mysql_fetch_assoc($sql_consulta_areas)) {

						

										echo '<input type="text" onkeypress="return justNumbers(event);" 

name="area4_'.$row_consulta_areas4[i].'" value="'.$arrayAsignaturas4[$row_consulta_areas4[i]].'" style="border-radius: 10px; width: 8%;"> '.$row_consulta_areas4['b'].'<br>';

								

							}

							echo '</div></td></tr>';

							//areas para Ciclos

							echo '<tr><td colspan="2"><div id="ciclos_adultos" style="display:none;">';

							mysql_data_seek($sql_consulta_areas, 0);

							while ($row_consulta_areas5 = mysql_fetch_assoc($sql_consulta_areas)) {

										echo '<input type="text" onkeypress="return justNumbers(event);" 

name="area5_'.$row_consulta_areas5[i].'" value="'.$arrayAsignaturas5[$row_consulta_areas5[i]].'" style="border-radius: 10px; width: 8%;"> '.$row_consulta_areas5['b'].'<br>';			

		}

	echo '</div></td></tr>';

?>

		</tr>

			</table>

			</div>

			</td>

			</tr>

</table>

</div>

</div>

</div>

</div>

</div>

		<?php

		break;

		case 134:

		?>

		<table><td></td> <td>

		  <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

 <option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		  	<option value="AEC" <?php if (!(strcmp("AEC", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Antes de la encuesta de continuidad</option>

			<option value="LMA" <?php if (!(strcmp("LMA", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Al momento de legalizar la matr&iacute;cula administrativa</option>		

				<option value="DTA" <?php if (!(strcmp("LMA", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Durante todo el a&ntilde;o</option>			

		  </select>

		</td></table>

		<?php

		break;

		case 135:

		$valoresP59 = explode("$", $row_configuracion['conf_valor']);		

		?>

	<div class="container_demohrvszv">

	<div class="accordion_example2wqzx">

	<div class="accordion_inwerds">

	<div class="acc_headerfgd"><strong>&Iacute;tem</strong> </div>

	<div class="acc_contentsaponk">

	<div class="grevdaiolxx">

		<table>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"a") == true)  {echo "checked=checked";} ?> value="a" name="a_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por m&eacute;ritos</b> (ver condiciones en el par&aacute;metro No <b>46</b></td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"b") == true)  {echo "checked=checked";} ?> value="b" name="b_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n anticipada para Retirados:</b> V&aacute;lido para  estudiantes que se retiran antes de finalizar el a&ntilde;o, con un abono del 75% de avance acad&eacute;mico y el certificado se genera, solo al final del a&ntilde;o.</td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"c") == true)  {echo "checked=checked";} ?> value="c" name="c_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por Reprobaci&oacute;n de Grados;</b> disponible para estudiantes Reprobados a&ntilde;o anterior.</td></tr>

			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"d") == true)  {echo "checked=checked";} ?> value="d" name="d_<?php echo $row_configuracion['conf_nombre']; ?>"></td>

			<td><b>Promoci&oacute;n Anticipada por Casu&iacute;stica:</b> Proceso habilitado para casos de: solo al corte del tercer periodo debidamente finalizado 75%, con un abono del 75% de avance acad&eacute;mico y el certificado se genera, solo al final del a&ntilde;o.</td></tr>

		</table>

</div>

</div>

</div>

</div>

</div>

		<?php

		break;

			case 138:

		?>

		<div class="container_demohrvszv">

		<div class="accordion_example2wqzx">

		<div class="accordion_inwerds">

		<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

		<div class="acc_contentsaponk">

		<div class="grevdaiolxx">

	<p style="text-align: left;margin:15px;">

			<b>LIBRO DE MATR&Iacute;CULAS - LIBRO FINAL DE VALORACIONES</b><br>

			Foliarlo filtrado por:<br>

			<select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

<option value="0" <?php if (!(strcmp("0", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Seleccione uno... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

				<option value="1" <?php if (!(strcmp("1", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Sedes y Jornadas en orden de llegada</option>

				<option value="2" <?php if (!(strcmp("2", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Sedes y Jornadas en orden Alfab&eacute;tico</option>

				<option value="3" <?php if (!(strcmp("3", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grados en orden de llegada</option>

				<option value="4" <?php if (!(strcmp("4", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grados en orden Alfab&eacute;tico</option>

				<option value="5" <?php if (!(strcmp("5", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grupos en orden de llegada</option>

				<option value="6" <?php if (!(strcmp("6", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grupos en orden Alfab&eacute;tico</option>

				<option value="7" <?php if (!(strcmp("7", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grupos y por sedes y por llegada</option>

				<option value="8" <?php if (!(strcmp("8", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Grupos y por sedes alfab&eacute;ticamente</option>												

			</select>

		</p>		

		</div></div></div></div></div>	

		<?php

		break;

			case 139:

		?>

		<div class="container_demohrvszv">  

		<div class="accordion_example2wqzx"> 

		<div class="accordion_inwerds">

		<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

		<div class="acc_contentsaponk">

		<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

			<b>LIBRO DE MATR&Iacute;CULAS - LIBRO FINAL DE VALORACIONES</b><br>

			Foliarlo filtrado por:<br><br>
				<input type="checkbox" name="1_<?php echo $row_configuracion['conf_nombre']; ?>" value="1" <?php if (strpos($row_configuracion['conf_valor'],"1") == true )    {echo "checked=checked";} ?>>Nivel Preescolar<br>

				<input type="checkbox" name="2_<?php echo $row_configuracion['conf_nombre']; ?>" value="2" <?php if (strpos($row_configuracion['conf_valor'],"2") == true )  {echo "checked=checked";} ?>>Nivel B&aacute;sica Primaria<br>

				<input type="checkbox" name="3_<?php echo $row_configuracion['conf_nombre']; ?>" value="3" <?php if (strpos($row_configuracion['conf_valor'],"3") == true )  {echo "checked=checked";} ?>>Nivel B&aacute;sica Secundaria<br>

				<input type="checkbox" name="4_<?php echo $row_configuracion['conf_nombre']; ?>" value="4" <?php if (strpos($row_configuracion['conf_valor'],"4") == true )    {echo "checked=checked";} ?>>Nivel Media Decimo<br>

                <input type="checkbox" name="5_<?php echo $row_configuracion['conf_nombre']; ?>" value="5" <?php if (strpos($row_configuracion['conf_valor'],"5") == true )    {echo "checked=checked";} ?>>Nivel Media Once<br>

				<input type="checkbox" name="6_<?php echo $row_configuracion['conf_nombre']; ?>" value="6" <?php if (strpos($row_configuracion['conf_valor'],"6") == true )    {echo "checked=checked";} ?>>Ciclos Basica Primaria<br>

                <input type="checkbox" name="7_<?php echo $row_configuracion['conf_nombre']; ?>" value="7" <?php if (strpos($row_configuracion['conf_valor'],"7") == true )    {echo "checked=checked";} ?>>Ciclos Basica Secundaria<br>

                <input type="checkbox" name="8_<?php echo $row_configuracion['conf_nombre']; ?>" value="8" <?php if (strpos($row_configuracion['conf_valor'],"8") == true )    {echo "checked=checked";} ?>>Ciclos Media<br>
		   
	
				<input type="checkbox" name="11_<?php echo $row_configuracion['conf_nombre']; ?>" value="11" <?php if (strpos($row_configuracion['conf_valor'],"11") == true )  {echo "checked=checked";} ?>>Modalidad Aceleraci&oacute;n del Aprendizaje<br>

				<input type="checkbox" name="12_<?php echo $row_configuracion['conf_nombre']; ?>" value="12" <?php if (strpos($row_configuracion['conf_valor'],"12") == true )  {echo "checked=checked";} ?>>Modalidad Necesidades Educativas NEE<br>

                <input type="checkbox" name="13_<?php echo $row_configuracion['conf_nombre']; ?>" value="13" <?php if (strpos($row_configuracion['conf_valor'],"13") == true )  {echo "checked=checked";} ?>>Grupos Juveniles Basica Primaria<br>

                <input type="checkbox" name="14_<?php echo $row_configuracion['conf_nombre']; ?>" value="14" <?php if (strpos($row_configuracion['conf_valor'],"14") == true )  {echo "checked=checked";} ?>>Grupos Juveniles Secundaria<br>

                <input type="checkbox" name="15_<?php echo $row_configuracion['conf_nombre']; ?>" value="15" <?php if (strpos($row_configuracion['conf_valor'],"15") == true )  {echo "checked=checked";} ?>>Grupos Juveniles Media<br>

		</p>

		</div></div></div></div></div>

		<?

		break;

		}

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (104,91)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

}?>

<?php 

include ("conb.php");$registrosh=mysqli_query($conexion,"select * from conf_sygescol_adic where id=8")or die("Problemas en la Consulta".mysqli_error());while ($regh=mysqli_fetch_array($registrosh)){$coloracordh=$regh['valor'];}

?>

<div class="container_demohrvszv_caja_1">

<div class="accordion_example2wqzx_caja_2">	 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_acudientes" style="background-color: <?php echo $coloracordh ?>"><center><strong>PAR&Aacute;METROS PARA INTERACCI&Oacute;N CON ACUDIENTES</strong></center><br /><center><input type="radio" value="rojoh" name="coloresh">Si&nbsp;&nbsp;<input type="radio" value="naranjah" name="coloresh">No</div></center>

				<div class="acc_contentsaponk_caja_4">

<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

<div class="container_demohrvszv" >

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

   <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

  <?php echo $row_configuracion['conf_descri']; ?>

     

</div> 

</div>

</div>

</div>

</div>

</div>

 </td>

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

		case 91: //DOCUMENTOS LEGALES
			$estado = '';
			if(strpos($row_configuracion['conf_valor'],",")>0)
			{
				$array_parametro = explode(",",$row_configuracion['conf_valor']);
				$primero = $array_parametro[2];
				$segundo = $array_parametro[3];
				$cuarto = $array_parametro[4];
				$quinto = $array_parametro[5];
				$sexto = $array_parametro[6];
				$septimo = $array_parametro[7];
				$octavo = $array_parametro[8];
				$noveno = $array_parametro[9];
				$decimo = $array_parametro[10];
				$once = $array_parametro[11];
				$doce = $array_parametro[12];
				$trece = $array_parametro[13];
				$catorce = $array_parametro[14];
				$quince = $array_parametro[15];
				$diesiseis_estu = $array_parametro[16];

				$diesiseis = $array_parametro[31];
				//desde la posicion 16 hasta la 23

				
			}     
			else{
				$parametro = $row_configuracion['conf_valor'];
}

				
				$selDocumentoAutorizado = "SELECT * FROM documentos_legales WHERE parametro=1 and docu_legal_id NOT IN(10,11,12,13,14,2,9,18)";
				
				$sqlDocumentoAutorizado = mysql_query($selDocumentoAutorizado, $link)or die(mysql_error());	

				?>
			 <table width="70%" >
			 <tr><td></td>
			 <td>
			 <select class="sele_mul" onclick="validar6691();validar66912()" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
				<option value="S,A" <?php if (substr($row_configuracion['conf_valor'],0,1)=="S") {echo "selected=\"selected\"";} ?>>Aplica</option>
				<option value="N" <?php if (substr($row_configuracion['conf_valor'],0,1)=="N") {echo "selected=\"selected\"";} ?>>No Aplica</option>
			  </select>
			  </td></tr>
			  <tr>
			  <td colspan="2">
				<table border="1" width="100%">
				<tr>
					<th colspan="2" rowspan="2">Documento Autorizado</th>
					<th colspan="2">Firma</th>
				</tr>
				<tr>
					<th>Si</th>
					<th>No</th>
				</tr>
					<tr>
<td>Constancias de Estudio</td>
<td><input id="p6891_1" name="cons_estu" type="checkbox" value="COES" <?php if (strlen($primero)>0) {echo "checked='checked'";} ?>/></td>
<td><input id="p6891_2" type="radio" <?php if (!(strcmp("1", $array_parametro[16]))) {echo "checked=checked";} ?> value="1" name="primeroA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
<td><input id="p6891_3" type="radio" <?php if (!(strcmp("2", $array_parametro[16]))) {echo "checked=checked";} ?> value="2" name="primeroA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
</tr>

					<tr>

					<td>Constancia de Matr&iacute;cula</td>

					<td><input id="p6891_4" name="cons_matri" type="checkbox" value="COMT" <?php if (strlen($segundo)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_5" type="radio" <?php if (!(strcmp("3", $array_parametro[17]))) {echo "checked=checked";} ?> value="3" name="segundoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_6" type="radio" <?php if (!(strcmp("4", $array_parametro[17]))) {echo "checked=checked";} ?> value="4" name="segundoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

						<tr>

					<td>Constancia de familias en acci&oacute;n</td>

					<td><input id="p6891_7" name="cons_fam" type="checkbox" value="COFA" <?php if (strlen($cuarto)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_8" type="radio" <?php if (!(strcmp("5", $array_parametro[18]))) {echo "checked=checked";} ?> value="5" name="terceroA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_9" type="radio" <?php if (!(strcmp("6", $array_parametro[18]))) {echo "checked=checked";} ?> value="6" name="terceroA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

						<tr>

					<td>Constancia cajas de compensaci&oacute;n</td>

					<td><input id="p6891_10" name="cons_cajas" type="checkbox" value="COCJ" <?php if (strlen($quinto)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_11" type="radio" <?php if (!(strcmp("7", $array_parametro[19]))) {echo "checked=checked";} ?> value="7" name="cuartoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_12" type="radio" <?php if (!(strcmp("8", $array_parametro[19]))) {echo "checked=checked";} ?> value="8" name="cuartoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

						<tr>

					<td>Paz y Salvo</td>

					<td><input id="p6891_13" name="cons_paz" type="checkbox" value="PAZ" <?php if (strlen($sexto)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_14" type="radio" <?php if (!(strcmp("9", $array_parametro[20]))) {echo "checked=checked";} ?> value="9" name="quintoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_15" type="radio" <?php if (!(strcmp("10", $array_parametro[20]))) {echo "checked=checked";} ?> value="10" name="quintoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					

					<tr>

					<td>Informe Valorativo Periodo a Periodo</td>

					<td><input id="p6891_16" name="cons_info" type="checkbox" value="INF" <?php if (strlen($septimo)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_17" type="radio" <?php if (!(strcmp("11", $array_parametro[21]))) {echo "checked=checked";} ?> value="11" name="sextoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_18" type="radio" <?php if (!(strcmp("12", $array_parametro[21]))) {echo "checked=checked";} ?> value="12" name="sextoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Observador del Alumno (Activo)</td>

					<td><input id="p6891_19" name="cons_obs" type="checkbox" value="OBS" <?php if (strlen($octavo)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_20" type="radio" <?php if (!(strcmp("13", $array_parametro[22]))) {echo "checked=checked";} ?> value="13" name="septimoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_21" type="radio" <?php if (!(strcmp("14", $array_parametro[22]))) {echo "checked=checked";} ?> value="14" name="septimoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Constancia Retiro de Estudiante</td>

					<td><input id="p6891_22" name="cons_ret" type="checkbox" value="CORE" <?php if (strlen($noveno)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_23" type="radio" <?php if (!(strcmp("15", $array_parametro[23]))) {echo "checked=checked";} ?> value="15" name="octavoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_24" type="radio" <?php if (!(strcmp("16", $array_parametro[23]))) {echo "checked=checked";} ?> value="16" name="octavoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Observador del Alumno (Retirado)</td>

					<td><input id="p6891_25" name="cons_retno" type="checkbox" value="OBSNO" <?php if (strlen($decimo)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_26" type="radio" <?php if (!(strcmp("17", $array_parametro[24]))) {echo "checked=checked";} ?> value="17" name="novenoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_27" type="radio" <?php if (!(strcmp("18", $array_parametro[24]))) {echo "checked=checked";} ?> value="18" name="novenoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Carnet de Papel</td>

					<td><input id="p6891_28" name="car_papel" type="checkbox" value="PAPEL" <?php if (strlen($once)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_29" type="radio" <?php if (!(strcmp("19", $array_parametro[25]))) {echo "checked=checked";} ?> value="19" name="decimoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_30" type="radio" <?php if (!(strcmp("20", $array_parametro[25]))) {echo "checked=checked";} ?> value="20" name="decimoA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>
					<td>Usuario y Contrase&ntilde;a de acudientes</td>
					<td><input id="p6891_31" name="gen_acu" type="checkbox" value="ACU" <?php if (strlen($doce)>0) {echo "checked='checked'";} ?>/></td>
					<td><input id="p6891_32" type="radio" <?php if (!(strcmp("21", $array_parametro[26]))) {echo "checked=checked";} ?> value="21" name="onceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
					<td><input id="p6891_33" type="radio" <?php if (!(strcmp("22", $array_parametro[26]))) {echo "checked=checked";} ?> value="22" name="onceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
					</tr>
					<tr>
					<td>Usuario y Contrase&ntilde;a de estudiantes</td>
					<td><input id="p6891_46" name="gen_estu" type="checkbox" value="ESTU" <?php if (strlen($diesiseis_estu)>0) {echo "checked='checked'";} ?>/></td>
					<td><input id="p6891_47" type="radio" <?php if (!(strcmp("31", $array_parametro[31]))) {echo "checked=checked";} ?> value="31" name="onceE_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
					<td><input id="p6891_48" type="radio" <?php if (!(strcmp("32", $array_parametro[31]))) {echo "checked=checked";} ?> value="32" name="onceE_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>
					</tr>
					<tr>

					<td>Formulario de inscripcion</td>

				

					<td><input type="checkbox" id="p6891_34"t name="gen_ins" type="checkbox" value="INS" <?php if (strlen($trece)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_35" type="radio" <?php if (!(strcmp("23", $array_parametro[27]))) {echo "checked=checked";} ?> value="23" name="doceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_36" type="radio" <?php if (!(strcmp("24", $array_parametro[27]))) {echo "checked=checked";} ?> value="24" name="doceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Pacto de convivencia</td>

				

					<td><input id="p6891_37" name="gen_pac" type="checkbox" value="PAC" <?php if (strlen($catorce)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_38" type="radio" <?php if (!(strcmp("25", $array_parametro[28]))) {echo "checked=checked";} ?> value="25" name="treceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_39" type="radio" <?php if (!(strcmp("26", $array_parametro[28]))) {echo "checked=checked";} ?> value="26" name="treceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Certificado parcial de estudios</td>

				

					<td><input id="p6891_40" name="cer_actual" type="checkbox" value="PARCER" <?php if (strlen($quince)>0) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_41" type="radio" <?php if (!(strcmp("27", $array_parametro[29]))) {echo "checked=checked";} ?> value="27" name="catorceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_42" type="radio" <?php if (!(strcmp("28", $array_parametro[29]))) {echo "checked=checked";} ?> value="28" name="catorceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>

					<tr>

					<td>Certificado de Estudios a&ntilde;o Anterior</td>

				

					<td><input id="p6891_43" name="cer_anterior" type="checkbox" value="CER2015,CER2014,CER2013,CER2012,CER2011,CER2010,CER2009,CER2008" <?php if (strlen($diesiseis)) {echo "checked='checked'";} ?>/></td>

					<td><input id="p6891_44" type="radio" <?php if (!(strcmp("29", $array_parametro[30]))) {echo "checked=checked";} ?> value="29" name="quinceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					<td><input id="p6891_45" type="radio" <?php if (!(strcmp("30", $array_parametro[30]))) {echo "checked=checked";} ?> value="30" name="quinceA_<?php echo $row_configuracion['conf_nombre']; ?>"/></td>

					</tr>
					<tr>
		

				<?php
				$r91=0;
				while($rowDocumentoAutorizado = mysql_fetch_array($sqlDocumentoAutorizado)){
					$r91++;
					$checkedFirmaSi = '';
					$checkedFirmaNo = '';

                    if ($rowDocumentoAutorizado['autoriza'] == 1)                    
                        $checkedAutoriza = 'checked="checked"';
                    else
                        $checkedAutoriza= '';

                    if ($rowDocumentoAutorizado['firma'] == 1)                    
                        $checkedFirmaSi = 'checked="checked"';
                    else if ($rowDocumentoAutorizado['firma'] == 2)
                        $checkedFirmaNo= 'checked="checked"';

		

					?>
				
						<td ><?php echo $rowDocumentoAutorizado['docu_legal_nombre'];?></td>
							<td ><input id="valida6791_1_<?php echo $r91; ?>"type="checkbox" <?php echo $checkedAutoriza; ?> value="1" name="autoriza_<?php echo $row_configuracion['conf_nombre']; ?><?php echo $rowDocumentoAutorizado['docu_legal_id']; ?>"/></td>

						<td ><input id="valida6791_2_<?php echo $r91; ?>"type="radio" <?php echo $checkedFirmaSi; ?> value="1" name="firma_<?php echo $row_configuracion['conf_nombre']; ?><?php echo $rowDocumentoAutorizado['docu_legal_id']; ?>" /></td>

						<td ><input id="valida6791_3_<?php echo $r91; ?>"type="radio" <?php echo $checkedFirmaNo; ?> value="2" name="firma_<?php echo $row_configuracion['conf_nombre']; ?><?php echo $rowDocumentoAutorizado['docu_legal_id']; ?>" /></td>
					</tr>
					<?php
				}
				?>			
				</table>

								<tr>
						
							<td ><a href="verificador_barcode.php" target="_blank">Verificador codigo de Barras</a></td>
					</tr>	
			  </td>
			  </tr>
			</table>
			<script>

function validar6691() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="S,A")

{

document.getElementById("p6891_1").disabled = false;

document.getElementById("p6891_2").disabled = false;

document.getElementById("p6891_3").disabled = false;

document.getElementById("p6891_4").disabled = false;

 document.getElementById("p6891_5").disabled = false;

document.getElementById("p6891_6").disabled = false;

document.getElementById("p6891_7").disabled = false;

document.getElementById("p6891_8").disabled = false;

 document.getElementById("p6891_9").disabled = false;

document.getElementById("p6891_10").disabled = false;

document.getElementById("p6891_11").disabled = false;

document.getElementById("p6891_12").disabled = false;

 document.getElementById("p6891_13").disabled = false;

document.getElementById("p6891_14").disabled = false;

document.getElementById("p6891_15").disabled = false;

document.getElementById("p6891_16").disabled = false;

 document.getElementById("p6891_17").disabled = false;

document.getElementById("p6891_18").disabled = false;

document.getElementById("p6891_19").disabled = false;

document.getElementById("p6891_20").disabled = false;

 document.getElementById("p6891_21").disabled = false;

document.getElementById("p6891_22").disabled = false;

document.getElementById("p6891_23").disabled = false;

document.getElementById("p6891_24").disabled = false;

document.getElementById("p6891_25").disabled = false;

document.getElementById("p6891_26").disabled = false;

document.getElementById("p6891_27").disabled = false;

 document.getElementById("p6891_28").disabled = false;

document.getElementById("p6891_30").disabled = false;

document.getElementById("p6891_31").disabled = false;

document.getElementById("p6891_32").disabled = false;

 document.getElementById("p6891_33").disabled = false;

document.getElementById("p6891_34").disabled = false;

document.getElementById("p6891_35").disabled = false;

document.getElementById("p6891_36").disabled = false;

 document.getElementById("p6891_37").disabled = false;

document.getElementById("p6891_38").disabled = false;

document.getElementById("p6891_39").disabled = false;

document.getElementById("p6891_29").disabled = false;

 document.getElementById("p6891_40").disabled = false;

document.getElementById("p6891_41").disabled = false;

document.getElementById("p6891_42").disabled = false;

 document.getElementById("p6891_43").disabled = false;

document.getElementById("p6891_44").disabled = false;

 document.getElementById("p6891_45").disabled = false;
 document.getElementById("p6891_46").disabled = false;
 document.getElementById("p6891_47").disabled = false;
 document.getElementById("p6891_48").disabled = false;

 document.getElementById("valida6791_1_1").disabled = false;
 document.getElementById("valida6791_1_2").disabled = false;
 document.getElementById("valida6791_1_3").disabled = false;

 document.getElementById("valida6791_2_1").disabled = false;
 document.getElementById("valida6791_2_2").disabled = false;
 document.getElementById("valida6791_2_3").disabled = false;

  document.getElementById("valida6791_3_1").disabled = false;
 document.getElementById("valida6791_3_2").disabled = false;
 document.getElementById("valida6791_3_3").disabled = false;

 document.getElementById("validar6791_4").disabled = false;
  document.getElementById("validar6791_5").disabled = false;
   document.getElementById("validar6791_6").disabled = false;

     

}
}

function validar66912() {

if(document.getElementById('<?php echo $row_configuracion["conf_nombre"]; ?>').value=="N")
{

  document.getElementById("p6891_1").disabled = true;

document.getElementById("p6891_2").disabled = true;

document.getElementById("p6891_3").disabled = true;

document.getElementById("p6891_4").disabled = true;

document.getElementById("p6891_5").disabled = true;

document.getElementById("p6891_6").disabled = true;

document.getElementById("p6891_7").disabled = true;

document.getElementById("p6891_8").disabled = true;

document.getElementById("p6891_9").disabled = true;

document.getElementById("p6891_10").disabled = true;

document.getElementById("p6891_11").disabled = true;

document.getElementById("p6891_12").disabled = true;

document.getElementById("p6891_13").disabled = true;

document.getElementById("p6891_14").disabled = true;

document.getElementById("p6891_15").disabled = true;

document.getElementById("p6891_16").disabled = true;

document.getElementById("p6891_17").disabled = true;

document.getElementById("p6891_18").disabled = true;

document.getElementById("p6891_19").disabled = true;

document.getElementById("p6891_20").disabled = true;

 document.getElementById("p6891_21").disabled = true;

document.getElementById("p6891_22").disabled = true;

document.getElementById("p6891_23").disabled = true;

document.getElementById("p6891_24").disabled = true;

document.getElementById("p6891_25").disabled = true;

document.getElementById("p6891_26").disabled = true;

document.getElementById("p6891_27").disabled = true;

 document.getElementById("p6891_28").disabled = true;

document.getElementById("p6891_30").disabled = true;

document.getElementById("p6891_31").disabled = true;

document.getElementById("p6891_32").disabled = true;

 document.getElementById("p6891_33").disabled = true;

document.getElementById("p6891_34").disabled = true;

document.getElementById("p6891_35").disabled = true;

document.getElementById("p6891_36").disabled = true;

 document.getElementById("p6891_37").disabled = true;

document.getElementById("p6891_38").disabled = true;

document.getElementById("p6891_39").disabled = true;

document.getElementById("p6891_29").disabled = true;

 document.getElementById("p6891_40").disabled = true;

document.getElementById("p6891_41").disabled = true;

document.getElementById("p6891_42").disabled = true;

 document.getElementById("p6891_43").disabled = true;

document.getElementById("p6891_44").disabled = true;

 document.getElementById("p6891_45").disabled = true;
 document.getElementById("p6891_46").disabled = true;
 document.getElementById("p6891_47").disabled = true;
 document.getElementById("p6891_48").disabled = true;

 document.getElementById("valida6791_1_1").disabled = true;
 document.getElementById("valida6791_1_2").disabled = true;
 document.getElementById("valida6791_1_3").disabled = true;

 document.getElementById("valida6791_2_1").disabled = true;
 document.getElementById("valida6791_2_2").disabled = true;
 document.getElementById("valida6791_2_3").disabled = true;

  document.getElementById("valida6791_3_1").disabled = true;
 document.getElementById("valida6791_3_2").disabled = true;
 document.getElementById("valida6791_3_3").disabled = true;

 document.getElementById("validar6791_4").disabled = true;
  document.getElementById("validar6791_5").disabled = true;
   document.getElementById("validar6791_6").disabled = true;

}

}

addEvent('load', validar6691); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
  addEvent('load', validar66912); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

</script> 

		<?php
		break;

	case 104: 

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

				<div class="container_demohrvszv">

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  </td>

				 </tr>

			

			</table> </div>

					<?php

		break;

	

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

if($totalRows_configuracion)

{

mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (105,140,158)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

}?>

<?php 

include ("conb.php");$registrosi=mysqli_query($conexion,"select * from conf_sygescol_adic where id=9")or die("Problemas en la Consulta".mysqli_error());while ($regi=mysqli_fetch_array($registrosi)){$coloracordi=$regi['valor'];}

?>

<div class="container_demohrvszv_caja_1">

<div class="accordion_example2wqzx_caja_2">

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_fotografica" style="background-color: <?php echo $coloracordi ?>"><center><strong>PAR&Aacute;METROS PARA SESI&Oacute;N FOTOGR&Aacute;FICA</strong></center><br /><center><input type="radio" value="rojoi" name="coloresi">Si&nbsp;&nbsp;<input type="radio" value="naranjai" name="coloresi">No</div></center>

				<div class="acc_contentsaponk_caja_4">

<div class="grevdaiolxx_caja_5">

<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

     <div class="accordion_example2wqzx">

     <div class="accordion_inwerds">

     <div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

     <div class="acc_contentsaponk">

     <div class="grevdaiolxx">

     

     <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

</div>

</div>

</div>

</div>

</div>

</div>

 </td>

	<td align="center">

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 105:
			$arregloF = explode("$",$row_configuracion['conf_valor']);

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

			?>

<table>
<tr>
	<td><b>Aplica</b></td>
	</tr>
<tr>
<td> 
<select id = "select_foto_carne_acu" name= "select_foto_carne_acu_<?php echo $row_configuracion['conf_nombre']; ?>" class="sele_mul" onclick="validar69105();validar691052()"> 
<option value="si" <?php if (!(strcmp("si", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>
<option value="no" <?php if (!(strcmp("no", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>
</select>
</td>
</tr>
</table>
<div class="container_demohrvszv">
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx">
<table border="1" style="text-align: center;">
<tr class="fila1"><th>Documento</th><th>Activar</th><th>Desactivar</th></tr>
<tr><td>Carnet Estudiantil</td>
<td><input type="radio" id="p69105_1"<?php if($arregloF[1]==A){ echo 'checked="checked"'; }?> name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_2"<?php if($arregloF[1]==D){ echo 'checked="checked"'; }?> name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>
<tr><td>Libro de matr&iacute;culas</td>
<td><input type="radio" id="p69105_3"<?php if($arregloF[2]==A){ echo 'checked="checked"'; }?> name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_4"<?php if($arregloF[2]==D){ echo 'checked="checked"'; }?> name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>
<tr><td>Obs. del Alumno</td>
<td><input type="radio" id="p69105_5"<?php if($arregloF[3]==A){ echo 'checked="checked"'; }?> name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_6"<?php if($arregloF[3]==D){ echo 'checked="checked"'; }?> name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr><tr><td>Planillas Calificaciones</td>
<td><input type="radio" id="p69105_7"<?php if($arregloF[4]==A){ echo 'checked="checked"'; }?> name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_8"<?php if($arregloF[4]==D){ echo 'checked="checked"'; }?> name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr><tr><td>Plataforma Estudiante</td>
<td><input type="radio" id="p69105_9"<?php if($arregloF[5]==A){ echo 'checked="checked"'; }?> name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_10"<?php if($arregloF[5]==D){ echo 'checked="checked"'; }?> name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Adm&oacute;n. Fotogr&aacute;fica</td>
<td><input type="radio" id="p69105_11"<?php if($arregloF[6]==A){ echo 'checked="checked"'; }?> name="f_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio"id="p69105_12" <?php if($arregloF[6]==D){ echo 'checked="checked"'; }?> name="f_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Bolet&iacute;n detallado</td>
<td><input type="radio" id="p69105_13"<?php if($arregloF[7]==A){ echo 'checked="checked"'; }?> name="g_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_14"<?php if($arregloF[7]==D){ echo 'checked="checked"'; }?> name="g_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Bolet&iacute;n Resumen</td>
<td><input type="radio" id="p69105_15"<?php if($arregloF[8]==A){ echo 'checked="checked"'; }?> name="h_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_16"<?php if($arregloF[8]==D){ echo 'checked="checked"'; }?> name="h_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Informe Final</td>
<td><input type="radio" id="p69105_17"<?php if($arregloF[9]==A){ echo 'checked="checked"'; }?> name="i_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_18"<?php if($arregloF[9]==D){ echo 'checked="checked"'; }?> name="i_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Consulta estudiantes</td>
<td><input type="radio" id="p69105_19"<?php if($arregloF[10]==A){ echo 'checked="checked"'; }?> name="j_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_20"<?php if($arregloF[10]==D){ echo 'checked="checked"'; }?> name="j_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Registro Biom&eacute;trico</td>
<td><input type="radio" id="p69105_21"<?php if($arregloF[11]==A){ echo 'checked="checked"'; }?> name="k_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_22"<?php if($arregloF[11]==D){ echo 'checked="checked"'; }?> name="k_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Matr&iacute;cula por Biomet</td>
<td><input type="radio" id="p69105_23"<?php if($arregloF[12]==A){ echo 'checked="checked"'; }?> name="l_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_24"<?php if($arregloF[12]==D){ echo 'checked="checked"'; }?> name="l_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Cuadro de Honor</td>
<td><input type="radio" id="p69105_25"<?php if($arregloF[13]==A){ echo 'checked="checked"'; }?> name="m_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_26"<?php if($arregloF[13]==D){ echo 'checked="checked"'; }?> name="m_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
<tr><td>Gobierno Escolar</td>
<td><input type="radio" id="p69105_27"<?php if($arregloF[14]==A){ echo 'checked="checked"'; }?> name="n_<?php echo $row_configuracion['conf_nombre']; ?>" value="A"></td>
<td><input type="radio" id="p69105_28"<?php if($arregloF[14]==D){ echo 'checked="checked"'; }?> name="n_<?php echo $row_configuracion['conf_nombre']; ?>" value="D"></td></tr>				
</tr>
</table>

<script>

function validar69105() {

if(document.getElementById('select_foto_carne_acu').value=="si")

{

document.getElementById("p69105_1").disabled = false;

document.getElementById("p69105_2").disabled = false;
document.getElementById("p69105_3").disabled = false;
document.getElementById("p69105_4").disabled = false;
document.getElementById("p69105_5").disabled = false;
document.getElementById("p69105_6").disabled = false;
document.getElementById("p69105_7").disabled = false;
document.getElementById("p69105_8").disabled = false;
document.getElementById("p69105_9").disabled = false;
document.getElementById("p69105_10").disabled = false;
document.getElementById("p69105_11").disabled = false;
document.getElementById("p69105_12").disabled = false;
document.getElementById("p69105_13").disabled = false;
document.getElementById("p69105_14").disabled = false;
document.getElementById("p69105_15").disabled = false;
document.getElementById("p69105_16").disabled = false;
document.getElementById("p69105_17").disabled = false;
document.getElementById("p69105_18").disabled = false;
document.getElementById("p69105_19").disabled = false;
document.getElementById("p69105_20").disabled = false;
document.getElementById("p69105_21").disabled = false;
document.getElementById("p69105_22").disabled = false;
document.getElementById("p69105_23").disabled = false;
document.getElementById("p69105_24").disabled = false;
document.getElementById("p69105_25").disabled = false;
document.getElementById("p69105_26").disabled = false;
document.getElementById("p69105_27").disabled = false;
document.getElementById("p69105_28").disabled = false;

     

}
}

function validar691052() {

if(document.getElementById('select_foto_carne_acu').value=="no")
{

document.getElementById("p69105_1").disabled = true;

document.getElementById("p69105_2").disabled = true;
document.getElementById("p69105_3").disabled = true;
document.getElementById("p69105_4").disabled = true;
document.getElementById("p69105_5").disabled = true;
document.getElementById("p69105_6").disabled = true;
document.getElementById("p69105_7").disabled = true;
document.getElementById("p69105_8").disabled = true;
document.getElementById("p69105_9").disabled = true;
document.getElementById("p69105_10").disabled = true;
document.getElementById("p69105_11").disabled = true;
document.getElementById("p69105_12").disabled = true;
document.getElementById("p69105_13").disabled = true;
document.getElementById("p69105_14").disabled = true;
document.getElementById("p69105_15").disabled = true;
document.getElementById("p69105_16").disabled = true;
document.getElementById("p69105_17").disabled = true;
document.getElementById("p69105_18").disabled = true;
document.getElementById("p69105_19").disabled = true;
document.getElementById("p69105_20").disabled = true;
document.getElementById("p69105_21").disabled = true;
document.getElementById("p69105_22").disabled = true;
document.getElementById("p69105_23").disabled = true;
document.getElementById("p69105_24").disabled = true;
document.getElementById("p69105_25").disabled = true;
document.getElementById("p69105_26").disabled = true;
document.getElementById("p69105_27").disabled = true;
document.getElementById("p69105_28").disabled = true;

}

}

addEvent('load', validar69105); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
  addEvent('load', validar691052); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
   

</script> 

</div>

</div>

</div>

</div>

</div>

			<?php

		break;

		case 140:

		$valores140 = explode("$", $row_configuracion['conf_valor']);

		?>

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Boletin Detallado</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

					<center>	

		<table>

			<tr>

				<td><input  type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"1") == true)  {echo "checked=checked";} ?> value="1" name="bloqueo_foto_detallado_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Foto</td>

			</tr>

			<tr>

				<td><input  id="validar67991_4"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"2") == true)  {echo "checked=checked";} ?> value="2" name="bloqueo_huella_detallado_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Huella</td>

			</tr>

			<tr>		

				<td><input id="validar67991_5"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"3") == true)  {echo "checked=checked";} ?> value="3" name="bloqueo_firma_detallado_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Firma</td>

			</tr>

			<tr>	

				<td><input id="validar67991_6"type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"4") == true)  {echo "checked=checked";} ?> value="4" name="bloqueo_carne_detallado_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Carn&eacute;</td>

			</tr>

	</table>

</center>	

</div>

</div>

</div>

</div>

</div>

<div class="container_demohrvszv">	  

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Boletin Resumen</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

					<center>

		<table>

			<tr>

				<td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"5") == true)  {echo "checked=checked";} ?> value="5" name="bloqueo_foto_resumen_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Foto</td>

			</tr>

			<tr>

				<td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"6") == true)  {echo "checked=checked";} ?> value="6" name="bloqueo_huella_resumen_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Huella</td>

			</tr>

			<tr>		

				<td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"7") == true)  {echo "checked=checked";} ?> value="7" name="bloqueo_firma_resumen_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Firma</td>

			</tr>

			<tr>	

				<td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"8") == true)  {echo "checked=checked";} ?> value="8" name="bloqueo_carne_resumen_<?php echo $row_configuracion['conf_nombre']; ?>" /></td><td>Carn&eacute;</td>

			</tr>

		</table>

		</center>	

</div>

</div>

</div>

</div>

</div>

		</p>			

		<?php

		break;	

		case 158:

		if ($row_configuracion['conf_nombre'] !="registro_ina_escuela_nueva" ) {

		?>

		<label>

		  <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

		  	<option value="N" <?php if (!(strcmp("N", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

			<option value="S" <?php if (!(strcmp("S", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>			

		  </select>

		</label>

		<?php

		}

		break;

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!-- -------------------------------------------- PARAMETROS VIGENCIA DE TIEMPOS -------------------------------- -->

<?php

if($totalRows_configuracion)

{

mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (128,153,159)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

}

?>

<?php 

include ("conb.php");$registrosj=mysqli_query($conexion,"select * from conf_sygescol_adic where id=10")or die("Problemas en la Consulta".mysqli_error());while ($regj=mysqli_fetch_array($registrosj)){$coloracordj=$regj['valor'];}

?>

<div class="container_demohrvszv_caja_1">  

<div class="accordion_example2wqzx_caja_2">

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_modulos_nuevos" style="background-color: <?php echo $coloracordj ?>"><center><strong>PAR&Aacute;METROS PARA ACTIVACI&Oacute;N DE M&Oacute;DULOS NUEVOS</strong></center><br /><center><input type="radio" value="rojoj" name="coloresj">Si&nbsp;&nbsp;<input type="radio" value="naranjaj" name="coloresj">No</div></center>

				<div class="acc_contentsaponk_caja_4">

<div class="grevdaiolxx_caja_5">

<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

<td valign="top" width="80%">

<div class="container_demohrvszv" >

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

 <?php echo $row_configuracion['conf_descri']; ?>

 

  </div>

     

</div>

</div>

</div>

</div>

</div>

 </td>

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

		case 128:

if ($row_configuracion['conf_nombre'] !="registro_ina_escuela_nueva" ) {
	?>
	<label>
  <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">
  	<option value="N" <?php if (!(strcmp("N", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>
	<option value="S" <?php if (!(strcmp("S", $row_configuracion['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>			
  </select>
</label>
	<?php
	}
		break;

		case 153:

			$variablesSep = explode("@",$row_configuracion['conf_valor']);

			$valoresCertificados = explode(",",$variablesSep[0]); // Certificados

			$valoresConstancias = explode(",",$variablesSep[1]); // Constancias

            $valoresConstancias2 = $variablesSep[2]; // Constancias
        

          //echo $variablesSep[0].'<br>'.$variablesSep[1].'<br>'.$variablesSep[2];

		?>

<table>	<tr><b>Aplica</b>

				  	  <select class="sele_mul op" name="pali_<?php echo $row_configuracion['conf_nombre']; ?>" id="parametro74153" onclick="validar74153()">

							<option value="S" <?php if (!(strcmp("S", $valoresConstancias2['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

							<option value="N" <?php if (!(strcmp("N", $valoresConstancias2['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

						  </select></table>

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd">Defina</div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<table >
<tr>
<td><input type="radio" id="radio1534" onclick="javascript:determinarEstadoCamposs153b();"<?php if($valoresCertificados[0]==I){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="I"></td><td>Asignarle<input type="text" id="v73531" onkeypress="return justNumbers(event);"value="<?php echo $valoresCertificados[1];?>" name="valCertificado_<?php echo $row_configuracion['conf_nombre']; ?>" size="5">como nota de la <b style="color:red;">Autoevaluacion.</b></td></td>
			</tr>
			<tr>

				<td><input type="radio" id="radio1533"onclick="javascript:determinarEstadoCamposs1532();"<?php if($valoresCertificados[0]==F){ echo 'checked="checked"'; }?> name="certificado_<?php echo $row_configuracion['conf_nombre']; ?>" value="F"></td><td>La califica el docente.</td>

			</tr>	

			</table>

			</div></div></div></div></div>

<div class="container_demohrvszv"> 

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd">Defina</div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

					<table>

	<tr>
				<td><input type="radio" id="radio1532"onclick="javascript:determinarEstadoCamposs153a();"<?php if($valoresConstancias[0]==I){ echo 'checked="checked"'; }?> name="constancia_<?php echo $row_configuracion['conf_nombre']; ?>" value="I"></td><td>Asignarle<input type="text"id="v73532"value="<?php echo $valoresConstancias[1];?>" name="valConstancia_<?php echo $row_configuracion['conf_nombre']; ?>" size="5"> como nota</td>
			</tr>
			<tr>

				<td><input type="radio" id="radio1531"onclick="javascript:determinarEstadoCamposs153();"<?php if($valoresConstancias[0]==F){ echo 'checked="checked"'; }?> name="constancia_<?php echo $row_configuracion['conf_nombre']; ?>" value="F"></td><td>La califica el docente.</td>

			</tr>	

		</table>

		</div></div></div></div></div>

<script type="text/javascript">

function determinarEstadoCamposs153() {
if(document.getElementById("radio1531").checked = true){
    document.getElementById("v73532").disabled = true;
}

}

function determinarEstadoCamposs153a() {
if(document.getElementById("radio1532").checked = true)
{
    document.getElementById("v73532").disabled = false;
}

}

function determinarEstadoCamposs1532() {
if(document.getElementById("radio1533").checked = true){
    document.getElementById("v73531").disabled = true;
}

}
function determinarEstadoCamposs153b() {
if(document.getElementById("radio1534").checked = true){
    document.getElementById("v73531").disabled = false;
}

}

</script>
<script>
function validar74153(){
if(document.getElementById('parametro74153').value=="S")
{
document.getElementById("radio1531").disabled = false;
document.getElementById("v73532").disabled = false;
document.getElementById("radio1532").disabled = false;
document.getElementById("radio1533").disabled = false;
document.getElementById("v73531").disabled = false;
document.getElementById("radio1534").disabled = false;
}
if(document.getElementById('parametro74153').value=="N")
{
document.getElementById("radio1531").disabled = true;
document.getElementById("v73532").disabled = true;
document.getElementById("radio1532").disabled = true;
document.getElementById("radio1533").disabled = true;
document.getElementById("v73531").disabled = true;
document.getElementById("radio1534").disabled = true;
}
}
	addEvent('load', validar74153); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro
</script>

		<?php 

		break;
	case 159: // en la pagina aprece como el parametro 81 y en el código como el 159.

		// permite recibir la cadena ya validad y la guarda en la base de datos
		function actualizarSolucionParametro($cadena){
			$sql_upd_configuracion = "UPDATE conf_sygescol SET conf_valor = '".$cadena."' WHERE conf_nombre LIKE '".$row_configuracion['conf_nombre']."'";
			$upd_configuracion = mysql_query($sql_upd_configuracion, $sygescol) or die("No se pudo actualizar los parametros del sistema");
		}	
		// permite validar los datos de la solucion del parametro 159 y crea una cadena que ya queda lista para guardar en la base de datos
		function crearCadenaAGuardar($cadena){
			define("APLICA", 0); // representa la seccion de aplica o no aplica de la solucion del paramtero 159
        	define("NO", 0); // value del radio button de la opcion aplica de la solucion del parametro 159
			define("SI", 1); // value del radio button de la opcion aplica de la solucion del parametro 159
			define("ANIOS", 1); // representa la seccion de años a tener en cuenta de la solucion del paramtero 159
			define("AREAS", 2); // representa la seccion de las areas a tener en cuenta de la solucion del lparametro 159
			define("AREAS_ESPECIFICAS", "8"); // representa el value de la opcion de areas especificas del la seccion de areas a tener en cuenta de la solucion del parametro 159
			define("CALIFICACION", 3); // representa la seccion de calificacion exigida de la solucion del parametro 159
			define("CALIFICACION_MINIMA", "11"); // value de la opcion de calificacion especifica minima de la seccion de calificacion exigida de la solucion del parametro 159
			define("CERTIFICADO", 4); // representa la seccion de modo de elaborar el certificado de la solucion del parametro 159
			define("AREA1", 5); // representa la posicion en la que se encuentra dentro del arreglo la primer area especifica
			define("AREA12", 16); // representa la posicion en la que se encuentra dentro del arreglo la ultima area especifica
			define("CAMPO_CALIFICACION_MINIMA", 17); // determina la posicion que ocupa la calificacion minima en el arreglo
			define("MINIMO_CALIFICACION_MINIMA", 1); // determina el minimo de calificacion permitida en el campo de calificacion minima
			define("MAXIMO_CALIFICACION_MINIMA", 5); // determina el maximo de calificacion permitida en el campo de calificacion minima
			// convierte una cadena de caracteres en un arreglo, creando columnas y dividiendo la cadena cada vez que se encuentra un caracter dolar ($) 
			$solucionParametro159 = explode("$",$cadena); 
			$cadenaCorrecta = ""; // esta variable contendra la cadena validada la cual sera guardada en la BD
			if( $solucionParametro159[APLICA] == SI ){ // si se selecciono la opcion si en la seccion de aplica de la solucion del parametro 159
				$cadenaCorrecta = SI; // le doy a la variable el valor de 1
				if( $solucionParametro159[ANIOS] == ""){ // si no selecciono una opcion en la seccion de años a tener en cuenta en la solucion del parametro 159
					$cadenaCorrecta = NO; // le doy a la variable el valor de 0
				}else{ // si si selecciono una opcion en la seccion de años a tener en cuenta 
					$cadenaCorrecta .= "$".$solucionParametro159[ANIOS]; // concateno a la varible un signo dolar y la opcion que eligio
					if($solucionParametro159[AREAS] == ""){ // si en la seccion de areas a tener en cuenta no eligio ninguna opcion 
						$cadenaCorrecta = NO;	// la variable toma el valor de 0
					}else{ // si si selecciono una opcion en la seccion de areas a tener en cuenta
						$cadenaCorrecta .= "$".$solucionParametro159[AREAS]; // le concateno a la variable un signo dolar y la opcion seleccionanda
						if($solucionParametro159[CALIFICACION] == ""){ // si no escogio ninguna opcion en la seccion de calificacion exigida
							$cadenaCorrecta = NO; // la variable toma el valor de 0
						}else{ // si si toma una opcion en la seccion de calificacion a tener en cuenta
							$cadenaCorrecta .= "$".$solucionParametro159[CALIFICACION]; // le concateno a la variable el signo dolar y la opcion que eleigio
							if($solucionParametro159[CERTIFICADO] == ""){ // si no escogio ninguna opcion en la seecion de modelo de elaborar nuevo certificado
								$cadenaCorrecta = NO; // la variable toma el nombre de 0
							}else{ // si si eligio una opcion en la seccion de modelo de elaborar nueov certificado
								$cadenaCorrecta .= "$".$solucionParametro159[CERTIFICADO]; // le concateno a la variable el signo dolar y la opcion seleccionada
								if($solucionParametro159[AREAS] == AREAS_ESPECIFICAS){ // si en la seccion de areas a tener en cuanta se selecciono la opcion areas especificas
									$tieneAlgunValor = NO; // esta variable me dira si ingresaros las areas especificas o no
									for($i = AREA1; $i <= AREA12; $i++){ // recorro en el arreglo las posiciones donde se guardan las areas especificas ingresadas
										if($solucionParametro159[$i] != ""){ // verifico exiten areas especificas ingresadas
											$tieneAlgunValor++; // aumento el valor de la variable en uno
										}
									}
									if($tieneAlgunValor >= 1){ // verifico si la variable encontro que existian una o más areas especificas ingresadas
										$hayValorRepetido = NO; // esta varaible me dice si hay valores repetidos
										if($tieneAlgunValor > 1){ // si se encontraron más de una area especifica ingresada
											//determino si existen areas especificas repetidas
											for($i = AREA1; $i <= AREA12; $i++){ 
												for($j = $i + 1; $j <= AREA12; $j++){ 
													if($solucionParametro159[$i] == $solucionParametro159[$j]){ 
														$hayValorRepetido++; // aumento la variable cada vez que encuentre que hay areas especificas repetidas
													}
												}
											}
										}
										if($hayValorRepetido){ // si exiten areas especificas repetidas
											$cadenaCorrecta = NO; // la variable toma el valor de 0
										}else{ // si no existen areas repetidas
											for($i = AREA1; $i <= AREA12; $i++){ // recooro todos los campos del arreglo donde se encuentran las areas especificas ingresadas
												$cadenaCorrecta .= "$".$solucionParametro159[$i]; // voy concatenando cada una de las areas especificas ingresadas
											}
										}
									}else{ // si no tiene ninguna area especifica ingresada

										$cadenaCorrecta = NO; // la variable toma el valor de 0
									}										

								} // termina el if que determina si en la seccion de areas a tener en cuenta se selecciono la opcion de areas especificas
								if($solucionParametro159[CALIFICACION] == CALIFICACION_MINIMA){ //si en la seccion de calificacion exigida se selecciona calificacion minima exigida especifica
									if($solucionParametro159[CAMPO_CALIFICACION_MINIMA] == ""){ // se verifica si se ingreso la calificacion minima exigida especifica
										$cadenaCorrecta = NO; // si no se ingreso la variable toma el valor de 0
									}else{ // si si ingreso la calificacion minima especifica exigida
										if($solucionParametro159[CAMPO_CALIFICACION_MINIMA] >= MINIMO_CALIFICACION_MINIMA &&  
										   $solucionParametro159[CAMPO_CALIFICACION_MINIMA] <= MAXIMO_CALIFICACION_MINIMA) // se verifica si no excede el rango determinado
									   	{
											$cadenaCorrecta .= "$".$solucionParametro159[CAMPO_CALIFICACION_MINIMA]; // se concatena a la variable el signo dolar y la calificacion minima especifica que ingreso
										}else{ // si se sale del rango
											$cadenaCorrecta = NO; // la variable toma el valor de 0
										}
									}
								} // termina el if que dtermina si en la seccion de calificacion exigida se selecciono la opcion de calificacion minima
							}
						}
					}
				}
			}else if( $solucionParametro159[APLICA] == NO || $solucionParametro159[APLICA] == ""){ // si en la seccion de aplica de la solucion del parametro 159 dicen que no aplica o no seleccionan ninguna opcion
				$cadenaCorrecta = NO; // la varaible toma el valor de 0
			}
			return $cadenaCorrecta; // devuelvo la variable con la cadena validada y lista para guardar en la base de datos
		}
		// permite conectarme a la BD (cga) al campo (a) que contiene los ids de las asignaturas y retorna el arreglo con los ids sin repetirse dentro del arreglo
		/*
		function darIdsAsignaturas(){
			global $link, $database_sygescol; // obtengo la variable global link que tiene el objeto conexion a BD y el nombre de la base de BD de sygescol
			mysql_select_db($database_sygescol,$link); // determino que me conectare a la BD de sygescol
			$sel = "SELECT DISTINCT a FROM cga"; // creo la sentencia SQL de consulta jalando los ids en que estan en el campo (a) de la tabla (cga) sin traer los repetidos
			$sql = mysql_query($sel, $link); // ejecuto la sentencia en el query y los resultados los guardos en la variable ($sql)
			$arrayIdsAsignaturas; // creo un variable que contendra los datos consultados en la BD
			$i = 0; // sera utilizada como contador para utilizarse cono indice en el arreglo que contendra los elementos consultados en la BD
			while($fila = mysql_fetch_array($sql)){ // obtiene cada fila de el resultado de la consulta a la BD
				$arrayIdsAsignaturas[$i] = $fila["a"]; // obtengo cada uno de los valores de la consulta a la BD y los guardo en un arreglo 
				$i++; // aumento el contador para que guarde el siguiente elemento en el siguiente campo del arreglo
			} // termino ciclo while
			return $arrayIdsAsignaturas; // retorno el arreglo con todos los elementos que fueron consultados en la BD 
		}
		$idsAsignaturas = darIdsAsignaturas(); // llamo al metodo para obtener el arreglo y asignalo a una variable
		*/
		/*
		$idAsignaturaMinimo = min($idsAsignaturas);
		$idAsignaturaMaximo = max($idsAsignaturas);
		*/
		// a la varibale $row_configuracion["conf_valor"] que contiene la cadena string separada por signos: $.. le hago un explode para convertirla a arreblo 
		// y de esa manera obtener los varoles serparados para elemento del parametro 159.
		$array_parametro159 = explode("$", $row_configuracion["conf_valor"]); 
		$aplica_parametro159 = $array_parametro159[0]; // tome el valor de la primer posicion del arreglo que contie el value del input de type radio que determina si esta habilitado o no el paremetro 159
		$anio = $array_parametro159[1]; // tomo el valor de la segunda posicion del arreglo que contiene el value del input de type radio de los años a tener en cuenta...
		$area = $array_parametro159[2]; // tomo el valor de la tercera posicion del arreglo que contiene el value del input de type radio de las areas a tener en cuenta...
		$calificacion = $array_parametro159[3]; // hago lo mismo que arriba pero esta vez para obtener el value del input type radio de la calificacion exigida...
		$certificado = $array_parametro159[4]; // hago lo mismo pero esta vez para obtener el value del input type radio que determina el modelo de nuevo certificado...
		// si la persona eligio áreas especificas entonces esas areas se guardan en los 12 campos que en cuentras en las posiciones del arreglo acontinuacion:
		// los datos de estos campos estas guardados de la misma manera en la que leemos de izquierda a derecha
		$asignatura1_ = $array_parametro159[5]; // valor del primer campo de la primera fila
		$asignatura2_ = $array_parametro159[6]; // valor del siguiente campo a mano derecha
		$asignatura3_ = $array_parametro159[7]; // valor del siguiente campo a mano derecha
		$asignatura4_ = $array_parametro159[8]; // valor del siguiente campo a mano derecha
		$asignatura5_ = $array_parametro159[9]; // valor del primer campo de la sunda fila
		$asignatura6_ = $array_parametro159[10]; // valor del siguiente campo a mano derecha
		$asignatura7_ = $array_parametro159[11]; // valor del siguiente campo a mano derecha
		$asignatura8_ = $array_parametro159[12]; // valor del siguiente campo a mano derecha
		$asignatura9_ = $array_parametro159[13]; // valor del primer campo de la tercera fila
		$asignatura10_ = $array_parametro159[14]; // valor del siguiente campo a mano derecha
		$asignatura11_ = $array_parametro159[15]; // valor del siguiente campo a mano derecha
		$asignatura12_ = $array_parametro159[16]; // valor del siguiente campo a mano derecha
		// en la parte de la calificacion especifica si el usuario determina que va a ingresar la calificacion minima; esta se encuentra en esta poscion del arreglo
		$cal_min = $array_parametro159[17]; // tomo el valor ingresado por medio del campo de type text del arreglo
		?>
		<br>
		<p>
			<label><strong>Aplica: </strong>
				<!--<select  id="apli_param159" name= "aplica_reconsideracion" class="sele_mul"> 
					<option value="1" <?php //if (strcmp("1", $aplica_parametro159[0])==0) {echo "selected=\"selected\"";} ?> >Si</option>
			 		<option value="0" <?php //if (strcmp("0", $aplica_parametro159[0])==0) {echo "selected=\"selected\"";} ?> >No</option>
				</select>-->

				Si <input  type="radio" onclick="validarinputs741591()"<?php if( strcmp( $aplica_parametro159, "1" ) == 0 ) { echo "checked='checked'"; } ?>  value = "1" name = "aplica_reconsideracion" /> 

				No <input  type="radio" onclick="validarinputs741592()"<?php if( strcmp( $aplica_parametro159, "0" ) == 0 ) { echo "checked='checked'"; } ?>  value = "0" name = "aplica_reconsideracion" /> 

			</label>

		</p>

<script type="text/javascript">

function validarinputs741591(){
 document.getElementById("validar7459_1").disabled = false;
  document.getElementById("validar7459_2").disabled = false;
   document.getElementById("validar7459_3").disabled = false;
    document.getElementById("validar7459_4").disabled = false;
     document.getElementById("validar7459_5").disabled = false;

       document.getElementById("validar7459_7").disabled = false;
        document.getElementById("validar7459_8").disabled = false;
         document.getElementById("validar7459_9").disabled = false;
          document.getElementById("validar7459_10").disabled = false;
           document.getElementById("validar7459_11").disabled = false;
            document.getElementById("validar7459_12").disabled = false;
             document.getElementById("validar7459_13").disabled = false;
              document.getElementById("validar7459_14").disabled = false;

}

function validarinputs741592(){

document.getElementById("validar7459_1").disabled = true;
  document.getElementById("validar7459_2").disabled = true;
   document.getElementById("validar7459_3").disabled = true;
    document.getElementById("validar7459_4").disabled = true;
     document.getElementById("validar7459_5").disabled = true;

       document.getElementById("validar7459_7").disabled = true;
        document.getElementById("validar7459_8").disabled = true;
         document.getElementById("validar7459_9").disabled = true;
          document.getElementById("validar7459_10").disabled = true;
           document.getElementById("validar7459_11").disabled = true;
            document.getElementById("validar7459_12").disabled = true;
             document.getElementById("validar7459_13").disabled = true;
              document.getElementById("validar7459_14").disabled = true;

}

	addEvent('load', validarinputs741591); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

</script> 

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		

		<div id="solucion_parametro159">

			<table>

				<tr>

					<p style="text-align: left; margin:15px;"><strong>A&ntilde;os a tener en cuenta para la consulta de la habilitaci&oacute;n del proceso:</strong></p>

					<p style="text-align: left; margin:15px;">

						<input type="radio" id="validar7459_14"<?php if (strcmp($anio,"1")==0) {echo "checked='checked'";} ?> value="1" name="habilitacion_proceso_anio<?php echo $row_configuracion['conf_nombre']; ?>" />Un a&ntilde;o<br> <br>

						<input type="radio" id="validar7459_13"<?php if (strcmp($anio,"2")==0) {echo "checked='checked'";} ?> value="2" name="habilitacion_proceso_anio<?php echo $row_configuracion['conf_nombre']; ?>" />Dos a&ntilde;os<br> <br>

						<input type="radio" id="validar7459_12"<?php if (strcmp($anio,"3")==0) {echo "checked='checked'";} ?> value="3" name="habilitacion_proceso_anio<?php echo $row_configuracion['conf_nombre']; ?>" />Tres a&ntilde;os<br> <br>

						<input type="radio" id="validar7459_11"<?php if (strcmp($anio,"4")==0) {echo "checked='checked'";} ?> value="4" name="habilitacion_proceso_anio<?php echo $row_configuracion['conf_nombre']; ?>" />Cuatro a&ntilde;os<br> <br>

					</p>

				</tr>

				<tr>

					<p style="text-align: left; margin:15px;"><strong>&Aacute;reas a Tener en cuenta para la validaci&oacute;n del proceso:</strong></p>

					<p style="text-align: left; margin:15px;">

						<input type="radio" id="validar7459_10"<?php if (strcmp($area,"5")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoCampos();" value="5" name="habilitacion_proceso_area<?php echo $row_configuracion['conf_nombre']; ?>" />&Aacute;reas Fundamentales Obligatorias<br> <br>

						<input type="radio" id="validar7459_9"<?php if (strcmp($area,"6")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoCampos();" value="6" name="habilitacion_proceso_area<?php echo $row_configuracion['conf_nombre']; ?>" />Solo las &Aacute;reas de la T&eacute;cnica<br> <br>

						<input type="radio" id="validar7459_8"<?php if (strcmp($area,"7")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoCampos();" value="7" name="habilitacion_proceso_area<?php echo $row_configuracion['conf_nombre']; ?>" />Cualquier &Aacute;rea de promoci&oacute;n<br> <br>

						<input type="radio" id="validar7459_7"<?php if (strcmp($area,"8")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoCampos();" value="8" name="habilitacion_proceso_area<?php echo $row_configuracion['conf_nombre']; ?>" />&Aacute;reas espec&iacute;ficas<br> <br>

				</tr>		

			</table>

 <table style="width:100%;">

<tr>	

<td><center>

		<input type="text" id="operraccionn" placeholder="Materia" style="width:25%;" class="asignatura"><input type="button" value="Consultar" onclick="clcuares()" style="width:35%;" class="asignatura"><input type="text" onkeypress="return justNumbers(event);" 

style="width:25%;" id="resulltaaddo" placeholder="Id Materias" class="asignatura">

</center>

</td>

 </tr>

         

</table>

			<div>

				<table>

		

				<tr><td><input type = "text" onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura1_; ?>" name="asignatura1_"></td><td><input type = "text"onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura2_; ?>" name="asignatura2_"></td><td><input type = "text" onkeypress="return justNumbers(event);"class="asignatura" style="width:98%;" value="<?php echo $asignatura3_; ?>" name="asignatura3_"></td><td><input type = "text" onkeypress="return justNumbers(event);"class="asignatura" style="width:98%;" value="<?php echo $asignatura4_; ?>" name="asignatura4_"></td></tr>

	        	<tr><td><input type = "text" onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura5_; ?>" name="asignatura5_"></td><td><input type = "text"onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura6_; ?>" name="asignatura6_"></td><td><input type = "text" onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura7_; ?>" name="asignatura7_"></td><td><input type = "text" onkeypress="return justNumbers(event);"class="asignatura" style="width:98%;" value="<?php echo $asignatura8_; ?>" name="asignatura8_"></td></tr>

	        	<tr><td><input type = "text" onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura9_; ?>" name="asignatura9_"></td><td><input type = "text"onkeypress="return justNumbers(event);"  class="asignatura" style="width:98%;" value="<?php echo $asignatura10_; ?>" name="asignatura10_"></td><td><input type = "text"  onkeypress="return justNumbers(event);"class="asignatura" style="width:98%;" value="<?php echo $asignatura11_; ?>" name="asignatura11_"></td><td><input type = "text"onkeypress="return justNumbers(event);" class="asignatura" style="width:98%;" value="<?php echo $asignatura12_; ?>" name="asignatura12_"></td></tr>

				</talbe>

			</div>

			<table>

					</p>

				</tr>

				<tr>

		<p style="text-align: left; margin:15px;"><strong>Calificaci&oacute;n exigida en el registro de las &aacute;reas pendientes para la promoci&oacute;n:</strong></p>

					<p style="text-align: left; margin:15px;">

						<input type="radio" id="validar7459_5"<?php if (strcmp($calificacion,"10")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoNota();" value="10" name="habilitacion_proceso_<?php echo $row_configuracion['conf_nombre']; ?>"/>Cualquier valor dentro de la escala de b&aacute;sico en adelante<br> <br>

						<input type="radio" id="validar7459_4"<?php if (strcmp($calificacion,"11")==0) {echo "checked='checked'";} ?> onclick="javascript:determinarEstadoNota();" value="11" name="habilitacion_proceso_<?php echo $row_configuracion['conf_nombre']; ?>"/>Una calificaci&oacute;n espec&iacute;fica m&iacute;nima <input type = "text" min="1" max="5" step="0.1" style="width: 15%;"  id="nota" name="calificacion_minima" value = "<?php echo $cal_min ?>"> <br> <br>

					</p>

				</tr>

				<tr>

					<p style="text-align: left; margin:15px;"><strong>Modo de elaborar el nuevo certificado:</strong></p>

					<p style="text-align: left; margin:15px;">

						<input type="radio" id="validar7459_3"<?php if (strcmp($certificado,"12")==0) {echo "checked='checked'";} ?> value="12" name="habilitacion_proceso_certificado<?php echo $row_configuracion['conf_nombre']; ?>" />Hacer un nuevo certificado de estudios, con el nuevo estado acad&eacute;mico y con la fecha de emisi&oacute;n actual<br> <br>

						<input type="radio" id="validar7459_2"<?php if (strcmp($certificado,"13")==0) {echo "checked='checked'";} ?> value="13" name="habilitacion_proceso_certificado<?php echo $row_configuracion['conf_nombre']; ?>" />Adicionar al certificado ya emitido una nota pie de documento, con el detalle de los procesos efectuados (Proceso de superaci&oacute;n de insuficiencias acad&eacute;micas - Nota de superaci&oacute;n - Fecha - Acta - Nueva Nota) &uacute;ltimo estado acad&eacute;mico.<br> <br>

						<input type="radio" id="validar7459_1"<?php if (strcmp($certificado,"14")==0) {echo "checked='checked'";} ?> value="14" name="habilitacion_proceso_certificado<?php echo $row_configuracion['conf_nombre']; ?>" />Cargar al libro final de valoraciones<br> <br>

					</p>

				</tr>

			</table>

		</div>

</div></div></div></div></div>

<script>

function clcuares()

{

var caden_a = document.getElementById('operraccionn').value;

caden_a = caden_a.toLowerCase(); 	

if(caden_a=="CIENCIAS ECONOMICAS" || caden_a=="ciencias economicas" || caden_a=="Ciencias Economicas" || caden_a=="ciencias económicas" || caden_a=="Ciencias Económicas" || caden_a=="CIENCIAS ECONÓMICAS")

{

var caddeena = '31';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="FILOSOFIA" || caden_a=="filosofia" || caden_a=="Filosofia" || caden_a=="filosofía" || caden_a=="Filosofía" || caden_a=="FILOSOFÍA")

{

var caddeena = '43';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="MATEMATICAS" || caden_a=="matematicas" || caden_a=="Matematicas" || caden_a=="matemáticas" || caden_a=="Matemáticas" || caden_a=="MATEMÁTICAS")

{

var caddeena = '29';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="EDUCACION RELIGIOSA" || caden_a=="educacion religiosa" || caden_a=="Educacion Religiosa" || caden_a=="educación Religiosa" || caden_a=="Educación Religiosa" || caden_a=="EDUCACIÓN RELIGIOSA")

{

var caddeena = '27';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="HUMANIDADES LENGUA CASTELLANA" || caden_a=="humanidades lengua castellana" || caden_a=="Humanidades Lengua Castellana")

{

var caddeena = '28';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="EDUCACIÓN FISICA RECREACION Y DEPORTES" || caden_a=="educación fisica recreacion y deportes" || caden_a=="Educación Fisica Recreacion y Deportes" || caden_a=="educación física recreación y deportes" || caden_a=="Educación Física Recreación y Deportes" || caden_a=="EDUCACIÓN FÍSICA RECREACIÓN Y DEPORTES")

{

var caddeena = '25';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="EDUCACION ETICA Y EN VALORES HUMANOS" || caden_a=="educacion etica y en valores humanos" || caden_a=="Educacion Etica y en Valores Humanos" || caden_a=="educación ética y en valores humanos" || caden_a=="Educación Ética y en Valores Humanos" || caden_a=="EDUCACIÓN ÉTICA Y EN VALORES HUMANOS")

{

var caddeena = '24';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="CIENCIAS NATURALES Y EDUCACION AMBIENTAL" || caden_a=="ciencias naturales y educacion ambiental" || caden_a=="Ciencias naturales y educación ambiental" || caden_a=="ciencias naturales y educación ambiental" || caden_a=="Ciencias Naturales y Educación Ambiental" || caden_a=="CIENCIAS NATURALES Y EDUCACIÓN AMBIENTAL")

{

var caddeena = '22';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="CIENCIAS SOCIALES HISTORIA GEOGRAFIA CONSTITUCIÓN POLITICA Y DEMOCRACIA" || caden_a=="ciencias sociales historia geografia constitución politica y democracia" || caden_a=="Ciencias Sociales Historia Geografia Constitución Politica y Democracia" || caden_a=="ciencias sociales historia geografía constitución política y democracia" || caden_a=="Ciencias Sociales Historia Geografía Constitución Política y Democracia" || caden_a=="CIENCIAS SOCIALES HISTORIA GEOGRAFÍA CONSTITUCIÓN POLÍTICA Y DEMOCRACIA")

{

var caddeena = '21';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="CIENCIAS POLITICAS" || caden_a=="ciencias politicas" || caden_a=="Ciencias Politicas" || caden_a=="Ciencias Politicas" || caden_a=="Ciencias Políticas" || caden_a=="CIENCIAS POLÍTICAS")

{

var caddeena = '32';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="TECNOLOGIA E INFORMATICA" || caden_a=="tecnologia e informatica" || caden_a=="Tecnologia e Informatica" || caden_a=="tecnología e informática" || caden_a=="Tecnología e Informática" || caden_a=="TECNOLOGÍA E INFORMÁTICA")

{

var caddeena = '33';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="DIMENSION COGNITIVA" || caden_a=="dimension cognitiva" || caden_a=="Dimension Cognitiva" || caden_a=="dimensión cognitiva" || caden_a=="Dimensión Cognitiva" || caden_a=="DIMENSIÓN COGNITIVA")

{

var caddeena = '35';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="DIMENSION CORPORAL" || caden_a=="dimension corporal" || caden_a=="Dimension Corporal" || caden_a=="dimensión corporal" || caden_a=="Dimensión Corporal" || caden_a=="DIMENSIÓN CORPORAL")

{

var caddeena = '36';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="DIMENSION ETICA ACTITUDES Y VALORES" || caden_a=="dimension etica actitudes y valores" || caden_a=="Dimension Etica Actitudes y Valores" || caden_a=="dimensión ética actitudes y valores" || caden_a=="Dimensión Ética Actitudes y Valores" || caden_a=="DIMENSIÓN ÉTICA ACTITUDES Y VALORES")

{

var caddeena = '39';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="DIMENSION ESTETICA" || caden_a=="dimension estetica" || caden_a=="Dimension Estetica" || caden_a=="dimensión estética" || caden_a=="Dimensión Estética" || caden_a=="DIMENSIÓN ESTÉTICA")

{

var caddeena = '38';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="DIMENSION COMUNICATIVA" || caden_a=="dimension comunicativa" || caden_a=="Dimension Comunicativa" || caden_a=="dimensión comunicativa" || caden_a=="Dimensión Comunicativa" || caden_a=="DIMENSIÓN COMUNICATIVA")

{

var caddeena = '40';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="EMPRENDIMIENTO" || caden_a=="emprendimiento" || caden_a=="Emprendimiento")

{

var caddeena = '42';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

if(caden_a=="HUMANIDADES IDIOMA EXTRANJERO" || caden_a=="humanidades idioma extranjero" || caden_a=="Humanidades Idioma Extranjero")

{

var caddeena = '44';

var caddeena = caddeena.toLowerCase();

document.getElementById("resulltaaddo").value=caddeena;

}

}

</script>

		<script type="text/javascript">

			<!--

			// permite que si chequeo el input type radio (Si) entonces se habilite la solucion del parametro y si chequeo no oculto la solucion del parametro.

			

			

			// permite determinar el estado del campo que contiene la nota especifica en la solucion del parametro 159 dependiendo si activan o desactivan la opcion de de calificacion especifica

			function determinarEstadoNota(){

				// miro si esta activa la opcion calificacion especifica en la solucion del parametro 159

				var notaEspecifica = document.getElementsByName( "habilitacion_proceso_<?php echo $row_configuracion['conf_nombre']; ?>" )[1].checked;

				if( notaEspecifica == true ){ // verifico si esta seleccionada ese input type radio calificiacion especifica

					document.getElementById("nota").disabled = false; // activo el campo para que pueda ingresar la nota especifica

				}else{ // si no esta activada esa opcion de calificacion especifica

					document.getElementById("nota").disabled = true; // desactivo el campo de calificacion especifica

				}

			}

			// permite que al cargar la pagina determinar si debe activar o no el campo de calificacion especifica minima

			function determinarEstadoNotaAlCargar(){

				const CALIFICACION_MINIMA = "11"; // esta constante tiene el valor que identifica al input type radio de la opcion calificacion especifica minima de la solucion del parametro 159

				var opcion_calificacion = "<?php echo $calificacion?>"; // obtiene la opcion que se selecciono y guardo en la BD en la solucion del parametro 159 en la seccion de calificacion exigida

				if(opcion_calificacion == CALIFICACION_MINIMA){ // determino si la opcion que selecciono fue la del calificacion especifica minima

					document.getElementById("nota").disabled = false; // habilito el campo de calificacion minima 

				}else{ // la opcion seleccionada no es la de calificacion especifica minima

					document.getElementById("nota").disabled = true; // deshabilito el campo de calificacion minima

				}

			}

			// Permite deshabilitar o habilitar un conjunto de campos en este caso para los 12 campos de la solucion del parametro 159 en la seccion de areas a tener en cuenta

			function setDisabledCampos(campos, valor){ // obtengo el conjunto de campos (array) y el valor (false o true)

				for(var j = 0; j < campos.length; j++){ // recorro el conjunto de campos

					campos[j].disabled = valor; // le asigno el valor que me pasaron por parametro a cada campo del conjunto de campos

				}

			}

			// permite determinar el estado de los campos de la seccion asignaturas a tener en cuenta en la solucion del parametro 159

			function determinarEstadoCampos( ){

				const AREAS_ESPECIFICAS = "8"; // determina el valor de la opcion que se debe elegir para activar los campos que este caso es areas especificas en la solucion del parametro 159

				// obtiene el conjunto de input type radio que contienen las diferentes opciones de la seccion de areas a tener en cuenta de la solucion del parametro 159

				var opciones = document.getElementsByName( "habilitacion_proceso_area<?php echo $row_configuracion['conf_nombre']; ?>" ); 

				for( var i = 0; i < opciones.length; i++ ){ // recorro el conjunto de input type radio que contienen las opciones

					if(opciones[i].checked == true){ // determino cual opcion esta seleccionada

						campos = document.getElementsByClassName("asignatura"); // obtengo el conjunto de los 12 campos de las asignaturas especificas

						if(opciones[i].value == AREAS_ESPECIFICAS){ // determino si la opcion seleccionada es la de areas especificas

							setDisabledCampos(campos,false); // activo los 12 campos para que ingrese las areas especificas

						}else{ // la opcion seleccionada no es la de areas especificas

							setDisabledCampos(campos,true); // desactivo los 12 campos de areas especificas

						} // termino else

					} // termino if

				} // termino for

			}

			// permite que al cargar la pagina determinar si debe habilitar o no los 12 campos de areas especificas dependiendo de los guardado en la BD anteriormente

			function determinarEstadoCamposAlCargar(){ 

				const areas_especificas = "8"; // determinia el valor del input type radio que representa la opcion de areas epecificas

				var opcion = "<?php echo $area?>"; // obtengo el valor guardado en la BD que determina la opcion que fue seleccionada y guardad

				var campos = document.getElementsByClassName("asignatura"); // obtengo el conjunto de los 12 campos de las areas especificas

				if (opcion == areas_especificas){ // si el valor traido es igual al valor que identifica la opcion areas especificas

					setDisabledCampos(campos, false); // activo los 12 campos

				}else{ // si el valor tradio es diferente fue porque se selecciono otra opcion diferente a areas especificas

					setDisabledCampos(campos, true); // desactivo los 12 campos

				}

			}

			// permite determinar el estados de la solucion, de los 12 campos de las areas especificas y el campo de calificacion minima al cargar la pagina

			function determinarEstados(){

				 // determina el estado de la solucion del parametro 159

				determinarEstadoCamposAlCargar(); // determina el estado de los 12 campos de las areas especificas 

				determinarEstadoNotaAlCargar(); // determinar el estado del campo de la calificacion minima 

			}

			// permite determinar si se repite algun area en los 12 campos donde se introducen las areas especificas

			function seRepiteArea(){

				

				var campos = document.getElementsByClassName("asignatura"); // esta variable almacena el arreglo de los campos

				// determina si se repite algun area y si es asi muestra una alerta

				for(var i = 0; i < campos.length - 1; i++){ 

					for(var j = i + 1; j < campos.length; j++){

						if(campos[i].value == campos[j].value  && campos[i].value != 0 ){

								sweetAlert("ERROR", "Revise que en el parametro 81 no se repitan areas", "warning");

							return false;

						}

						

					}

				}

			}

	

			addEvent('load', determinarEstados, false); // determino que cuando se cargue la pagina habilite o deshabilite la solkucion del parametro

			//-->

		</script>

	

		<?php

		break;

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!---------------------------------------------- FIN PARAMETROS VIGENCIA DE TIEMPOS -------------------------------- -->

<!----------------------------------------------  PARAMETROS PROCESOS ASIGNADOS AL SISTEMA -------------------------------- -->

<?php

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (136,151,164)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosk=mysqli_query($conexion,"select * from conf_sygescol_adic where id=11")or die("Problemas en la Consulta".mysqli_error());while ($regk=mysqli_fetch_array($registrosk)){$coloracordk=$regk['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_vigencia_tiempos" style="background-color: <?php echo $coloracordk ?>"><center><strong>PAR&Aacute;METROS PARA CONTROL VIGENCIA DE TIEMPOS</strong></center><br /><center><input type="radio" value="rojok" name="coloresk">Si&nbsp;&nbsp;<input type="radio" value="naranjak" name="coloresk">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 136:
		$valoresP60 = explode("$", $row_configuracion['conf_valor'])
		?>
		<table>
			<tr> <td></td><td><select class="sele_mul" name="a_<?php echo $row_configuracion['conf_nombre']; ?>">
				<option value="S" <?php if (!(strcmp("S", $valoresP60[0]))) {echo "selected=\"selected\"";} ?>>Aplica</option>
				<option value="N" <?php if (!(strcmp("N", $valoresP60[0]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>
			</select></td></tr>
			<tr><td></td><td><b>Si aplica defina:</b></td>
			</tr>
			<tr><td></td><td>
			
		<table>
			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"c") == true)  {echo "checked=checked";} ?> value="c" name="conc_<?php echo $row_configuracion['conf_nombre']; ?>"></td>
			<td><b>Con control total de acceso al sistema para el coordinador acad&eacute;mico por ausencia de cierre parcial o total de grupos</b></td></tr>
			<tr><td><input type="checkbox"  <?php if (strpos($row_configuracion['conf_valor'],"d") == true)  {echo "checked=checked";} ?> value="d" name="cond_<?php echo $row_configuracion['conf_nombre']; ?>"></td>
			<td><b>Con control de acceso al siguiente periodo, para el docente</b></td></tr>
			<tr><td><input type="radio"  <?php if (strpos($row_configuracion['conf_valor'],"e") == true)  {echo "checked=checked";} ?> value="e" name="cone_<?php echo $row_configuracion['conf_nombre']; ?>"></td>
			<td><b>Con control de impresion de boletines para el estudiante afectado</b> </td></tr>
			<tr><td><input type="radio"  <?php if (strpos($row_configuracion['conf_valor'],"f") == true)  {echo "checked=checked";} ?> value="f" name="cone_<?php echo $row_configuracion['conf_nombre']; ?>"></td>
			<td><b>Con control de impresion de boletines para el grupo afectado</b> </td></tr>
			<tr><td><input type="radio"  <?php if (strpos($row_configuracion['conf_valor'],"g") == true)  {echo "checked=checked";} ?> value="g" name="cone_<?php echo $row_configuracion['conf_nombre']; ?>"></td>
			<td><b>Permitir la impresion de boletines, asignando la identidad del docente responsable</b> </td></tr>
		</table>
			</td></tr>
		</table>
		<?php
		break;
	case 151:

		$reasignacion2_ = explode("$",$row_configuracion['conf_valor']);

		?>

	<div class="container_demohrvszv">

	<div class="accordion_example2wqzx">

	<div class="accordion_inwerds">

	<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

	<div class="acc_contentsaponk">

	<div class="grevdaiolxx">

		<table>

		<p style="text-align: left; margin:15px;">

		<input type="radio" onclick="javascript:determinarEstadoCampos151();"<?php if (strpos($row_configuracion['conf_valor'],"1")==true) {echo "checked='checked'";} ?> value="1" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />No aplica <b>LA REASIGNACION DE GRUPOS</b> para la institucion educativa <br> <br>

		<input type="radio" onclick="javascript:determinarEstadoCampos151();" <?php if (strpos($row_configuracion['conf_valor'],"2")==true) {echo "checked='checked'";} ?> value="2" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />Permitir el cambio de curso siempre y cuando, el estudiante tenga calificaciones parciales registradas en el sistema en todas las asignaturas.<br> <br>

		<input type="radio" onclick="javascript:determinarEstadoCampos151();"<?php if (strpos($row_configuracion['conf_valor'],"3")==true) {echo "checked='checked'";} ?> value="3" name="reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" />Permitir el cambio de curso pero controlando, que finalizada la semana <input type="text" class="p119"onkeypress="return justNumbers(event);" style="border-radius: 10px; width: 10%;" name="reasignacion2_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $reasignacion2_[2];?>"> del periodo activo, al estudiante se le hayan registrado calificaciones parciales en el sistema.

		</p>

		</table>

		</div>

</div>

</div>

</div>

</div>

<script type="text/javascript">

	

function determinarEstadoCampos151( ){

				const AREAS_ESPECIFICAS = "3"; // determina el valor de la opcion que se debe elegir para activar los campos que este caso es areas especificas en la solucion del parametro 159

				// obtiene el conjunto de input type radio que contienen las diferentes opciones de la seccion de areas a tener en cuenta de la solucion del parametro 159

				var opciones = document.getElementsByName( "reasignacion_<?php echo $row_configuracion['conf_nombre']; ?>" ); 

				for( var i = 0; i < opciones.length; i++ ){ // recorro el conjunto de input type radio que contienen las opciones

					if(opciones[i].checked == true){ // determino cual opcion esta seleccionada

						campos = document.getElementsByName("reasignacion2_<?php echo $row_configuracion['conf_nombre']; ?>"); // obtengo el conjunto de los 12 campos de las asignaturas especificas

						if(opciones[i].value == AREAS_ESPECIFICAS){ // determino si la opcion seleccionada es la de areas especificas

							setDisabledCampos(campos,false); // activo los 12 campos para que ingrese las areas especificas

						}else{ // la opcion seleccionada no es la de areas especificas

							setDisabledCampos(campos,true); // desactivo los 12 campos de areas especificas

						} // termino else

					} // termino if

				} // termino for

	}

</script>

		<?php

		break;

		Case 164:

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  	<a href="asignacion_tareas.php" target="_blank" style="color:#3399FF">Ir a tareas por perfiles</a>

				  </td>

				 </tr>

			</table> 

					<?php

		break; 

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!---------------------------------------------- FIN PARAMETROS PROCESOS ASIGNADOS AL SISTEMA -------------------------------- -->

<!---------------------------------------------- PARAMETROS ASIGNACION INTEGRANTES -------------------------------- -->

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (142,143)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosx=mysqli_query($conexion,"select * from conf_sygescol_adic where id=13")or die("Problemas en la Consulta".mysqli_error());while ($regx=mysqli_fetch_array($registrosx)){$coloracordx=$regx['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_automatizacion_sistema" style="background-color: <?php echo $coloracordx ?>"><center><strong>PAR&Aacute;METROS PARA AUTOMATIZACI&Oacute;N DE PROCESOS ASIGNADOS AL SISTEMA</strong></center><br /><center><input type="radio" value="rojox" name="coloresx">Si&nbsp;&nbsp;<input type="radio" value="naranjax" name="coloresx">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 142:

		?>

		

<div class="container_demohrvszv">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Iacute;tem 1</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="RA" <?php if (strpos($row_configuracion['conf_valor'],"RA") == true )    {echo "checked=checked";} ?>>Rendimiento acad&eacute;mico<br>

				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="NPO" <?php if (strpos($row_configuracion['conf_valor'],"NPO") == true )  {echo "checked=checked";} ?>>N&uacute;mero de puesto obtenido<br>

				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="RCH" <?php if (strpos($row_configuracion['conf_valor'],"RCH") == true )  {echo "checked=checked";} ?>>Registro en cuadro de honor<br>

				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="RI" <?php if (strpos($row_configuracion['conf_valor'],"RI") == true )    {echo "checked=checked";} ?>>Registros de Inasistencia<br>

				<input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="CA" <?php if (strpos($row_configuracion['conf_valor'],"CA") == true )    {echo "checked=checked";} ?>>Citaci&oacute;n de Acudientes<br>

				<input type="checkbox" name="f_<?php echo $row_configuracion['conf_nombre']; ?>" value="CCA" <?php if (strpos($row_configuracion['conf_valor'],"CCA") == true )  {echo "checked=checked";} ?>>Cumplimiento de Citaci&oacute;n del Acudiente<br>

				<input type="checkbox" name="g_<?php echo $row_configuracion['conf_nombre']; ?>" value="ARA" <?php if (strpos($row_configuracion['conf_valor'],"ARA") == true )  {echo "checked=checked";} ?>>Asistencia a reuniones del acudiente<br>

				<input type="checkbox" name="h_<?php echo $row_configuracion['conf_nombre']; ?>" value="AEPA" <?php if (strpos($row_configuracion['conf_valor'],"AEPA") == true )  {echo "checked=checked";} ?>>Asistencia escuela de padres Acudiente<br>

				<input type="checkbox" name="i_<?php echo $row_configuracion['conf_nombre']; ?>" value="RPS" <?php if (strpos($row_configuracion['conf_valor'],"RPS") == true )  {echo "checked=checked";} ?>>Resultados pruebas saber<br>

				<input type="checkbox" name="j_<?php echo $row_configuracion['conf_nombre']; ?>" value="RRA" <?php if (strpos($row_configuracion['conf_valor'],"RRA") == true )  {echo "checked=checked";} ?>>Registro de reincidencias automatizadas<br>

				<input type="checkbox" name="k_<?php echo $row_configuracion['conf_nombre']; ?>" value="RN" <?php if (strpos($row_configuracion['conf_valor'],"RN") == true )  {echo "checked=checked";} ?>>Registro de Novedades<br>

				<input type="checkbox" name="l_<?php echo $row_configuracion['conf_nombre']; ?>" value="RG" <?php if (strpos($row_configuracion['conf_valor'],"RG") == true )  {echo "checked=checked";} ?>>Reasignaciones de Grupo<br>

				<input type="checkbox" name="m_<?php echo $row_configuracion['conf_nombre']; ?>" value="RENR" <?php if (strpos($row_configuracion['conf_valor'],"RENR") == true )  {echo "checked=checked";} ?>>Resultados de nivelaciones y/o recuper<br>

				<input type="checkbox" name="n_<?php echo $row_configuracion['conf_nombre']; ?>" value="RS" <?php if (strpos($row_configuracion['conf_valor'],"RS") == true )  {echo "checked=checked";} ?>>Reportes de S.M.S.<br>

				<input type="checkbox" name="ñ_<?php echo $row_configuracion['conf_nombre']; ?>" value="RDE" <?php if (strpos($row_configuracion['conf_valor'],"RDE") == true )  {echo "checked=checked";} ?>>Reportes De E-mails<br>

		</p>

		</div>

</div>

</div>

</div>

</div>

		<?

		break;	

		case 143:

		?>

<div class="container_demohrvszv">  

<div class="accordion_example2wqzx">	 

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Itilde;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_celularA" <?php if (strpos($row_configuracion['conf_valor'],"acu_celularA") == true )    {echo "checked=checked";} ?>>N&uacute;mero de Celular Del acudiente<br>

				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_celularP" <?php if (strpos($row_configuracion['conf_valor'],"acu_celularP") == true )  {echo "checked=checked";} ?>>N&uacute;mero de Celular Del Padre<br>

				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_celularM" <?php if (strpos($row_configuracion['conf_valor'],"acu_celularM") == true )  {echo "checked=checked";} ?>>N&uacute;mero de Celular De la Madre<br>

				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_emailA" <?php if (strpos($row_configuracion['conf_valor'],"acu_emailA") == true )    {echo "checked=checked";} ?>>Correo Electr&oacute;nico Del acudiente<br>

				<input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_emailP" <?php if (strpos($row_configuracion['conf_valor'],"acu_emailP") == true )    {echo "checked=checked";} ?>>Correo Electr&oacute;nico Del Padre<br>

				<input type="checkbox" name="f_<?php echo $row_configuracion['conf_nombre']; ?>" value="acu_emailM" <?php if (strpos($row_configuracion['conf_valor'],"acu_emailM") == true )  {echo "checked=checked";} ?>>Correo Electr&oacute;nico De la Madre<br>

				<input type="checkbox" name="g_<?php echo $row_configuracion['conf_nombre']; ?>" value="alumno_fec_nac" <?php if (strpos($row_configuracion['conf_valor'],"alumno_fec_nac") == true )  {echo "checked=checked";} ?>>Fecha de Nacimiento del Estudiante<br>

				<input type="checkbox" name="h_<?php echo $row_configuracion['conf_nombre']; ?>" value="flias_acc_ben" <?php if (strpos($row_configuracion['conf_valor'],"flias_acc_ben") == true )  {echo "checked=checked";} ?>>Beneficiario de Familias en Acci&oacute;n<br>

				<input type="checkbox" name="i_<?php echo $row_configuracion['conf_nombre']; ?>" value="sisben_id" <?php if (strpos($row_configuracion['conf_valor'],"sisben_id") == true )  {echo "checked=checked";} ?>>Sisben<br>

				<input type="checkbox" name="j_<?php echo $row_configuracion['conf_nombre']; ?>" value="transporte_id" <?php if (strpos($row_configuracion['conf_valor'],"transporte_id") == true )  {echo "checked=checked";} ?>>Beneficiario de Transporte Escolar<br>

				<input type="checkbox" name="k_<?php echo $row_configuracion['conf_nombre']; ?>" value="benefi_alime" <?php if (strpos($row_configuracion['conf_valor'],"benefi_alime") == true )  {echo "checked=checked";} ?>>Beneficiario de Alimentaci&oacute;n Escolar<br>

				<input type="checkbox" name="l_<?php echo $row_configuracion['conf_nombre']; ?>" value="tipo_alime" <?php if (strpos($row_configuracion['conf_valor'],"tipo_alime") == true )  {echo "checked=checked";} ?>>Tipo Alimentaci&oacute;n<br>

				<input type="checkbox" name="m_<?php echo $row_configuracion['conf_nombre']; ?>" value="estu_conf" <?php if (strpos($row_configuracion['conf_valor'],"estu_conf") == true )  {echo "checked=checked";} ?>>Estudiante v&iacute;ctima de conflicto<br>

				<input type="checkbox" name="n_<?php echo $row_configuracion['conf_nombre']; ?>" value="cuadro_Acu" <?php if (strpos($row_configuracion['conf_valor'],"cuadro_Acu") == true )  {echo "checked=checked";} ?>>Cuadro Acumulativo de Matricula<br>

				<input type="checkbox" name="ñ_<?php echo $row_configuracion['conf_nombre']; ?>" value="pre_matri" <?php if (strpos($row_configuracion['conf_valor'],"pre_matri") == true )  {echo "checked=checked";} ?>>Prerrequisitos de Matricula<br>

		</p>

		</div></div></div></div></div>

		

		<?

		break;	

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!---------------------------------------------- FIN PARAMETROS ASIGNACION DE INTEGRANTES -------------------------------- -->

<!----------------------------------------------  PARAMETROS ASPECTOS PLAN DE ESTUDIO -------------------------------- -->

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (144,145,146,147,166)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosy=mysqli_query($conexion,"select * from conf_sygescol_adic where id=14")or die("Problemas en la Consulta".mysqli_error());while ($regy=mysqli_fetch_array($registrosy)){$coloracordy=$regy['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_integrantes" style="background-color: <?php echo $coloracordy ?>"><center><strong>PAR&Aacute;METROS PARA ASIGNACI&Oacute;N DE INTEGRANTES</strong></center><br /><center><input type="radio" value="rojoy" name="coloresy">Si&nbsp;&nbsp;<input type="radio" value="naranjay" name="coloresy">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

do { $consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

<td valign="top" width="80%">

<div class="container_demohrvszv" >

<div class="accordion_example2wqzx">	 

<div class="accordion_inwerds">

<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

</div></div></div></div></div>

 </td>

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 144:

		?>

<div class="container_demohrvszv">  

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Itilde;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="directivosDocentes" <?php if (strpos($row_configuracion['conf_valor'],"directivosDocentes") == true )    {echo "checked=checked";} ?>>Directivos docentes<br>

				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="docentes" <?php if (strpos($row_configuracion['conf_valor'],"docentes") == true )  {echo "checked=checked";} ?>>Docentes<br>

				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="acudientes" <?php if (strpos($row_configuracion['conf_valor'],"acudientes") == true )  {echo "checked=checked";} ?>>Acudientes<br>

				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="estudiantes" <?php if (strpos($row_configuracion['conf_valor'],"estudiantes") == true )    {echo "checked=checked";} ?>>Estudiantes<br>
<!--
	        <input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="otro" <?php if (strpos($row_configuracion['conf_valor'],"otro") == true )    {echo "checked=checked";} ?>>Otro<br>		
-->
		</p>

		</div></div></div></div></div>

		

		<?

		break;

		case 145:
		?>
<div class="container_demohrvszv">  
<div class="accordion_example2wqzx">
<div class="accordion_inwerds">
<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>
<div class="acc_contentsaponk">
<div class="grevdaiolxx">
		<p style="text-align: left;margin:15px;">
				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="directivosDocentes" <?php if (strpos($row_configuracion['conf_valor'],"directivosDocentes") == true )    {echo "checked=checked";} ?>>Directivos docentes<br>
				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="docentes" <?php if (strpos($row_configuracion['conf_valor'],"docentes") == true )  {echo "checked=checked";} ?>>Docentes<br>
				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="acudientes" <?php if (strpos($row_configuracion['conf_valor'],"acudientes") == true )  {echo "checked=checked";} ?>>Acudientes<br>
				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="estudiantes" <?php if (strpos($row_configuracion['conf_valor'],"estudiantes") == true )    {echo "checked=checked";} ?>>Estudiantes<br>
				<input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="otro" <?php if (strpos($row_configuracion['conf_valor'],"otro") == true )    {echo "checked=checked";} ?>>Otro<br>	

		</p> 
</div></div></div></div></div>
		<?php
		break;

case  146:

		?>

<div class="container_demohrvszv">  

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="directivosDocentes" <?php if (strpos($row_configuracion['conf_valor'],"directivosDocentes") == true )    {echo "checked=checked";} ?>>Directivos docentes<br>

				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="docentes" <?php if (strpos($row_configuracion['conf_valor'],"docentes") == true )  {echo "checked=checked";} ?>>Docentes<br>

				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="acudientes" <?php if (strpos($row_configuracion['conf_valor'],"acudientes") == true )  {echo "checked=checked";} ?>>Acudientes<br>

				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="estudiantes" <?php if (strpos($row_configuracion['conf_valor'],"estudiantes") == true )    {echo "checked=checked";} ?>>Estudiantes<br>

<!--

				<input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="otro" <?php if (strpos($row_configuracion['conf_valor'],"otro") == true )    {echo "checked=checked";} ?>>Otro<br>				
-->
		</p> 

</div></div></div></div></div>

		<?php

		break;

		case 147:

		?>

<div class="container_demohrvszv">  

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>&Iacute;tem</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

		<p style="text-align: left;margin:15px;">

				<input type="checkbox" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" value="directivosDocentes" <?php if (strpos($row_configuracion['conf_valor'],"directivosDocentes") == true )    {echo "checked=checked";} ?>>Directivos docentes<br>

				<input type="checkbox" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" value="docentes" <?php if (strpos($row_configuracion['conf_valor'],"docentes") == true )  {echo "checked=checked";} ?>>Docentes<br>

				<input type="checkbox" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" value="acudientes" <?php if (strpos($row_configuracion['conf_valor'],"acudientes") == true )  {echo "checked=checked";} ?>>Acudientes<br>

				<input type="checkbox" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" value="estudiantes" <?php if (strpos($row_configuracion['conf_valor'],"estudiantes") == true )    {echo "checked=checked";} ?>>Estudiantes<br>

<!--

				<input type="checkbox" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" value="otro" <?php if (strpos($row_configuracion['conf_valor'],"otro") == true )    {echo "checked=checked";} ?>>Otro<br>				

-->

		</p> 

</div></div></div></div></div>

		<?php

		break;

		case 166:

			$reasignacion2_ = explode("$",$row_configuracion['conf_valor']);

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				<div class="cajaparametrogenerales"><a href="gobie.php" target="_blank" style="color:#3399FF">Ir a sistematisacion de gobierno escolar</a></div>

				  </td>

				 </tr>

			

			</table> 

	

		<?php

		break;

		}

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (168,165)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosvv=mysqli_query($conexion,"select * from conf_sygescol_adic where id=15")or die("Problemas en la Consulta".mysqli_error());while ($regvv=mysqli_fetch_array($registrosvv)){$coloracordvv=$regvv['valor'];}

?>

<div class="container_demohrvszv_caja_1">

<div class="accordion_example2wqzx_caja_2">

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_definir_aspectos_plan_estudio" style="background-color: <?php echo $coloracordvv ?>"><center><strong>PAR&Aacute;METROS PARA DEFINIR ASPECTOS DEL PLAN DE ESTUDIOS</strong></center><br /><center><input type="radio" value="rojovv" name="coloresvv">Si&nbsp;&nbsp;<input type="radio" value="naranjavv" name="coloresvv">No</div></center>

				<div class="acc_contentsaponk_caja_4">

<div class="grevdaiolxx_caja_5">

<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do	{	$consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

<div class="container_demohrvszv" >

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

</div></div></div></div></div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	case 168: 

		?>

			<?php

			if(strpos($row_configuracion['conf_valor'],"$")>0)

			{

				$array_parametro = explode("$",$row_configuracion['conf_valor']);

				$cri = $array_parametro[0];

				$cri2 = $array_parametro[1];

				$cri3 = $array_parametro[2];

		

			}

			else

				$cri = $row_configuracion['conf_valor'];

		?>

	
<table  width="90%" >

		 <tr>

		 <td><b>Aplica</b>

		  <select class="sele_mul" name="criterio_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio_<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="S" <?php if (!(strcmp("S", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

			<option value="N" <?php if (!(strcmp("N", $cri['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

		  </select> 

<a href="area_crear_datos.php" target="_blank" style="color:#3399FF">Ir a ingreso de areas</a><br>

	
</td>

</tr>

</table>
<table  width="90%" >

<tr>

 <td><b>Aplica</b>

		  <select class="sele_mul" name="criterio2_<?php echo $row_configuracion['conf_nombre']; ?>" id="criterio2_<?php echo $row_configuracion['conf_nombre']; ?>">

			<option value="S" <?php if (!(strcmp("S", $cri2['conf_valor']))) {echo "selected=\"selected\"";} ?>>Si</option>

			<option value="N" <?php if (!(strcmp("N", $cri2['conf_valor']))) {echo "selected=\"selected\"";} ?>>No</option>

		  </select> 

				<a href="asignatura_crear_datos.php" target="_blank" style="color:#3399FF">Ir a ingreso de asignaturas</a>

	
</td>

</tr>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</table>

		<?php

		break;

	case 165: 

	$reasignacion2_ = explode("$",$row_configuracion['conf_valor']);

				$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

				  <a href="asignacion_tareas.php" target="_blank" style="color:#3399FF">Ir a tareas por perfiles</a>

				  </td>

				 </tr>

			

			</table> 

</div>

		<?php

		break;

		}// este es el fin 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!---------------------------------------------- FIN PARAMETROS ASPECTOS PLAN DE ESTUDIO -------------------------------- -->

<!----------------------------------------------  PARAMETROS CIERRE AÑO -------------------------------- --> 

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (137)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosww=mysqli_query($conexion,"select * from conf_sygescol_adic where id=16")or die("Problemas en la Consulta".mysqli_error());while ($regww=mysqli_fetch_array($registrosww)){$coloracordww=$regww['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

				<div class="acc_headerfgd_caja_titulo" id="parametros_cierre_año" style="background-color: <?php echo $coloracordww ?>"><center><strong>PAR&Aacute;METROS PARA CONTROL CIERRE A&Nacute;O</strong></center><br /><center><input type="radio" value="rojoww" name="coloresww">Si&nbsp;&nbsp;<input type="radio" value="naranjaww" name="coloresww">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario" border="1">

	<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

    <th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

do {	$consecutivo++;

	

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

   

	<td align="center">

	

	<?php

	switch($row_configuracion['conf_id'])

	{

	

			case 137:

		$valoresP61 = explode("$", $row_configuracion['conf_valor'])

		?>

		<!--PARAMETRO 58-->

		<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 1</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		<p style="text-align: left;margin: 0px 15px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

			<b style="color: red;">1. No permitir</b> el cierre en las &aacute;reas donde falte <b>al menos un ESTUDIANTE</b> por calificar, en cualquiera de los periodos acad&eacute;micos del a&ntilde;o, en el grupo que se pretenda cerrar.

			<br><b style="color: red;">Mensaje de alerta:</b><br>

			Tiene estudiantes pendientes por calificar del <b>#Grupo# - #Asignatura# -#Periodo# - #Docente# - #Estudiante#</b>.<br>

			<select class="sele_mul" name="a_<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

				<option value="S" <?php if (!(strcmp("S", $valoresP61[0]))) {echo "selected=\"selected\"";} ?>>Aplica</option>

				<option value="N" <?php if (!(strcmp("N", $valoresP61[0]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			</select>

		</p>

</div>

</div>

</div>

</div>

</div>

	<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 2</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		<p style="text-align: left;margin: 0px 15px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

			<b style="color: red;">2. No permitir</b> la generaci&oacute;n de:<br>

			<label style="font-size: 11px;border: solid 1px;border-radius: 10px;font-weight: bold;">1</label> Informe Final <br>

			<label style="font-size: 11px;border: solid 1px;border-radius: 10px;font-weight: bold;">2</label> Certificados de estudio <br>

			<label style="font-size: 11px;border: solid 1px;border-radius: 10px;font-weight: bold;">3</label> Libro final de valoraciones, a aquellos estudiantes, en cuyos grupos no se haya realizado el cierre <b>Total</b> de las &aacute;reas.

			<br><b style="color: red;">Mensaje de alerta:</b><br>

			Est&aacute; pendiente por cerrar las &aacute;reas del <b>#Grupo# - #Asignatura#.</b><br>

			<select class="sele_mul" name="b_<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

				<option value="S" <?php if (!(strcmp("S", $valoresP61[1]))) {echo "selected=\"selected\"";} ?>>Aplica</option>

				<option value="N" <?php if (!(strcmp("N", $valoresP61[1]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			</select>

		</p>

</div>

</div>

</div>

</div>

</div>

<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 3</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		<p style="text-align: left;margin: 0px 15px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

			<b style="color: red;">3. Validar que</b> en los grupos con estudiantes pendientes por registro de calificaciones, producto del <b>proceso de matr&iacute;cula extraordinaria</b> , el sistema no permita el cierre de 

			&aacute;reas, hasta tanto se haya registrado las calificaciones pendientes.<br><b style="color: red;">Mensaje de alerta:</b><br>

			Tiene estudiantes pendientes por calificar por matr&iacute;cula extraordinaria como perfil secretar&iacute;a acad&eacute;mica, en el <b>#Grupo# - #Periodos# - #Estudiante#</b><br>

	<select class="sele_mul" name="c_<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

				<option value="S" <?php if (!(strcmp("S", $valoresP61[2]))) {echo "selected=\"selected\"";} ?>>Aplica</option>

				<option value="N" <?php if (!(strcmp("N", $valoresP61[2]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			</select>

		</p>

	</div>

</div>

</div>

</div>

</div>

<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 4</div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

		<p style="text-align: left;margin: 0px 15px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

			<b style="color: red;">4. Validar que</b> en los grupos donde el sistema haya reportado al Perfil Coordinador Acad&eacute;mico alerta de pendientes por ausencia de registros del <b>FORDEB</b> en cualquiera de los periodos del a&ntilde;o y a&uacute;n est&eacute;n 

			<b>PENDIENTES </b>por registrar en el sistema, no se pueda cerrar las &aacute;reas<br><b style="color: red;">Mensaje de alerta:</b><br>

			A&uacute;n existe registro de Docentes pendientes por subir a la plataforma, (descriptores de Fortalezas, Debilidades y Recomendaciones) en: <b>#Grupo#  #Periodos# #Asignatura# #Docente#.</b><br>

			<select class="sele_mul" name="d_<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

				<option value="S" <?php if (!(strcmp("S", $valoresP61[3]))) {echo "selected=\"selected\"";} ?>>Aplica</option>

				<option value="N" <?php if (!(strcmp("N", $valoresP61[3]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			</select>

		</p>

	</div>

</div>

</div>

</div>

</div>

<div class="container_demohrvszv">

		  

		<div class="accordion_example2wqzx">

			 

			    <div class="accordion_inwerds">

				<div class="acc_headerfgd">&Iacute;tem 5</div>

				<div class="acc_contentsaponk">

					

				<div class="grevdaiolxx">

		<p style="text-align: left;margin: 0px 15px;border: solid 2px #CE6767;border-radius: 10px;padding: 12px;">

			<b style="color: red;">5. No generar</b> matr&iacute;culas a <b>ESTUDIANTES ANTIGUOS</b> por <b style="color: red;">Ninguno de los conceptos</b> ubicados 

			en la ruta <b>&#8220;Crear matr&iacute;culas&#8221;</b> o por el sistema biom&eacute;trico, si no se ha efectuado el cierre de &aacute;reas total del a&ntilde;o o semestre 

			anterior, en el grupo inmediatamente anterior de la matr&iacute;cula a efectuar.<br><b style="color: red;">Mensaje de alerta:</b><br>

			Est&aacute; pendiente por cerrar las &aacute;reas del  <b>#Grupo# - #Asignatura#</b><br>

			<select class="sele_mul" name="e_<?php echo $row_configuracion['conf_nombre']; ?>" style="width: 70%; margin: 5px 0 0 15px;">

				<option value="S" <?php if (!(strcmp("S", $valoresP61[4]))) {echo "selected=\"selected\"";} ?>>Aplica</option>

				<option value="N" <?php if (!(strcmp("N", $valoresP61[4]))) {echo "selected=\"selected\"";} ?>>No Aplica</option>

			</select>

		</p>		

</div>

</div>

</div>

</div>

</div>			

		<?php

		break;

}

?>

</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>

<!---------------------------------------------- FIN PARAMETROS CIERRE AÑO -------------------------------- -->

<?php

// esta es la tabla 2

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (162,160)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosppo=mysqli_query($conexion,"select * from conf_sygescol_adic where id=18")or die("Problemas en la Consulta".mysqli_error());while ($regppo=mysqli_fetch_array($registrosppo)){$coloracordppo=$regppo['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

			<?php

$query_ano_sistema162 = "SELECT * FROM year";

$ano_sistema162 = mysql_query($query_ano_sistema162, $sygescol) or die(mysql_error());

$row_ano_sistema162 = mysql_fetch_assoc($ano_sistema162);

$totalRows_ano_sistema162 = mysql_num_rows($ano_sistema162);

$an = $row_ano_sistema162["b"];

 ?>

				<div class="acc_headerfgd_caja_titulo" id="parametros_control_calificaciones" style="background-color: <?php echo $coloracordppo ?>"><center><strong>PAR&Aacute;METROS PARA EL A&Ntilde;O <?php echo $an+1; ?></strong></center><br /><center><input type="radio" value="rojoppo" name="coloresppo">Si&nbsp;&nbsp;<input type="radio" value="naranjappo" name="coloresppo">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do

	{

		$consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

 

<td align="center">

	

<?php

switch($row_configuracion['conf_id'])

{

		case 162:	

			$estado = '';

				if(strpos($row_configuracion['conf_valor'],"$")>0)

				{

					$array_parametro = explode("$",$row_configuracion['conf_valor']);

					$parametro = $array_parametro[0];

					$estado = $array_parametro[1];

				}

				else

					$parametro = $row_configuracion['conf_valor'];

				?>

			 <table  width="90%" >

				 <tr>

				 <td><b>Aplica</b>

</td><td>
				

				 <select class="sele_mul" name="<?php echo $row_configuracion['conf_nombre']; ?>" id="<?php echo $row_configuracion['conf_nombre']; ?>">

					<option value="S" <?php if (!(strcmp("S", $parametro))) {echo "selected=\"selected\"";} ?>>Si</option>

					<option value="N" <?php if (!(strcmp("N", $parametro))) {echo "selected=\"selected\"";} ?>>No</option>

				  </select>

</td><td></td><td>

				  	<a href="configuracion_matricula.php" target="_blank" style="color:#3399FF">Ir a proceso de continuidad</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				  </td>

				 </tr>

			

			</table> 

			

<?php

	

		break;
      case 160:
	$array_parametro = explode("$",$row_configuracion['conf_valor']);
		//Consultamos el tope maximo de los estudiantes (Zona Urbana)
		$proyecion_cupos_ind_1 = $array_parametro[1];
		$proyecion_cupos_ind_2 = $array_parametro[2];
		$proyecion_cupos_ind_3 = $array_parametro[3];
		$proyecion_cupos_ind_4 = $array_parametro[4];
		$proyecion_cupos_ind_5 = $array_parametro[5];
		$proyecion_cupos_ind_6 = $array_parametro[6];
		$proyecion_cupos_ind_7 = $array_parametro[7];
		$proyecion_cupos_ind_8 = $array_parametro[8];
		$proyecion_cupos_ind_9 = $array_parametro[9];
        $proyecion_cupos_ind_10 = $array_parametro[10];
		$proyecion_cupos_ind_11 = $array_parametro[11];
        $proyecion_cupos_ind_12 = $array_parametro[12];
        $proyecion_cupos_ind_13 = $array_parametro[13];
        $proyecion_cupos_ind_14 = $array_parametro[14];
        $proyecion_cupos_ind_15 = $array_parametro[15];
        $proyecion_cupos_ind_16 = $array_parametro[16];
        $proyecion_cupos_ind_17 = $array_parametro[17];
		?>
<!-- PARAMETRO 82 -->
		<div class="container_demohrvszv">
		<div class="accordion_example2wqzx">
			<div class="accordion_inwerds">
				<div class="acc_headerfgd">&Iacute;tem</div>
				<div class="acc_contentsaponk">
					<div class="grevdaiolxx">
		<table width="50%" class="formulario" align="center" style="float:left;">
			<tr>
				<th class="formulario">GRADO</th>
				<th class="formulario">INDICE (%)</th>
			</tr>
			<tr class="fila1">
				<td>Primero</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" name="planilla_prom_ant1_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_1; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila2">
				<td>Segundo</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant2_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_2; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
				<td>Tercero</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant3_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_3; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila2">
				<td>Cuarto</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant4_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_4; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
				<td>Quinto</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant5_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_5; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
			<tr class="fila2">
				<td>Sexto</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant6_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_6; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila1">
				<td>Septimo</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant7_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_7; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila2">
				<td>Octavo</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant8_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_8; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
				<td>Noveno</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant9_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_9; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
			<tr class="fila2">
				<td>Media Decimo</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant10_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_10; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
           <tr class="fila1">
				<td>Media Once</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant11_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_11; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
			<tr class="fila2">
				<td>Ciclo 1 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant12_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_12; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila1">
				<td>Ciclo 2 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant13_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_13; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila2">
				<td>Ciclo 3 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant14_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_14; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila1">
				<td>Ciclo 4 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant15_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_15; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
			<tr class="fila2">
				<td>Ciclo 5 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant16_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_16; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
            <tr class="fila1">
				<td>Ciclo 6 Adultos</td>
				<td style='text-align:center;'><input type="text" onkeypress="return justNumbers(event);" 
name="planilla_prom_ant17_ind_<?php echo $row_configuracion['conf_nombre']; ?>" value="<?php echo $proyecion_cupos_ind_17; ?>" style="border-radius: 10px; width: 18%;" /></td>
			</tr>
		</table>	
		</div>
</div>
</div>
</div>
</div>
<!-- FIN PARAMETRO 82 -->
		<?php
		break;
} 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>
<!-- johan arley -->

<?php
if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver, encabezado_parametros.titulo

								FROM conf_sygescol  INNER JOIN encabezado_parametros on encabezado_parametros.id_param=conf_sygescol.conf_id

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (243)  ORDER BY encabezado_parametros.id_orden ";

	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());

	$row_configuracion = mysql_fetch_assoc($configuracion);

// aca inicia la otra tabla

}?>

<?php 

include ("conb.php");$registrosppo=mysqli_query($conexion,"select * from conf_sygescol_adic where id=18")or die("Problemas en la Consulta".mysqli_error());while ($regppo=mysqli_fetch_array($registrosppo)){$coloracordppo=$regppo['valor'];}

?>

<div class="container_demohrvszv_caja_1">

		  

		<div class="accordion_example2wqzx_caja_2">

			 

			<div class="accordion_inwerds_caja_3">

			<?php

$query_ano_sistema162 = "SELECT * FROM year";

$ano_sistema162 = mysql_query($query_ano_sistema162, $sygescol) or die(mysql_error());

$row_ano_sistema162 = mysql_fetch_assoc($ano_sistema162);

$totalRows_ano_sistema162 = mysql_num_rows($ano_sistema162);

$an = $row_ano_sistema162["b"];

 ?>

				<div class="acc_headerfgd_caja_titulo" id="parametros_control_calificaciones" style="background-color: <?php echo $coloracordppo ?>"><center><strong>PAR&Aacute;METROS PARA EL RECONOCIMIENTO DE VOZ</strong></center><br /><center><input type="radio" value="rojoppo" name="coloresppo">Si&nbsp;&nbsp;<input type="radio" value="naranjappo" name="coloresppo">No</div></center>

				<div class="acc_contentsaponk_caja_4">

					

					<div class="grevdaiolxx_caja_5">

					<table  align="center" width="85%" class="centro" cellpadding="10" class="formulario"  border="1">

<tr>

	<th class="formulario"  style="background: #3399FF;" >Consecutivo </th>

	<th class="formulario"  style="background: #3399FF;" >Id Par&aacute;metro </th>

	<th class="formulario" >Tipo de Par&aacute;metro</th>

    <th class="formulario" >Detalle del Par&aacute;metro</th>

	<th class="formulario">Selecci&oacute;n</th>

	</tr>

	<?php

	do

	{

		$consecutivo++;

	?>

	<td class="formulario"   id="Parametro<?php echo $consecutivo; ?>" ><strong> <?php echo $consecutivo; ?></strong></td>

	<td class="formulario"  id="Parametro<?php echo $consecutivo; ?>" ><strong><?php echo $row_configuracion['conf_id'] ?></strong></td>

<td valign="top"><strong>

<div class="container_demohrvszv_caja_tipo_param">

<div class="accordion_example2wqzx">

<div class="accordion_inwerds">

<div class="acc_headerfgd"><strong>Tipo de Par&aacute;metro</strong></div>

<div class="acc_contentsaponk">

<div class="grevdaiolxx_caja_tipo_param">

<div  class="textarea "  align="justify" id="conf_nom_ver-<?php echo $row_configuracion['conf_id'] ?>"><?php echo $row_configuracion['conf_nom_ver']; ?></div>

</div></div></div></div></div>

</strong>

</td>

	

     

      <td valign="top" width="80%">

     <div class="container_demohrvszv" >

		  

		<div class="accordion_example2wqzx">

			 

			<div class="accordion_inwerds">

				<div class="acc_headerfgd"  id="cgasvf"><strong>Detalle Par&aacute;metro</strong></div>

				<div class="acc_contentsaponk">

					

					<div class="grevdaiolxx">

      <div  align="justify" class="textarea " id="conf_descri-<?php echo $row_configuracion['conf_id'] ?>" style="width: 90%;" align="justify">

     

      <?php echo $row_configuracion['conf_descri']; ?>

     

      </div>

     

					</div>

				</div>

			</div>

		</div>

</div>

 </td>

 

<td align="center">

	

<?php

switch($row_configuracion['conf_id'])

{


case 243:
$array_parametro = explode("$",$row_configuracion['conf_valor']);
              $array_parametro = explode("$",$row_configuracion['conf_valor']);
     

  //documentar//


			?>


<div class="container_demohrvszv">

    <div class="accordion_example2wqzx">

     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>Mensajes predeterminados</strong> </div>

        <div class="acc_contentsaponk">


          <div class="grevdaiolxx">






<script>

function agregarrv1(){
	var div = document.getElementById('rv1');
div.innerHTML = div.innerHTML + 'Extra stuff';
}

</script>




<div style="text-align:center;font-weight:bolder">Estudiantes que son llamados por segunda vez en el mismo intervalo de clase y ya fue registrada la inasistencia.</div>
<textarea name="rv1" id="rv1" cols="10" rows="10"  class="textarearv"><?php echo $array_parametro[0]; ?></textarea>


<br />
<div style="text-align:center;font-weight:bolder">Estudiantes llamados con datos similares.</div>
<textarea name="rv2" id="rv2" cols="10" rows="10"  class="textarearv"><?php echo $array_parametro[1]; ?></textarea>

<br />
<div style="text-align:center;font-weight:bolder">Estudiantes llamados con datos incorrectos.</div>
<textarea name="rv3" id="rv3" cols="10" rows="10"  class="textarearv"><?php echo $array_parametro[2]; ?></textarea>


<br />
<div style="text-align:center;font-weight:bolder">Confirmaci&oacute;n de registro exitoso</div>
<textarea name="rv4" id="r4" cols="10" rows="10"  class="textarearv"><?php echo $array_parametro[3]; ?></textarea>

<br />
<div style="text-align:center;font-weight:bolder">Mensaje en caso de error en la inasistencia</div>
<textarea name="rv7" id="r7" cols="10" rows="10"  class="textarearv"><?php echo $array_parametro[4]; ?></textarea>
<style>
	
.textarearv {
	border: 1px solid #6297BC;
	width: 100%;
	height: 30px;
}
</style>







			
</div>
</div>
</div>
</div>
</div>





<div class="container_demohrvszv">


    <div class="accordion_example2wqzx">


     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>Tiempo predeterminados(Segundos):</strong> </div>

        <div class="acc_contentsaponk">


          <div class="grevdaiolxx">






<script>

function agregarrv1(){
	var div = document.getElementById('rv1');
div.innerHTML = div.innerHTML + 'Extra stuff';
}

</script>










<table border="0" width="100%">
	
	<tr>
<td>
<div style="text-align:center;font-weight:bolder">Analisis de la informacion: </div> 

</td>
</tr>
<tr>
<td>
<div style="text-align:justify"> <br /> Intervalo de tiempo que emplea el sstema para analizar la informaci&oacute;n ingresada.</div>		<br />	
</td>
</tr>
<tr>	
<td>
<center><input type="number" name="rv5" value="<?php echo $array_parametro[5]; ?>"/>	</center> <br />
</td>
	</tr>


	<tr>
		<td>

		<div style="text-align:center;font-weight:bolder">Mensajes de ayuda: </div>	<br />
		<td>
		</tr>
		
		<tr>
		<td>
		<center>
			<div style="text-align:justify">Intervalo de tiempo que emplea el sstema para poner en pantalla el mensaje de ayuda.</div>
		</center><br />

		</td>
</tr>
		<tr>
		<td>

			<center>
				<input type="number" name="rv6" value="<?php echo $array_parametro[6]; ?>"/>
			</center>

		</td>
	</tr>
</table>



<br />



<style>
	
.textarearv {
	border: 1px solid #6297BC;
	width: 100%;
	height: 30px;
}
</style>







			
</div>
</div>
</div>
</div>
</div>






<div class="container_demohrvszv">


    <div class="accordion_example2wqzx">


     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>Tipo de interaccion con el Reconocimiento de voz</strong> </div>

        <div class="acc_contentsaponk">


          <div class="grevdaiolxx">






<script>

function agregarrv1(){
	var div = document.getElementById('rv1');
div.innerHTML = div.innerHTML + 'Extra stuff';
}

</script>



<input type="radio" name="tirv" value="tv" <?php if  ($array_parametro[7]=='tv') {echo "checked='checked'";} ?>/><label>Touch/Voz</label>
<br />
<input type="radio" name="tirv" value="v" <?php if  ($array_parametro[7]=='v') {echo "checked='checked'";} ?>/><label> Voz</label>


<br />



<style>
	
.textarearv {
	border: 1px solid #6297BC;
	width: 100%;
	height: 30px;
}
</style>







			
</div>
</div>
</div>
</div>
</div>




<div class="container_demohrvszv">


    <div class="accordion_example2wqzx">


     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>Estructura de la informacion</strong> </div>

        <div class="acc_contentsaponk">


          <div class="grevdaiolxx">






<script>

function agregarrv1(){
	var div = document.getElementById('rv1');
div.innerHTML = div.innerHTML + 'Extra stuff';
}

</script>

<center>
	<input type="radio" name="testruc" value="t1" <?php if  ($array_parametro[8]=='t1') {echo "checked='checked'";} ?>/><label>Tipo 1</label>
</center>
<center>
	<img style="width:80%" src="images/tipo1.PNG" name="imgrv" alt="" />
</center>
<br />
<center>
	<input type="radio" name="testruc" value="t2"  <?php if  ($array_parametro[8]=='t2') {echo "checked='checked'";} ?>/><label> Tipo 2</label>
</center>
<center>
	<img style="width:80%" src="images/tipo2.PNG" name="imgrv" alt="" />
</center>


<br />



<style>
	.imgrv{
		width: 90%;
		height: 10%;
		margin: 0 auto;
	}
.textarearv {
	border: 1px solid #6297BC;
	width: 100%;
	height: 30px;
}
</style>







			
</div>
</div>
</div>
</div>
</div>












<div class="container_demohrvszv">


    <div class="accordion_example2wqzx">


     <div class="accordion_inwerds">

        <div class="acc_headerfgd"><strong>&iquest;Permitir registros los fines de semana?</strong> </div>

        <div class="acc_contentsaponk">


          <div class="grevdaiolxx">






<script>

function agregarrv1(){
	var div = document.getElementById('rv1');
div.innerHTML = div.innerHTML + 'Extra stuff';
}

</script>





<input type="radio" name="tfines" value="fs"  <?php if  ($array_parametro[9]=='f1') {echo "checked='checked'";} ?>/><label>Si</label>
<br />
<input type="radio" name="tfines" value="fn"  <?php if  ($array_parametro[9]=='f2') {echo "checked='checked'";} ?>/><label> No</label>


<br />



<style>
	
.textarearv {
	border: 1px solid #6297BC;
	width: 100%;
	height: 30px;
}
</style>







			
</div>
</div>
</div>
</div>
</div>






			<?php 

		break;









} 

?>

	</td>

</tr>

<?php

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</table>

</div>

</div>

</div>

</div>

</div>
<!-- johanfin -->

<tr>

<td></td>

</tr>

<tr>

<div class="busqm form-style-5" style="background-color:transparent;">
<br /><br />

		<input type="text" name="buscaro_opar" placeholder="Ingrese Busqueda"><select name="buscadortipo_wq"><option value="nadaresp">Seleccione...</option selected><option value="descripconsec">N&uacute;mero de consecutivo</option><option value="descripbpd">Detalle del Par&aacute;metro</option><option value="descripid">ID del Par&aacute;metro</option><option value="tipobpd">Tipo del Par&aacute;metro</option></select>
	<input type="submit" value="Buscar" name="btn_buscarewe">
<input  name="actualizar" type="submit" id="actualizar" value="Limpiar">
	
<br /><br />
</div>
	
<br />

		<td align="center" colspan="4" style="position: fixed;bottom: 0px;width: 100%; left: 0px;background: rgba(0, 0, 0, 0.3);">

			<input  name="actualizar" type="submit" id="actualizar" value="Actualizar Parametros" onclick="return seRepiteAreaa()">

			<input  type="button" name="volver" value="Volver" onclick="location.href='configuracion_1290.php'"/>	

		
<style>

#vactod{

	background-color: #FF5252;

	color: white;

}	

</style>

		</td>

	</tr>

<script type="text/javascript">

<?php

if($totalRows_configuracion)

{

	mysql_data_seek($configuracion,0);

	mysql_select_db($database_sygescol, $sygescol);

	$query_configuracion = "SELECT conf_sygescol.conf_id, conf_sygescol.conf_nombre, conf_sygescol.conf_valor, conf_sygescol.conf_descri, conf_sygescol.conf_nom_ver

								FROM conf_sygescol

							WHERE conf_sygescol.conf_estado = 0

								AND conf_sygescol.conf_id IN (14, 16, 17, 18, 19, 20, 50, 56, 57, 58, 65, 66, 67, 68, 69, 70, 71, 73, 75, 76, 87, 88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,223) Order By conf_sygescol.conf_id";
	$configuracion = mysql_query($query_configuracion, $sygescol) or die(mysql_error());
	$row_configuracion = mysql_fetch_assoc($configuracion);
}
do
{
	switch($row_configuracion['conf_id'])
	{
			case 119:
		?>
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']."_fecha_1"; ?>", ifFormat : "%Y-%m-%d",	button : "aaa_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']."_fecha_2"; ?>", ifFormat : "%Y-%m-%d",	button : "bbb_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']."_fecha_3"; ?>", ifFormat : "%Y-%m-%d",	button : "ccc_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']."_fecha_4"; ?>", ifFormat : "%Y-%m-%d",	button : "ddd_<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;
		case 15:
		?>
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "b_<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;
		case 16:
		?>
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "b_<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;
		case 17:
		?>
		Calendar.setup({inputField : "<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "b_<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;
		case 67:
		?>
		Calendar.setup({inputField : "P_<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "a_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "S_<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "b_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "T_<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "c_<?php echo $row_configuracion['conf_nombre']; ?>"});
		Calendar.setup({inputField : "C_<?php echo $row_configuracion['conf_nombre']; ?>", ifFormat : "%Y-%m-%d",	button : "d_<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;
		case 121:
		?>
Calendar.setup({inputField : "periodo_fecha_inicio121", ifFormat : "%Y-%m-%d",	button : "pi_<?php echo $row_configuracion['conf_nombre']; ?>"});
Calendar.setup({inputField : "periodo_fecha_final121", ifFormat : "%Y-%m-%d",	button : "pf_<?php echo $row_configuracion['conf_nombre']; ?>"});
Calendar.setup({inputField : "periodo_fecha_inicio121_2", ifFormat : "%Y-%m-%d",	button : "pi_2<?php echo $row_configuracion['conf_nombre']; ?>"});
Calendar.setup({inputField : "periodo_fecha_final121_2", ifFormat : "%Y-%m-%d",	button : "pf_2<?php echo $row_configuracion['conf_nombre']; ?>"});
Calendar.setup({inputField : "periodo_fecha_inicio121_2_1", ifFormat : "%Y-%m-%d",	button : "pi_2_1<?php echo $row_configuracion['conf_nombre']; ?>"});
Calendar.setup({inputField : "periodo_fecha_final121_2_1", ifFormat : "%Y-%m-%d",	button : "pf_2_1<?php echo $row_configuracion['conf_nombre']; ?>"});
		<?php
		break;

			
		case 113:

		?>

		Calendar.setup({inputField : "periodo_fecha_inicio113", ifFormat : "%Y-%m-%d",	button : "pi_<?php echo $row_configuracion['conf_nombre']; ?>"});

		Calendar.setup({inputField : "periodo_fecha_final113", ifFormat : "%Y-%m-%d",	button : "pf_<?php echo $row_configuracion['conf_nombre']; ?>"});

		<?php

		break;		

		case 120:

		?>

		Calendar.setup({inputField : "periodo_fecha_inicio", ifFormat : "%Y-%m-%d",	button : "bb_<?php echo $row_configuracion['conf_nombre']; ?>", range: [<?php echo $row_ano_sistema['b']; ?>,<?php echo $row_ano_sistema['b']; ?>]});

		Calendar.setup({inputField : "periodo_fecha_final", ifFormat : "%Y-%m-%d",	button : "cc_<?php echo $row_configuracion['conf_nombre']; ?>", range: [<?php echo $row_ano_sistema['b']; ?>,<?php echo $row_ano_sistema['b']; ?>]});

		<?php

		break;

	}

}while($row_configuracion = mysql_fetch_assoc($configuracion));

?>

</script>

</form>

</td>

</tr>

<tr>

<th class="footer">

<?php

include_once("inc.footer.php");

mostrar_mensaje($_GET['listo']);

?>

</th>

</tr>

</table>

<style type="text/css">

.formulario55 td{

	border: solid 1px rgba(23, 18, 18, 0.08);

}

.formulario55 th{

	border: solid 2px rgba(23, 18, 18, 0.08);

}

input[type="radio"]{

    display: inline-block;

    width: 19px;

    height: 19px;

    background: url(img/check_radio_sheet.png) left top no-repeat;

    margin: -1px 2px 0 0;

    vertical-align: middle;

    cursor:pointer;

}

input[type="checkbox"]{

display: inline-block;

width: 17px;

height: 19px;

background: url(img/check_radio_sheet.png) left top no-repeat;

margin: -1px 2px 0 0;

vertical-align: middle;

cursor: pointer;

}

</style>

<script type="text/javascript">

	function activaAreas(){

		var caja = document.getElementById("totAreasPerdidas");

		var radioGen = document.getElementsByName("dm_29");

		var contenido = "null";

		for(var i=0;i<radioGen.length;i++)

        {

        	 if(radioGen[i].checked){

        	 	contenido=radioGen[i].value;

        	 }

        }

		

		if (contenido == 3) {

			caja.style.display = "block";

		}else{

			caja.style.display = "none";

		}

	}

</script>

<style type="text/css">

    

    .container_demohrvszv_caja_tipo_param{

      width: 300px;

      left: 0px;

    }

    .grevdaiolxx_caja_tipo_param{

      color: black;

      text-align: justify;

      white-space:normal;

      width: 240px;

    }

  </style>

<!--ESTILOS ACORDEON-->

<style type="text/css">

    

    .container_demohrvszv_caja_1{

      width: 1550px;

margin: 5px;

    }

    .grevdaiolxx_caja_5{

      color: black;

      text-align: justify;

      white-space:normal;

      width:900px;

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

<!--ESTILOS ACORDEON-->

<style type="text/css">

    

    .container_demohrvszv{

      width: 450px;

      left: 0px;

      margin:3px;

    }

    .grevdaiolxx{

      color: black;

      text-align: justify;

      white-space:normal;

      width: 390px;

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

</body>

</html>

<?php 

}

else {header("location:login_parametros.php");}

	 ?>

	 <style>

	 	.sweet-alert .sa-icon.sa-warning {

      border-color: #3399FF; }

    .sweet-alert .sa-icon.sa-warning .sa-line {

      background-color: #3399FF;}

    .sweet-alert h2 {

      color: #000; }

    .sweet-alert p {

    color: black;}

    .sweet-alert button {

    background-color: white;

    color:black;

}

.sweet-alert {

    background-color: white;

   }

.sweet-alert button {
    background-color: white;
    color: white;
}

   @-webkit-keyframes pulseWarning {

  0% {

    border-color:#FF9C01; }

  100% {

    border-color:#FBEE47; } }

@keyframes pulseWarning {

  0% {

    border-color:#FF9C01; }

  100% {

    border-color: #FBEE47; } }

.pulseWarning {

  -webkit-animation: pulseWarning 0.75s infinite alternate;

  animation: pulseWarning 0.75s infinite alternate; }

@-webkit-keyframes pulseWarningIns {

  0% {

    background-color: white; }

  100% {

    background-color:white; } }

@keyframes pulseWarningIns {

  0% {

    background-color: white; }

  100% {

    background-color: white; } }

</style>

<!-- Cambiar colores input -->

<style type="text/css">

input[disabled]

{

	background: rgba(178,178,178,0.2);

}

input[type="text"][disabled]

{

	background: rgba(178,178,178,0.2);

}

</style>