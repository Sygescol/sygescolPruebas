<?php
$roles_con_permiso = array('99', '6', '1', '2', '5', '8', '13', '3', '12', '16');
include_once("inc.configuracion.php");
include_once("inc.validasesion.php");
include_once("inc.funciones.php");
include_once("conexion.php");
include_once("horario_function.php");

//Conexión a la base de datos
$link = conectarse();
mysql_select_db($database_sygescol,$link);



$grado_nivel= array(-2 => 1, -1 => 1, 0 => 1, 1 => 2, 2 => 2, 3 => 2, 4 => 2, 5 => 2, 6 => 3, 7 => 3, 8 => 3, 9 => 3,  10 => 4, 11 => 4, 21 => 21, 22 => 21,  23 => 22, 24 => 22,  25 => 23, 26 => 23, 31 => 24, 32 => 24, 33 => 24, 34 => 24, 35 => 24, 36 => 24);

//Consultamos el grado y el grupo
$sql_grado_grupo = "SELECT grupo_id as 'grado_grupo', jornada_nombre as 'jornada', gao_codigo as 'grado', grupo_codigo as 'grupo', 
gao_id as a, gao_semestre FROM v_grupos ORDER BY jornada_nombre, gao_codigo, grupo_codigo";
$resultado_grado_grupo = mysql_query($sql_grado_grupo,$link) or die ("No se pudo consultar los grados y los grupos");

if(isset($_GET['gradoGrupo'])){
//-------------Horario--------------------//
	$sql_grado_grupo_sel = "
	SELECT grupo_id as 'grado_grupo', jornada_id as 'id_jornada', jornada_nombre as 'jornada', gao_codigo as 'grado', grupo_codigo as 'grupo', 
	gao_id as a, gao_semestre FROM v_grupos WHERE grupo_id = ".$_GET['gradoGrupo']." ORDER BY jornada_nombre, gao_codigo, grupo_codigo";
	$resultado_grado_grupo_sel = mysql_query($sql_grado_grupo_sel,$link) or die ("No se pudo consultar los grados y los grupos");
	$grado_grupo_sel = mysql_fetch_array($resultado_grado_grupo_sel);
}
function ultimoDia($mes,$ano){
	return strftime("%d", mktime(0, 0, 0, $mes+1, 0, $ano));
} 

