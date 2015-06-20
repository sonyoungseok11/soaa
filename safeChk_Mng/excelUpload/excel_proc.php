<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<? require_once("./reader.php"); ?>

<?
if ($_FILES["src"]["error"] > 0){
	echo "에러있음";
}else{
//	echo "Upload: " . $_FILES["src"]["name"] . "<br>";  // 전송된 파일의 실제 이름 값
//	echo "Type: " . $_FILES["src"]["type"] . "<br>";  // 전송된 파일의 형식(type)
//	echo "Size: " . ($_FILES["src"]["size"]) . " Byte<br>";  // 전송된 파일의 용량(기본 byte 값)
//	echo "Stored in: " . $_FILES["src"]["tmp_name"];  //  서버에 저장된 임시 복사본의 이름
//
//	echo "<br><br>";



//	$upload_url			=	"/www/excel/";
	$upload_url			=	"/excelUpload/";
//	$upload_cnt = fn_fileupload($upload_url);

	//엑셀 Excel 97-2003  통합문서  .xls 만 올릴것

	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding("UTF-8"); // 이부분만 바꿨습니다.

	$data->read($_FILES["src"]["name"]);

//	echo $data->sheets[0]['numRows'] . "<br>";
//	echo $data->sheets[0]['numCols'] . "<br>";
	$num=0;
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) { 
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) { 
			$list[$num] = $data->sheets[0]['cells'][$i][$j];
			$num++;
		} 
	echo "\n"; 
	} 

	$rows_tot_column = 23;
//	echo "총 컬럼 갯수=" .count($list) . "<br>";
	$column = count($list) / 23;
//	echo "줄수=" . $column . "<br>";

	$j=0;
	for($i=0; $i<count($list); $i++){
		if($j == $rows_tot_column){
			$insert_rows .= "_";	//1줄 2줄 구분을 _ 으로.
			$j=0;
		}
		$j++;
		$insert_rows .= $list[$i] . ",";	//각줄에서 각각의 컬럼 구분을 , 으로		
	}
	
	$insert_rows = explode("_", $insert_rows);

	$year = date("Y");

	for($i=0; $i<count($insert_rows); $i++){	//읽어온 엑셀의 데이터를 한줄 한줄 반복 돌림
		$tmp = explode(",", $insert_rows[$i]);	// 한줄씩 읽어온 데이터에서 각 구분 컬럼인 , 로 잘라서 쿼리에 반영.
			$rs = fn_select_fetch_array("reg_no", "soaa_reg", "reg_no <> '' order by reg_no desc limit 0,1");
			$reg_no = $rs["reg_no"];

			if($reg_no == ""){
				$reg_no = $year . "-" . "00001";	
			}else{
				$tmp_reg_no = explode("-", $reg_no);
				echo $tmp_reg_no;
				exit;
				$reg_no = $year . "_" . $tmp_reg_no;
			}
			
			$rs_cnt = fn_insert("
								reg_no,		reg_date,
								c_ceo_nm,	c_biz_no,
								c_corp_nm,	c_jibun1,
								c_jibun2,	c_addr,
								c_tel,

								outdoor_act_cate,		outdoor_act_type,
								outdoor_real_jibun1,	outdoor_real_jibun2,
								outdoor_real_addr,		gu_office,

								outdoor_size0,	outdoor_size1,
								outdoor_size2,	outdoor_size3,
								outdoor_size4,	outdoor_size5,
								outdoor_size6,	outdoor_size7,

								chk_personA,	chk_personB,
								chk_result,		chk_pay,

								payment_state,	real_chkday,
								payment_in_day,	report_certi,

								s_ceo_nm,	s_biz_no,
								s_corp_nm,	s_jibun1,
								s_jibun2,	s_addr,

								use_item,			outdoor_act_type_gubun,
								chk_report,			memo1,
								chk_p_positionA,	chk_p_positionB,

								rf_date,	rf_nm,
								rf_payment,	rf_reason,
								insert_id,	insert_date",


								"'$i',		'$tmp[0]',
								'$tmp[1]','$tmp[2]',
								'$tmp[3]','$tmp[4]',
								'$tmp[5]','$tmp[6]',
								'$tmp[7]',
								
								'$tmp[8]',	'$tmp[9]',
								'$tmp[10]',	'$tmp[11]',
								'$tmp[12]',	'$tmp[13]',

								'$tmp[14]',	'$tmp[15]',
								'$tmp[16]',	'$tmp[17]',
								'$tmp[18]',	'$tmp[19]',
								'$tmp[20]',	'$tmp[21]',
								
								'$tmp[22]',	'$tmp[23]',
								'$tmp[24]',	'$tmp[25]',

								'$tmp[26]',	'$tmp[27]',
								'$tmp[28]',	'$tmp[29]',

								'$tmp[30]',	'$tmp[31]',
								'$tmp[32]',	'$tmp[33]',
								'$tmp[34]',	'$tmp[35]',

								'$tmp[36]',	'$tmp[37]',
								'$tmp[38]',	'$tmp[39]',
								'$tmp[40]',	'$tmp[41]',

								'$tmp[42]',	'$tmp[43]',
								'$tmp[44]',	'$tmp[45]',
								'$tmp[46]',	'$tmp[47]'
								",


								"soaa_reg");
			if($rs_cnt < 1){
				$failed_rs = $i;
			}
	}

	$Delent_cnt = fn_fileupDel($upload_url);

	if( $rs_cnt == 1 && $failed_rs == "" ){
?>
	<script>
	alert("모든 자료가 정상적으로 등록 되었습니다.");
	history.back(-1);
	</script>
<? } else {	?>
	<script>
	alert('<?=$i?>' + "번째 자료에러 오류가 발생 했습니다.");
	</script>
<? }
	
}?>