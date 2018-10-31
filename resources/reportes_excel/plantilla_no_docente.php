<?php
/* ----Conexion con Base de Datos---- */
$link = mysql_connect("localhost","root","");
mysql_select_db("bdrh", $link);
    
$result=mysql_query("SELECT *, DATEDIFF(CURRENT_DATE(),Gob_Fed)/365 AS Antiguedad FROM trabajador where EXISTS (select * from clave_presupuestal where trabajador.RFC=clave_presupuestal.RFC_trabajador and clave_presupuestal.Denominacion not like '%prof%')
order by Apaterno Asc", $link);  

	//Creando y llenando tabla	
if($row=mysql_fetch_array($result)){
	date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Humanos Itca") //Autor
							 ->setLastModifiedBy("Humanos Itca") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL(Plantilla)")
							 ->setSubject("Reporte Excel con PHP y MySQL(Plantilla)")
							 ->setDescription("Plantilla de personal no docente")
							 ->setKeywords("Plantilla de personal")
							 ->setCategory("Reporte excel");
		//Definiendo el tamaño del papel y la orientacion
		$objPHPExcel->getActiveSheet()->getPageSetup()
    						 ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()
    						 ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		//Definiendo los margenes
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.7);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.7);
		
		//Estableciendo las opciones de escala  --Utiles a la hora de imprimir--
		$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(85);

		$tituloReporte = <<<TEXTO
		 INSTITUTO TECNOLÓGICO DE CD. ALTAMIRANO
		 DEPARTAMENTO DE RECURSOS HUMANOS
		 CLAVE DEL CENTRO DE TRABAJO: 12DIT0005B
 		 PLANTILLA DE PERSONAL DEL PERIODO: ENERO - JUNIO 2016
TEXTO;
		$TituloReporte2="INSTITUTO TECNOLÓGICO DE CD. ALTAMIRANO \n DEPARTAMENTO DE RECURSOS HUMANOS \n CLAVE DEL CENTRO DE TRABAJO: 12DIT0005B \n PLANTILLA DE PERSONAL DEL PERIODO: ENERO - JUNIO 2016";
				
		$titulosColumnas = array('No.', 'NOMBRE DEL TRABAJADOR', 'R.F.C.', 'C.U.R.P.','CLAVE PRESUPUESTAL.','GOB.FED','S.E.P','C.T.','ANT.','STATUS','COD. Y DENOMINACION DE LA CAT.','PUESTO','ESCOLARIDAD','DISTRIBUCION JORNADA DE TRABAJO','NO. HORAS');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:O1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$TituloReporte2)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
					->setCellValue('E3',  $titulosColumnas[4])
					->setCellValue('F3',  $titulosColumnas[5])
					->setCellValue('G3',  $titulosColumnas[6])
					->setCellValue('H3',  $titulosColumnas[7])
					->setCellValue('I3',  $titulosColumnas[8])
					->setCellValue('J3',  $titulosColumnas[9])
					->setCellValue('K3',  $titulosColumnas[10])
					->setCellValue('L3',  $titulosColumnas[11])
					->setCellValue('M3',  $titulosColumnas[12])
					->setCellValue('N3',  $titulosColumnas[13])
					->setCellValue('O3',  $titulosColumnas[14]);

$contador=1;
$i=4;

