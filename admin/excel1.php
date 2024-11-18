<?php
	include $_SERVER['DOCUMENT_ROOT'].'/melon/core.php';
	include $_SERVER['DOCUMENT_ROOT'].'/PHPExcel.php';


	$table = 'statistics';
	$path = '';
	$where = '';
	addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
	$pagingTags = $melon['dir'].'/page/$page'.$path;
	
	$statistics = pageList($table,$where,'no desc',10999,99910,$param['page'],$pagingTags);



//	$orders = getList('g5_shop_order','od_id in(999999,'.$param['no'].')');
//  $alpabets= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	$title = '리얼랜딩 실시간접속 현황';




    $objPHPExcel = new PHPExcel();
    $sheet      = $objPHPExcel->getActiveSheet();

    // 글꼴
  
    $sheet->getDefaultStyle()->getFont()->setName('굴림')->setSize(11);;
    $sheetIndex = $objPHPExcel->setActiveSheetIndex(0);
	$today = date('Y-m-d');
    // 제목
 //   $sheetIndex->setCellValue('A1',$today.' '.$excelTitle);
   // $sheetIndex->mergeCells('A1:J1');
//    $sheetIndex->getStyle('A1')->getFont()->setSize(20)->setBold(true);
  //  $sheetIndex->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) { 
		$rd->setRowHeight(13.5); 
	}

	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22.5);
	$sheet->getStyle('A1:P1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel
->getActiveSheet()
->getStyle('A1:P1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()
->setRGB('f0f0f0'); //i.e,colorcode=D3D3D3

 $styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
 
 
$objPHPExcel->getActiveSheet()
->getStyle('A1:P1')->applyFromArray($styleArray);


$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    );

    $sheet->getDefaultStyle()->applyFromArray($style);



	
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(70);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
//	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

	

	 $sheetIndex->getStyle('A1')->getFont()->setSize(9)->setBold(true);
	 $sheetIndex->getStyle('B1')->getFont()->setSize(9)->setBold(true);
	 $sheetIndex->getStyle('C1')->getFont()->setSize(9)->setBold(true);
	 $sheetIndex->getStyle('D1')->getFont()->setSize(9)->setBold(true);
//	 $sheetIndex->getStyle('F1')->getFont()->setSize(9)->setBold(true);


    // 내용





 $sheetIndex->setCellValue('A1', 'no')
                ->setCellValue('B1', '접속자IP')
                ->setCellValue('C1', '상세경로')
                ->setCellValue('D1', '접속일');
//                ->setCellValue('F1', '오픈일');
          

 for ($bora=0;$bora<$statistics['length'];$bora++ ) { 
	 $statistics = $statistics[$bora];

	
	
						
    $sheetIndex->setCellValue('A'.($bora+2),$statistics['no'])
					  ->setCellValue('B'.($bora+2),$statistics['user_ip'])	
					  ->setCellValue('C'.($bora+2),$statistics['refferer'])
					  ->setCellValue('D'.($bora+2),$statistics['create_date']);
//					->setCellValue('F'.($bora+2),$statistics['open_date']);

 }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='.$today.' '.iconv('UTF-8','EUC-KR',$title).'.xls');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean();
    $objWriter->save('php://output');
 
    exit;
