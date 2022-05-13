<?php

function listarArchivos( $path ){

    // Abrimos la carpeta que nos pasan como parámetro

	

	$array_annos = array();

    $dir = opendir($path);

    while ($elemento = readdir($dir)){

        if( $elemento != "." && $elemento != ".."){

            if( is_dir($elemento) ){

				$resultado = strrpos($elemento, "sygescol");

				if($resultado !== FALSE){

					$datos_anno = $elemento;

					$array_annos[] = $datos_anno[8].$datos_anno[9].$datos_anno[10].$datos_anno[11];

				}

                //echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";

            } else {

                //echo "<br />". $elemento;

            }

        }

    }

	asort($array_annos); 

	//print_r($array_annos);

	return $array_annos;

}

$annos = listarArchivos(".");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head><meta charset="windows-1252">



<title>...Acceso al Sistema...</title>

<style type="text/css">
body{font-family: 'Questrial', sans-serif;}

 .p1{ font-family: 'Archivo Black', sans-serif;}
     .p2{font-family: 'Questrial', sans-serif;} 

.container {

    width: 206px;

    max-width: 206px;

    margin: 0 auto;

}




.signup {
    padding: 12px 76px 35px 69px;
    background-size: 100% 100%;
    border: 7px solid #0079b2;
    background: #fff;
    -moz-border-radius: 25px;
    -webkit-border-radius: 25px;
    border-radius: 1px;
    display: table;
    width: 292px;
    position: static;
}
.signup .header {

    margin-bottom: 10px;

	margin-top:10px;

}

.signup .cab_header{

	background-color:#CCCCCC;

}

select#anoLectivo {
    width: 240px;
}

a#olvido_directivo {
    text-align: center;
    color: #0079b2;
    text-decoration: none;
}

.signup .header h3 {
    color: #014565;
    font-size: 18px;
    font-weight: bold;
    font-family: 'Archivo Black', sans-serif;
    margin: 5px;
}

.signup .inputs p {
    color: #09364c;
    font-size: 17px;
    font-weight: 300;
    width: 80px;
    margin: 0px;
    font-family: 'Questrial', sans-serif;
}

.signup .sep {

    height: 1px;

    background: #e8e8e8;

    width: 206px;

    margin: 0px -15px;

}

.signup .inputs {
    margin-top: 10px;
    margin-left: 11px;
}

.signup .inputs label {

    color: #8f8f8f;

    font-size: 12px;

    font-weight: 300;

    letter-spacing: 1px;

    margin-bottom: 2px;

    display: block;

}

input::-webkit-input-placeholder {

    color:    #b5b5b5;

}

input:-moz-placeholder {

    color:    #b5b5b5;

}

.signup .inputs .texto {
    background: #ffffff;
    border-radius: 4px;
    border: none;
    padding: 12px 9px;
    width: 222px;
    margin-bottom: 22px;
    border: 1px solid #78bcdc;
    clear: both;
    color: #0f374a;
    font-size: 15px;
    font-family: 'Questrial', sans-serif;
}

.signup .inputs .texto:focus {

    background: #fff;

    box-shadow: 0px 0px 0px 3px #fff38e, inset 0px 2px 3px rgba( 0,0,0,0.2 ), 0px 5px 5px rgba( 0,0,0,0.15 );

    outline: none;   

}


.imglol{width:100px;cursor: pointer;}

.signup .inputs label.terms {

    float: left;

    font-size: 14px;

    font-style: italic;

}

.signup .inputs .submit {
    width: 100%;
    border-radius: 4px;
    border: 0px;
    padding: 8px 0;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    background: #0079b2;
    display: table;
    position: static;
    font-family: 'Archivo Black', sans-serif;
}

.signup .inputs .submit:hover {
      cursor: pointer;
      background: #0b415a;

}

img.grayscale{

    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+ */

    filter: gray; /* IE6-9 */

    -webkit-filter: grayscale(100%); /* Chrome 19+ & Safari 6+ */

    -webkit-transition: all .6s ease; /* Fade to color for Chrome and Safari */

    -webkit-backface-visibility: hidden; /* Fix for transition flickering */

}

.container-top{
    display: flex;
    /* align-items por defecto tiene el valor `stretch` */
    align-items: start;
    width: 80%;
    margin:0px;
    margin-left:10%;
    justify-content: center
    
}

</style>

