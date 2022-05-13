	<?php 
include_once("inc.configuracion.php");
include_once("inc.validasesion.php");
include_once("inc.funciones.php");
include_once("conexion.php");
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="js/mootools.js"></script>
<script src="includes/cssmenus2/js/cssmenus.js" type="text/javascript"></script>
<script src="js/SqueezeBox/SqueezeBox.js" type="text/javascript"></script>
<script src="js/SqueezeBox/SqueezeBox.js" type="text/javascript"></script>
<script src="js/jquery/headerfixed/jquery.fixedheadertable.js"></script>
<script src="js/DD_roundies.js"></script>
<script type="text/javascript" src="js/utilidades.js"></script>
<link rel="stylesheet" href="js/tooltips/js/sexy-tooltips/vista.css" type="text/css" media="all" id="theme"/>
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link href="includes/cssmenus2/skins/viorange/horizontal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<link rel="stylesheet" href="js/SqueezeBox/assets/SqueezeBox.css" type="text/css" />
<link rel="stylesheet" href="js/SqueezeBox/assets/SqueezeBox.css" type="text/css" />
<link href="css/basico.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<link href="js/jquery/headerfixed/css/defaultTheme.css" rel="stylesheet" media="screen" />

	<title>Crear Adenda</title>
<!--Estilos-->	
<link rel="stylesheet" type="text/css" href="adenda.css">


<!--link  font-->		
<link href='https://fonts.googleapis.com/css?family=Questrial|Archivo+Black' rel='stylesheet' type='text/css'>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

 <style type="text/css">
   iframe {height:500px;}
    iframe {display:block; width:80%; margin: 0 auto; border:none; position:absolute;}
  </style>
</head>

<?php 
$link=conectarse();
mysql_select_db($database_sygescol,$link);
$consultanombrer="SELECT nombre from admco where cargo LIKE'Rector' OR cargo LIKE 'Rectora' ";
$consultanombrerr=mysql_query($consultanombrer,$link);
$consultanombrerrr=mysql_fetch_array($consultanombrerr);






$consultacolegior="SELECT b from clrp where i=1";
$consultacolegiorr=mysql_query($consultacolegior,$link);
$consultacolegiorrr=mysql_fetch_array($consultacolegiorr);

$consultaadendar="SELECT id_adenda from adenda ORDER BY id_adenda desc LIMIT 1";
$consultaadendarr=mysql_query($consultaadendar,$link);
$consultaadendarrr=mysql_fetch_array($consultaadendarr);

$anio=date("Y");
$contador= $consultaadendarrr['id_adenda']+1;


 ?>
<body>
<div></div>
<?php 
include_once("inc.header.php");
 ?>
<br><br>
<div class="container">
	
<center><h2 class="p1" style="color:#263480;">ADENDA N. <?php echo $contador; ?> &nbsp; CAMBIO DE PAR&Aacute;METROS A&Ntilde;O  <?php echo $anio;  ?></h2>
<hr><br></center>

<center>
<form method="POST" action="adenda.php" >
	<table border="1px">
		<tr>
			<td class="p1 td1">FECHA:</td>
			<td class="td2 p2"><input type="date"  required  name="fecha" id="fecha"></td>
		</tr>
		<tr>
			<td class="p1 td1">DE:</td>
			<td class="td2 p2">Rector&Iacute;a <?php echo $consultacolegiorrr['b']; ?></td>
		</tr>
		<tr>
			<td class="p1 td1">PARA:</td>
			<td class="td2 p2">Servicio de Soporte T&eacute;cnico Sistemas e Inform&aacute;tica Ivhorsnet S.A.S.</td>
		</tr>
		<tr>
			<td class="p1 td1">ASUNTO:</td>
			<td class="td2 p2"><input type="text" required placeholder="Asunto" name="asunto" id="asunto" style="width:440px;"></td>
		</tr>
	</table><br>

