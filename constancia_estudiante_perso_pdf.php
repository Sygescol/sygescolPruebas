<?php

//Archivo con los datos para la conexion

$roles_con_permiso = array('99', '6', '1', '2', '3', '4');

include_once("inc.configuracion.php");

include_once("inc.validasesion.php");

include_once("inc.funciones.php");

include_once("conexion.php");

$link=conectarse();



//Clase para crear los pdfs

require_once('includes/fpdf153/fpdf2file.php');

include_once("inc.funciones.php");

include_once("horario_function.php");


include "includes/phpqrcode/phpqrcode.php";




define (__TRACE_ENABLED__, false);

define (__DEBUG_ENABLED__, false);



if(count($_GET)>0){

	$_POST=$_GET;

}



function dos_digitos($valor)

{

	if(strlen($valor) < 2)

	{

		$valor = '0' . $valor;

	}

	return $valor;

} 



function eliminarDir($carpeta)

{

	foreach(glob($carpeta . "/*") as $archivos_carpeta)

	{

		//echo $archivos_carpeta;

	 

		if (is_dir($archivos_carpeta))

		{

			eliminarDir($archivos_carpeta);

		}

		else

		{

			unlink($archivos_carpeta);

		}

	}	 

	//rmdir($carpeta);

}

function cropImage($nw, $nh, $source, $stype, $dest) {

	$carpeta='images/tempfirmas';

	if(!is_dir($carpeta)){

		@mkdir($carpeta, 0755);

	}

	

   	$dire = 'images/';

	$img = $source;

	$img = str_replace('data:image/png;base64,', '', $img);

	$img = str_replace(' ', '+', $img);

	$data = base64_decode($img);

	$file = $carpeta.'/'.$dest.'.png';

	$success = file_put_contents($file, $data);

	

	//-------------------------------------------------------------

	$png = $carpeta.'/'.$dest.'.png';

	$background = array(255, 255, 255);

	$size = getimagesize($png);

	$img = imagecreatefrompng($png);

	$image = imagecreatetruecolor($width = $size[0], $height = $size[1]);

	imagefill($image, 0, 0, $bgcolor = imagecolorallocate($image, $background[0], $background[1], $background[2]));

	imagecopyresampled($image, $img, 0, 0, 0, 0, $width, $height, $width, $height);

	imagecolortransparent($image, $bgcolor);

	imagegif($image, $carpeta.'/'.$dest.".gif" , 100);

	imagedestroy($image);

	

	return $carpeta.'/'.$dest . ".gif";

}



function getMonthDays($Month, $Year) 

{ 

   //Si la extensiÛn que mencionÈ est· instalada, usamos esa. 

   if( is_callable("cal_days_in_month")) 

   { 

      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year); 

   } 

   else 

   { 

      //Lo hacemos a mi manera. 

      return date("d",mktime(0,0,0,$Month+1,0,$Year)); 

   } 

} 

class DPDF extends FPDF2File

{

	

	function SetDatosHeader($datos_institucion, $long_max, $ancho_max, $titulo)

	{

		

		$this->datos_institucion = $datos_institucion;

		$this->long_max = $long_max;

		$this->ancho_max = $ancho_max;

		$this->titulo = $titulo;

	}

	

	function Footer()

	{

		/*global $url,$pass, $link;

		$datos_sis="SELECT * FROM acerca_de";

		$query_sis=mysql_query($datos_sis, $link)or die("2. No se pudo consultar los datos de Sistema");

		$rows_sis=mysql_fetch_array($query_sis);

		

		$select_datos="SELECT clrp.a AS escudo, clrp.b AS nombre, clrp.g AS direccion,

				municipio.municipio_nombre, dpto.nombre AS departamento_nombre, 

				clrp.e AS telefono1, clrp.n AS telefono2, clrp.fx AS fax,

				clrp.c AS resolucion, clrp.tt AS dane, clrp.nn AS icfes, clrp.p AS correo, clrp.uu AS URL

				FROM clrp LEFT JOIN municipio ON (clrp.u = municipio.municipio_id) 

				LEFT JOIN dpto ON (municipio.departamento_id = dpto.id)";

		$sql_datos=mysql_query($select_datos, $link)or die("3. No se pudo Consultar los datos de la InstituciÛn.");

		$rows_datos=mysql_fetch_array($sql_datos);

		

		

		$this->SetY(-22);

		$this->SetFont('Arial','B',8);

		//$this->Cell(0,10,'Desarrollado por Sistemas Ivhorsnet.  Ing. Orlando Jaimes Leal - Cel: '.$rows_sis['ace_de_cel'].' - Tel: '.$rows_sis['ace_de_tel1'] ,0,0,'C');

		$texto=$rows_datos['direccion'].'   '.ucwords_latin1($rows_datos['municipio_nombre']).' - '.$rows_datos['departamento_nombre'];

		$this->Cell(0,10,$texto,0,0,'C');

		

		$this->SetY(-18);

		$this->SetFont('Arial','B',8);

		//$this->Cell(0,10,'Desarrollado por Sistemas Ivhorsnet.  Ing. Orlando Jaimes Leal - Cel: '.$rows_sis['ace_de_cel'].' - Tel: '.$rows_sis['ace_de_tel1'] ,0,0,'C');

		$texto='Telefax '.$rows_datos['fax'].' Tel. '.$rows_datos['telefono1'].' - '.$rows_datos['telefono2'];

		$this->Cell(0,10,$texto,0,0,'C');

		

		$this->SetY(-14);

		$this->SetFont('Arial','BU',8);

		//$this->Cell(0,10,'Desarrollado por Sistemas Ivhorsnet.  Ing. Orlando Jaimes Leal - Cel: '.$rows_sis['ace_de_cel'].' - Tel: '.$rows_sis['ace_de_tel1'] ,0,0,'C');

		$texto=$rows_datos['URL'].'          '.$rows_datos['correo'];

		$this->Cell(0,10,$texto,0,0,'C');*/

		$this->PiePersonalizado();

		

	}

	

	function Header()

	{

		global $row_estudiantes_grupo, $totalRows_asignaturas_grupo, $link;

		$this->HeaderVertical($this->datos_institucion, $this->long_max, $this->ancho_max, $this->titulo);

		

		$sel_dt_empr = "SELECT * FROM acerca_de";

		$sql_dt_empr = mysql_query($sel_dt_empr, $link)or die(mysql_error());

		$rows_dt_empr = mysql_fetch_array($sql_dt_empr);

		

		//$this->SetFont('Arial','B',8);

		//$this->RotatedText(205, 70, 'Desarrollado por Sistemas Ivhorsnet. Ing. Orlando Jaimes Leal - Tel: '.$rows_dt_empr['ace_de_tel1'].' - Cel: '.$rows_dt_empr['ace_de_cel'], 270);

	}

	



	var $B=0;

    var $I=0;

    var $U=0;

    var $HREF='';

    var $ALIGN='';



    function WriteHTML($html)

    {

        //HTML parser

        $html=str_replace("\n", ' ', $html);

        $a=preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach($a as $i=>$e)

        {

            if($i%2==0)

            {

                //Text

                if($this->HREF)

                    $this->PutLink($this->HREF, $e);

                elseif($this->ALIGN == 'center')

                    $this->Cell(0, 5, $e, 0, 1, 'C');

                else

                    $this->Write(5, $e);

            }

            else

            {

                //Tag

                if($e{0}=='/')

                    $this->CloseTag(strtoupper(substr($e, 1)));

                else

                {

                    //Extract properties

                    $a2=split(' ', $e);

                    $tag=strtoupper(array_shift($a2));

                    $prop=array();

                    foreach($a2 as $v)

                        if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$', $v, $a3))

                            $prop[strtoupper($a3[1])]=$a3[2];

                    $this->OpenTag($tag, $prop);

                }

            }

        }

    }



    function OpenTag($tag, $prop)