<script language="javascript">

	function CambiarClass(cual){		

		document.getElementById("admin").classList.add("grayscale");

		document.getElementById("docen").classList.add("grayscale");

		document.getElementById("acudi").classList.add("grayscale");

		document.getElementById("estu").classList.add("grayscale");

		document.getElementById("docum").classList.add("grayscale");	

		//--------------------------------------------------------//

		document.getElementById("form_admin").style.display = "none";

		document.getElementById("form_docen").style.display = "none";

		document.getElementById("form_acudi").style.display = "none";

		document.getElementById("form_estu").style.display = "none";

		document.getElementById("form_docum").style.display = "none";	

		

		document.getElementById(cual).classList.remove("grayscale");

		document.getElementById("form_" + cual).style.display = "";	

	}

</script>

<!-- PARA MOSTRAR EL MODAL DE RECUPERACION -->

<script type="text/javascript" src="sygescol2014/js/mootools.js"></script>

<link rel="stylesheet" href="sygescol2014/js/SqueezeBox/assets/SqueezeBox.css" type="text/css" />

<script src="sygescol2014/js/SqueezeBox/SqueezeBox.js" type="text/javascript"></script>

<!--link  font-->		
<link href='https://fonts.googleapis.com/css?family=Questrial|Archivo+Black' rel='stylesheet' type='text/css'>

<script type="text/javascript">

window.addEvent('domready', function() {

		SqueezeBox.assign($$('a.modal'), {

		parse: 'rel'

	});

});



function AbrirVentana(button,tipo)

{

	//var nombre = $(campo).value;

	//SqueezeBox.open("recuperacion_clave.php?tema="+nombre+"&sub="+subtem, {handler: 'iframe', size:{x:610,y:420}});

	if(tipo != ""){

		SqueezeBox.open("sygescol2020/recuperacion_clave.php?tipo="+tipo, {handler: 'iframe', size:{x:490,y:400}});

	}



}

</script>

<!-- FIN MODAL RECUPERACION-->

</head>

<body id="cuerpo">

<div class="container-top">
    
    <div id="position1"><img id="admin" onclick="CambiarClass('admin')" class=" imglol" src="t1.png"  /></div>

    <div id="position2"><img id="docen" onclick="CambiarClass('docen')" class="grayscale imglol" src="t2.png"  /></div>

    <div id="position3"><img id="acudi" onclick="CambiarClass('acudi')" class="grayscale imglol" src="t4.png"  /></div>

    <div id="position4"><img id="estu" onclick="CambiarClass('estu')" class="grayscale imglol" src="t3.png"  /></div>

    <div id="position5"><img id="docum" onclick="CambiarClass('docum')" class="grayscale imglol" src="t5.png"  /></div>
    
