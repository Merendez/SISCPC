<?php
include("../conexion.php");
/* A continuación, realizamos la conexión con nuestra base de datos en MySQLi */

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);

$result= mysqli_query($link, "select * from bienes");

	//Creando y llenando tabla	
if($row=mysqli_fetch_array($result, MYSQLI_BOTH)){
	date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("CONAGUA") //Autor
							 ->setLastModifiedBy("CONAGUA") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel Reporte Bienes")
							 ->setSubject("Reporte Excel Reporte Bienes")
							 ->setDescription("Reporte Excel Reporte Bienes")
							 ->setKeywords("Reporte Excel Reporte Bienes")
							 ->setCategory("Reporte Excel Reporte Bienes");
		//Definiendo el tamaño del papel y la orientacion
		$objPHPExcel->getActiveSheet()->getPageSetup()
    						 ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()
    						 ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
		//Definiendo los margenes
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.7);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.7);
		
		//Estableciendo las opciones de escala  --Utiles a la hora de imprimir--
		$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(100);

		$tituloReporte = <<<TEXTO
		 COMICION NACIONAL DEL AGUA
		 DEPARTAMENTO DE RECURSOS FINANCIEROS
 		 REPORTE DE BIENES
TEXTO;
		$TituloReporte2="COMICION NACIONAL DEL AGUA\n DEPARTAMENTO DE RECURSOS FINANCIEROS \n REPORTE DE BIENES";
				
		$titulosColumnas = array('No.', 'camb', 'descripcion', 'existencias');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:O1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$TituloReporte2)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3]);

$contador=1;
$i=4;

do{ 

//Guardadndo en variables resultado de consulta sql
$camb=$row["camb"];

$descripcion=$row["descripcion"];

$existencia=$row["existencia"];
		  
		  $objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, $contador)
		            ->setCellValue('B'.$i, $row["Apaterno"]." ".$row["Amaterno"]." ".$row["Nombre"])
        		    ->setCellValue('C'.$i, $row["RFC"])
            		->setCellValue('D'.$i, $row["Curp"]);
					
		
		//REALIZANDO LA SEGUNDA CONSULTA mysqli PARA LLENAR EN UNA SOLA CELDA LAS CLAVES PRESUPUESTALES
		$result2=mysqli_query("SELECT * FROM clave_presupuestal  where RFC_trabajador ='".$row["RFC"]."' order by idClave Asc", $link); 
		
	
		if($row=mysqli_fetch_array($result2)){

		}
		
		
		//Dando formato a las variables para eliminar el salto de linea extra
			
		
		   
$contador=$contador+1;
$i++;
//}//Termina el if que elimina registros duplicados

}while($row=mysqli_fetch_array($result));

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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);		
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
        $objDrawing->setPath('./img/logo.png');
		$objDrawing->setHeight(60);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objDrawing->setCoordinates('B1');
        $objDrawing->setOffsetX(100);
		 $objDrawing->setOffsetY(20);
       //$objDrawing->getShadow()->setVisible(true); //Agrega sombra
        $objDrawing->getShadow()->setDirection(4);
		
		

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
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="CONAGUA.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
} 
else{ 
echo "<center>No se ha encontrado ningun Registro...</center>"; 
} 
	
mysqli_close($link); //Cerrando la conexion
	
?>