do{ 

//Guardadndo en variables resultado de consulta sql
$Apaterno=$row["Apaterno"];
$Amaterno=$row["Amaterno"];
$Nombre=$row["Nombre"];
$RFC=$row["RFC"];
$Curp=$row["Curp"];
$Gob_fed=$row["Gob_fed"];
$SEP=$row["SEP"];
$CT=$row["CT"];
$Ant=$row["Antiguedad"];
$Puesto=$row["Puesto"];
$Escolaridad=$row["Escolaridad"];
$Distribucion_hrs_grupo=$row["Distribucion_hrs_grupo"];
$No_hrs=$row["No_hrs"];
$Status="";
$Codificacion="";
$Clave="";
		  
		  $objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, $contador)
		            ->setCellValue('B'.$i, $row["Apaterno"]." ".$row["Amaterno"]." ".$row["Nombre"])
        		    ->setCellValue('C'.$i, $row["RFC"])
            		->setCellValue('D'.$i, $row["Curp"]);
					
		
		//REALIZANDO LA SEGUNDA CONSULTA MYSQL PARA LLENAR EN UNA SOLA CELDA LAS CLAVES PRESUPUESTALES
		$result2=mysql_query("SELECT * FROM clave_presupuestal  where RFC_trabajador ='".$row["RFC"]."' order by idClave Asc", $link); 
		
	
		if($row=mysql_fetch_array($result2)){
		do{
			
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('E'.$i, $row["idClave"]);
			
		$Clave.=$row["idClave"]."\n";
		$Status.=$row["Status"]."\n";
		$Codificacion.=$row["Codificacion"]." ".$row["Denominacion"]." \n ";
		}while($row=mysql_fetch_array($result2));}
		
		
		//Dando formato a las variables para eliminar el salto de linea extra
		$Clave_trimmed = trim($Clave, " \n.");
		$Status_trimmed = trim($Status, " \n.");
		$Codificacion_trimmed = trim($Codificacion, " \n.");
		
	    /*Continuando con la tabla despues del bucle
		  Todo esto se llena con variables, debido a que se han vaciado
		  de memoria las celdas de la primer consulta*/
		  $objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('E'.$i, $Clave_trimmed)
        		    ->setCellValue('F'.$i, $Gob_fed)
		            ->setCellValue('G'.$i, $SEP)
        		    ->setCellValue('H'.$i, $CT)
            		->setCellValue('I'.$i, $Ant);
		 	  
		 //Continuando con la tabla despues de los bucles
		 $objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('J'.$i, $Status_trimmed)
		            ->setCellValue('K'.$i, $Codificacion_trimmed)
        		    ->setCellValue('L'.$i, $Puesto)
            		->setCellValue('M'.$i, $Escolaridad)
					->setCellValue('N'.$i, $Distribucion_hrs_grupo)
					->setCellValue('O'.$i, $No_hrs);	
		
		   
$contador=$contador+1;
$i++;
//}//Termina el if que elimina registros duplicados

}while($row=mysql_fetch_array($result));

//echo ($todo); 
$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Arial Narrow',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>12,
	            	'color'     => array(
    	            	'rgb' => '000000'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('rgb' => 'FFFFFF')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial Narrow',
                'bold'      => true,
				'size' =>6.5,                          
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'FFFFFF'
        		),
        		'endcolor'   => array(
            		'argb' => 'FFFFFF'
        		)	
			),
            'borders' => array(
            	'allborders'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial Narrow',
				'size' =>6.5,               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('rgb' => 'FFFFFF')
			),
           	'borders' => array(
               	'allborders'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '000000'
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:O".($i-1));
		/*		
		for($i = 'A'; $i <= 'O'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		*/
		//Alto de algunas columnas
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(65);
	    //Agregando la imagen de la SEP
		$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./img/sep.png');
		$objDrawing->setHeight(60);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objDrawing->setCoordinates('B1');
        $objDrawing->setOffsetX(100);
		 $objDrawing->setOffsetY(20);
       //$objDrawing->getShadow()->setVisible(true); //Agrega sombra
        $objDrawing->getShadow()->setDirection(4);
		
		//Agregando la imagen de la SEP
		$objDrawing2 = new PHPExcel_Worksheet_Drawing();
        $objDrawing2->setName('Logo');
        $objDrawing2->setDescription('Logo');
        $objDrawing2->setPath('./img/logo.png');
		$objDrawing2->setHeight(90);
		$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());
        $objDrawing2->setCoordinates('L1');
        $objDrawing2->setOffsetX(100);
		$objDrawing2->setOffsetY(5);
        //$objDrawing2->getShadow()->setVisible(true);
       // $objDrawing2->getShadow()->setDirection(4);

		//Dando ancho a las columnas
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(22);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(13);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(17.5);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(7);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(7);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(7);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(4.8);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(4);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(26);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(16);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(20);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(5);
		//Indicando a un congunto de celdas que el texto se ajuste al tamaño
		$objPHPExcel->getActiveSheet()->getStyle('A4:O150')
                    ->getAlignment()->setWrapText(true);
		//Indicando la alineacion centrada a un conjunto de celdas
		$objPHPExcel->getActiveSheet()->getStyle('C4:J150')
         ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//ALINEACION HORIZONTAL
		 $objPHPExcel->getActiveSheet()->getStyle('C4:J150')
         ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//ALINEACION VERTICAL
		//Columna horas de profesor
		$objPHPExcel->getActiveSheet()->getStyle('O4:O150')
         ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//ALINEACION HORIZONTAL
		 $objPHPExcel->getActiveSheet()->getStyle('O4:O150')
         ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//ALINEACION VERTICAL
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Plantilla');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Plantilla_no_docente_ITCA.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
} 
else{ 
echo "<center>No se ha encontrado ningun Registro...</center>"; 
} 
	
mysql_close($link); //Cerrando la conexion
	
?>