    {

        //Opening tag

        if($tag=='B' or $tag=='I' or $tag=='U')

            $this->SetStyle($tag, true);

        if($tag=='A')

            $this->HREF=$prop['HREF'];

        if($tag=='BR')

            $this->Ln(5);

        if($tag=='P')

            $this->ALIGN=$prop['ALIGN'];

        if($tag=='HR')

        {

            if( $prop['WIDTH'] != '' )

                $Width = $prop['WIDTH'];

            else

                $Width = $this->w - $this->lMargin-$this->rMargin;

            $this->Ln(2);

            $x = $this->GetX();

            $y = $this->GetY();

            $this->SetLineWidth(0.4);

            $this->Line($x, $y, $x+$Width, $y);

            $this->SetLineWidth(0.2);

            $this->Ln(2);

        }

    }



    function CloseTag($tag)

    {

        //Closing tag

        if($tag=='B' or $tag=='I' or $tag=='U')

            $this->SetStyle($tag, false);

        if($tag=='A')

            $this->HREF='';

        if($tag=='P')

            $this->ALIGN='';

    }



    function SetStyle($tag, $enable)

    {

        //Modify style and select corresponding font

        $this->$tag+=($enable ? 1 : -1);

        $style='';

        foreach(array('B', 'I', 'U') as $s)

            if($this->$s>0)

                $style.=$s;

        $this->SetFont('', $style);

    }



    function PutLink($URL, $txt)

    {

        //Put a hyperlink

        $this->SetTextColor(0, 0, 255);

        $this->SetStyle('U', true);

        $this->Write(5, $txt, $URL);

        $this->SetStyle('U', false);

        $this->SetTextColor(0);

    }

	

	var $angle=0;

	

	function Rotate($angle, $x=-1, $y=-1)

	{

		if($x==-1)

			$x=$this->x;

		if($y==-1)

			$y=$this->y;

		if($this->angle!=0)

			$this->_out('Q');

		$this->angle=$angle;

		if($angle!=0)

		{

			$angle*=M_PI/180;

			$c=cos($angle);

			$s=sin($angle);

			$cx=$x*$this->k;

			$cy=($this->h-$y)*$this->k;

			$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));

		}

	}

	

	function _endpage()

	{

		if($this->angle!=0)

		{

			$this->angle=0;

			$this->_out('Q');

		}

		parent::_endpage();

	}

	

	function RotatedText($x, $y, $txt, $angle)

	{

		//Text rotated around its origin

		$this->Rotate($angle, $x, $y);

		$this->Text($x, $y, $txt);

		$this->Rotate(0);

	}

	

	function RotatedImage($file, $x, $y, $w, $h, $angle)

	{

		//Image rotated around its upper-left corner

		$this->Rotate($angle, $x, $y);

		$this->Image($file, $x, $y, $w, $h);

		$this->Rotate(0);

	}



	

}

	

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

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

}

function contenido()

