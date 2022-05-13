<?php
$roles_con_permiso = array('99', '6', '1', '3');
include_once("inc.configuracion.php");
include_once("inc.validasesion.php");
include_once("inc.funciones.php");
include_once("conexion.php");

//Conexión a la base de datos
$link = conectarse();
mysql_select_db($database_sygescol,$link);

if(count($_GET)>0){
	$_POST=$_GET;
}

//Consultamos el grado y el grupo
$sql_grado_grupo = "
SELECT 	g.i as 'grado_grupo', jraa.b as 'jornada', gao.ba as 'grado', guo.ba as 'grupo'
FROM 	gao, guo, g, cg, cljraa, jraa
WHERE 	g.b = gao.i AND g.a = guo.i AND g.i = cg.b AND cg.a = cljraa.i AND 
		cljraa.a = jraa.i 
ORDER BY jraa.i, gao.ba";
//echo "<br><br>" . $sql_grado_grupo;
$resultado_grado_grupo = mysql_query($sql_grado_grupo,$link) or die ("No se pudo consultar los grados y los grupos");
$num_grupos = mysql_num_rows($resultado_grado_grupo);

function listar_directorios_ruta($ruta){
   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
            //mostraría tanto archivos como directorios
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               //solo si el archivo es un directorio, distinto que "." y ".."
               echo "<option value='$ruta$file'>$ruta$file</option>";
               listar_directorios_ruta($ruta . $file . "/");
            }
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
} 
if(isset($_POST['verfotos']))
{
	$sql_estudiantes = "
	SELECT a.alumno_id,a.alumno_ape1,a.alumno_ape2,a.alumno_nom1,a.alumno_nom2,m.matri_codigo,a.alumno_foto
	FROM   alumno a 
			INNER JOIN matricula m ON a.alumno_id=m.alumno_id
	WHERE  m.grupo_id = '$_POST[gr]' AND m.matri_estado=0
	ORDER BY m.matri_codigo";
	$resultado_estudiantes = mysql_query($sql_estudiantes, $link) or die(mysql_error());
	$num_estudiantes = mysql_num_rows($resultado_estudiantes);
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
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="js/highslide/highslide-with-html.js"></script>
<script type="text/javascript" src="js/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />


<script type="text/javascript">
	hs.showCredits = false;
	hs.align = 'right';
	hs.wrapperClassName = 'draggable-header';
    hs.graphicsDir = 'js/highslide/graphics/';
    hs.outlineType = 'rounded-white';
	
	function cerrar_dialogo(archivo, url)
	{
		//toggleSpinner(destino);
		//Objeto que realiza la petición
		var nuevoRequest = new Request({
			method: 'post',
			url: archivo,
			onSuccess: function(texto, xmlrespuesta){
				if(texto>0)
				{
				//	alert("Ya se encuentra un alumno registrado \ncon los datos de identificacion que usted digitó.");
				}
			}
		});
		nuevoRequest.send(url);
	}
</script>
</head>
<body id="cuerpo">
<?php
include_once("inc.header.php");
?>
<table align="center" width="<?php echo $ancho_plantilla; ?>" class="centro" cellpadding="10">
<tr>
<th scope="col" colspan="1" class="centro">ADMINISTRACION FOTOS ESTUDIANTES </th>
</tr>
<tr>
<td>
<table width="600" border="1" align="center" class="formulario">
    <tr>
      <th colspan="3" class="formulario">Utilice las siguientes opciones para la administracion de fotos </th>
    </tr>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>
      <td width="203" align="right" valign="top"><b>Escanear carpeta :</b>&nbsp;&nbsp;</td>
      <td width="286" height="20" align="left" valign="middle">
	  <select name="directorio" id="directorio">
	  <option value="images/fotos/estudiantes">images/fotos/estudiantes</option>
	  <?php echo listar_directorios_ruta("images/fotos/estudiantes"); ?>
      </select>      </td>
      <td width="89" height="20" align="left" valign="middle">	    <div align="center">
	    <input type="submit" name="escanear" id="escanear" value="Escanear" />	    
	    </div></td>
    </tr>
	</form>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<tr>
      <td width="203" align="right" valign="top"><b>Ver fotos grupo  :</b>&nbsp;&nbsp;</td>
      <td width="286" height="20" align="left" valign="middle">
	  <select name="gr" id="gr">
        <option value="0">Seleccione un grupo</option>
        <?php
	$con = 0;
	while($grado_grupo = mysql_fetch_array($resultado_grado_grupo))
	{
		$sem = '';
		if($grado_grupo['a'] == 25 || $grado_grupo['a'] == 26)
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
        <option value="<?php echo $grado_grupo['grado_grupo'] ?>"><?php echo $grado_grupo['grado'] . "-" . $grado_grupo['grupo'] . $sem?></option>
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
      <td width="89" height="20" align="left" valign="middle">
          <div align="center">
            <input type="submit" id="verfotos" name="verfotos" value="Ver fotos" />      
          </div>      </td>
	</tr>
	</form>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<tr>
	  <td height="20" colspan="2" align="right" valign="top"><strong>Estudiantes con Codigo de Barras Pendientes por Matricula:</strong></td>
	  <td height="20" align="left" valign="middle"><input type="submit" id="verEstu" name="verEstu" value="Ver Estudiantes" /></td>
	  </tr>
	</form>
  </table>
  
</td>
</tr>
<?php
if(isset($_POST['escanear']))
{
?>
	<tr>
	<td>
	<?php
	
	chdir($_POST['directorio']);
	$dir = getcwd();
	$directorio_actual = opendir($dir); 

	echo "<b>Directorio actual:</b><br>$dir<br><br>"; 
	?>
	
	<table width="80%" border="1" cellpadding="4" cellspacing="0" align="center">
	<tr>
	  <th class="formulario" valign="middle" width="19">N&deg;</th>
		<th class="formulario" valign="middle" width="165">Archivo</th>
		<th class="formulario" valign="middle" width="382">Estudiante</th>
		<th class="formulario" valign="middle" width="122">Grupo</th>
	</tr>
	
	<?php
	$con_archivos = 0;
	$num=1;
	while ($archivo = readdir($directorio_actual))
	{
		if(!is_dir($archivo))
		{
			$datos_archivo = explode('.',$archivo);
			$id_estudiante = $datos_archivo[0];
			
			if(strtolower($datos_archivo[1]) == 'jpg')
			{
				//consultamos si el estudiante existe
				$sql_estudiante = "SELECT CONCAT(alumno_ape1, ' ', alumno_ape2, ' ' , alumno_nom1, ' ', alumno_nom2) as estudiante, CONCAT(gao.ba, '-', guo.b, ' ', jraa.b) as grupo
				FROM alumno INNER JOIN matricula ON (alumno.alumno_id = matricula.alumno_id) INNER JOIN g ON (matricula.grupo_id = g.i) INNER JOIN gao ON (g.b = gao.i) INNER JOIN guo ON (g.a = guo.i) INNER JOIN jraa ON (gao.g = jraa.i)
				WHERE alumno.alumno_id = '$id_estudiante' AND matri_estado = 0";
				$resultado_estudiante = mysql_query($sql_estudiante, $link) or die("No se pudo consultar el estuidante $sql_estudiante" );
				$datos_estudiante = mysql_fetch_assoc($resultado_estudiante);
				$num_estudiante = mysql_num_rows($resultado_estudiante);
				
				//Actualizamos la foto del estuidante
				if($num_estudiante > 0)
				{
					$foto = str_replace('images/fotos/estudiantes','',$_POST['directorio']) .$archivo;
					$sql_upd_foto = "UPDATE alumno SET alumno_foto = '$foto' WHERE alumno_id = '$id_estudiante'";
					$upd_foto = mysql_query($sql_upd_foto, $link) or die("No se pudo actualizar la foto");
				}
			}
			
			$class = 'fila2';
			if($con_archivos % 2 == 0)
			{
				$class = 'fila1';
			}
			
			
	?>
		<tr class="<?php echo $class; ?>">
		  <td><?php echo $num; ?></td>
			<td><?php echo $archivo; ?></td>
			<td <?php echo ($datos_estudiante['estudiante'] != '') ? '' : 'bgcolor="#FF6633"'; ?> ><?php echo ($datos_estudiante['estudiante'] != '') ? $datos_estudiante['estudiante'] : '&nbsp;'; 
			?></td>
			<td><?php echo ($datos_estudiante['grupo'] != '') ? $datos_estudiante['grupo'] : '&nbsp;'; ?></td>
		</tr>	
	<?php	
		$num++;	
		}
		$con_archivos++;
		
	} 
	closedir($directorio_actual);
	?>
	</table>
	</td>
	</tr>
<?php
}
if(isset($_POST['verEstu'])){
	?>
	<tr>
	<td>
	<?php
			$select_estu="SELECT estudiante_noesta.*, v_grupos.grupo_nombre FROM estudiante_noesta
							INNER JOIN v_grupos ON (estudiante_noesta.grupo_id=v_grupos.grupo_id) ORDER BY v_grupos.grado_base";
			$sql_estu=mysql_query($select_estu, $link) or die("No se pudo consultar el estuidante $sql_estudiante" );
	?>
		<table width="80%" border="1" cellpadding="4" cellspacing="0" align="center">
			<tr>
			  <th class="formulario" valign="middle" width="19">N&deg;</th>
				<th class="formulario" valign="middle" width="165">Archivo</th>
				<th class="formulario" valign="middle" width="382">Estudiante</th>
				<th class="formulario" valign="middle" width="122">Grado</th>
				<th class="formulario" valign="middle" width="122">Asignar</th>
			</tr>
			<?php
			$num=1;
			while($rows_estu=mysql_fetch_array($sql_estu)){
				if(file_exists('images/fotos/pendientes/'.$rows_estu['foto'])){
				?>
					<tr>
					  <td><?php echo $num;?></td>
					  <td><a href="<?php echo 'images/fotos/pendientes/'.$rows_estu['foto'];?>" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})"><?php echo $rows_estu['foto'];?></a></td>
					  <td><?php echo $rows_estu['nombre'];?></td>
					  <td><?php echo $rows_estu['grupo_nombre'];?></td>
					  <td align="center"><a href="asignar_estu_antiguos.php?estu_id=<?php echo $rows_estu['id'];?>" onclick="return hs.htmlExpand(this, {wrapperClassName: 'draggable-header', headingText: 'Seleccione El Estudiante.', objectType: 'iframe', dimmingOpacity: 0.75, align: 'center', width:'620',  height:'380' })"><strong>Asignar Estudiante</strong></a></td>
					</tr>
				<?php
					$num++;
				}
			}
			?>
		</table>
	</td>
	</tr>
	<?php
}
if(isset($_POST['verfotos']))
{
?>
<tr>
	<td>
		<table class="formulario" width="800" border="1" align="center">
		<tr>
			<th class="formulario" width="10%">Id</th>
			<th class="formulario" width="10%">C&oacute;d</th>
			<th class="formulario" width="70%">Estudiante</th>
			<th class="formulario" width="20%">Foto</th>
		</tr>
		<?php
		if($num_estudiantes > 0)
		{
			while($estudiante = mysql_fetch_assoc($resultado_estudiantes))
			{
				$novedad="SELECT novedad_estudiante.matri_id, tipo_novedad.tn_nombre, novedad_estudiante.nov_fecha FROM novedad_estudiante 
											INNER JOIN matricula ON (matricula.matri_id=novedad_estudiante.matri_id)
											INNER JOIN tipo_novedad ON (novedad_estudiante.tn_id=tipo_novedad.tn_id)
						WHERE matricula.matri_estado=0 AND matricula.alumno_id=".$estudiante['alumno_id'];
				$query_novedad=mysql_query($novedad, $link)or die('No se pudo consultar la Novedad'. mysql_error());
				$rows_novedad=mysql_fetch_array($query_novedad);
				$num_rows_novedad=mysql_num_rows($query_novedad);
					
		?>
			<tr>
				<td><?php echo $estudiante['alumno_id']; ?></td>
				<td><?php echo $estudiante['matri_codigo']; ?></td>
				<td><?php echo $estudiante['alumno_ape1'] . ' ' . $estudiante['alumno_ape2'] . ' ' . $estudiante['alumno_nom1'] . ' ' . $estudiante['alumno_nom2']; 
				if($num_rows_novedad>0){
					echo '  &nbsp; &nbsp;<span class="resaltado">('.$rows_novedad['tn_nombre'].')-('.$rows_novedad['nov_fecha'].')</span>';
				}
				
				?></td>
				<td align="center">
				<?php
				if($estudiante['alumno_foto'] == '' || !file_exists('images/fotos/estudiantes/' . $estudiante['alumno_foto']))
				{
					$estudiante['alumno_foto'] = 'no_imagen.jpg';								
				}
				?>
				<img src="images/fotos/estudiantes/<?php echo $estudiante['alumno_foto']; ?>" border="0" width="100" />
				</td>
			</tr>		
			<?php
			}
		}
		else
		{
		?>
			<tr><td colspan="3" align="center" class="resaltado">No se encontrarón estudiantes en el grupo</td></tr>
		<?php
		}
		?>
		</table>
	</td>
</tr>	
<?php
}
?>
<tr>
<th class="footer">
<?php
include_once("inc.footer.php");
?>
</th>
</tr>
</table>

</body>
</html>