function dos_digitos($valor)
{
	if(strlen($valor) < 2)
	{
		$valor = '0' . $valor;
	}
	return $valor;
} 
$dias_semana=array(1=>'Lunes', 2=>'Martes', 3=>'Miércoles', 4=>'Jueves', 5=>'Viernes', 6=>'Sábado', 7=>'Domingo');
$fech_letra=array(1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Septiembre', 10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $nombre_sistema; ?></title>
<script type="text/javascript" src="js/mootools.js"></script>
<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>
<script type="text/javascript" src="js/utilidades.js"></script>
<link rel="stylesheet" type="text/css" href="styles_calendario.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script language="javascript">
	jQuery.noConflict();
</script>
<script type="text/javascript" src="js/script_calendario.js"></script>
<script language="javascript">
function validaFormulario(formulario)
{
	if(formulario.gradoGrupo.value == 0)
	{
		alert("Debe seleccionar un grupo");
		formulario.gradoGrupo.focus();
		return false;
		
	}
	
	return true;
}
</script>
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />
</head>
<body id="cuerpo">
<?php
include_once("inc.header.php");
?>
<table align="center" width="<?php echo $ancho_plantilla; ?>" class="centro" cellpadding="10">
<tr>
<th scope="col" colspan="1" class="centro">HORARIO VIRTUAL</th>
</tr>
<?php
if(isset($_GET['gradoGrupo'])){
?>
<tr>
<td  bgcolor="#FFFFFF" style="border:1px solid #EEEEEE;">
<br />
<?php
if(!isset($_GET['mes'])){
	$_GET['mes']=date(n); 
}
$mes=$_GET['mes'];
$mes_ceros=($_GET['mes']<10)?'0'.$_GET['mes']:$_GET['mes'];

$anio=$_SESSION['lectivo'];

$dia=1;

$horario = new GenerarHorarioClases($_GET['gradoGrupo'], '', $_SESSION['lectivo'], $mes, $database_sygescol, $link);	
$horario_grupos = $horario->return_horario();
$periodos = $horario->array_periodos;
$jornadas = $horario->array_jornadas;
$intervalos = $horario->array_intervalos;
$intervalos_jc = $horario->array_intervalos_jc;
$id_tip_hor = $horario->id_tip_hor;
$horario_virtual = $horario->calendario_hor();	
//print_r($horario_grupos);

$colors = array('green','blue','chreme');

//if(strlen($mes)==1) $mes='0'.$mes;

$sql_grado_grupo2 = "
SELECT grupo_id as 'grado_grupo', jornada_id as 'id_jornada', jornada_nombre as 'jornada', gao_codigo as 'grado', grupo_codigo as 'grupo', 
gao_id as a, gao_semestre FROM v_grupos WHERE grupo_id = ".$_GET['gradoGrupo']." ORDER BY jornada_nombre, gao_codigo, grupo_codigo";
$resultado_grado_grupo2 = mysql_query($sql_grado_grupo2,$link) or die ("No se pudo consultar los grados y los grupos");
$grado_grupo2 = mysql_fetch_array($resultado_grado_grupo2);
?>
	<table width="781" align="center">
    	<tr >
			<td colspan="7" align="center" class="eventHeading <?php echo $colors[0];?>"><?php echo $fech_letra[$_GET['mes']];?>&nbsp;&nbsp; Grado <?php echo $grado_grupo2['grado'].' - '.$grado_grupo2['grupo'];?> &nbsp;&nbsp; <?php echo 'Jornada '.$grado_grupo2['jornada'];?></td>
        </tr>
        <tr >
          <td class="eventHeading <?php echo $colors[0];?>" width="14%" align="center"><font size="+2">Domingo</font></td>
          <td class="eventHeading <?php echo $colors[1];?>" width="14%" align="center"><font size="+2">Lunes</font></td>
          <td class="eventHeading <?php echo $colors[2];?>" width="14%" align="center"><font size="+2">Martes</font></td>
          <td class="eventHeading <?php echo $colors[0];?>" width="14%" align="center"><font size="+2">Miércoles</font></td>
          <td class="eventHeading <?php echo $colors[1];?>" width="14%" align="center"><font size="+2">Jueves</font></td>
          <td class="eventHeading <?php echo $colors[2];?>" width="14%" align="center"><font size="+2">Viernes</font></td>
          <td class="eventHeading <?php echo $colors[0];?>" width="14%" align="center"><font size="+2">Sabado</font></td>
        </tr>
        <?php		
        $numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio));
        $ultimo_dia=ultimoDia($mes,$anio);       
        $total_dias=$numero_primer_dia+$ultimo_dia;
        $diames=1;
				
		$MiTimeStamp = mktime(0,0,0,$mes,1,$anio);
		$dia_hor=date("N",$MiTimeStamp);
		$j=1;
        while($j<=$total_dias){
			echo "<tr> \n";
			//$i contador dias por semana
			$i=0; 
			while($i<7){
				if($j<=$numero_primer_dia){
						echo " <td align='center'></td> \n";
				}elseif($diames>$ultimo_dia){
						echo " <td align='center'></td> \n";
				}else{
					if($diames<10) $diames_con_cero='0'.$diames;
					else $diames_con_cero=$diames;
					
					$fec_hor_cam=$anio.'-'.$mes.'-'.$diames_con_cero;
					$background = '';
					if($horario_virtual[$anio][$mes_ceros][$diames_con_cero]['HABIL'] == 'N'){
						if($horario_virtual[$anio][$mes_ceros][$diames_con_cero]['TIPO'] == 'NOHA'){
							$background = 'style="background: #FD6F72;"';
						}elseif($horario_virtual[$anio][$mes_ceros][$diames_con_cero]['TIPO'] == 'COOR'){
							$background = 'style="background: #A4BBFF;"';
						}
					}								
					
				?>
				<td align="center">
					<ul class="eventList"><!-- -->
						<li class="news" <?php echo $background;?>>
							<h1 align="center">
								<span class="icon">
								<?php echo $diames; ?>
								</span>
							</h1>
							<div class="content"  style="overflow:auto;position:absolute;top:0px;left:0px;height:100%;width:100%;">
								<div class="title" align="center">
									<center>Horario de Clases <b>GRADO <?php echo $grado_grupo2['grado'].' - '.$grado_grupo2['grupo'];?> - <?php echo 'JORNADA '.strtr(strtoupper($grado_grupo2['jornada']), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ");?></b>
											<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;".strtr(strtoupper($row_datos_periodo['per_num_letra'].' '.$row_datos_periodo['per_nombre']), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ");?>
									</center>
								</div>
								<div class="body">
									<?php
									$MiTimeStamp = mktime(0,0,0,$mes,$diames,$anio);
									if($horario_virtual[$anio][$mes_ceros][$diames_con_cero]['HABIL'] == 'S'){
										?>
										<font color="#000000" size="+1">
											<center><?php echo 'Dia '.$horario_virtual[$anio][$mes_ceros][$diames_con_cero]['NUM_DIA']; ?></center>
										</font>
										<?php
										for($int = 0; $int < count($intervalos); $int++)
										{
											if($intervalos[$int]['TIPO'] == 'C'){
												$id_int = $intervalos[$int]['ID'];
												$total_sem = count($jornadas);
											?>
												<fieldset style=' border-color: #8FAEF8; border-style:solid;'>
													<legend><b><?php echo date("h:i A", $intervalos[$int]['INICIO']).' - '.date("h:i A", $intervalos[$int]['FIN']);?></b></legend>
														<?php
														$tot_prof = $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int]['TOT_PROF'];
														for($prof=0; $prof < $tot_prof; $prof++){
															?>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asignatura: </b> <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int][$prof]['ASI_NOM'];?> <b>( <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int][$prof]['ASI_ABR'];?> )</b> 
															<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Docente: </b> <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int][$prof]['DOC_NOM'];?>
															<?php
															if($total_sem > 6){
																?>
																<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Aula: </b> <?php echo $horario_grupos['INTERVALO'][ $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int][$prof]['PER_ID'] ][$id_int][ $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int][$prof]['JOR_ID'] ][$prof]['AUL_NOM'];?>
																<?php
															}

															echo ($prof == ($tot_prof - 1))?'<br/>':'<hr style="margin-top:4px; margin-bottom:4px;" noshade="noshade" />';
														}
														?>
														
												</fieldset>
											<?php
											}else{
												echo "<center><b>Descanso ".date("h:i A", $intervalos[$int]['INICIO']).' - '.date("h:i A", $intervalos[$int]['FIN'])."</b></center><br />";
											}
										}
										if(count($intervalos_jc) > 0){ 
											echo "<center><b>JORNADA CONTRARIA</b></center><br />";
										}
										for($int_jc = 0; $int_jc < count($intervalos_jc); $int_jc++)
										{
											if($intervalos_jc[$int_jc]['TIPO'] == 'C'){
												$id_int_jc = $intervalos_jc[$int_jc]['ID'];
												$total_sem = count($jornadas);
											?>
												<fieldset style=' border-color: #8FAEF8; border-style:solid;'>
													<legend><b><?php echo date("h:i A", $intervalos_jc[$int_jc]['INICIO']).' - '.date("h:i A", $intervalos_jc[$int_jc]['FIN']);?></b></legend>
														<?php
														$tot_prof = $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc]['TOT_PROFJC'];
														for($prof=0; $prof < $tot_prof; $prof++){
															?>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asignatura: </b> <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc][$prof]['ASI_NOMJC'];?> <b>( <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc][$prof]['ASI_ABRJC'];?> )</b> 
															<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Docente: </b> <?php echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc][$prof]['DOC_NOMJC'];?>
															<?php
															if($total_sem > 6){
																?>
																<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Aula: </b> <?php echo $horario_grupos['INTERVALOJC'][ $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc][$prof]['PER_IDJC'] ][$id_int_jc][ $horario_virtual[$anio][$mes_ceros][$diames_con_cero][$id_int_jc][$prof]['JOR_IDJC'] ]['AUL_NOMJC'];?>
																<?php
															}
															echo ($prof == ($tot_prof - 1))?'<br/>':'<hr style="margin-top:4px; margin-bottom:4px;" noshade="noshade" />';
														}
														?>
												</fieldset>
											<?php
											}else{
												echo "<center><b>DescansoCC ".date("h:i A", $intervalos_jc[$int_jc]['INICIO']).' - '.date("h:i A", $intervalos_jc[$int_jc]['FIN'])."</b></center><br />";
											}
										}
									}else{
										echo $horario_virtual[$anio][$mes_ceros][$diames_con_cero]['MSN'];
									}
									?>
									<br/>
								</div>
								<div class="date">
									<?php
										//echo mktime(0,0,0,$mes,$diames,$anio); 
										echo $dias_semana[date("N",$MiTimeStamp)]; 
										echo ' '.$diames_con_cero; 
										echo ' de '.$fech_letra[$_GET['mes']];
									?>
								</div>
							</div>
						</li>
					</ul>
				</td>
				<?php
				$diames++;
				}
			$i++;
			$j++;
			}
            echo "</tr> \n";
        }
        ?>