{

	global $link;

	global $pdf;

	global $fcolp;

	global $resultado_quienes_firman;

	global $num_quiens_firman;

	global $row_docu_legal;

	

	//$periodicidad=array(1=>'CICLO 1 (ENERO - FEBRERO)', 2=>'CICLO 1 (ENERO - FEBRERO)', 3=>'CICLO 2 (MARZO - ABRIL)', 4=>'CICLO 2 (MARZO - ABRIL)', 5=>'CICLO 3 (MAYO - JUNIO)', 6=>'CICLO 3 (MAYO - JUNIO)', 7=>'CICLO 4 (JULIO - AGOSTO)', 8=>'CICLO 4 (JULIO - AGOSTO)', 9=>'CICLO 5 (SEPTIEMBRE - OCTUBRE)', 10=>'CICLO 5 (SEPTIEMBRE - OCTUBRE)', 11=>'CICLO 6 (NOVIEMBRE - DICIEMBRE)', 12=>'CICLO 6 (NOVIEMBRE - DICIEMBRE)');

	$meses_periodo=array(1=>'1,2', 2=>'1,2', 3=>'3,4', 4=>'3,4', 5=>'5,6', 6=>'5,6', 7=>'7,8', 8=>'7,8', 9=>'9,10', 10=>'9,10', 11=>'11,12', 12=>'11,12');

	

	

	$datos_colegio = mysql_query("SELECT b, u, gg, municipio_nombre, dpto.nombre 

							FROM clrp 

							LEFT JOIN municipio ON (clrp.u = municipio.municipio_id) 

							LEFT JOIN dpto ON (municipio.departamento_id = dpto.id)", $link)or die("5.");

	$rows_datos_colegio = mysql_fetch_array($datos_colegio);

	

	$datos_persona = "SELECT alumno.*, matricula.*, tipo_docum.nombre, v_grupos.grupo_nombre, municipio.municipio_nombre, dpto.nombre as departamento_nombre, v_grupos.gao_nombre, v_grupos.jornada_nombre

											FROM alumno

												INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id)

												INNER JOIN v_grupos ON (matricula.grupo_id=v_grupos.grupo_id)

												LEFT JOIN tipo_docum ON (alumno.tipo_docu_id=tipo_docum.id)

												LEFT JOIN municipio ON (alumno.muni_exp_id = municipio.municipio_id) 

												LEFT JOIN dpto ON (municipio.departamento_id = dpto.id) 

										WHERE matri_id='".$_POST['matri_id']."' AND matri_estado=0";

	$query_consulta=mysql_query($datos_persona,$link) or die("No se pudo consultar los datos del estudiante" . ' ' . $datos_persona);

	$rows_estudiante=mysql_fetch_array($query_consulta);	

	

	

		$nombre_ano = array(2007 => "Dos Mil Siete", 2008 => "Dos Mil Ocho", 2009 => "Dos Mil Nueve", 2010 => "Dos Mil Diez", 2011 => "Dos Mil Once", 2012 => "Dos Mil Doce", 2013 => "Dos Mil Trece", 2014 => "Dos Mil Catorce");

		$nombre_mes = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");

		$nombre_mes_ids = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", 

					"07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");

		

		$nombre_dia=array(1 => "Un", 2 => "Dos", 3 => "Tres", 4 => "Cuatro", 5 => "Cinco", 6 => "Seis", 7 => "Siete", 8 => "Ocho", 9 => "Nueve", 10 => "Diez", 

		11 => "Once", 12 => "Doce", 13 => "Trece", 14 => "Catorce", 15 => "Quince", 16 => "Dieciseis", 17 => "Diecisiete", 18 => "Dieciocho", 19 => "Diecinueve", 20 => "Veinte", 

		21 => "Veintiun", 22 => "Veintidos", 23 => "Veintitres", 24 => "Veinticuatro", 25 => "Veinticinco", 26 => "Veintiseis", 27 => "Veintisiete", 28 => "Veintiocho", 29 => "Veintinueve", 30 => "Treinta", 31 => "Treinta y un");



	//Mostramos el texto que va en la constancia

	if($_POST['tipo']==1){

		$consulta_grado = mysql_query("select v_grupos.*, super_sede.ssede_nombre from v_grupos

												INNER JOIN sedes ON (sedes.sede_consecutivo=v_grupos.grupo_sede)

												INNER JOIN super_sede ON (super_sede.ssede_consecutivo=sedes.super_sede)

										where grupo_id = '".$_POST[grupo]."'",$link);

		$rows_grado=mysql_fetch_array($consulta_grado)or die("4.");

		//$meses_per=explode(",", $meses_periodo[$_POST['periodicidad']]);

		

		$select_ciclos = "SELECT * FROM ciclos_flias_accion WHERE ciclo_id = '".$_POST['periodicidad']."'";

		$sql_ciclos = mysql_query($select_ciclos, $link)or die("No se pudo consultar los ciclos.");

		$row_ciclos = mysql_fetch_array($sql_ciclos);

		

		$mes_ini = strtr(strtoupper($nombre_mes_ids[ date("m", strtotime($row_ciclos['ciclo_desde'])) ]), "‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙", "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄");

		$mes_fin = strtr(strtoupper($nombre_mes_ids[ date("m", strtotime($row_ciclos['ciclo_hasta'])) ]), "‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙", "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄");

		$nombre = strtr(strtoupper($row_ciclos['ciclo_nombre']), "‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙", "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄");	

		

		$meses_per[0] = date("n", strtotime($row_ciclos['ciclo_desde']));

		$meses_per[1] = date("n", strtotime($row_ciclos['ciclo_hasta']));

		

		$nombre = $nombre.' ('; 

		if($mes_ini != ''){

			$nombre .= ' '.$mes_ini.' '.date("d", strtotime($row_ciclos['ciclo_desde']));

		}

		if($mes_fin != ''){

			$nombre .= ' - '.$mes_fin.' '.date("d", strtotime($row_ciclos['ciclo_hasta']));

		}

		$nombre .= ')';

		

		$periodicidad = $nombre;

		

		//date('n')

		$asigna='';

		$total_horas=0;

		$total_inasis=0;

		

		if(date('n') <= $meses_per[1]){

			echo "<html>

					<head>

						<style type='text/css'>

							.mensajePago{

								background: -o-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -moz-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -ms-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -webkit-gradient(linear,left top,left bottom,from(#A5D34A),to(#7E9D3B)) repeat scroll 0 0 #7E9D3B;

								-ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorStr=#A5D34A, endColorStr=#7E9D3B)';

								background-color:#A5D34A;

								padding:10px;

								color:#000000 ;

								-moz-border-radius:6px 6px 6px 6px;;

								-webkit-border-radius:10px;

								box-shadow: 0px 0px 15px #000;

								-moz-box-shadow: 0px 0px 15px #000;

								-webkit-box-shadow: 0px 0px 15px #000;

								font-size:17px;

							}

						</style>

					</head>

					<body>

						<div id='mensaje' style='position: fixed; z-index:101; top:40%; right:30%; width:40%;' class='mensajePago'>

							<table width='100%' border='0'>

							  <tr>

								<th colspan='2' scope='col' style='color:#0000FF; font-size:16px;'>MENSAJE IMPORTANTE </th>

							  </tr>

							  <tr>

								<th scope='col' width='10%'><img src='images/iconos/advertencia.gif' /></th>

								<td width='90%'>

									<p style=' padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px;' align='justify'>

										<strong> No ha Finalizado el Ciclo para Generar la Constancia de Familias en AcciÛn

										<div><center><input style='height:30px;' type='button' value='Cerrar' onclick='javascript:window.close();' /></center></div>

										</strong>

									</p>

								</td>

							  </tr>

							</table>

						</div>

					</body>

				</html>";

			exit();

		}

		

		$total_horas = 0;		

		$to_dias = 0;

		foreach($meses_per as $ms_pr){			

			/*$asigna=explode(",", dias_asignatura($_POST['grupo'], $ms_pr, $_POST['matri_id']));

			//echo $ms_pr.' '.$asigna.'<br>';

			$total_horas+=$asigna[0];

			$total_inasis+=$asigna[1];*/

			

			$sql_tipo_horario = "SELECT tipo_horario_id, tipo_horario.th_nombre, 

			jraa.b as jornada, sede_nombre,  tipo_horario_bd.id as tip_hor_bd

			FROM tipo_horario_grupo, jraa, sedes, tipo_horario, tipo_horario_bd

			WHERE grupo_id = '".$_POST['grupo']."'

			AND tipo_horario_id = tipo_horario.th_id

			AND tipo_horario_bd.id=tipo_horario.tipo_horario_db

			AND tipo_horario.sede_consecutivo = sedes.sede_consecutivo 

			AND jraa_id = jraa.i";

			$resultado_tipo_horario = mysql_query($sql_tipo_horario, $link) or die("No se pudo consultar el tipo de horario del grupo");

			$row_tipo_horario = mysql_fetch_assoc($resultado_tipo_horario);

			$num_tipo_horario = mysql_num_rows($resultado_tipo_horario);

			

			if($num_tipo_horario > 0){

				$tipo_horario_id = $row_tipo_horario['tipo_horario_id'];

				//Obtengo los intervalos de clase para el tipo de horario al que pertenece el grupo

				$sql_intervalos_ini = "SELECT tipo_horario_intervalo.*, tipo_intervalo.ti_nombre, tipo_intervalo.ti_id 

									FROM tipo_horario_intervalo

										INNER JOIN tipo_intervalo ON (tipo_horario_intervalo.tipo_intervalo_id = tipo_intervalo.ti_id)

									WHERE tipo_horario_intervalo.tipo_horario_id = $tipo_horario_id 

									ORDER BY tipo_horario_intervalo.Hora_ini ASC, tipo_horario_intervalo.Hora_fin ASC LIMIT 0, 1";

				$intervalos_clase_ini = mysql_query($sql_intervalos_ini, $link) or die("6. ".mysql_error());

				$rows_ini = mysql_fetch_array($intervalos_clase_ini);

				

				$sql_intervalos_fin = "SELECT tipo_horario_intervalo.*, tipo_intervalo.ti_nombre, tipo_intervalo.ti_id 

									FROM tipo_horario_intervalo

										INNER JOIN tipo_intervalo ON (tipo_horario_intervalo.tipo_intervalo_id = tipo_intervalo.ti_id)

									WHERE tipo_horario_intervalo.tipo_horario_id = $tipo_horario_id 

									ORDER BY tipo_horario_intervalo.Hora_ini DESC, tipo_horario_intervalo.Hora_fin DESC LIMIT 0, 1";

				$intervalos_clase_fin = mysql_query($sql_intervalos_fin, $link) or die("7. ".mysql_error());

				$rows_fin = mysql_fetch_array($intervalos_clase_fin);

			}

			

			$mes_ceros = dos_digitos($ms_pr);

			$horario = new GenerarHorarioClases($_POST['grupo'], '', $_SESSION['lectivo'], $mes_ceros, $database_sygescol, $link);	

			$horario_grupos = $horario->return_horario();

			$periodos = $horario->array_periodos;

			$jornadas = $horario->array_jornadas;

			$intervalos = $horario->array_intervalos;

			$intervalos_jc = $horario->array_intervalos_jc;

			$id_tip_hor = $horario->id_tip_hor;

			$horario_virtual = $horario->calendario_hor();

			

			foreach($horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ] as $dias_key => $dias_val){			

				if($horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ][ $dias_key ]['HABIL'] == 'S'){

				

					$sel_inasis = "SELECT * FROM inasistencia 

									WHERE matri_id = '".$_POST['matri_id']."'

										AND ina_fecha = '".$_SESSION['lectivo']."-".$mes_ceros."-".$dias_key."'";
//echo $sel_inasis.'<br>';
					$sql_inasis = mysql_query($sel_inasis, $link)or die(mysql_error());

					$num_inasis = mysql_num_rows($sql_inasis);

					

					$tot_hor_dia = 0;

					foreach($horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ][ $dias_key ] as $inter_key => $inter_val){

						

						if(is_array($inter_val)){

							$tot_prof = $horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ][ $dias_key ][ $inter_key ]['TOT_PROF'];

							for($prof=0; $prof < $tot_prof; $prof++){													

								if(!isset($dia_array[$dias_key]['HORAS'])){

									$dia_array[$dias_key]['HORAS'] = 0;

								}

								$tot_hor_dia += $horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ][ $dias_key ][ $inter_key ][ $prof ]['TOT_HOR'];

								//echo $num_inasis.' '.$tot_hor_dia.' '.$horario_virtual[ $_SESSION['lectivo'] ][ $mes_ceros ][ $dias_key ][ $inter_key ][ $prof ]['TOT_HOR'].'<br>';

							}										

						}						

					}	

					$to_dias++;
//echo $num_inasis.' >= '.$tot_hor_dia.' and '.$num_inasis.' > 0'.'<br>';
					if($num_inasis < $tot_hor_dia and $num_inasis > 0){

						$total_horas += 1;

					}				

				}				

			}

		}

		

		if($to_dias == 0){

			echo "<html>

					<head>

						<style type='text/css'>

							.mensajePago{

								background: -o-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -moz-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -ms-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -webkit-gradient(linear,left top,left bottom,from(#A5D34A),to(#7E9D3B)) repeat scroll 0 0 #7E9D3B;

								-ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorStr=#A5D34A, endColorStr=#7E9D3B)';

								background-color:#A5D34A;

								padding:10px;

								color:#000000 ;

								-moz-border-radius:6px 6px 6px 6px;;

								-webkit-border-radius:10px;

								box-shadow: 0px 0px 15px #000;

								-moz-box-shadow: 0px 0px 15px #000;

								-webkit-box-shadow: 0px 0px 15px #000;

								font-size:17px;

							}

						</style>

					</head>

					<body>

						<div id='mensaje' style='position: fixed; z-index:101; top:40%; right:30%; width:40%;' class='mensajePago'>

							<table width='100%' border='0'>

							  <tr>

								<th colspan='2' scope='col' style='color:#0000FF; font-size:16px;'>MENSAJE IMPORTANTE </th>

							  </tr>

							  <tr>

								<th scope='col'><img src='images/iconos/advertencia.gif' /></th>

								<td >

									<p style=' padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px;' align='justify'>

										<strong> No se ha Ingresado El Horario Por parte de la coordinaciÛn acadÈmica 

										<div><center><input style='height:30px;' type='button' value='Cerrar' onclick='javascript:window.close();' /></center></div>

										</strong>

									</p>

								</td>

							  </tr>

							</table>

						</div>

					</body>

				</html>";

			exit();

		}

		$porcentaje_ina = round(($to_dias * 20)/100);
//echo $total_horas.' >= '.$porcentaje_ina;

		if($total_horas >= $porcentaje_ina){

			echo "<html>

					<head>

						<style type='text/css'>

							.mensajePago{

								background: -o-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -moz-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -ms-linear-gradient(top,#A5D34A,#7E9D3B) repeat scroll 0 0 #7E9D3B;

								background: -webkit-gradient(linear,left top,left bottom,from(#A5D34A),to(#7E9D3B)) repeat scroll 0 0 #7E9D3B;

								-ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorStr=#A5D34A, endColorStr=#7E9D3B)';

								background-color:#A5D34A;

								padding:10px;

								color:#000000 ;

								-moz-border-radius:6px 6px 6px 6px;;

								-webkit-border-radius:10px;

								box-shadow: 0px 0px 15px #000;

								-moz-box-shadow: 0px 0px 15px #000;

								-webkit-box-shadow: 0px 0px 15px #000;

								font-size:17px;

							}

						</style>

					</head>

					<body>

						<div id='mensaje' style='position: fixed; z-index:101; top:40%; right:30%; width:40%;' class='mensajePago'>

							<table width='100%' border='0'>

							  <tr>

								<th colspan='2' scope='col' style='color:#0000FF; font-size:16px;'>MENSAJE IMPORTANTE </th>

							  </tr>

							  <tr>

								<th scope='col'><img src='images/iconos/advertencia.gif' /></th>

								<td >

									<p style=' padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px;' align='justify'>

										<strong>El estudiante No Cumplio con el 80% de Asistencia en ".$periodicidad.", por lo tanto el informe coresponde al siguiente reporte.

										<div><center><input style='height:30px;' type='button' value='Ver Reporte' onclick=\"document.location='constancia_estudiante_perso_asistencia.php?matri_id=".$_POST['matri_id']."&grupo=".$_POST['grupo']."&periodicidad=".$_POST['periodicidad']."'\" /></center></div>

										</strong>

									</p>

								</td>

							  </tr>

							</table>

						</div>

					</body>

				</html>";

			exit();

		}

		

		$sele_texto="SELECT * FROM constancias_personalizadas WHERE Matri_id = '".$_POST['matri_id']."' AND Cons_Todos=2 AND Cons_tipo=1";

		$sql_texto=mysql_query($sele_texto, $link)or die("8. ".mysql_error());

		$num_texto = mysql_num_rows($sql_texto);

		$rows_texto=mysql_fetch_array($sql_texto);

		if($num_texto==0 or $rows_texto['Cons_Texto']==''){

			$sele_texto="SELECT * FROM constancias_personalizadas WHERE Cons_Todos=1 AND Cons_tipo=1";

			$sql_texto=mysql_query($sele_texto, $link)or die("9. ".mysql_error());

			$num_texto = mysql_num_rows($sql_texto);

			$rows_texto=mysql_fetch_array($sql_texto);

		}

		

		/*$_POST['texto']=$rows_texto['Cons_Texto'];

		$carreta = strip_tags(html_entity_decode($_POST['texto']));*/

		

		$texto = strip_tags($rows_texto['Cons_Texto']);

		$texto = ereg_replace('#ESTUDIANTE#',strtoupper($rows_estudiante['alumno_ape1'].' '.$rows_estudiante['alumno_ape2'].' '.$rows_estudiante['alumno_nom1'].' '.$rows_estudiante['alumno_nom2']), $texto);

		$texto = ereg_replace('#TIPODOCUMENTO#',$rows_estudiante['nombre'], $texto);

		$texto = ereg_replace('#NUMDOCUMENTO#',$rows_estudiante['alumno_num_docu'], $texto);

		

		$lugar_expedicion = ucwords_latin1($rows_estudiante['municipio_nombre']) . ' - ' . $rows_estudiante['departamento_nombre'];

		if($rows_estudiante['municipio_nombre'] == '')

		{

			$lugar_expedicion = '(SIN DEFINIR)';

		}

		$texto = ereg_replace('#LUGAREXPEDICION#', $lugar_expedicion , $texto);							

		$texto = ereg_replace('#PERIODICIDAD#', $periodicidad , $texto);

		$texto = ereg_replace('#LECTIVO#',$_SESSION['lectivo'], $texto);

		$texto = ereg_replace('#PORSENTAJEASISTENCIA#','80 %', $texto);

		$texto = ereg_replace('#GRADO#',$rows_estudiante['gao_nombre'], $texto);

		$texto = ereg_replace('#JORNADA#',$rows_estudiante['jornada_nombre'], $texto);

		

		$hora_inicio = strtotime($rows_ini['Hora_ini']);						

		$hora_final = strtotime($rows_fin['Hora_fin']);

		$texto = ereg_replace('#HORINI#',date("h:i A", $hora_inicio), $texto);

		$texto = ereg_replace('#HORFIN#',date("h:i A", $hora_final), $texto);

		

		$texto = ereg_replace('#INSTITUCION#',$rows_datos_colegio['b'], $texto);

		$texto = ereg_replace('#MUNICIPIO#', ucfirst(strtr(strtolower($rows_datos_colegio['municipio_nombre']), "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄","‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙")), $texto);

		$texto = ereg_replace('#DEPARTAMENTO#', $rows_datos_colegio['nombre'], $texto);

										

		$fecha_genera = "a los " . $nombre_dia[date("j")] . " (".date("d").") dÌas del mes de ".$nombre_mes[date("n")]." de " .$nombre_ano[date("Y")]. " (".date("Y").").";



		$texto = ereg_replace('#FECHA#', $fecha_genera, $texto);

		

			

	}elseif($_POST['tipo']==2){

		$sele_texto="SELECT * FROM constancias_personalizadas WHERE Matri_id = '".$_POST['matri_id']."' AND Cons_Todos=2 AND Cons_tipo=2";

		$sql_texto=mysql_query($sele_texto, $link)or die("10. ".mysql_error());

		$num_texto = mysql_num_rows($sql_texto);

		$rows_texto=mysql_fetch_array($sql_texto);

		if($num_texto==0 or $rows_texto['Cons_Texto']==''){

			$sele_texto="SELECT * FROM constancias_personalizadas WHERE Cons_Todos=1 AND Cons_tipo=2";

			$sql_texto=mysql_query($sele_texto, $link)or die("11. ".mysql_error());

			$num_texto = mysql_num_rows($sql_texto);

			$rows_texto=mysql_fetch_array($sql_texto);

		}

		$texto = strip_tags(html_entity_decode($rows_texto['Cons_Texto']));

		$texto = ereg_replace('#ESTUDIANTE#',strtoupper($rows_estudiante['alumno_ape1'].' '.$rows_estudiante['alumno_ape2'].' '.$rows_estudiante['alumno_nom1'].' '.$rows_estudiante['alumno_nom2']), $texto);

		$texto = ereg_replace('#TIPODOCUMENTO#',$rows_estudiante['nombre'], $texto);

		$texto = ereg_replace('#NUMDOCUMENTO#',$rows_estudiante['alumno_num_docu'], $texto);

		

		$texto = ereg_replace('#NUMEROMATRICULA#',$rows_estudiante['matri_id'], $texto);

		$texto = ereg_replace('#FECHAMATRICULA#',$rows_estudiante['matri_fecha'], $texto);

		$texto = ereg_replace('#GRADOESTUDIANTE#',$rows_estudiante['gao_nombre'], $texto);

		$texto = ereg_replace('#JORNADAMATRICULA#',$rows_estudiante['jornada_nombre'], $texto);

		if($rows_estudiante['matri_folio']==0){

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_id'], $texto);

		}else{

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_folio'], $texto);

		}

		

		$lugar_expedicion = ucwords_latin1($rows_estudiante['municipio_nombre']) . ' - ' . $rows_estudiante['departamento_nombre'];

		if($rows_estudiante['municipio_nombre'] == '')

		{

			$lugar_expedicion = '(SIN DEFINIR)';

		}

		$texto = ereg_replace('#LUGAREXPEDICION#', $lugar_expedicion , $texto);							

		//$texto = ereg_replace('#PERIODICIDAD#', $periodicidad , $texto);

		$texto = ereg_replace('#LECTIVO#',$_SESSION['lectivo'], $texto);

		

		$texto = ereg_replace('#INSTITUCION#',$rows_datos_colegio['b'], $texto);

		$texto = ereg_replace('#MUNICIPIO#', ucfirst(strtr(strtolower($rows_datos_colegio['municipio_nombre']), "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄","‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙")), $texto);

		$texto = ereg_replace('#DEPARTAMENTO#', $rows_datos_colegio['nombre'], $texto);

											

		$fecha_genera = "a los " . $nombre_dia[date("j")] . " (".date("d").") dÌas del mes de ".$nombre_mes[date("n")]." de " .$nombre_ano[date("Y")]. " (".date("Y").").";



		$texto = ereg_replace('#FECHA#', $fecha_genera, $texto);

	}elseif($_POST['tipo']==3){

		$sele_texto="SELECT * FROM constancias_personalizadas WHERE Matri_id = '".$_POST['matri_id']."' AND Cons_Todos=2 AND Cons_tipo=3";

		$sql_texto=mysql_query($sele_texto, $link)or die('12. '.mysql_error());

		$num_texto = mysql_num_rows($sql_texto);

		$rows_texto=mysql_fetch_array($sql_texto);

		if($num_texto==0 or $rows_texto['Cons_Texto']==''){

			$sele_texto="SELECT * FROM constancias_personalizadas WHERE Cons_Todos=1 AND Cons_tipo=3";

			$sql_texto=mysql_query($sele_texto, $link)or die('13. '.mysql_error());

			$num_texto = mysql_num_rows($sql_texto);

			$rows_texto=mysql_fetch_array($sql_texto);

		}

		$texto = strip_tags(html_entity_decode($rows_texto['Cons_Texto']));

		$texto = ereg_replace('#ESTUDIANTE#',strtoupper($rows_estudiante['alumno_ape1'].' '.$rows_estudiante['alumno_ape2'].' '.$rows_estudiante['alumno_nom1'].' '.$rows_estudiante['alumno_nom2']), $texto);

		$texto = ereg_replace('#TIPODOCUMENTO#',$rows_estudiante['nombre'], $texto);

		$texto = ereg_replace('#NUMDOCUMENTO#',$rows_estudiante['alumno_num_docu'], $texto);

		

		$texto = ereg_replace('#NUMEROMATRICULA#',$rows_estudiante['matri_id'], $texto);

		$texto = ereg_replace('#FECHAMATRICULA#',$rows_estudiante['matri_fecha'], $texto);

		$texto = ereg_replace('#GRADOESTUDIANTE#',$rows_estudiante['gao_nombre'], $texto);

		$texto = ereg_replace('#JORNADAMATRICULA#',$rows_estudiante['jornada_nombre'], $texto);

		if($rows_estudiante['matri_folio']==0){

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_id'], $texto);

		}else{

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_folio'], $texto);

		}

		

		$lugar_expedicion = ucwords_latin1($rows_estudiante['municipio_nombre']) . ' - ' . $rows_estudiante['departamento_nombre'];

		if($rows_estudiante['municipio_nombre'] == '')

		{

			$lugar_expedicion = '(SIN DEFINIR)';

		}

		$texto = ereg_replace('#LUGAREXPEDICION#', $lugar_expedicion , $texto);							

		//$texto = ereg_replace('#PERIODICIDAD#', $periodicidad[$_POST['periodicidad']] , $texto);

		$texto = ereg_replace('#LECTIVO#',$_SESSION['lectivo'], $texto);

		

		$texto = ereg_replace('#INSTITUCION#',$rows_datos_colegio['b'], $texto);

		$texto = ereg_replace('#MUNICIPIO#', ucfirst(strtr(strtolower($rows_datos_colegio['municipio_nombre']), "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄","‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙")), $texto);

		$texto = ereg_replace('#DEPARTAMENTO#', $rows_datos_colegio['nombre'], $texto);

											

		$fecha_genera = "a los " . $nombre_dia[date("j")] . " (".date("d").") dÌas del mes de ".$nombre_mes[date("n")]." de " .$nombre_ano[date("Y")]. " (".date("Y").").";



		$texto = ereg_replace('#FECHA#', $fecha_genera, $texto);

		

	}elseif($_POST['tipo']==6){

		//Consultamos las Entidades Nuevas

		$sql_nueva_ent = "SELECT * FROM def_nueva_ent WHERE id_nueva_ent='".$_POST['entConst']."'";

		$query_nueva_ent = mysql_query($sql_nueva_ent, $link)or die("No se Pudo consultar las entidades");

		$num_entidades=mysql_num_rows($query_nueva_ent);

		$rows_ent_nuev = mysql_fetch_array($query_nueva_ent);

	

		$sele_texto="SELECT * FROM constancias_personalizadas WHERE Matri_id = '".$_POST['matri_id']."' AND Cons_Todos=2 AND Cons_tipo=6 AND id_ent = '".$_POST['entConst']."'";

		$sql_texto=mysql_query($sele_texto, $link)or die('14. '.mysql_error());

		$num_texto = mysql_num_rows($sql_texto);

		$rows_texto=mysql_fetch_array($sql_texto);

		if($num_texto==0 or $rows_texto['Cons_Texto']==''){

			$sele_texto="SELECT * FROM constancias_personalizadas WHERE Cons_Todos=1 AND Cons_tipo=6 AND id_ent = '".$_POST['entConst']."'";

			$sql_texto=mysql_query($sele_texto, $link)or die('15. '.mysql_error());

			$num_texto = mysql_num_rows($sql_texto);

			$rows_texto=mysql_fetch_array($sql_texto);

		}

		$texto = utf8_decode(strip_tags(html_entity_decode($rows_texto['Cons_Texto'])));

		$texto = ereg_replace('#ESTUDIANTE#',strtoupper($rows_estudiante['alumno_ape1'].' '.$rows_estudiante['alumno_ape2'].' '.$rows_estudiante['alumno_nom1'].' '.$rows_estudiante['alumno_nom2']), $texto);

		$texto = ereg_replace('#TIPODOCUMENTO#',$rows_estudiante['nombre'], $texto);

		$texto = ereg_replace('#NUMDOCUMENTO#',$rows_estudiante['alumno_num_docu'], $texto);

		

		$texto = ereg_replace('#NUMEROMATRICULA#',$rows_estudiante['matri_id'], $texto);

		$texto = ereg_replace('#FECHAMATRICULA#',$rows_estudiante['matri_fecha'], $texto);

		$texto = ereg_replace('#GRADOESTUDIANTE#',$rows_estudiante['gao_nombre'], $texto);

		$texto = ereg_replace('#JORNADAMATRICULA#',$rows_estudiante['jornada_nombre'], $texto);

		if($rows_estudiante['matri_folio']==0){

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_id'], $texto);

		}else{

			$texto = ereg_replace('#NUMEROFOLIO#',$rows_estudiante['matri_folio'], $texto);

		}

		

		$lugar_expedicion = ucwords_latin1($rows_estudiante['municipio_nombre']) . ' - ' . $rows_estudiante['departamento_nombre'];

		if($rows_estudiante['municipio_nombre'] == '')

		{

			$lugar_expedicion = '(SIN DEFINIR)';

		}

		$texto = ereg_replace('#LUGAREXPEDICION#', $lugar_expedicion , $texto);							

		//$texto = ereg_replace('#PERIODICIDAD#', $periodicidad[$_POST['periodicidad']] , $texto);

		$texto = ereg_replace('#LECTIVO#',$_SESSION['lectivo'], $texto);

		

		$texto = ereg_replace('#INSTITUCION#',$rows_datos_colegio['b'], $texto);

		$texto = ereg_replace('#MUNICIPIO#', ucfirst(strtr(strtolower($rows_datos_colegio['municipio_nombre']), "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ‹⁄","‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘¸˙")), $texto);

		$texto = ereg_replace('#DEPARTAMENTO#', $rows_datos_colegio['nombre'], $texto);

											

		$fecha_genera = "a los " . $nombre_dia[date("j")] . " (".date("d").") dÌas del mes de ".$nombre_mes[date("n")]." de " .$nombre_ano[date("Y")]. " (".date("Y").").";



		$texto = ereg_replace('#FECHA#', $fecha_genera, $texto);

		$texto = ereg_replace('#ENTIDAD#',$rows_ent_nuev['nom_nueva_ent'], $texto);

	}

	

	$carreta = $texto;	

	$carreta_segmentada = explode('#SALTO#',$carreta);

	

	for($i = 0; $i < count($carreta_segmentada); $i++)

	{

		$x=17;

		$y = $pdf->GetY();

		$pdf->SetXY($x,$y);

		$pdf->SetFont('arial','',10);

		$texto = trim($carreta_segmentada[$i]);

		$pdf->MultiCell(182,8,$texto,0,J);

		

		//Salto de linea

		$x=17;

		$y = $pdf->GetY();

		$pdf->SetXY($x,$y);

		$pdf->Cell(182,8,'',0,1,C);

	}

	

	

	//Mostramos las firmas

	//Mostramos las firmas

	$pdf->SetFont('Arial','',12);

	$con_firmas = 0;

	$x = 17;

	$y = $y + 30;



	if($num_quiens_firman)

	{

		$con_firmas = 0;

		$x = 17;

		$y = $pdf->GetY() + 15;

		

		$ancho_firma = 91;

		$x_ancho = 18;

		//Si solo es una firma

		if($num_quiens_firman == 1)		

		{

			$ancho_firma = 182;

			$x_ancho = 65;

		}

		$tot_fir = 0;

		mysql_data_seek($resultado_quienes_firman,0);

		while($quien_firma = mysql_fetch_array($resultado_quienes_firman)){

		

			$tot_fir++;

			if($tot_fir > 1){

				$x_ancho += $ancho_firma;

			}

			//Consultamos la abreviatura del documento

			$sql_cod_documento = "SELECT codigo	FROM tipo_docum WHERE id = '".$quien_firma['tipo_documento']."'";

			$resultado_cod_documento = mysql_query($sql_cod_documento, $link) or die ("No se pudo consultar el tipo de documento");

			$cod_documetno = mysql_fetch_array($resultado_cod_documento);

			//$pdf->Image("images/firma_rector.gif", $x + 60, $y - 21,0, 45);

			

			if($quien_firma['admco_firma'] != '' and $quien_firma['firma_digital'] == 1){				

				$source = $quien_firma['admco_firma'];

				$dest_estu = substr( md5(microtime()), 1, 5); // archivo de destino

				list($width_s, $height_s, $type2, $attr) = getimagesize($source); // obtengo informaciÛn del archivo

				$img = cropImage($width_s, $height_s, $source, 'png', $dest_estu);

		

				//$pdf->Image($img, $x + 35, $y +0,0, 40);

				if($_POST['tipo']==1){
				
								//constancia de Familias en accion
								//Consultamos si se genera con firma 
									$sql_firma = "SELECT conf_valor	FROM conf_sygescol WHERE conf_id = 91";

								$resultado_firma = mysql_query($sql_firma, $link) or die ("No se pudo consultar el tipo de documento");


								while($row_con_firma = mysql_fetch_array($resultado_firma)){

									$valores = explode("," , $row_con_firma['conf_valor']);
							$tiene =0;
									for($i = 0; $i<= count($valores); $i++){
										if($valores[$i] == "6"){
											$vacio="sin firma";
											echo $vacio;
											$tiene++;
										}
									}
								
								}

							if($tiene > 0){
								echo ".";

							}else{
									$pdf->Image($img, $x + 35, $y +0,0, 40);
							}



					}else if ($_POST['tipo']==6) {
					
									//Constancia de Cajas de compensacion  (Constancias confenalco, confatolima etc)
									//Consultamos si se genera con firma
									$sql_firma = "SELECT conf_valor	FROM conf_sygescol WHERE conf_id = 91";

								$resultado_firma = mysql_query($sql_firma, $link) or die ("No se pudo consultar el tipo de documento");


								while($row_con_firma = mysql_fetch_array($resultado_firma)){

									$valores = explode("," , $row_con_firma['conf_valor']);
							$tiene =0;
									for($i = 0; $i<= count($valores); $i++){
										if($valores[$i] == "8"){
											$vacio="sin firma";
											echo $vacio;
											$tiene++;
										}
									}
								
								}

							if($tiene > 0){
								echo ".";

							}else{
								$pdf->Image($img, $x + 35, $y +0,0, 40);
							}



						}

				$img_res[ $quien_firma['id'] ] = $dest_estu;				

			}

			

			$pdf->SetXY($x-17, $y+20);

			$texto = "_________________________";

			$pdf->Cell($ancho_firma, 5, $texto, 0, 0, C);

			$pdf->SetXY($x-17, $y + 25);

			$texto = $quien_firma['nombre'] . '.';

			$pdf->Cell($ancho_firma,5,$texto,0,0,C);

			$pdf->SetXY($x-17, $y + 30);

			$texto = $cod_documetno['codigo']. " ". $quien_firma['documento'];

			$pdf->Cell($ancho_firma,5,$texto,0,0,C);		

			$pdf->SetXY($x-17, $y + 35);

			$texto = ucwords(strtolower($quien_firma['cargo']));

			$pdf->Cell($ancho_firma, 5, $texto,0,0,C);

			$con_firmas++;

			if($con_firmas == 1)

			{

				$x = 108;

				$y = $y;

			}

			else if ($con_firmas == 2)

			{

				break;

			}

		}

	}

	/*$pdf->SetXY($x, $y+15);

	$texto = ucwords(strtolower($quien_firma['cargo']));

	$pdf->Cell(182,5,$texto,0,0,C);*/

	

	//***************************************

	if($row_docu_legal['verificador_barcode'] == 1){

		$sql_direccion_web = "SELECT uu, b FROM clrp";

		$resultado_direccion_web = mysql_query($sql_direccion_web, $link) or die ("No se pudo consultar la direccion web del colegio");

		$direccion_web = mysql_fetch_array($resultado_direccion_web);

		

		$inic = $direccion_web['b'];

		$iniciales = '';

		for($i=0; $i<strlen($inic); $i++){

			if($i==0){

				$iniciales.=$inic[$i];

			}elseif($inic[($i-1)]==' '){

				$iniciales.=$inic[$i];

			}

		}

		$iniciales = strtoupper(ereg_replace("[‰·‡‚„™¡¿¬√ƒÕÃŒœÌÏÓÔÈËÍÎ…» ÀÛÚÙıˆ∫”“‘’÷˙˘˚¸⁄Ÿ€‹^¥`®~Á«Ò—›˝]","",$iniciales));

		

		$sel_year = "SELECT * FROM year";

		$sql_year = mysql_query($sel_year, $link)or die('16. '.mysql_error());

		$rows_year = mysql_fetch_array($sql_year);

		

		$id_flias = 0;

		if($_POST['tipo']==1){

			$_POST['tip_cons']=6;

			$id_flias = $_POST['periodicidad'];

		}elseif($_POST['tipo']==2){

			$_POST['tip_cons']=4;

			$id_flias = 0;

		}else{

			$_POST['tip_cons']=5;

			$id_flias = 0;		

		}

		$ver = 0;

		

		$sel_cod_estu = "SELECT * FROM certificado_codigo WHERE matri_id = '".$_POST['matri_id']."' AND grupo_id = '".$_POST['grupo']."' AND cert_tipo='".$_POST['tip_cons']."' AND id_flias_acc = '".$id_flias."'";

		$sql_cod_estu = mysql_query($sel_cod_estu, $link)or die('17. '.mysql_error());

		$num_cod_estu = mysql_num_rows($sql_cod_estu);

		if($num_cod_estu > 0){

			$rows_cod_estu = mysql_fetch_array($sql_cod_estu);

			$barcode = $rows_cod_estu['cod_barras'];

			$fecha_barcode =  date('d/m/Y', strtotime($rows_cod_estu['fecha_registro']));

		}else{

			while($ver == 0){

				$num_ale = rand(10000000,99999999);

				$sel_cod = "SELECT * FROM certificado_codigo WHERE cod_barras='".$iniciales.$rows_year['b'].$num_ale."'";

				$sql_cod = mysql_query($sel_cod, $link)or die('18. '.mysql_error());

				$num_cod = mysql_num_rows($sql_cod);

				if($num_cod == 0){

					$ver = 1;

					$sel_insert = "INSERT INTO certificado_codigo (cod_barras, matri_id, grupo_id, cert_tipo, id_flias_acc, fecha_registro, hora_registro)

								VALUES ('".$iniciales.$rows_year['b'].$num_ale."', '".$_POST['matri_id']."', '".$_POST['grupo']."', '".$_POST['tip_cons']."', '".$id_flias."', CURDATE(), CURTIME())";

					$sql_insert = mysql_query($sel_insert, $link)or die('19. '.mysql_error());

				}

			}

			$barcode = $iniciales.''.$rows_year['b'].''.$num_ale;

			$fecha_barcode = date('d/m/Y');

		}

		

		$ruta = "images/CodigosDeBarras/$barcode.jpg";
			QRcode :: png ('http://www.ietsagradafamilia.edu.co/sygescol2022/verificacion_certificado.php?cod_ver='.$barcode, $ruta);				

		
			$image = imagecreatefrompng($ruta); 

			$bg = imagecreatetruecolor(imagesx($image), imagesy($image)); 
	
			imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255)); 
			imagealphablending($bg, TRUE); 
			imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image)); 
			imagedestroy($image);
			$quality = 50; // 0 = worst / smaller file, 100 = better / bigger file 
			imagejpeg($bg,$ruta, $quality); 
			ImageDestroy($bg);

			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFillColor('0', '0', '0');

			$pdf->SetFont('Arial','',9);

			if(file_exists("images/CodigosDeBarras/".$barcode.".jpg")){
			$pdf->Image("images/CodigosDeBarras/".$barcode.".jpg", 140, $y-50,0, 35);
		    }


		$pdf->SetXY(140, $y-15);

		    $sel_cod_estu = "SELECT * FROM certificado_codigo WHERE matri_id = '".$_POST['matri_id']."' AND grupo_id = '".$_POST['grupo']."' AND cert_tipo='".$_POST['tip_cons']."' AND id_flias_acc = '".$id_flias."'";
		    $sql_cod_estu = mysql_query($sel_cod_estu, $link)or die(mysql_error());
		    $num_cod_estu = mysql_num_rows($sql_cod_estu);
		    if($num_cod_estu > 0){
			$rows_cod_estu = mysql_fetch_array($sql_cod_estu);
			$barcode = $rows_cod_estu['cod_barras'];
			$fecha_barcode =  date('d/m/Y', strtotime($rows_cod_estu['fecha_registro']));
		    }

		$pdf->Cell(38,5,$barcode.'  '.$fecha_barcode,0,1,C);

		$y = $pdf->GetY();

		$pdf->SetXY(130, $y - 1);

		$pdf->SetFont('Arial','',6);

		//$pdf->Cell(38,5,'CÛdigo de AutenticaciÛn de veracidad',0,0,C);

		//$texto = 'Por favor verifique la autenticidad de este documento utilizando el verificador del cÛdigo de barras, en Èl incluido ('.$barcode.'). Este verificador exime de responsabilidad a quien firma el documento. ';

		//$texto = 'Por favor verifique la autenticidad de este documento utilizando el verificador del cÛdigo de barras, en Èl incluido ('.$barcode.'). Este verificador exime ante cualquier proceso fraudulento a que sea expuesta la informaciÛn en Èl incluida. ';

		$sel_verificador = "SELECT * FROM conf_sygescol WHERE conf_nombre = 'verificador_barras'";

		$sql_verificador = mysql_query($sel_verificador, $link)or die("No se pudo consultar Verificador");

		$row_verificador = mysql_fetch_array($sql_verificador);

		

		//$pdf->Cell(38,5,'CÛdigo de AutenticaciÛn de veracidad',0,0,C);

		$texto = $row_verificador ['conf_valor'];

		$texto = str_replace("#CODIGO#", $barcode, $texto);

		$texto = str_replace("#WEB#", $direccion_web['uu'], $texto);

		

		$pdf->MultiCell(58,3,$texto,0,J);

		$pdf->SetFont('Arial','',8);

	}

}





