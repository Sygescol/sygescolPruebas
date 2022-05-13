<?php
//Archivo con los datos para la conexion
$roles_con_permiso = array('99', '6', '1', '2', '5', '8', '13', '3');
include_once("inc.configuracion.php");
include_once("inc.validasesion.php");
include_once("inc.funciones.php");
include_once("conexion.php");
include_once("includes/clases/Periodo.php");
include_once("includes/clases/Asignatura_Nota_1.php");
include_once("includes/clases/Area_Nota_1.php");
require_once('includes/clases/Sygescol_Varios.php');
require_once('includes/clases/Escala_Valorativa.php');
$link=conectarse();
mysql_select_db($database_sygescol,$link);
include("includes/Funcion_Notas/Notas_Por_Area.php");
include("includes/Funcion_Notas/Notas_Por_Asignatura.php");

require('includes/fpdf153/fpdf2file.php');

//Datos del colegio
$colp = mysql_query("select * from clrp LEFT JOIN municipio ON (clrp.u = municipio.municipio_id) LEFT JOIN dpto ON (municipio.departamento_id = dpto.id)",$link);
$fcolp = mysql_fetch_array($colp);

$estudiante = strtr(strtoupper($rows_estudiante['nombre']), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ") ;

	$documento = $rows_estudiante['alumno_num_docu'];

	$municipio = ucfirst(strtr(strtolower($rows_estudiante['municipio_nombre']), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ","àáâãäåæçèéêëìíîïðñòóôõöøùüú"));

	$dpto = $rows_estudiante['nombre_dpt'];

	$grado = $rows_grado['gao_nombre'];

	$anio_matricula = $rows_estudiante['matri_anyo'] ;

	$jornada = $rows_grado['jornada_nombre'];

	$sede = $rows_grado['ssede_nombre'];

	$folio = $rows_estudiante['matri_folio'];

	$dada_en = ucfirst(strtr(strtolower($fcolp['municipio_nombre']), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ","àáâãäåæçèéêëìíîïðñòóôõöøùüú"));

	$dada_en_nombre = $fcolp['nombre'];

	$lugar_expedicion = ucfirst(strtr(strtolower($rows_estudiante['municipio_nombre']), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ","àáâãäåæçèéêëìíîïðñòóôõöøùüú"));

	$num_matricula = $rows_estudiante['alumno_id'];

	$fecha_matri = $rows_estudiante['matri_fecha'];

	$anio_matri = $rows_estudiante['matri_anyo'];

	$dpto_dada = $fcolp['nombre'];

class PDF extends FPDF
{
	var $long_max = 315;
	//Cabecera de página
	function Header()
	{
		global $fcolp;
		global $datos_estudiantes;
		global $grado_grupo;
		global $datos_acta;
		$this->SetAuthor("Sistemas IVHORSNET");
		$this->Image("Marca_de_agua.jpg",4,4);
		
		//Definimos la fuente con la que vamos a trabajar
		$this->SetFont('Arial','B',12);
		
		//Definimos las margenes
		//$this->SetMargins(15, 10);
		
		
		
		/*//Dibujar margen
		$this->SetXY(17, 12);
		$this->Cell(182,236,'',1);*/
		
		//Dibujar cuadro del encabezado
		/*$this->SetXY(17, 12);
		$this->Cell(182,27,'',1);*/
		
		
		
		//Mostramos el nombre de la Institucion
		$this->SetFont('Arial','B',18);
		$this->SetXY(33, 9);
		$this->Cell(155,20,strtoupper($fcolp[1]),0,0,C);
		
		//Mostramos la dirección de la Institucion
		$this->SetFont('Arial','B',10);
		$this->SetXY(35, 19);
		$dir = $fcolp[3] . " - " . $fcolp[4] . ", " . $fcolp[20];
		$this->Cell(155,15,$dir,0,0,C);
		
		//Mostramos los telefonos y el fax de la Institucion
		$this->SetXY(35, 24);
		$tel = "Teléfonos: " . $fcolp[5] . " - " . $fcolp[6] . ", " . "Fax: " . $fcolp[21];
		$this->Cell(155,18,$tel,0,0,C);
		
		//Mostramos resolucion, dane e icfes
		$this->SetXY(35, 29);
		$res = "RES: " . $fcolp[14] . "        DANE:" . $fcolp[12] . "        ICFES:" . "" . $fcolp[11];
		$this->Cell(155,23,$res,0,0,C);
		
		//Mostramos el titulo del documento
		$this->SetFont('Arial','B',14);
		$this->SetXY(17, 44);
		
		$texto = "ACTA INDIVIDUAL DE GRADUACIÓN";
		$this->Cell(182,26,$texto,0,0,C);
		
		
		
		$y = $this->GetY() - 40;
		$this->SetY($y);
	}

	//Pie de página
	function Footer()
	{
		/*//Posición: a 1,5 cm del final
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');*/
	}
}

//-------------------------Determinar Si gano o perdio el Año-------------------//

function promocion($matri_id, $link, $db)
{
	mysql_select_db($db, $link);


$obj_escala_valorativa = new Escala_Valorativa($db, $link, $_SESSION['sis_cal_dec'], $_SESSION['sis_cal_cal']);
$escala_valorativa = new Escala_Valorativa($db, $link, $_SESSION['sis_cal_dec'], $_SESSION['sis_cal_cal']);

$query_periodos = "
SELECT 	* 
FROM 	periodo_fechas INNER JOIN v_grupos ON (periodo_fechas.per_con_id = v_grupos.per_con_id)
WHERE 	v_grupos.grupo_id = '".$_POST['grupo']."'
ORDER BY per_numero DESC
LIMIT 0 , 1";
$resultperiodos=mysql_query($query_periodos,$link);
$rowperiodos=mysql_fetch_array($resultperiodos);
$periodoconsulta=$rowperiodos['per_id'];
	
	$query_areas = "SELECT DISTINCT aes.i as aes_id, aes.b as aes_nombre, aes.a as aes_abreviatura
					FROM aes INNER JOIN efr ON (aes.i = efr.a) INNER JOIN aintrs ON (efr.i = aintrs.g) INNER JOIN cga ON (aintrs.i = cga.a) 
					INNER JOIN cg ON (cga.b = cg.i) 
					WHERE cg.b = '".$_POST['grupo']."' ORDER BY aes.g ";
	$areas = mysql_query($query_areas, $link) or die(mysql_error());

	$are_perdidas = 0;
	$bandera = 0;
	$recuperaciones_pendientes = 0;
	
	while($row_asignaturas_grupo = mysql_fetch_assoc($areas))
	{
		$areas_no=areas_mos($_POST['grupo'], $periodoconsulta, $row_asignaturas_grupo['aes_id'], '', $matri_id, $link);
						
		$nota_area_estudiante = $escala_valorativa->get_val_ajustado($areas_no);
		$datos_escala = $escala_valorativa->get_datos_escala('', '', $nota_area_estudiante);
		$esca_nac_id = $datos_escala['esca_nac_id']; 
		//$asig=asig_mos($_POST['grupo_id'], $periodoconsulta, $row_datos_asignaturaa['id_Are'], $cga_id, $matri_id, $link);
		if($esca_nac_id==4){
			$query_asignaturas = "SELECT DISTINCT aintrs.i as asignatura_id, aintrs.b as asignatura_nombre, cga.i as cga_id, cga.u as cga_horas
			FROM aes INNER JOIN efr ON (aes.i = efr.a) INNER JOIN aintrs ON (efr.i = aintrs.g) INNER JOIN cga ON (aintrs.i = cga.a) 
			INNER JOIN cg ON (cga.b = cg.i) 
			WHERE cg.b = $_POST[grupo]
			AND aes.i = $row_asignaturas_grupo[aes_id]
			ORDER BY aes.g";
			$resultado_asignaturas = mysql_query($query_asignaturas, $link) or die(mysql_error() . ' ' . $query_asignaturas);
			$num_rows_asignaturas = mysql_num_rows($resultado_asignaturas);
			$nota=array();
			$asig=0;
			while($row_asignatura = mysql_fetch_assoc($resultado_asignaturas))
			{
			
			$asig=asig_mos($_POST[grupo], $periodoconsulta, $row_asignaturas_grupo[aes_id], $row_asignatura['cga_id'], $matri_id, $link);
			$nota_asigna_estudiante = $escala_valorativa->get_val_ajustado($asig);
			$datos_escala_asig = $escala_valorativa->get_datos_escala('', '', $nota_asigna_estudiante);
			$esca_nac_letra_asigna = $datos_escala_asig['esca_nac_letra'];
			$esca_nac_id= $datos_escala_asig['esca_nac_id'];
			
				if($esca_nac_id==4){
						$sqlrecup1 = "
							SELECT 	nota_nueva_asig ,nota_perdio_asig, nota_recup_asig, recuperacion_fecha, recuperacion_hora
							FROM 	recuperacionessemestre 
							WHERE 	grado_grupo_id='".$_POST[grupo]."' AND cga_id = '".$row_asignatura['cga_id']."' AND 
									matri_id = '".$matri_id."' AND semestre = '98'";	
						$result1=mysql_query($sqlrecup1,$link);
						$rowrecup1=mysql_fetch_assoc($result1);
						$cantrecup1=mysql_num_rows($result1);
						if($cantrecup1!=0){
							$nota_asigna_niv1 = $escala_valorativa->get_val_ajustado($rowrecup1['nota_nueva_asig']);
							$datos_escala_niv1 = $escala_valorativa->get_datos_escala('', '', $nota_asigna_niv1);
							$esca_nac_letra_ni1 = $datos_escala_niv1['esca_nac_letra'];
							$esca_nac_id_niv1= $datos_escala_niv1['esca_nac_id'];
						}
						
						if($esca_nac_id_niv1==4){
							$sqlrecup2 = "
							SELECT 	nota_nueva_asig ,nota_perdio_asig, nota_recup_asig, recuperacion_fecha, recuperacion_hora
							FROM 	recuperacionessemestre 
							WHERE 	grado_grupo_id='".$_POST[grupo]."' AND cga_id = '".$row_asignatura['cga_id']."' AND 
									matri_id = '".$matri_id."' AND semestre = '99'	";	
							$result2=mysql_query($sqlrecup2,$link);
							$rowrecup2=mysql_fetch_array($result2);
							$cantrecup2=mysql_num_rows($result2);
							if($cantrecup2!=0){
								$nota_asigna_niv2 = $escala_valorativa->get_val_ajustado($rowrecup2['nota_nueva_asig']);
								$datos_escala_niv2 = $escala_valorativa->get_datos_escala('', '', $nota_asigna_niv1);
								$esca_nac_letra_ni2 = $datos_escala_niv1['esca_nac_letra'];
								$esca_nac_id_niv2= $datos_escala_niv1['esca_nac_id'];
							}
							if($esca_nac_id_niv2==4){
								$are_perdidas++;
							}elseif($cantrecup2==0){
								if($cantrecup1==0){
									$are_perdidas++;
									$nose_presento++;
								}else{
									$are_perdidas++;
								}
							}else{
							
							}
						}elseif($cantrecup1==0){
							$sqlrecup2 = "
							SELECT 	nota_nueva_asig ,nota_perdio_asig, nota_recup_asig, recuperacion_fecha, recuperacion_hora
							FROM 	recuperacionessemestre 
							WHERE 	grado_grupo_id='".$_POST[grupo]."' AND cga_id = '".$row_asignatura['cga_id']."' AND 
									matri_id = '".$matri_id."' AND semestre = '99'	";	
							$result2=mysql_query($sqlrecup2,$link);
							$rowrecup2=mysql_fetch_array($result2);
							$cantrecup2=mysql_num_rows($result2);
							if($cantrecup2!=0){
								$nota_asigna_niv1 = $escala_valorativa->get_val_ajustado($rowrecup2['nota_nueva_asig']);
								$datos_escala_niv1 = $escala_valorativa->get_datos_escala('', '', $nota_asigna_niv1);
								$esca_nac_letra_ni1 = $datos_escala_niv1['esca_nac_letra'];
								$esca_nac_id_niv1= $datos_escala_niv1['esca_nac_id'];
							}
							if($esca_nac_id_niv1==4){
								$are_perdidas++;
							}elseif($cantrecup2==0){
									$are_perdidas++;
									$nose_presento++;
							}else{
							
							}
						}else{
						
						}
				}
			}// Asignaturas
							
		}else{
			$query_asignaturas = "SELECT DISTINCT aintrs.i as asignatura_id, aintrs.b as asignatura_nombre, cga.i as cga_id, cga.u as cga_horas
			FROM aes INNER JOIN efr ON (aes.i = efr.a) INNER JOIN aintrs ON (efr.i = aintrs.g) INNER JOIN cga ON (aintrs.i = cga.a) 
			INNER JOIN cg ON (cga.b = cg.i) 
			WHERE cg.b = $_POST[grupo]
			AND aes.i = $row_asignaturas_grupo[aes_id]
			ORDER BY aes.g";
	
			$resultado_asignaturas = mysql_query($query_asignaturas, $link) or die(mysql_error() . ' ' . $query_asignaturas);
			$num_rows_asignaturas = mysql_num_rows($resultado_asignaturas);
			$hor_ina=0;
			$int_hor=0;
			$inasistencia=0;
			$tot_inasis=0;
			while($row_asignatura = mysql_fetch_assoc($resultado_asignaturas))
			{

				$query_periodos2 = "
				SELECT 	* 
				FROM 	periodo_fechas INNER JOIN v_grupos ON (periodo_fechas.per_con_id = v_grupos.per_con_id)
				WHERE 	v_grupos.grupo_id = '".$_POST['grupo']."'";
				$resultperiodos2=mysql_query($query_periodos2,$link);
				
				$query_criterios_promocion1 = "SELECT criterios_promocion.cri_prom_id, criterios_promocion.cri_prom_texto, criterios_promocion.cri_prom_valor, cri_prom_estado FROM criterios_promocion where criterios_promocion.cri_prom_id=8 ORDER BY cri_prom_orden";
				$criterios_promocion1 = mysql_query($query_criterios_promocion1, $link) or die(mysql_error());
				$row_criterios_promocion1 = mysql_fetch_assoc($criterios_promocion1);
				$totalRows_criterios_promocion1 = mysql_num_rows($criterios_promocion1);
				$int_hor+=$row_asignatura['cga_horas'];
				while($rowperiodos2=mysql_fetch_array($resultperiodos2)){
						
						
					$query_inasistencias = "SELECT ina_tipo
					FROM inasistencia 
					WHERE matri_id = ".$matri_id." AND cga_id = ".$row_asignatura['cga_id']." AND per_id = ".$rowperiodos2['per_id']." AND ina_tipo = 'I'";
					$datos_inasistencias = mysql_query($query_inasistencias, $link) or die(mysql_error());
					$num_rows_inasistencias = mysql_num_rows($datos_inasistencias);
						
					if($num_rows_inasistencias>0){	
						$hor_ina+=$num_rows_inasistencias;
					}
				}				
			}//---
			
			if($int_hor!=0){
				$tot_ina=$int_hor*40;
				$por1=$row_criterios_promocion1['cri_prom_valor']/100;
				$tot_ina=$tot_ina*$por1;
				
				$tot_inasis=($hor_ina*100)/$tot_ina;
		
				if($tot_inasis>=100){
					$query_asignaturas = "SELECT DISTINCT aintrs.i as asignatura_id, aintrs.b as asignatura_nombre, cga.i as cga_id, cga.u as cga_horas
					FROM aes INNER JOIN efr ON (aes.i = efr.a) INNER JOIN aintrs ON (efr.i = aintrs.g) INNER JOIN cga ON (aintrs.i = cga.a) 
					INNER JOIN cg ON (cga.b = cg.i) 
					WHERE cg.b = $_POST[grupo]
					AND aes.i = $row_asignaturas_grupo[aes_id]
					ORDER BY aes.g";
					$resultado_asignaturas = mysql_query($query_asignaturas, $link) or die(mysql_error() . ' ' . $query_asignaturas);
					$num_rows_asignaturas = mysql_num_rows($resultado_asignaturas);
					while($row_asignatura = mysql_fetch_assoc($resultado_asignaturas))
					{
						$sqlrecup1 = "
							SELECT 	nota_nueva_asig ,nota_perdio_asig, nota_recup_asig, recuperacion_fecha, recuperacion_hora
							FROM 	recuperacionessemestre 
							WHERE 	grado_grupo_id='".$_POST[grupo]."' AND cga_id = '".$row_asignatura['cga_id']."' AND 
									matri_id = '".$matri_id."' AND semestre = '98'";	
						$result1=mysql_query($sqlrecup1,$link);
						$rowrecup1=mysql_fetch_array($result1);
						$cantrecup1=mysql_num_rows($result1);
						
						$nota_asigna_niv1 = $escala_valorativa->get_val_ajustado($rowrecup1['nota_nueva_asig']);
						$datos_escala_niv1 = $escala_valorativa->get_datos_escala('', '', $nota_asigna_niv1);
						$esca_nac_letra_ni1 = $datos_escala_niv1['esca_nac_letra'];
						$esca_nac_id_niv1= $datos_escala_niv1['esca_nac_id'];
						
						if($esca_nac_id_niv1==4){
							$sqlrecup2 = "
							SELECT 	nota_nueva_asig ,nota_perdio_asig, nota_recup_asig, recuperacion_fecha, recuperacion_hora
							FROM 	recuperacionessemestre 
							WHERE 	grado_grupo_id='".$_POST[grupo]."' AND cga_id = '".$row_asignatura['cga_id']."' AND 
									matri_id = '".$matri_id."' AND semestre = '99'	";	
							$result2=mysql_query($sqlrecup2,$link);
							$rowrecup2=mysql_fetch_array($result2);
							$cantrecup2=mysql_num_rows($result2);
							
							$nota_asigna_niv1 = $escala_valorativa->get_val_ajustado($rowrecup2['nota_nueva_asig']);
							$datos_escala_niv1 = $escala_valorativa->get_datos_escala('', '', $nota_asigna_niv1);
							$esca_nac_letra_ni1 = $datos_escala_niv1['esca_nac_letra'];
							$esca_nac_id_niv1= $datos_escala_niv1['esca_nac_id'];
							if($esca_nac_id_niv1==4){
								$are_perdidas++;
							}elseif($cantrecup2==0){
								$are_perdidas++;
							}else{
							
							}
						}elseif($cantrecup1==0){
							$are_perdidas++;
						}else{
						
						}
					//$are_perdidas+=1;							
				}
			}
		
		}//---- Si perdio Por desp BJ o por Inasistencia		
		
	}//-----Cierre areas
	
	$rows_niv['conf_valor']=$_SESSION['sis_cal_niv_num'];
	
	$obs_asign=$are_perdidas;
	
	$consulta="SELECT * 
			FROM periodo_fechas
			INNER JOIN v_grupos ON ( periodo_fechas.per_con_id = v_grupos.per_con_id ) 
			WHERE v_grupos.grupo_id = '$_POST[grupo]'
			ORDER BY per_numero ASC";
	$sql_periodo=mysql_query($consulta, $link);
	$rows_periodo=mysql_fetch_array($sql_periodo);
	$num_periodo=mysql_num_rows($sql_periodo);
	
	
	$consulta2="SELECT * 
			FROM periodo_recu_finaño
			WHERE rec_con_id='".$rows_periodo[per_con_id]."' AND CURDATE()>=rec_fin AND rec_numero=98";
	$sql_rec_fin=mysql_query($consulta2, $link);
	$rows_rec=mysql_fetch_array($sql_rec_fin);
	$num_rows_rec1=mysql_num_rows($sql_rec_fin);
	$fecha=date('Y-m-d');
	
	$rec1=0;
	$rec2=0;
	
	
	if($num_rows_rec1>0){
		$rec1=1;
	}
	
	$consulta2="SELECT * 
			FROM periodo_recu_finaño
			WHERE rec_con_id='".$rows_periodo[per_con_id]."' AND CURDATE()>=rec_fin AND rec_numero=99";
	$sql_rec_fin=mysql_query($consulta2, $link);
	$rows_rec=mysql_fetch_array($sql_rec_fin);
	$num_rows_rec2=mysql_num_rows($sql_rec_fin);
	
	if($num_rows_rec2>0){
		$rec2=1;		
	}
	
	
	if($_SESSION['sis_cal_niv_num']==1){
				
		if($obs_asign==1){
			$consulta_criterio22="SELECT * FROM criterios_promocion WHERE cri_prom_id=22";
			$resul_criterio22=mysql_query($consulta_criterio22, $link);
			$rows_criterio22=mysql_fetch_array($resul_criterio22);
				if($rows_criterio22['cri_prom_valor']==0){
					$estado=0;
				}else{
					if($rec1==1){
						$estado=1;
					}else{
						$estado=2;
					}
				}
				if($nose_presento==1){
					
					$consulta_criterio23="SELECT * FROM criterios_promocion WHERE cri_prom_id=23";
					$resul_criterio23=mysql_query($consulta_criterio23, $link);
					$rows_criterio23=mysql_fetch_array($resul_criterio23);
					if($rows_criterio23['cri_prom_valor']==0){
						$estado=0;
					}else{
						if($rec1==1){
							$estado=1;	
						}else{
							$estado=2;	
						}
					}
					
				}
			
		}elseif($obs_asign==2){
			
				$consulta_criterio25="SELECT * FROM criterios_promocion WHERE cri_prom_id=25";
				$resul_criterio25=mysql_query($consulta_criterio25, $link);
				$rows_criterio25=mysql_fetch_array($resul_criterio25);
				if($rows_criterio25['cri_prom_valor']==0){
					$estado=0;
				}else{
					if($rec1==1){
						$estado=1;
					}else{
						$estado=2;
					}
				}
				
				if($nose_presento==2){
				
					$consulta_criterio26="SELECT * FROM criterios_promocion WHERE cri_prom_id=26";
					$resul_criterio26=mysql_query($consulta_criterio26, $link);
					$rows_criterio26=mysql_fetch_array($resul_criterio26);
					if($rows_criterio26['cri_prom_valor']==0){
						$estado=0;
					}else{
						if($rec1==1){
							$estado=1;
						}else{
							$estado=2;
						}
					}
				}
		}elseif($obs_asign>=3){
			$estado=1;
		}elseif($obs_asign==0){
			$estado=0;
		}
	}elseif($_SESSION['sis_cal_niv_num']==2){
		if($obs_asign==1){
			
				$consulta_criterio28="SELECT * FROM criterios_promocion WHERE cri_prom_id=28";
				$resul_criterio28=mysql_query($consulta_criterio28, $link);
				$rows_criterio28=mysql_fetch_array($resul_criterio28);
				if($rows_criterio28['cri_prom_valor']==0){
					$estado=0;
				}else{
					if($rec2==1){
						$estado=1;
					}else{
						$estado=2;
					}
				}
				
				if($nose_presento==1){
					$consulta_criterio30="SELECT * FROM criterios_promocion WHERE cri_prom_id=30";
					$resul_criterio30=mysql_query($consulta_criterio30, $link);
					$rows_criterio30=mysql_fetch_array($resul_criterio30);
					if($rows_criterio30['cri_prom_valor']==0){
						$estado=0;
					}else{
						if($rec2==1){
							$estado=1;
						}else{
							$estado=2;
						}
					}
				}
				
				if($criterio29==1){
					$consulta_criterio29="SELECT * FROM criterios_promocion WHERE cri_prom_id=29";
					$resul_criterio29=mysql_query($consulta_criterio29, $link);
					$rows_criterio29=mysql_fetch_array($resul_criterio29);
					if($rows_criterio29['cri_prom_valor']==1){
						$estado=0;
					}elseif($rows_criterio29['cri_prom_valor']==2){
						if($rec2==1){
							$estado=1;
						}else{
							$estado=2;
						}
					}
				}
				
				if(count($array_perdidas)==2){
					$consulta_criterio37="SELECT * FROM criterios_promocion WHERE cri_prom_id=37";
					$resul_criterio37=mysql_query($consulta_criterio37, $link);
					$rows_criterio37=mysql_fetch_array($resul_criterio37);
					if($rows_criterio37['cri_prom_valor']==0){
						$estado=0;
					}else{
						if($rec2==1){
							$estado=1;
						}else{
							$estado=2;
						}
					}
				}	
		}elseif($obs_asign==2){
			
				$consulta_criterio36="SELECT * FROM criterios_promocion WHERE cri_prom_id=36";
				$resul_criterio36=mysql_query($consulta_criterio36, $link);
				$rows_criterio36=mysql_fetch_array($resul_criterio36);
				
				if($rows_criterio36['cri_prom_valor']==0){
					
					$estado=0;
				}else{
					if($rec2==1){
						$estado=1;
					}else{
						$estado=2;
					}
				} 
				if($nose_presento==2){
					$consulta_criterio38="SELECT * FROM criterios_promocion WHERE cri_prom_id=38";
					$resul_criterio38=mysql_query($consulta_criterio38, $link);
					$rows_criterio38=mysql_fetch_array($resul_criterio38);
					
					if($rows_criterio38['cri_prom_valor']==0)
						$estado=0;
					}else{
						if($rec2==1){
							$estado=1;
						}else{
							$estado=2;
						}
					}
				}		
				
		}elseif($obs_asign>=3){
			$estado=1;
		}elseif($obs_asign==0){
			$estado=0;
		}
	
	}
	return $estado;
}


function fechaBonita($fecha)
{
	$nombre_mes=array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
	
	$nuevaFecha = explode('-',$fecha);
	$dia = $nuevaFecha[2];
	$mes = $nombre_mes[($nuevaFecha[1] * 1)];
	$ano = $nuevaFecha[0];
	
	return $dia . ' de '. $mes . ' de ' . $ano;
}

function contenido($estudiante, $documento, $mun_exp, $dep_exp, $tipo_documento, $cabecera, $certifica, $titulo, $datos_acta, $fcolp, $fecha_genera, $resultado_quienes_firman, $num_quiens_firman, $tipo_modalidad,$grado)
{	

//Se agrego esto para mostrar las variables cargadas
	$link=conectarse();
mysql_select_db($database_sygescol,$link);
$sql_estudiantes_grado22 = "select matricula.matri_id as 'id_estudiante', alumno.alumno_num_docu as 'documento',  
	CONCAT(alumno.alumno_ape1, ' ', alumno.alumno_ape2, ' ', alumno.alumno_nom1, ' ', alumno.alumno_nom2) as 'nombre',
	gao.b, gao.ba as 'grado', guo.ba as 'grupo', municipio_nombre as 'mun_exp', dpto.nombre as 'dep_exp', 
	tipo_docum.codigo as 'tipo_documento', cg.cg_modalidad, modalidadmedia_id
	FROM alumno 
	INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id)
	LEFT JOIN municipio ON (alumno.muni_exp_id  = municipio.municipio_id)
	LEFT JOIN dpto ON (municipio.departamento_id = dpto.id), g, gao, guo, tipo_docum, cg
	WHERE matricula.grupo_id = g.i AND g.b = gao.i AND g.i = '".$_POST['grupo']."' AND g.a = guo.i 
	AND matricula.matri_id NOT IN (SELECT matri_id FROM novedad_estudiante) $criterio 
	AND tipo_docum.id = alumno.tipo_docu_id AND cg.b = g.i
	ORDER BY g.i, alumno.alumno_ape1, alumno.alumno_ape2, alumno.alumno_nom1, alumno.alumno_nom2";


	$resultado_estudiantes_grado22 = mysql_query($sql_estudiantes_grado22,$link) or die ("No se pudo consultar los estudiantes del grado");
	$num_estudiantes_grado22 = mysql_fetch_array($resultado_estudiantes_grado22);


	$sql_estudiantes_grado23 = "SELECT * 
FROM v_grupos
INNER JOIN v_grados ON ( v_grados.gao_id = v_grados.gao_id ) 
INNER JOIN sedes ON ( sedes.sede_consecutivo = v_grupos.grupo_sede ) 
INNER JOIN g ON ( g.b = v_grupos.gao_id ) 
WHERE g.i = '".$_POST['grupo']."'";


	$resultado_estudiantes_grado23 = mysql_query($sql_estudiantes_grado23,$link) or die ("No se pudo consultar los estudiantes del grado");
	$num_estudiantes_grado23 = mysql_fetch_array($resultado_estudiantes_grado23);


    $cabecera = strip_tags(TildesHtmlaTexto($cabecera));
    
	$certifica = str_replace("#INSTITUCION#",$fcolp[1],$certifica);	
	$cabecera = str_replace("#INSTITUCION#",$fcolp[1],$cabecera);
	$tipo_modalidad = str_replace("#INSTITUCION#",$fcolp[1],$tipo_modalidad);
	
	$cabecera = str_replace("#MUNICIPIO#",$fcolp['municipio_nombre'],$cabecera);
	$certifica = str_replace("#MUNICIPIO#",$fcolp['municipio_nombre'],$certifica);
	$tipo_modalidad = str_replace("#MUNICIPIO#",$fcolp['municipio_nombre'],$tipo_modalidad);

	$cabecera = str_replace("#DEPARTAMENTO#",$fcolp['nombre'],$cabecera);
	$certifica = str_replace("#DEPARTAMENTO#",$fcolp['nombre'],$certifica);
	$tipo_modalidad = str_replace("#DEPARTAMENTO#",$fcolp['nombre'],$tipo_modalidad);

	$cabecera = str_replace("#GRADO#",$num_estudiantes_grado22['b'],$cabecera);
    $certifica = str_replace("#GRADO#",$num_estudiantes_grado22['b'],$certifica);
	$tipo_modalidad = str_replace("#GRADO#",$num_estudiantes_grado22['b'],$tipo_modalidad);


	$cabecera = str_replace("#GRUPO#",$num_estudiantes_grado22['grupo'],$cabecera);
	$certifica = str_replace("#GRUPO#",$num_estudiantes_grado22['grupo'],$certifica);
	$tipo_modalidad = str_replace("#GRUPO#",$num_estudiantes_grado22['grupo'],$tipo_modalidad);

	$cabecera = str_replace("#SEDE#",$num_estudiantes_grado23['sede_nombre'],$cabecera);
	$certifica = str_replace("#SEDE#",$num_estudiantes_grado23['sede_nombre'],$certifica);
	$tipo_modalidad = str_replace("#SEDE#",$num_estudiantes_grado23['sede_nombre'],$tipo_modalidad);

	
	$cabecera = str_replace("#FECHA#",TildesHtmlaTexto($fecha_genera),$cabecera);
	$certifica = str_replace("#FECHA#",TildesHtmlaTexto($fecha_genera),$certifica);
	$tipo_modalidad = str_replace("#FECHA#",TildesHtmlaTexto($fecha_genera),$tipo_modalidad);



	

	$cabecera_segmentada = explode('#SALTO#',$cabecera);


	//hasta que se termina lo que se agrego


	global $pdf;
	global $fcolp;
	global $link;
	
	$pdf->AddPage();
	
	//La carreta de la cabecera del acta
	$x=20;
	//$y=5;
	$y = 50;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','',9);
	$cabecera = strip_tags(html_entity_decode($cabecera));
	$pdf->MultiCell(182,5,$cabecera,0,J);
	
	//Lo que va despues de la Carreta
	$x=17;
	$y = $pdf->GetY() + 5;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','B',10);
	$texto = "Comprobada la situación legal y académica del estudiante";
	$pdf->Cell(182,20,$texto,0,1,C);
	
	//Viene ahora el nombre del estudiante
	$x=17;
	$y = $pdf->GetY() + 10;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('MG','',36);
	$texto = ucwords(strtolower($estudiante));
	$pdf->Cell(182,20,$texto,0,1,C);
	
	//Ahora va el documento del estudiante
	$x=17;
	$y = $pdf->GetY() + 1;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','B',10);
	$texto = $tipo_documento . ' Nº ' . $documento . ' de ' . $mun_exp . ', ' . $dep_exp;
	$pdf->Cell(182,1,$texto,0,1,C);
	
	//Ahora va el texto que certifica el acta
	$x=17;
	$y = $pdf->GetY() + 20;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','',10);
	$texto = strip_tags(html_entity_decode($certifica));
	$pdf->MultiCell(182,6,$texto,0,J);
	
	//Ahora va el titulo que obtuvo el estudiante
	$x=17;
	$y = $pdf->GetY() + 22;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('MG','',32);
	$texto = $titulo;
	$pdf->Cell(182,22,$texto,0,1,C);
	
	if($tipo_modalidad != '')
	{
		$x=17;
		$y = $pdf->GetY() - 4;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('MG','',32);
		$texto = 'en';
		$pdf->Cell(182,12,$texto,0,1,C);
		
		$x=17;
		$y = $pdf->GetY() - 4;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('MG','',32);
		$texto = $tipo_modalidad;
		$pdf->Cell(182,12,$texto,0,1,C);
	}
	/*
	$x=17;
		$y = $pdf->GetY() - -28;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('arial','B',15);
		$texto = '________________________________';
		$pdf->Cell(182,12,$texto,0,1,C);

    $x=17;
		$y = $pdf->GetY() - 4;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('arial','B',10);
		$texto = 'ISLEY YUMARA RUGE AVELLANEDA';
		$pdf->Cell(182,12,$texto,0,1,C);


	$x=17;
		$y = $pdf->GetY() - 4;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('arial','B',10);
		$texto = 'C.C.   No. 39.556.001 de Girardot';
		$pdf->Cell(182,12,$texto,0,1,C);


	$x=17;
		$y = $pdf->GetY() - 4;
		$pdf->SetXY($x,$y);
		$pdf->SetFont('arial','B',10);
		$texto = ' Rectora';
		$pdf->Cell(182,12,$texto,0,1,C);			
*/

	
	

	//Mostramos las firmas
	$pdf->SetFont('Arial','',9);
	if($num_quiens_firman)
	{
		$con_firmas = 0;
		$x = 17;
		$y = $pdf->GetY() + 50;	
		
		$ancho_firma = 91;
		$x_ancho = 18;
		//Si solo es una firma
		if($num_quiens_firman == 1)		
		{
			$ancho_firma = 182;
			$x_ancho = 65;
		}

		mysql_data_seek($resultado_quienes_firman,0);
		while($quien_firma = mysql_fetch_array($resultado_quienes_firman))
		{


			$tot_fir++;
			if($tot_fir > 1){
				$x_ancho += $ancho_firma;
			}
			if($quien_firma['admco_firma'] != '' and $quien_firma['firma_digital'] == 1){				
				$source = $quien_firma['admco_firma'];
				$dest_estu = substr( md5(microtime()), 1, 5); // archivo de destino
				list($width_s, $height_s, $type2, $attr) = getimagesize($source); // obtengo información del archivo
				$img = cropImage($width_s, $height_s, $source, 'png', $dest_estu);
				$pdf->Image($img , $x_ancho, $y - 23,0, 45);
				
				$img_res[ $quien_firma['id'] ] = $dest_estu;				
			}


			//Consultamos la abreviatura del documento
			$sql_cod_documento = "SELECT codigo	FROM tipo_docum WHERE id = '".$quien_firma['tipo_documento'] ."'";
			$resultado_cod_documento = mysql_query($sql_cod_documento, $link) or die ("No se pudo consultar el tipo de documento");
			$cod_documetno = mysql_fetch_array($resultado_cod_documento);
			$pdf->SetXY($x, $y);
			$texto = "________________________________________";
			$pdf->Cell($ancho_firma,5,$texto,0,0,C);
			$pdf->SetXY($x, $y+5);
			$texto = $quien_firma['nombre'] . '.';
			$pdf->Cell($ancho_firma,5,$texto,0,0,C);
			$pdf->SetXY($x, $y+10);
			$texto = $cod_documetno['codigo']. " ". $quien_firma['documento'];
			$pdf->Cell($ancho_firma,5,$texto,0,0,C);		
			$pdf->SetXY($x, $y+15);
			$texto = ucwords(strtolower($quien_firma['cargo']));
			$pdf->Cell($ancho_firma,5,$texto,0,0,C);
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

	//Ahora dice de donde fue tomada la copia
	$x=17;
	$y = $pdf->GetY() + 10;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','',7);
	$texto = "Es copia tomada del acta General de Grado. Folio Nº " . $datos_acta['acgra_folio_inicio'] . " al " . $datos_acta['acgra_folio_hasta'] . " del " . fechaBonita($datos_acta['acgra_fecha']);
	$pdf->Cell(182,1,$texto,0,1,J);
	
	//Ahora donde fue dada
	$x=17;
	$y = $pdf->GetY() + 1;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('arial','',7);
	$texto = "Dada en " . $fcolp['municipio_nombre'] . " (".$fcolp['nombre']."), $fecha_genera";
	$pdf->Cell(182,6,$texto,0,1,J);
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


if(isset($_POST['grupo']))
{
	$idGrado = $_POST['grupo'];		
	
	$criterio = '';
	if(isset($_POST['matri_id']))
	{
		$criterio = 'AND matricula.matri_id = '.$_POST['matri_id'];
	}
	
		
	//Ahora determinamos cuales estudiantes se graduaron o se van a graduar
	$sql_estudiantes_grado = "select matricula.matri_id as 'id_estudiante', alumno.alumno_num_docu as 'documento',  
	CONCAT(alumno.alumno_ape1, ' ', alumno.alumno_ape2, ' ', alumno.alumno_nom1, ' ', alumno.alumno_nom2) as 'nombre',
	gao.b, gao.ba as 'grado', guo.ba as 'grupo', municipio_nombre as 'mun_exp', dpto.nombre as 'dep_exp', 
	tipo_docum.codigo as 'tipo_documento', cg.cg_modalidad, modalidadmedia_id
	FROM alumno 
	INNER JOIN matricula ON (alumno.alumno_id=matricula.alumno_id)
	LEFT JOIN municipio ON (alumno.muni_exp_id  = municipio.municipio_id)
	LEFT JOIN dpto ON (municipio.departamento_id = dpto.id), g, gao, guo, tipo_docum, cg
	WHERE matricula.grupo_id = g.i AND g.b = gao.i AND g.i = $idGrado AND g.a = guo.i 
	AND matricula.matri_id NOT IN (SELECT matri_id FROM novedad_estudiante) $criterio 
	AND tipo_docum.id = alumno.tipo_docu_id AND cg.b = g.i
	ORDER BY g.i, alumno.alumno_ape1, alumno.alumno_ape2, alumno.alumno_nom1, alumno.alumno_nom2";
	
	$resultado_estudiantes_grado = mysql_query($sql_estudiantes_grado,$link) or die ("No se pudo consultar los estudiantes del grado");
	$num_estudiantes_grado = mysql_num_rows($resultado_estudiantes_grado);
	
	//Ahora recorro cada uno de los estudiantes del grado y reviso que halla superado todas las areas del grado
	
	$mod_grado = array(1 => 'Técnico', 2 => 'Académico');
	$con_estudiantes = 0;
	$con_areas_superadas = 0;
		$con_areas_promovidas = 0;
		$con_areas_perdidas = 0;
	
		$bandera = 0;
		$abreviatura_areas_perdidas = '';
	while($estudiantes_grado = mysql_fetch_array($resultado_estudiantes_grado))
	{
		
			$id_estudiante = $estudiantes_grado['id_estudiante'];
			
			$estado=promocion($id_estudiante, $link, $database_sygescol);
			
			if($estado==0){
				$estu_promovido_id[$con_estudiantes] = $id_estudiante;
				$estu_promovido_nombre[$con_estudiantes] = $estudiantes_grado['nombre'];
				$estu_promovido_documento[$con_estudiantes] = $estudiantes_grado['documento'];
				$estu_promovido_mun_exp[$con_estudiantes] = $estudiantes_grado['mun_exp'];
				$estu_promovido_dep_exp[$con_estudiantes] = $estudiantes_grado['dep_exp'];
				$estu_promovido_tipo_documento[$con_estudiantes] = $estudiantes_grado['tipo_documento'];
				$modalidad = $estudiantes_grado['modalidadmedia_id'];
				$mod_estu= $estudiantes_grado['cg_modalidad'];
				$con_estudiantes++;
			}
	}
	
	if($con_estudiantes)
	{
		//Consultamos la cabecera para el acta individual de grado
		$sql_cabecera_acta = "SELECT docu_dato_texto FROM documentos_datos WHERE docu_legal_id = 3 AND docu_dato_nombre = 'cabecera'";
		$resultado_cabecera_acta = mysql_query($sql_cabecera_acta, $link) or die ("No se pudo consultar la cabecera para el acta de grado");
		$cabecera_acta = mysql_fetch_array($resultado_cabecera_acta);
		
		//Consultamos el texto que certifica el acta según la modalidad de educación del grado
		
			$tipo_modalidad = 'despues_tradicional';
			
			//Consultamos la modalidad del colegio
			$sql_modalidad_colegio = "SELECT profundizacion.nombre as cualquier FROM grado_profundi INNER JOIN profundizacion ON (grado_profundi.id_profundizacion=profundizacion.id) where id_grupo='".$_POST['grupo']."'";
			$resultado_modalidad_colegio = mysql_query($sql_modalidad_colegio, $link) or die ("No se pudo consultar la modalidad del colegio");			
			$modalidad_colegio = mysql_fetch_array($resultado_modalidad_colegio);
			$titulo = "Bachiller " . $modalidad_colegio['cualquier'];
			
			
		$sql_certifica_acta = "SELECT docu_dato_texto FROM documentos_datos WHERE docu_legal_id = 3 AND docu_dato_nombre = '$tipo_modalidad'";
		$resultado_certifica_acta = mysql_query($sql_certifica_acta, $link) or die ("No se pudo consultar el texto que certifica el acta");
		$certifica_acta = mysql_fetch_array($resultado_certifica_acta);
		
		//Consultamos los datos del acta
		$sql_datos_acta = "SELECT * FROM acta_grado WHERE acgra_id = $mod_estu";
		$resultado_datos_acta = mysql_query($sql_datos_acta, $link) or die ("No se pudo consultar los datos del acta");
		$datos_acta = mysql_fetch_array($resultado_datos_acta);
		
		
		//Ahora identificamos la fecha en la que se genera el acta
		$nombre_ano=array(2007 => "Dos Mil Siete", 2008 => "Dos Mil Ocho", 2009 => "Dos Mil Nueve", 2010 => "Dos Mil Diez", 2011 => "Dos Mil Once");
		$nombre_mes=array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
		$nombre_dia=array(1 => "Un", 2 => "Dos", 3 => "Tres", 4 => "Cuatro", 5 => "Cinco", 6 => "Seis", 7 => "Siete", 8 => "Ocho", 9 => "Nueve", 10 => "Diez", 
		11 => "Once", 12 => "Doce", 13 => "Trece", 14 => "Catorce", 15 => "Quince", 16 => "Dieciseis", 17 => "Diecisiete", 18 => "Dieciocho", 19 => "Diecinueve", 20 => "Veinte", 
		21 => "Veintiun", 22 => "Veintidos", 23 => "Veintitres", 24 => "Veinticuatro", 25 => "Veinticinco", 26 => "Veintiseis", 27 => "Veintisiete", 28 => "Veintiocho", 29 => "Veintinueve", 30 => "Treinta", 31 => "Treinta y un");
	
		$fecha_genera = "a los " . $nombre_dia[date("j")] . " (".date("d").") días del mes de ".$nombre_mes[date("n")]." de " .$nombre_ano[date("Y")]. " (".date("Y").").";
		
		
		//Consultamos quienes pueden firmar este documento
		$sql_quienes_firman = "SELECT nombre, documento, tipo_documento, cargo, genero, admco_firma, firmas_autorizadas.firma_digital
	FROM admco, firmas_autorizadas
	WHERE admco.id = fir_aut_tabla_id AND fir_aut_documento = 3";
	$resultado_quienes_firman = mysql_query($sql_quienes_firman, $link) or die ("No se pudo consultar las personas que firman el documento " . $sql_quienes_firman . ' ' . mysql_error() );
	$num_quiens_firman = mysql_num_rows($resultado_quienes_firman);
	
		//Creación del objeto de la clase heredada
		
		$long_max = 250;
		$ancho_max = 192;
		
		$pdf=new PDF('P', 'mm', 'legal');
		$pdf->SetAutoPageBreak(true, 20);
		$pdf->AliasNbPages();
		$pdf->SetFont('Times','',12);
		$pdf->AddFont('MG','','MG.php');
		$file=basename(tempnam(getcwd(),'tmp'));

		for($z=0; $z < $con_estudiantes; $z++)
		{
			$estudiante = $estu_promovido_nombre[$z];
			$documento = $estu_promovido_documento[$z];
			$mun_exp = $estu_promovido_mun_exp[$z];
			$dep_exp = $estu_promovido_dep_exp[$z];
			$tipo_documento = $estu_promovido_tipo_documento[$z];
			
			contenido($estudiante, $documento, $mun_exp, $dep_exp, $tipo_documento, $cabecera_acta['docu_dato_texto'], $certifica_acta['docu_dato_texto'], $titulo, $datos_acta, $fcolp, $fecha_genera, $resultado_quienes_firman, $num_quiens_firman,$datos_tipo_modalidad['tt_nombre']);
		}
		$pdf->Output();
	}else{
	//Sin Estudiantes...................................
	
	}
}
?>