</div>
<div style="margin-top:25px;width: 83%;margin-left:0%">

	<table align="center" style="border-color:#0079b2;">

	<tr>

		<td>

		<div class="width50  floatleft">

			<div class="moduletable ">

				<div class="">

					<div class="moduletable_content clearfix">

						<div class="custom">

							<div class="container">

								<form id="form_admin" class="signup" action="../inc_eleccion_sistema.php" enctype="application/x-www-form-urlencoded" method="post" target="_parent">

									<div class="header">

										<h3 align="center"><nobr>Acceso a Directivos <br/>/ Administrativos</nobr></h3>

									</div>

									<div class="sep"></div>

									<div class="inputs">

										<p>Usuario:</p>

											<input type="text" id="username" class="texto" name="username" value="" placeholder="Usuario" />

										<br clear="all" />

										<p>Contraseña:</p>

											<input type="password" class="texto" id="password" name="password" value="" placeholder="Contraseña" />

										<br clear="all" />

										<p>Año:</p>

										<select class="texto" id="anoLectivo" name="anoLectivo"> 

											<?php

											foreach($annos as $val){

											?>

											<option <?php echo ($val == date("Y"))?'selected="selected"':'';?> value="<?php echo $val;?>"><?php echo $val;?></option>

											<?php

											}

											?>

										</select>          

									   <br clear="all" />

										<input class="submit" id="entrar" name="entrar" type="submit" value="Ingresar" />
                                        <br>
                                        Olvid&oacute; su contrase&ntilde;a? <a id="olvido_directivo" name="olvido_directivo" href="#" onclick="AbrirVentana(this,'directivo');">Clic Aqui</a>

									</div>

								</form>

								<form id="form_docen" class="signup" action="../inc_eleccion_sistema.php" style="display:none;" enctype="application/x-www-form-urlencoded" method="post" target="_parent">

									<div class="header">

										<h3 align="center"><nobr>Acceso a Docentes</nobr></h3>

									</div>

									<div class="sep"></div>

									<div class="inputs">

										<p>Usuario:</p>

											<input type="text" id="username" class="texto" name="username" value="" placeholder="Usuario" />

										<br clear="all" />

										<p>Contraseña:</p>

											<input type="password" class="texto" id="password" name="password" value="" placeholder="Contraseña" />

										<br clear="all" />

										<p>Año:</p>

										<select class="texto" id="anoLectivo" name="anoLectivo"> 

											<?php

											foreach($annos as $val){

											?>

											<option <?php echo ($val == date("Y"))?'selected="selected"':'';?> value="<?php echo $val;?>"><?php echo $val;?></option>

											<?php

											}

											?>

										</select>          

									   <br clear="all" />

										<input class="submit" id="entrar" name="entrar" type="submit" value="Ingresar" />
                                        <br>

                                        Olvid&oacute; su contrase&ntilde;a? <a id="olvido_directivo" name="olvido_directivo" href="#" onclick="AbrirVentana(this,'directivo');">Clic Aqui</a>

									</div>

								</form>

								<form id="form_acudi" class="signup" action="../inc_eleccion_sistema_padres.php" style="display:none;" enctype="application/x-www-form-urlencoded" method="post" target="_parent">

									<div class="header">

										<h3 align="center"><nobr>Acceso a Acudientes</nobr></h3>

									</div>

									<div class="sep"></div>

									<div class="inputs">

										<p>Usuario:</p>

											<input type="text" id="username" class="texto" name="username" value="" placeholder="Usuario" />

										<br clear="all" />

										<p>Contraseña:</p>

											<input type="password" class="texto" id="password" name="password" value="" placeholder="Contraseña" />

										<br clear="all" />

										<p>Año:</p>

										<select class="texto" id="anoLectivo" name="anoLectivo"> 

											<?php

											foreach($annos as $val){

												if($val > 2012){

												?>

												<option <?php echo ($val == date("Y"))?'selected="selected"':'';?> value="<?php echo $val;?>"><?php echo $val;?></option>

												<?php

												}

											}

											?>

										</select>          

									   <br clear="all" />

										<input class="submit" id="entrar" name="entrar" type="submit" value="Ingresar" />
                                        <br>
										 Olvid&oacute; su contrase&ntilde;a? <a id="olvido_directivo" name="olvido_directivo" href="#" onclick="AbrirVentana(this,'directivo');">Clic Aqui</a>
									</div>

								</form>

								<form id="form_estu" class="signup" action="../inc_eleccion_sistema_estudiante.php" style="display:none;" enctype="application/x-www-form-urlencoded" method="post" target="_parent">

									<div class="header">

										<h3 align="center"><nobr>Acceso a Estudiantes<br/>/ ExAlumnos</nobr></h3>

									</div>

									<div class="sep"></div>

									<div class="inputs">

										<p>Usuario:</p>

											<input type="text" id="username" class="texto" name="username" value="" placeholder="Usuario" />

										<br clear="all" />

										<p>Contraseña:</p>

											<input type="password" class="texto" id="password" name="password" value="" placeholder="Contraseña" />

										<br clear="all" />

										<p>Año:</p>

										<select class="texto" id="anoLectivo" name="anoLectivo"> 

											<?php

											foreach($annos as $val){

											?>

											<option <?php echo ($val == date("Y"))?'selected="selected"':'';?> value="<?php echo $val;?>"><?php echo $val;?></option>

											<?php

											}

											?>

										</select>          

									   <br clear="all" />

										<input class="submit" id="entrar" name="entrar" type="submit" value="Ingresar" />
                                        <br>

                                        Olvid&oacute; su contrase&ntilde;a? <a id="olvido_directivo" name="olvido_directivo" href="#" onclick="AbrirVentana(this,'directivo');">Clic Aqui</a>
                                       	</div>

								</form>

								<form id="form_docum" class="signup" action="../inc_eleccion_sistema_documentos.php" style="display:none;" enctype="application/x-www-form-urlencoded" method="post" target="_parent">

									<div class="header">

										<h3 align="center"><nobr>Descarga de Documentos<br />Autorizados</nobr></h3>

									</div>

									<div class="sep"></div>

									<div class="inputs">

										<p style="width:90%;">Número de Documento:</p>

											<input type="text" id="documento_acudiente" class="texto" name="documento_acudiente" value="" placeholder="Número de Documento" />

										<br clear="all" />

										<p>Año:</p>

										<select class="texto" id="anoLectivo" name="anoLectivo">

											<?php

											foreach($annos as $val){

												if($val > 2013){

												?>

												<option <?php echo ($val == date("Y"))?'selected="selected"':'';?> value="<?php echo $val;?>"><?php echo $val;?></option>

												<?php

												}

											}

											?>

										</select>          

									   <br clear="all" />

										<input class="submit" id="entrar" name="entrar" type="submit" value="Ingresar" />

									</div>

								</form>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		</td>

	</tr>

	</table>

</div>

</body>

</html>