<div class="textoc"><p>La Instituci&oacute;n Educativa en representaci&oacute;n del se&ntilde;or (a) Rector (a) <?php echo $consultanombrerrr['nombre']; ?>   , solicita autorice a quien corresponda para que se realice (n) los cambios a continuaci&oacute;n descritos:</p></div>

<table border="1px"	>
    <tr>
    	<td colspan="2" class="p1 td1">Par&aacute;metro N.</td>
    	<td rowspan="2" class="p1 td1" style="width: 520px;text-align:center; "> DESCRIPCI&Oacute;N DEL PAR&Aacute;METRO</td>
    </tr>
	<tr>
		<td class="p1 td1" style="text-align: center">N.</td>
		<td class="p1 td1" style="text-align: center">ID</td>
		
	</tr>
	<tr>
		<td class="td2 p2"><input style="width: 60px;"  onkeypress="return justNumbers(event);" maxlength="3" required type="text" name="numpar" id="numpar"></td>
		<td class="td2 p2"><input style="width: 60px;" onkeypress="return justNumbers(event);"  maxlength="3" required type="text" name="idpar" id="idpar"></td>
		<td class="td2 p2"><textarea id="textarea"  required name="textarea" placeholder="Escriba Aqu&iacute;..."></textarea></td>
	</tr>
</table>


<br>

<table >
    <tr>
    	<td colspan="2" class="p1" style="width: 300px;text-align: center;padding: 6px;">SOLICITADO EN LA INSTITUCION	 POR:</td>
    	<td colspan="2" class="p1" style="text-align: center;padding: 6px;">AUTORIZADO EN  LA EMPRESA <br> POR:</td>
    </tr>
	<tr>
		<td>NOMBRE:</td>
		<td><input type="text" style="margin-top: 5px;" onkeypress="txNombres()" required placeholder="Digite Nombre" id="nombresoli" name="nombresoli" ></td>

		<td style="text-align: right;">NOMBRE:</td>
		<td><input type="text" style="margin-top: 5px;" disabled title="Campo no autorizado para su perfil"></td>
	</tr>
	<tr>
		<td>CARGO:</td>
		<td><input type="text"   style="margin-top: 5px;" required placeholder="Digite Cargo" id="codigo" name="codigo"></td>
		<td>FUNCIONARIO:</td>
		<td><input type="text" style="margin-top: 5px;" disabled title="Campo no autorizado para su perfil"></td>
	</tr>
</table>
<br>

<input type="submit" value="ENVIAR" id="enviar" name="enviar"></input><br><br>
</form>
<hr>
<center>
<h2 style="color:#263480;">Buscador de Parametros</h2>
<iframe src="adenda_buscador.php" frameborder="0"></iframe>
</center>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
</div>

<br>
<div class="container">
<!-- consulta -->

<?php 
$consadendasr="SELECT id_adenda from adenda";
$consadendasrr=mysql_query($consadendasr,$link);
$consadendasrrr=mysql_fetch_array($consadendasrr);

$conadendar="SELECT id_adenda from adenda ORDER BY id_adenda ASC LIMIT 1";
$conadendarr=mysql_query($conadendar,$link);
$conadendarrr=mysql_fetch_array($conadendarr);





 ?>



<center>

<hr id="inicioconsulta">
<h2 class="p1" style="color:#263480;">CONSULTAR ADENDAS</h2>
<hr><br></center>
<center>
<form method="POST" action="adenda.php#inicioconsulta" >
<select id="sadendas" name="sadendas" class="selectcl"  style="font-family: inherit;font-size: inherit;line-height: inherit;width: 350px;height: 45px;padding-left: 10px;font-size: 16px;font-family: 'Questrial', sans-serif;border-radius: 4px;color: #151C46;" >

<option>Seleccione la adenda...</option>
<option value="<?php echo $conadendarrr['id_adenda'];?>">ADENDA NUMERO: <?php echo $conadendarrr['id_adenda']; ?></option>
<?php 
while ($consade=mysql_fetch_assoc($consadendasrr)) {
?>
<option value="<?php echo $consade['id_adenda'];?>">ADENDA NUMERO: <?php echo $consade['id_adenda']; ?></option>
<?php 
} 
 ?>
