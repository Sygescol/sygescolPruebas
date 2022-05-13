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

	<title>Crear Nuevo Requerimiento</title>

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

$consultaadendar="SELECT id_adenda from requerimientos ORDER BY id_adenda desc LIMIT 1";
$consultaadendarr=mysql_query($consultaadendar,$link);
$consultaadendarrr=mysql_fetch_array($consultaadendarr);


$consultadocenter="SELECT dcne_ape1, dcne_ape2, dcne_nom1, dcne_nom2 from dcne";
$consultadocenterr=mysql_query($consultadocenter,$link);
$consultadocenterrr=mysql_fetch_array($consultadocenterr);

$consultaadminr="SELECT nombre from admco";
$consultaadminrr=mysql_query($consultaadminr,$link);
$consultaadminrrr=mysql_fetch_array($consultaadminrr);


$anio=date("Y");
$contador= $consultaadendarrr['id_adenda']+1;
 ?>
<body>
<?php 
include_once("inc.header.php");
 ?>
<br><br>
<div class="container">
<center><h2 class="p1" style="color:#263480;">REQUERIMIENTO N. <?php echo $contador; ?> &nbsp; <br> A&Ntilde;O  <?php echo $anio;  ?></h2>


<hr><br></center>
<center>
<form method="POST" action="requerimiento.php">
	<table border="1px">
		<tr><td class="p1 td1">FECHA:</td>
			<td class="td2 p2"><input type="date"  required  name="fecha" id="fecha"></td></tr>
		<tr><td class="p1 td1">DE:</td>
			<td class="td2 p2"><?php echo $consultacolegiorrr['b']; ?></td></tr>
		<tr><td class="p1 td1">PARA:</td>
			<td class="td2 p2">Servicio de Soporte T&eacute;cnico Sistemas e Inform&aacute;tica Ivhorsnet S.A.S.</td></tr>
		<tr><td class="p1 td1">ASUNTO:</td>
		<td class="td2 p2"><input type="text" required placeholder="Asunto" name="asunto" id="asunto" style="width:440px;"></td></tr>
	</table><br>

<div class="textoc"><p>Yo 
<select id="adncodcne" name="adncodcne">
	<option>seleccione uno...</option>
    <option style="font-weight: bold">ADMINISTRATIVOS</option> 
 <?php while ($consultaadminrrrr=mysql_fetch_assoc($consultaadminrr)) { ?>
<option value="<?php echo $consultaadminrrrr['nombre'];?>"><?php echo $consultaadminrrrr['nombre'];?></option>
<?php }  ?>
	<option style="font-weight: bold">DOCENTES:</option>
<?php while ($consultadocenterrrr=mysql_fetch_assoc($consultadocenterr)) { ?>
<option value="<?php echo $consultadocenterrrr['dcne_ape1'].''.$consultadocenterrrr['dcne_ape2']. ''.$consultadocenterrrr['dcne_nom1']. ''.$consultadocenterrrr['dcne_nom2'];?>"><?php echo $consultadocenterrrr['dcne_ape1'].''.$consultadocenterrrr['dcne_ape2']. ''.$consultadocenterrrr['dcne_nom1']. ''.$consultadocenterrrr['dcne_nom2'];?></option>
<?php }  ?>
</select>
funcionario (a) de la <?php echo $consultacolegiorrr['b']; ?>solicito autorice a quien corresponda para que se realicen los ajustes en la (s) RUTA (s) abajo descritas, lo que considero no corresponden o deben ser objeto de revisi&oacute;n.</p></div>