function fila_vacia($pdf, $alto_celda)

{

	$y = $pdf->GetY();

	$pdf->SetXY($x, $y);

	$ancho_celda = 80;

	$texto = '';

	$pdf->Cell($ancho_celda,$alto_celda,$texto,0,0,C);

	

	if($hoja_actual != $pdf->hoja_num)	

	{

		$hoja_actual = $pdf->hoja_num;

		cabecera_tabla($pdf);

	}

}



//Parametros de configuraciÛn seg˙n el tamaÒo de papel (Letter y Legal) que se elija

$_GET['tipo'] = 'Letter';

if($_GET['tipo'] == 'Letter')

{

	$long_max = 250;

	$ancho_max = 192;

	$tipo = $_GET['tipo'];

}

else

{

	$long_max = 295;

	$ancho_max = 187;

	$tipo = 'Legal';

}

if((isset($_POST['accion']) && $_POST['matri_id'] != '') || (isset($_POST['accion2']) && $_POST['matri_id'] != '') || (isset($_POST['accion3']) && $_POST['matri_id'] != ''))

{	

	$grupo = $_POST['grupo'];

	if(isset($_POST['accion2']))

	{

		$_POST['accion'] = $_POST['accion2'] || $_POST['accion3'];

		$_POST['texto'] = $_POST['carreta'];

	}

	

	

	//Consultamos el aÒo del sistema

	

	$sql_ano_sistema= "SELECT b FROM year";

	$resultado_ano_sistema = mysql_query($sql_ano_sistema, $link) or die ("No se pudo consultar el aÒo del sistema");

	$ano_sistema = mysql_fetch_array($resultado_ano_sistema);

	

	$sel_docu_legal = "SELECT docu_legal_id, docu_legal_nombre, verificador_barcode FROM documentos_legales WHERE docu_legal_id = '5'";

	$sql_docu_legal = mysql_query($sel_docu_legal, $link) or die ("No se pudo consultar el documento legal");

	$row_docu_legal = mysql_fetch_array($sql_docu_legal);

	

	if($_POST['accion'] == 'I')

	{

		//Consultamos en que consecutivo vamos

		$sql_num_constancia = "SELECT docu_conse_id, docu_conse_num FROM documento_consecutivo WHERE docu_legal_id = 5 AND docu_conse_ano = " . $ano_sistema['b'];

		$resultado_num_constancia = mysql_query($sql_num_constancia, $link) or die ("No se pudo consultar el numero de constancia " . $sql_num_constancia);

		$num_constancia = mysql_fetch_array($resultado_num_constancia);

		$num_registros_constancia = mysql_num_rows($resultado_num_constancia);

		

		if($num_registros_constancia == 0)

		{

			$registro_num_constancia = "INSERT INTO documento_consecutivo (docu_legal_id, docu_conse_num, docu_conse_ano, docu_conse_estado) 

			VALUES (5, '0000', ".$ano_sistema['b'].", 0)";

			$resultado_registro_num_constancia = mysql_query($registro_num_constancia, $link) or die ("No se pudo registra el numero del consecutivo");

			

			$num_constancia['docu_conse_num'] = '0000';

		}

		

		$constancia_numero = $num_constancia['docu_conse_num'] + 1;

		for($i = strlen($constancia_numero); $i <= 3; $i++)

		{

			$constancia_numero = '0'.$constancia_numero;

		} 

		

		//Actualizo el numero de certificado que se han generado

		$sql_update_num_constancia = "UPDATE documento_consecutivo SET docu_conse_num = '".$constancia_numero."' WHERE docu_legal_id = 5 AND docu_conse_ano = " . $ano_sistema['b'];

		$resultado_update_num_constancia = mysql_query($sql_update_num_constancia, $link) or die ("No se pudo actualizar el numero de la constancia generada");

	}

	

	//________________N U M E R O   C O N S E C U T I V O___________________________

	if($_POST['accion3'] == 'I'){

		$sql_num_certificado = "SELECT docu_conse_id, docu_conse_num FROM documento_consecutivo WHERE docu_legal_id = 5";

		$resultado_num_certificado = mysql_query($sql_num_certificado, $link) or die ("No se pudo consultar el numero de la Constancia de Retiirados ");

		$num_certificado = mysql_fetch_array($resultado_num_certificado);

		$num_registros_certificado = mysql_num_rows($resultado_num_certificado);

		

		if($num_registros_certificado == 0)

		{

			$registro_num_certificado = "INSERT INTO documento_consecutivo (docu_legal_id, docu_conse_num) 

							 VALUES ('5', '$_POST[num_conse]')";

			$resultado_registro_num_certificado = mysql_query($registro_num_certificado, $link) or die ("No se pudo registra el numero del consecutivo");

			$id_consec = mysql_insert_id($link);

				

			$num_certificado['docu_conse_num'] = 0;

		}

		

		$certificado_numero = $num_certificado['docu_conse_num'] + 1;

		for($i = strlen($certificado_numero); $i <= 3; $i++)

		{

			$certificado_numero = '0'.$certificado_numero;

		} 

		

		$sql_update_num_certificado = "UPDATE documento_consecutivo SET docu_conse_num = '".$certificado_numero."' WHERE docu_legal_id = 5";

		$resultado_update_num_certificado = mysql_query($sql_update_num_certificado, $link) or die ("No se pudo actualizar el numero del certificado generado");

	}

	//**********************************************************************

		//Consultamos quienes pueden firmar este documento

		if($_POST['tipo']==1){
		$sql_quienes_firman = "SELECT nombre, documento, tipo_documento, cargo, genero, admco_firma, firmas_autorizadas.firma_digital

		FROM admco, firmas_autorizadas

		WHERE admco.id = fir_aut_tabla_id AND fir_aut_documento = 13";
	    }else{
	   	$sql_quienes_firman = "SELECT nombre, documento, tipo_documento, cargo, genero, admco_firma, firmas_autorizadas.firma_digital

		FROM admco, firmas_autorizadas

		WHERE admco.id = fir_aut_tabla_id AND fir_aut_documento = 14";
	    }

		$resultado_quienes_firman = mysql_query($sql_quienes_firman, $link) or die ("No se pudo consultar las personas que firman el documento");

		$num_quiens_firman = mysql_num_rows($resultado_quienes_firman);

		$quien_certifica = mysql_fetch_array($resultado_quienes_firman);

		

		

		$rector = "SELECT admco.* FROM admco INNER JOIN usuario ON(admco.id = usuario.usu_fk) WHERE usu_rol=5";

		$resul_rector = mysql_query($rector, $link) or die ("Error1");

		$row_rector = mysql_fetch_assoc($resul_rector);



		//Consultamos la info del colegio

		$sql_datos_colegio = "SELECT clrp.a AS escudo, clrp.b AS nombre, clrp.g AS direccion,

			municipio.municipio_nombre, dpto.nombre AS departamento_nombre, 

			clrp.e AS telefono1, clrp.n AS telefono2, clrp.fx AS fax,

			clrp.c AS resolucion, clrp.tt AS dane, clrp.nn AS icfes

			FROM clrp LEFT JOIN municipio ON (clrp.u = municipio.municipio_id) 

			LEFT JOIN dpto ON (municipio.departamento_id = dpto.id)";

		$resultado_datos_colegio = mysql_query($sql_datos_colegio, $link) or die('1. '.mysql_error());

		$datos_colegio = mysql_fetch_assoc($resultado_datos_colegio);



	

    

	

	

		$pdf=new DPDF('P','mm',$tipo);

		$file=basename(tempnam(getcwd(),'tmp'));

		$pdf->Open($file);

		$pdf->SetDatosHeader($datos_colegio, $long_max,$ancho_max , "");

		$pdf->extgstates = array();

		$pdf->SetAutoPageBreak(true, $salto_hoja);

		$pdf->SetMargins(1.5, 1);

		

		$pdf->AddPage();

		if($_POST['tipo']==1){

			$titulo='CONSTANCIAS FAMILIAS EN ACCI”N';

		}else{

			$titulo='CONSTANCIA DE ESTUDIO ';

		}

		

		if($_POST['accion3'] == 'I')

		{

			//Mostramos el numero del certificado

			//Titulo del documento

			$texto1 = "CONSTANCIA N∫ " . $certificado_numero . " DE " . $ano_sistema['b'];

			$y = $pdf->GetY();

			$pdf->SetXY(17, $y + 2);

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(182,10,$texto1,0,0,R);

		}

		

		if($constancia_numero != '')

		{

			//Mostramos el numero del certificado

			//Titulo del documento

			$texto1 = "CONSTANCIA N∫ " . $constancia_numero . " DE " . $ano_sistema['b'];

			$y = $pdf->GetY();

			$pdf->SetXY(17, $y + 2);

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(182,10,$texto1,0,0,R);

		}

		//Quien certifica

		

		if($row_rector['genero'] == 'F')

		{

			$texto2 = "LA SUSCRITA RECTORA";

		}

		else if($row_rector['genero'] == 'M')

		{

			$texto2 = "EL SUSCRITO RECTOR";

		}

		

		

		$y = $pdf->GetY();

		$pdf->SetXY(17, $y + 7);

		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(182,10,$texto2,0,0,C);

		

		//Titulo del documento

		$texto = "H A C E   C O N S T A R";

		$y = $pdf->GetY();

		$pdf->SetXY(17, $y + 11);

		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(182,10,$texto,0,1,C);

		

		$x=17;

		$y = $pdf->GetY() + 14;

		$pdf->SetXY($x,$y);

		

		contenido();

		

		//Creamos el pdf

		$pdf->extgstates = array();

	    $pdf->SetAutoPageBreak(true, 16);

	    $pdf->SetMargins(1.5, 1);

	

		$pdf->Output($file);

		echo "<HTML><SCRIPT>document.location='getpdf.php?f=$file';</SCRIPT></HTML>";

		eliminarDir('images/tempfirmas');

}	





?>