</select>
<br><br><input type="submit" value="CONSULTAR" id="consultar" name="consultar"  style="margin-bottom: 30px;" /><br>
</form>



<?php 
$id_sadendas=$_POST['sadendas'];
if (isset($_POST['consultar'])){	
	


if ($id_sadendas=="Seleccione la adenda...") {
echo "<script>alert('POR FAVOR SELECCIONE UNA ADENDA');</script>";
}
elseif($id_sadendas!="Seleccione la adenda..."){
$cotadendasr="SELECT * from adenda where id_adenda='".$_POST['sadendas']."' ";
$cotadendasrr=mysql_query($cotadendasr,$link);
$cotadendasrrr=mysql_fetch_array($cotadendasrr);
?>


<h2 class="p1" style="color:#263480;">ADENDA NUMERO: <?php $numero_adenda=$cotadendasrrr['id_adenda']; echo $numero_adenda;?> </h2>
<input type="hidden" value="<?php echo $numero_adenda ?>" name="numero_adenda">
<h3><?php echo $cotadendasrrr['anio']; ?></h3>

<table border="1px">
		<tr>
			<td class="p1 td1">FECHA:</td>
			<td class="td2 p2"><?php echo $cotadendasrrr['fecha']; ?></td>
		</tr>
		<tr>
			<td class="p1 td1">DE:</td>
			<td class="td2 p2">Rector&Iacute;a <?php echo $consultacolegiorrr['b']; ?></td>
		</tr>
		<tr>
			<td class="p1 td1">PARA:</td>
			<td class="td2 p2">Servicio de Soporte T&eacute;cnico Sistemas e Inform&aacute;tica Ivhorsnet S.A.S.</td>
		</tr>
		<tr>
			<td class="p1 td1">ASUNTO:</td>
			<td class="td2 p2"><?php echo $cotadendasrrr['asunto']; ?></td>
		</tr>
	</table><br>

<div class="textoc"><p>La Instituci&oacute;n Educativa en representaci&oacute;n del se&ntilde;or (a) Rector (a) <?php echo $consultanombrerrr['nombre']; ?>   , solicita autorice a quien corresponda para que se realice (n) los cambios a continuaci&oacute;n descritos:</p>

</div>

<table border="1px"	>
    <tr>
    	<td colspan="2" class="p1 td1">Par&aacute;metro N.</td>
    	<td rowspan="2" class="p1 td1" style="width: 520px;text-align:center; "> DESCRIPCI&Oacute;N DEL PAR&Aacute;METRO</td>
    </tr>
	<tr>
		<td class="p1 td1" style="text-align: center">N.</td>
		<td class="p1 td1" style="text-align: center">ID</td>
		
	</tr>
	<tr>
	<?php 

$consultar="SELECT * from adenda where id_adenda='".$numero_adenda."' ";
$consultarr=mysql_query($consultar,$link);
$consultarrr=mysql_fetch_array($consultarr);




	 ?>
		<td class="td2 p2"><?php echo $consultarrr['parametro_conse']; ?></td>
		<td class="td2 p2"><?php echo $consultarrr['parametro_id']; ?></td>
     <td class="td2 p2" ><textarea disabled><?php echo $cotadendasrrr['descripcion']; ?></textarea></td>
	</tr>
</table>


<br>

<table border="1px">
    <tr>
    	<td colspan="2" class="p1" style="background:#263480;color:#fff; width: 300px;text-align: center;padding: 6px;">SOLICITADO EN LA INSTITUCION POR:</td>
    	<td colspan="2" class="p1" style="background:#263480;color:#fff;width: 300px; text-align: center;padding: 6px;">AUTORIZADO EN LA EMPRESA <br> POR:</td>
    </tr>
	<tr>
		<td style="text-align: right;color:#263480;background:#fff;">NOMBRE:</td>
		<td style="color:#263480;background:#fff;"><?php echo $cotadendasrrr['nombre_soli']; ?></td>

		<td style="color:#263480;background:#fff;text-align: right;">NOMBRE:</td>

		<td style="color:#263480;background:#fff;"> <?php echo $consultarrr['nombre_auto']; ?> </td>
	</tr>
	<tr>
		<td style="color:#263480;background:#fff;text-align: right;">CARGO:</td>
		<td style="color:#263480;background:#fff;"><?php echo $cotadendasrrr['codigo_soli']; ?></td>
		<td style="color:#263480;background:#fff;text-align: right;">FUNCIONARIO:</td>

		<td style="color:#263480;background:#fff;"> <?php echo $consultarrr['nombre_ejec']; ?></td>
	</tr>
</table>
<br><br>

<table border="1" style="width:610px; ">
	<tr>
		<td style="background:#263480;color:#fff; width: 300px;text-align: center;padding: 6px;">OBSERVACION</td>
	</tr>	
	<tr>	
		<td><textarea disabled id="observacion"  placeholder="Digite aqui la observacion" name="observacion" >
		<?php echo $consultarrr['observacion']; ?></textarea></td>
	</tr>
</table>
<?php 
    }}
 ?>