<table border="1px"	>
    <tr>
        <td class="p1 td1" style="width:60px;text-align: center;">N.</td>
    	<td class="p1 td1" style="width: 320px;text-align: center;">RUTA</td>
    	<td class="p1 td1" style="width: 520px;text-align:center; "> DESCRIPCI&Oacute;N DEL PROBLEMA</td>
    </tr>

	<tr>
		<td class="td2 p2"><input type="text" name="numero" id="numero" onkeypress="return justNumbers(event);" maxlength="3" style="width:42px;"></td>
		<td class="td2 p2"><textarea id="textareaa"  required name="textareaa" placeholder="Escriba Aqu&iacute; la ruta..."></textarea></td>
		<td class="td2 p2"	><textarea id="textarea"  required name="textarea" placeholder="Escriba Aqu&iacute; la descripci&oacute;n..."></textarea></td>
	</tr>
</table>







<br>



<table>
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

</center>

</div><!-- cierra el container-->



<!-- ///////////////////////////////////////////////////////////////CONSULTAR/////////////////////////////////////-->

<br>

<div class="container">

	<center>

		





<?php 

$consadendasr="SELECT id_adenda FROM requerimientos";
$consadendasrr=mysql_query($consadendasr,$link);
$consadendasrrr=mysql_fetch_array($consadendasrr);



$conadendar="SELECT id_adenda from requerimientos ORDER BY id_adenda ASC LIMIT 1";
$conadendarr=mysql_query($conadendar,$link);
$conadendarrr=mysql_fetch_array($conadendarr);


 ?>

<center>


<h2 class="p1" style="color:#263480;" id="inicioconsulta">CONSULTAR REQUERIMIENTOS</h2>

<hr><br></center>

<center>

<form method="POST" action="requerimiento.php#inicioconsulta" >

<select id="sadendas" name="sadendas" class="selectcl"  style="font-family: inherit;font-size: inherit;line-height: inherit;width: 350px;height: 45px;padding-left: 10px;font-size: 16px;font-family: 'Questrial', sans-serif;border-radius: 4px;color: #151C46;" >



<option>Seleccione el requerimiento...</option>

<option value="<?php echo $conadendarrr['id_adenda'];?>">REQUERIMIENTO NUMERO: <?php echo $conadendarrr['id_adenda']; ?></option>

<?php 

