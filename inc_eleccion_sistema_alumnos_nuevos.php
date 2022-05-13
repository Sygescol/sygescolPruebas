<?php
//Este archivo permite configurar el acceso, a los diferentes años escolares en los q ha funcionado sygescol para los padres de familia
//Pues toco por asi decirlo, montar el sistema de nuevo, cuando se va a montar un nuevo año, ya que el ajustar
//el sistema para q soportará varios años, era casi como volverlo a hacer, entonces la mejor alternativa fue esta

//Deacuerdo al año lectivo seleccionamos donde esta el sistema para ese año
if(isset($_POST['entrar']))
{
	//Aquí definimos la ruta donde se encuentra el login para cada año
	switch ($_POST['sede'])
{	
	case 1: 
			$sede_estudiante = "../ingreso_inscripcion.php";
			?>
		<script type="text/javascript">
		location.href = "<?php echo $sede_estudiante ?>";
		</script>
<?php
			break;
	case 2: 
			$sede_estudiante = "../marco/ingreso_inscripcion.php";
			?>
		<script type="text/javascript">
		location.href = "<?php echo $sede_estudiante ?>";
		</script>
<?php
			break;	
	}
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="acceso" id="acceso">
<table border="0" align="center" cellpadding="4" cellspacing="5" style="border:#CCCCCC 2px dashed">

  <tr>
    <td><div align="right"><strong>Sede</strong></div></td>
    <td><select name="sede" id="sede" >
      <option value="1">Sede Principal</option>
    </select></td>
  </tr>
  <tr><td colspan="2" align="center">
  <input name="entrar" type="submit" id="entrar" value="Ingresar">
  </td>
  </tr>
  </table>
</form>