</center>
<br><br>
</div><!-- cierra el container-->
<br><br>



<script>

function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
return /\d/.test(String.fromCharCode(keynum));
}
function txNombres() {
if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
{
  event.returnValue = false;
}
}
</script>
</body>
<?php 
if (isset($_POST['enviar'])) {
	
$ingresardatos="INSERT INTO adenda (id_adenda,anio,fecha,asunto,parametro_conse,parametro_id,descripcion,nombre_soli,codigo_soli)
VALUES ('".$contador."','".$anio."','".$_POST['fecha']."','".$_POST['asunto']."','".$_POST['numpar']."','".$_POST['idpar']."','".$_POST['textarea']."','".$_POST['nombresoli']."','".$_POST['codigo']."')";
mysql_query($ingresardatos,$link) 
or die("PROBLEMAS EN LA INSERCION DE LOS DATOS");






// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = "ingorjale@gmail.com";
$email_subject = "ADENDA NUMERO: ". $contador;
$remitente=$consultacolegiorrr['b'];
// Aquí se deberían validar los datos ingresados por el usuario

$email_message = "SOLICITUD DE CAMBIO."."\n\n"." ADENDA NUMERO:". $contador ."\n\n";
$email_message .= "FECHA:  " . $_POST['fecha'] . "\n";
$email_message .= "DE: " . $consultacolegiorrr['b'] . "\n"."PARA: Servicio de Soporte Tecnico Sistemas e Informatica Ivhorsnet S.A.S. ". "\n";
$email_message .= "ASUNTO: " . $_POST['asunto'] . "\n\n\n";
$email_message .= " La Institucion Educativa en representacion del señor (a) Rector (a) ".$consultanombrerrr['nombre']." , solicita autorice a quien corresponda para que se realice (n) los cambios a continuacion descritos: " . "\n\n\n";

$email_message .=" NUMERO DEL PARAMETRO:". $_POST['numpar']."\n\n "."ID DEL PARAMETRO: ". $_POST['idpar']."\n\n DESCRIPCION: " . $_POST['textarea'] . "\n\n\n";
$email_message .= "SOLICITADO EN LA INSTITUCION POR: \n NOMBRE: " . $_POST['nombresoli'] . "\n";
$email_message .= "CARGO: " . $_POST['codigo'] . "\n\n";


@mail($email_to, $email_subject, $email_message,$remitente);
?>
<script>
alert("DATOS ENVIADOS CORRECTAMENTE")
setTimeout ("redireccionar()", 5);
</script>
<?php
}

 ?>
<script type="text/javascript">
function redireccionar(){
  window.location="adenda.php";
} 
 //tiempo expresado en milisegundos
</script>



</html>