while ($consade=mysql_fetch_assoc($consadendasrr)) {

?>

<option value="<?php echo $consade['id_adenda'];?>">REQUERIMIENTO NUMERO: <?php echo $consade['id_adenda']; ?></option>

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

$cotadendasr="SELECT * from requerimientos where id_adenda='".$_POST['sadendas']."' ";

$cotadendasrr=mysql_query($cotadendasr,$link);

$cotadendasrrr=mysql_fetch_array($cotadendasrr);

?>





<h2 class="p1" style="color:#263480;">REQUERIMIENTO NUMERO: <?php $numero_adenda=$cotadendasrrr['id_adenda']; echo $numero_adenda;?> </h2>

<input type="hidden" value="<?php echo $numero_adenda ?>" name="numero_adenda">

<h3><?php echo $cotadendasrrr['anio']; ?></h3>



<table border="1px">

		<tr>

			<td class="p1 td1">FECHA:</td>

			<td class="td2 p2"><?php echo $cotadendasrrr['fecha']; ?></td>

		</tr>

		<tr>

			<td class="p1 td1">DE:</td>

			<td class="td2 p2"><?php echo $consultacolegiorrr['b']; ?></td>

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



<div class="textoc"><p>Yo <?php echo  $cotadendasrrr['funcionario']; ?> funcionario (a) de la <?php echo $consultacolegiorrr['b']; ?>solicito autorice a quien corresponda para que se realicen los ajustes en la (s) RUTA (s) abajo descritas, lo que considero no corresponden o deben ser objeto de revisi&oacute;n.</p>



</div>



<table border="1px"	>
    <tr>
        <td class="p1 td1" style="width:60px;text-align: center;">N.</td>
    	<td class="p1 td1" style="width: 320px;text-align: center;">RUTA</td>
    	<td class="p1 td1" style="width: 520px;text-align:center; "> DESCRIPCI&Oacute;N DEL PROBLEMA</td>

    </tr>

	<tr>

		<td class="td2 p2"><input type="text" name="numero" id="numero"  style="width:42px;" value="<?php echo $cotadendasrrr['numero'];?>" disabled></td>

		<td class="td2 p2"><textarea id="textareaa"  required name="textareaa" placeholder="Escriba Aqu&iacute; la ruta..." disabled><?php echo $cotadendasrrr['ruta'];?></textarea></td>

		<td class="td2 p2"	><textarea id="textarea"  disabled name="textarea" placeholder="Escriba Aqu&iacute; la descripci&oacute;n..."><?php echo $cotadendasrrr['descripcion'];?></textarea></td>

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
		<td style="color:#263480;background:#fff;"><?php echo $cotadendasrrr['nombre_auto'];?> </td>
	</tr>
	<tr>
		<td style="color:#263480;background:#fff;text-align: right;">CARGO:</td>
		<td style="color:#263480;background:#fff;"><?php echo $cotadendasrrr['codigo_soli']; ?></td>
		<td style="color:#263480;background:#fff;text-align: right;">FUNCIONARIO:</td>
		<td style="color:#263480;background:#fff;"> <?php echo $cotadendasrrr['nombre_ejec']; ?></td>
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

<br>
	</center>
</div>
<br>

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
$adncodcnea=$_POST['adncodcne'];


if ($adncodcnea=="Seleccione uno...") {
echo "<script>alert('POR FAVOR SELECCIONE UN DOCENTE O ADMINISTRATIVO');</script>";
}

elseif($adncodcnea!="Seleccione uno..."){

$ingresardatos="INSERT INTO requerimientos (id_adenda,anio,fecha,asunto,numero,ruta,descripcion,nombre_soli,codigo_soli,funcionario)

VALUES ('".$contador."','".$anio."','".$_POST['fecha']."','".$_POST['asunto']."','".$_POST['numero'] ."','".$_POST['textareaa']."','".$_POST['textarea']."','".$_POST['nombresoli']."','".$_POST['codigo']."','".$_POST['adncodcne']."')";

mysql_query($ingresardatos,$link) 

or die("PROBLEMAS EN LA INSERCION DE LOS DATOS");

$cor="SELECT * from requerimientos where funcionario='".$_POST['adncodcne']."' ";
$corr=mysql_query($cor,$link);
$corrr=mysql_fetch_array($corr);


// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias

$email_to = "ingorjale@gmail.com";
$email_subject = "REQUERIMIENTO NUMERO: ". $contador;
$remitente=$consultacolegiorrr['b'];


// Aquí se deberían validar los datos ingresados por el usuario
$email_message = "SOLICITUD DE CAMBIO."."\n\n"." REQUERIMIENTO NUMERO: ". $contador ."\n\n";
$email_message .= "FECHA:  " . $_POST['fecha'] . "\n";
$email_message .= "DE: " . $consultacolegiorrr['b'] . "\n"."PARA: Servicio de Soporte Tecnico Sistemas e Informatica Ivhorsnet S.A.S. ". "\n";
$email_message .= "ASUNTO: " . $_POST['asunto'] . "\n\n\n";

$email_message .= "Yo ". $corrr['funcionario'] ." funcionario (a) de la ". $consultacolegiorrr['b']  ." solicito autorice a quien corresponda para que se realicen los ajustes en la (s) RUTA (s) abajo descritas, lo que considero no corresponden o deben ser objeto de revisi&oacute;n. " . "\n\n\n";

$email_message .="NUMERO: ". $corrr['numero'] . "\n RUTA: ". $corrr['ruta'] ."\nDESCRIPCION: " . $_POST['textarea'] . "\n\n\n";
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




}



 ?>

<script type="text/javascript">

function redireccionar(){

  window.location="requerimiento.php";

} 

 //tiempo expresado en milisegundos

</script>



</html>





