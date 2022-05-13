<?php
//Este archivo permite configurar el acceso, a los diferentes años escolares en los q ha funcionado sygescol
//Pues toco por asi decirlo, montar el sistema de nuevo, cuando se va a montar un nuevo año, ya que el ajustar
//el sistema para q soportará varios años, era casi como volverlo a hacer, entonces la mejor alternativa fue esta

//Deacuerdo al año lectivo seleccionamos donde esta el sistema para ese año
if(isset($_POST['entrar']))
{
	//Aquí definimos la ruta donde se encuentra el login para cada año y la sede	
	$login_2007 = "sygescol2007/login_pae.php";   //para el 2007
	$login_2008 = "sygescol2008/login_pae.php";   //para el 2008
	$login_2009 = "sygescol2009/login_pae.php";   //para el 2009
	$login_2010 = "sygescol2010/login_pae.php";   //para el 2010
	$login_2011 = "sygescol2011/login_pae.php";   //para el 2011
	$login_2012 = "sygescol2012/login_pae.php";   //para el 2011
	$login_2013 = "sygescol2013/login_pae.php";   //para el 2011
	if($_POST['anoLectivo'] > 2012){
		$action = "sygescol".$_POST['anoLectivo']."/login_pae.php";
	}else{
		switch ($_POST['anoLectivo'])
		{
			case 2007: 
				$action = $login_2007;
				break;
			case 2008:
				$action = $login_2008;
				break;
			case 2009:
				$action = $login_2009;
				break;
			case 2010:
				$action = $login_2010;
				break;
			case 2011:
				$action = $login_2011;
				break;
			case 2012:
				$action = $login_2012;
				break;
			case 2013:
				$action = $login_2013;
				break;
		}
	}
?>
<html>
<head>
<script type="text/javascript">
function enviarFormulario()
{
	formulario = document.getElementById('datosAcceso');
	formulario.submit();
}
</script>
</head>
<body onLoad="enviarFormulario()">
	<form action="<?php echo $action; ?>" method="post" name="datosAcceso" id="datosAcceso">
	<input type="hidden" name="username" value="<?php echo $_POST['username']; ?>" />
	<input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" />
	</form>
</body>
</html>
<?php
}
else
{
?>

	<table width="90%" cellspacing="1" cellpadding="0">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="acceso" id="acceso" onSubmit="return validaFormulario(this)">
	  <tr> 
		<td width="40%"><span class="Estilo14">Usuario</span></td>
		<td width="60%"> <input name="username" type="text" id="username" value="<? echo $a;?>" size="10">	</td>
	  </tr>
	  <tr> 
		<td class="Estilo14">Password</td>
		<td><input name="password" type="password" id="password" size="10"></td>
	  </tr>
	  <tr> 
		<td class="Estilo14">A&ntilde;o</td>
		<td><select name="anoLectivo" id="anoLectivo">
			<option value="2009" <?php if(date("Y") == "2009") echo 'selected="selected"'; ?>>2009</option>
			<option value="2010" <?php if(date("Y") == "2010") echo 'selected="selected"'; ?>>2010</option>
			<option value="2010" <?php if(date("Y") == "2011") echo 'selected="selected"'; ?>>2011</option>
			</select>
	<input type="hidden" name="sede" id="sede" value="1" />
	</td>
	  </tr>
	  <tr align="center" valign="middle"> 
		<td height="41" colspan="2">
		<input type="submit" name="entrar" id="entrar" value="Ingresar"></td>
	  </tr>
	</form>
	</table>
	<script>
	function validaFormulario(formulario)
	{
		if(formulario.username.value == '')
		{
			alert("Debe escribir un usuario");
			formulario.username.focus();
			return false;			
		}
		if(formulario.sede.value == 0)
		{
			alert("Debe seleccionar una sede");
			formulario.sede.focus();
			return false;			
		}
		
		}
	</script>
<?php
}
?>	