<?php

    #로컬
    #$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']."/reallanding";

	include $_SERVER['DOCUMENT_ROOT'].'/melon/core.php';
	include $_SERVER['DOCUMENT_ROOT'].'/PHPExcel.php';

	$startDate = trim($param["startDate"]);
	$endDate = trim($param["endDate"]);

	$table = 'applicants';
	$path = '';
	if(!is_null($startDate) && !is_null($endDate)){
	    $where = "DATE(create_date) >= '{$startDate}'";
	    if(date("Y-m-d")!==$endDate){
	        $where.="AND DATE(create_date) <= '{$endDate}'";
	    }
	}else{
	    $where = "";
	}
	addKeywordCondition($path,$where,$param['search_type'],$param['search_keyword'],true);
	$pagingTags = $melon['dir'].'/page/$page'.$path;
	
	$applicants = pageList($table,$where,'no desc',500,255353,$param['page'],$pagingTags);


$alpabets= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	$title = '랜딩페이지 DB 현황';





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



	

 $fieldCnt=0;
	foreach ($melon['fields'] as $field=>$fieldName){
	$objPHPExcel->getActiveSheet()->getColumnDimension($alpabets[$fieldCnt])->setWidth(30);
	$objPHPExcel->getActiveSheet()->getStyle($alpabets[$fieldCnt])->getAlignment()->setWrapText(true);
		 $fieldCnt =  $fieldCnt+1;
	}


		$objPHPExcel->getActiveSheet()->getStyle($alpabets[$fieldCnt])->getAlignment()->setWrapText(true);

			$objPHPExcel->getActiveSheet()->getStyle($alpabets[$fieldCnt+1])->getAlignment()->setWrapText(true);


//셀크기 별도 조절
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    // 내용

	
				


 $fieldCnt=0;

      
					foreach ($melon['fields'] as $field=>$fieldName){
						 
					 $sheetIndex->setCellValue($alpabets[ $fieldCnt].'1', $fieldName);
					 $fieldCnt =  $fieldCnt+1;
					}
						 $sheetIndex->setCellValue($alpabets[ $fieldCnt].'1', '상태');
						 $sheetIndex->setCellValue($alpabets[ $fieldCnt+1].'1', '등록일');
//                ->setCellValue('C1', '주소')
//                ->setCellValue('D1', '연락처')
//                ->setCellValue('F1', '오픈일');
          

 for ($bora=0;$bora<$applicants['length'];$bora++ ) { 
	 $applicant = $applicants[$bora];

	$data = jsonDecode($applicant['contents']);

	 $fieldCnt=0;

	
								foreach ($melon['fields'] as $field=>$fieldName){
    $sheetIndex->setCellValue($alpabets[$fieldCnt].($bora+2),$data[$field]);
		 $fieldCnt++;
							}
							if($applicant['status']==1){
								$status='상담완료';
							}
								if($applicant['status']==0){
								$status='상담대기';
							}
							  $sheetIndex->setCellValue($alpabets[$fieldCnt].($bora+2),$status);
							  $sheetIndex->setCellValue($alpabets[$fieldCnt+1].($bora+2),dateFormat($applicant['create_date'],'Y.m.d H:i:s'));


 }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='.$today.' '.iconv('UTF-8','EUC-KR',$title).'.xls');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean();
    $objWriter->save('php://output');
 
    exit;
