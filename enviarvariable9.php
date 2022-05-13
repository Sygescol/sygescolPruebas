<?php 

include_once("inc.funciones.php");
require_once('Connections/sygescol.php'); 

$roles_con_permiso = array('99', '13', '12');

include_once("inc.configuracion.php");

include_once("inc.validasesion.php");

include_once("inc.funciones.php");

include_once("conexion.php");

include_once("horario_function.php");

/* andres */

/*DETERMINAR SI SE ENVIARA AL BOLETIN*/
include("conb.php");
$registro2mm=mysqli_query($conexion,"SELECT * from rv_asist")

or die ("Problemas en la Consulta ".mysqli_error());

while ($descripw2mm=mysqli_fetch_array($registro2mm)){

$var_enviar_s=$descripw2mm['msm_obser'];

}

if ($var_enviar_s=="S") {

/*FECHA*/
include("conb.php");

$registro2=mysqli_query($conexion,"SELECT * from rv_asist")

or die ("Problemas en la Consulta ".mysqli_error());

while ($descripw2=mysqli_fetch_array($registro2)){

$x_tipo_observacion_x1=$descripw2['tina'];
$nombrexxxx=$descripw2['cnp'];
$x_horax_x=$descripw2['horx'];
$x_fechaa_xx=$descripw2['cf'];
$x_grado_xx=$descripw2['cg'];
$x_t_observacion=$descripw2['tobserv'];

}


$nxombre3 = explode(" ", $nombrexxxx);
$nom1xx=$nxombre3[0];//n1
$nom2xx=$nxombre3[1];//n2
$ape1xx=$nxombre3[2];//n3
$ape2xx=$nxombre3[3];//n4
if ($ape2xx!='') {
include("conb.php");
$registro3x=mysqli_query($conexion,"select *from alumno join matricula on alumno.alumno_id=matricula.alumno_id where alumno.alumno_ape1='$ape1xx' AND alumno.alumno_ape2='$ape2xx' AND alumno.alumno_nom1='$nom1xx' AND alumno.alumno_nom2='$nom2xx'")
or die ("Problemas en la Consulta ".mysqli_error());
while ($descripw22=mysqli_fetch_array($registro3x)){
$id_matrixx=$descripw22['matri_id'];
$nox1=$descripw22['alumno_nom1'];
$nox2=$descripw22['alumno_nom2'];
$nox3=$descripw22['alumno_ape1'];
$nox4=$descripw22['alumno_ape2'];

}

$nombreperxz=array($nox3,$nox4,$nox1,$nox2);
$nombreperxz2 = implode(" ", $nombreperxz);


}

if ($ape2xx=='') {
include("conb.php");
$registro3xx=mysqli_query($conexion,"select *from alumno join matricula on alumno.alumno_id=matricula.alumno_id where alumno.alumno_ape1='$nom2xx' AND alumno.alumno_ape2='$ape1xx' AND alumno.alumno_nom1='$nom1xx'")
or die ("Problemas en la Consulta ".mysqli_error());
while ($descripw22=mysqli_fetch_array($registro3xx)){
$id_matrixx=$descripw22['matri_id'];
$nox1=$descripw22['alumno_nom1'];
$nox3=$descripw22['alumno_ape1'];
$nox4=$descripw22['alumno_ape2'];

}

$nombreperxz=array($nox3,$nox4,$nox1);
$nombreperxz2 = implode(" ", $nombreperxz);
echo $nombreperxz2;

}



if($_SESSION['perfil_id']!=99){
$x_nombre_usuario_x1=$_SESSION['usuario_nombre'];
$x_perfil_nombre_x1=$_SESSION['perfil_nombre'];
}

$usarioxxw=$x_nombre_usuario_x1;
$perfilxxw=$x_perfil_nombre_x1;



/*grado*/



include("conb.php");

$registro2xu=mysqli_query($conexion,"select *from v_grupos where grupo_id='$x_grado_xx'")

or die ("Problemas en la Consulta ".mysqli_error());

while ($descripw2xu=mysqli_fetch_array($registro2xu)){

$gradofinalxxz=$descripw2xu['grupo_nombre'];

}


$gradofinalxxz = explode(" ", $gradofinalxxz);
$gradofinalxxz_2=$gradofinalxxz[0];
$gradofinalxxz_20=$gradofinalxxz[1];

/*ANOTACION*/


include("conb.php");

$registro2x=mysqli_query($conexion,"SELECT * from rv_asist")

or die ("Problemas en la Consulta ".mysqli_error());

while ($descripw2x=mysqli_fetch_array($registro2x)){

$conf_tipo_ina=$descripw2x['tina'];

}



include("conb.php");

$registro2xx=mysqli_query($conexion,"SELECT * from tipo_inasistencia where tipo_ina_abrev='$conf_tipo_ina'")

or die ("Problemas en la Consulta ".mysqli_error());

while ($descripw2xx=mysqli_fetch_array($registro2xx)){

$comprobantexx=$descripw2xx['text_obs'];

}


$cadena = 'El veloz murcielago hindu comia feliz cardillo y kiwi.';
$patrones = array();
$patrones[0] = '/#HORA#/';
$patrones[1] = '/#FECHA#/';
$patrones[2] = '/#ESTUDIANTE#/';
$patrones[3] = '/#ASIGNATURA#/';
$patrones[4] = '/#DOCENTE#/';
$sustituciones = array();
$sustituciones[0] = $x_horax_x;
$sustituciones[1] = $x_fechaa_xx;
$sustituciones[2] = $nombreperxz2;
$sustituciones[3] = $gradofinalxxz_2;
$sustituciones[4] = $usarioxxw;

$anotacion_fx=preg_replace($patrones, $sustituciones, $comprobantexx);












include("conb.php");
$registro2=mysqli_query($conexion,"INSERT INTO observadoralumno (fecha,hora,matri_id,idregistroinasistencias,tipo,id_pacto_conv,anotacion,per_id,responsable,perfil,tip_observacion) VALUES ('$x_fechaa_xx','$x_horax_x','$id_matrixx', '0', '0', '0', '$anotacion_fx', '0', '$usarioxxw','$perfilxxw','0')")
or die ("Problemas en la Consulta ".mysqli_error());


echo '<script language="javascript">window.location="../rv/webspeechdemo.php";</script>'; 

}

if ($var_enviar_s=="N") {
echo '<script language="javascript">window.location="../rv/webspeechdemo.php";</script>'; 
}































