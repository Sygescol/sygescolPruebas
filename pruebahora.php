<?php 

// JORNADA


setlocale(LC_ALL,"es_CO");

$f_dia=strftime("%A");


$f_dia="sabado";


if ($f_dia!="Sábado" || $f_dia!="sábado" || $f_dia!="sabado" || $f_dia!="Sabado") {

$tipo_jornada=date('A');

if ($tipo_jornada=='AM') {

	$t_jornada_idgrupo="M";

}

if ($tipo_jornada=='PM') {

	$t_jornada_idgrupo="T";

}


}

if ($f_dia=="Sábado" || $f_dia=="sábado" || $f_dia=="sabado" || $f_dia=="Sabado") {

	$t_jornada_idgrupo="F";

}




echo $t_jornada_idgrupo;
 ?>