</table>
<br /><br /><br />
<table width="80%" border="0" align="center" cellpadding="5" cellspacing="5">
<tr>
<nobr>
<?php
for($i=1;$i<13;$i++){
?>
	<td width="8.3333333333333333333333333333333%" style="border:1px solid #EEEEEE;" height="33" align="center"><a href="calendario_clases.php?mes=<?php echo $i;?>&gradoGrupo=<?php echo $_GET['gradoGrupo'];?>" style="color:#0196e3; text-decoration:none;"><?php echo $fech_letra[$i];?></a></td>
<?php
}


?>	</nobr></tr></table></td></tr>
<?php
}
?>
<tr>
  <td >
  <form action="calendario_clases.php" method="get" name="grado_grupo" lang="es" onsubmit="return validaFormulario(this)">
<table width="600" border="0" align="center" class="formulario">
	<tr>
		<th colspan="2" class="formulario">Grupos</th>
	</tr>
	<tr>
	<td align="right"><b>Grado-Grupo:</b>&nbsp;&nbsp;</td>
	<td width="282">
	<select name="gradoGrupo">
	<option value="0">Seleccione un grupo</option>
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
	 
	<option value="<?php echo $grado_grupo['grado_grupo'] ?>"><?php echo $grado_grupo['grado'] . "-" . $grado_grupo['grupo']?></option>
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
	</select></td>
	</tr>
	<tr>
	<td align="center" colspan="2">
	<input name="verHorario" type="submit" id="verHorario" value="Ver Horario" />	</td>
	</tr>
</table>
</form>
  
  </td>
</tr>
<tr>
<th class="footer">
<?php
include_once("inc.footer.php");
?></th>
</tr>
</table>	
</body>
</html>
