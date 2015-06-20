<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<? 
	if ($_FILES["src"]["error"] > 0){
		echo "에러있음";
	}else{


//		error_reporting(E_ALL);

		$upload_url = "/www/excelUpload/";
		$filename = "[" . date('Y-m-d') . "] - " . date('G:i:s') . "_" . $_FILES["src"]["name"];

		$file_name = fn_fileupload($upload_url);


		include_once ("./PHPExcel.php");	
		include_once "./PHPExcel/IOFactory.php";	

		$objPHPExcel = new PHPExcel();

//		echo "파일경로=". $file_name . "<br><br>";
		$rs_result =	"";
		try{
			//업르도 된 엑셀 형식에 맞는 Reader객체를 만든다.
			$objReader = PHPExcel_IOFactory::createReaderForFile($filename);

			//읽기전용으로 설정
			$objReader->setReadDataOnly(true);

			//엑셀파일을 읽는다.
			$objExcel = $objReader->load($filename);

			//첫번쨰 시트를 선택
			$objExcel->setActiveSheetIndex(0);

			$objWorksheet = $objExcel->getActiveSheet();

			//총 라인수. 첫줄인 제목을 빼야함. TOTAL 33-1 = 32
			$maxRow = $objWorksheet->getHighestRow()-1;

			//1줄을 뺀 두번쨰 줄 실제 데이터부터 시작.
			for ($i = 2 ; $i <= $maxRow+1 ; $i++){
				$reg_date = $objWorksheet->getCell('A' . $i)->getValue();
				$reg_date =  date('Y-m-d', fn_time_convert_EXCEL_to_PHP($reg_date));

				/** 신청자정보S **/
				$c_ceo_nm = $objWorksheet->getCell('B' . $i)->getValue();
				$c_rrn1	= $objWorksheet->getCell('C' . $i)->getValue();
				$c_corp_nm = $objWorksheet->getCell('D' . $i)->getValue();
				$c_tel = $objWorksheet->getCell('E' . $i)->getValue();
				$c_jibun1 = $objWorksheet->getCell('F' . $i)->getValue();
				$c_jibun2 = $objWorksheet->getCell('G' . $i)->getValue();
				$c_addr = $objWorksheet->getCell('H' . $i)->getValue();
				/** 신청자정보E **/

				$outdoor_act_cate = $objWorksheet->getCell('I' . $i)->getValue();	//광고물종류
				$use_item = $objWorksheet->getCell('J' . $i)->getValue();			//사용자재
				$chk_pay = $objWorksheet->getCell('K' . $i)->getValue();			//검사수수료
				$outdoor_act_type = $objWorksheet->getCell('L' . $i)->getValue();	//광고물형식
				$outdoor_act_type_gubun_tmp	= $objWorksheet->getCell('M' . $i)->getValue();	//광고물구분

				/** 표시위치 장소S **/
				$outdoor_real_jibun1 = $objWorksheet->getCell('N' . $i)->getValue();
				$outdoor_real_jibun2 = $objWorksheet->getCell('O' . $i)->getValue();
				$outdoor_real_addr = $objWorksheet->getCell('P' . $i)->getValue();
				/** 표시위치 장소E **/

				//********** 광고물 규격 0~7, h S************* //
				$gu_office = $objWorksheet->getCell('Q' . $i)->getValue();		//해당구청
				$outdoor_size0 = $objWorksheet->getCell('R' . $i)->getValue();	
				$outdoor_size1 = $objWorksheet->getCell('S' . $i)->getValue();
				$outdoor_size2 = $objWorksheet->getCell('T' . $i)->getValue();
				$outdoor_size3 = $objWorksheet->getCell('U' . $i)->getValue();
				$outdoor_size4 = $objWorksheet->getCell('V' . $i)->getValue();
				$outdoor_size5 = $objWorksheet->getCell('W' . $i)->getValue();
				$outdoor_size6 = $objWorksheet->getCell('X' . $i)->getValue();
				$outdoor_size7 = $objWorksheet->getCell('Y' . $i)->getValue();
				$outdoor_sizeH0 = $objWorksheet->getCell('Z' . $i)->getValue();
				//********** 광고물 규격 0~7, h E************* //

				/** 시공업자S**/
				$s_ceo_nm = $objWorksheet->getCell('AA' . $i)->getValue();
				$s_biz_no = $objWorksheet->getCell('AB' . $i)->getValue();
				$s_corp_nm = $objWorksheet->getCell('AC' . $i)->getValue();
				$s_jibun1 = $objWorksheet->getCell('AD' . $i)->getValue();
				$s_jibun2 = $objWorksheet->getCell('AE' . $i)->getValue();
				$s_addr = $objWorksheet->getCell('AF' . $i)->getValue();
				/** 시공업자E**/

				$memo1 = $objWorksheet->getCell('AG' . $i)->getValue();

				//간판종류를 영문으로 변경
				$outdoor_act_cate = fn_select_fetch_array("en_nm", "common_selectbox", "code='01' and ko_nm='" . $outdoor_act_cate . "'");

				//광고물형식을 영문으로 변경
				$outdoor_act_type = fn_select_fetch_array("en_nm", "common_selectbox", "code='05' and ko_nm='" . $outdoor_act_type . "'");

				//광고물구분을 영문으로 변경
				switch($outdoor_act_type_gubun_tmp){
					case "신규" : $outdoor_act_type_gubun = "N";	break;
					case "연장" : $outdoor_act_type_gubun = "R";	break;
					case "기타" : $outdoor_act_type_gubun = "E";	break;
				}

				//구청을 영문으로 변경
				$gu_office = fn_select_fetch_array("en_nm", "common_selectbox", "code='10' and ko_nm='" . $gu_office . "'");

				$rs = fn_select_fetch_array("reg_no", "soaa_reg_check", "reg_no <> '' order by reg_no desc limit 0,1");
				$reg_no = $rs["reg_no"];

				if($reg_no){
					$reg_no_seNum = explode("-", $reg_no);
					$reg_no_seNum[1]++;
					$reg_no_seLength = strlen($reg_no_seNum[1]);

					if($reg_no_seLength){
						$reg_no_seNum[1] = str_pad($reg_no_seNum[1], 5, "0", STR_PAD_LEFT);
					}

				$reg_no = date("Y") . "-" . $reg_no_seNum[1];

				}else{
					$reg_no = date("Y") . "-" . "00001";
				}

				$rs_cnt = fn_insert("
							reg_no,	reg_date,
							c_ceo_nm, c_rrn1,
							c_corp_nm,
							
							c_tel,	c_jibun1,
							c_jibun2,	c_addr,

							outdoor_act_cate,	use_item,
							chk_pay,	outdoor_act_type,
							outdoor_act_type_gubun,

							outdoor_real_jibun1,	outdoor_real_jibun2,
							outdoor_real_addr,	gu_office,

							outdoor_size0,	outdoor_size1,
							outdoor_size2,	outdoor_size3,
							outdoor_size4,	outdoor_size5,
							outdoor_size6,	outdoor_size7,
							outdoor_sizeH0,

							s_ceo_nm,	s_biz_no,
							s_corp_nm,	

							s_jibun1,	s_jibun2,
							s_addr,	memo1,

							insert_id,
							insert_date
							",

							"
							'$reg_no',	'$reg_date',
							'$c_ceo_nm',	'$c_rrn1',
							'$c_corp_nm',

							'$c_tel','$c_jibun1',
							'$c_jibun2',	'$c_addr',

							'$outdoor_act_cate[0]','$use_item',
							'$chk_pay',	'$outdoor_act_type[0]',
							'$outdoor_act_type_gubun',

							'$outdoor_real_jibun1',	'$outdoor_real_jibun2',
							'$outdoor_real_addr','$gu_office[0]',

							'$outdoor_size0',	'$outdoor_size1',
							'$outdoor_size2',	'$outdoor_size3',
							'$outdoor_size4',	'$outdoor_size5',
							'$outdoor_size6',	'$outdoor_size7',
							'$outdoor_sizeH0',

							'$s_ceo_nm',	'$s_biz_no',	
							'$s_corp_nm',

							'$s_jibun1',	'$s_jibun2',
							'$s_addr',		'$memo1',

							'". $_SESSION['id'] . "',
							now()
							",
						
							"soaa_reg_check");
				if($rs_cnt){
					$rs_result++;
				}else{
					$failed_rs .= $c_ceo_nm . ",";
				}
			}
			
		
		}catch(exception $e){
			echo $e->getMessage() . "오류코드:" . $e->getCode();
		}
	}


//	echo "엑셀 줄수=" . $maxRow . "<br>";
//
//	echo "반영갯수=" . $rs_result;
//
//	exit;

	if($rs_result == $maxRow){
		echo "
				<script>
					alert(\"총 $maxRow 건의 자료가 업로드 되었습니다\");
					location.href=\"/safeChk_Mng/soaa_reg.php\";
				</script>

			";
	}else{
		echo 
				"<script>
					alert(\"업로드 오류\" + '<?=$failed_rs?>');
					location.href=/safeChk_Mng/soaa_reg.php;
				</script>
				";
	}
?>