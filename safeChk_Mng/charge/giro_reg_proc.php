<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$input_money_date	=	$_POST['input_money_date'];	//입금일자
	$gu_office	=	$_POST['gu_office'];	//구청
	$check_pay	=	$_POST['check_pay'];	//금액
	$c_corp_nm	=	$_POST['c_corp_nm'];	//업소
	$c_ceo_nm	=	$_POST['c_ceo_nm'];		//업소
	$c_tel		=	$_POST['c_tel'];		//연락처

	$insert_date = date('Y-m-d-G:i:s');
	$insert_id	=	$_SESSION['id'];

	$check_pay_cnt	=	count($check_pay);


	for($i=0; $i<$check_pay_cnt; $i++){
		//넘어온 20개의 데이터중 금액을 넣은 실제 데이터만 루프돌림.
		if($check_pay[$i] == ""){
			continue;
		}

		$check_pay[$i]	=	str_replace(",", "", $check_pay[$i]);
		$input_pay_type = explode($i+1 . "_", $_POST[$i+1 . "_input_pay_type"][0]);	//입금구분		
		//echo "일자=" . $input_money_date[$i] . "----" . "입금 구분=" .$input_pay_type[0] . "----" . "구청=" .$gu_office[$i] . "-------" . "금액=" . $check_pay[$i] . "<br>";
		

		//이름을 왼쪽부터 2글자만 가져옴
		$tmp_c_ceo_nm[$i] = mb_substr($c_ceo_nm[$i], 0, 2, "utf-8");
	
		//회사명의 전체 글자수를 utf-8로 읽어서 전체 개수 나누기 2 한후, 왼쪽부터 갯수만큼 읽어옴
		//ex) 사단법인우주항공협력계열자치단체 -> 사단법인우주항공
		$tmp_c_corp_len		=	mb_strlen($c_corp_nm[0], "utf-8") ;
		$tmp_c_corp_nm[$i]	=	mb_substr($tmp_c_corp_nm[0], 0, ($tmp_c_corp_len/2), "utf-8");

		//신청자, 업체이름, 설치구, 신청일로부터 2년이내로 검색
		//이름은 왼쪽부터 2글자
		//업체명은 전체글자수 / 2 개수를 왼쪽부터. (ex 롯데타워업무시설관리 -> 롯데타워업
		$result = fn_select_fetch_array("reg_no, c_ceo_nm, c_corp_nm",
										"soaa_reg_check",
										"c_ceo_nm like '$tmp_c_ceo_nm[$i]%' and c_corp_nm like '$tmp_c_corp_nm[$i]%' and
										gu_office='$gu_office[$i]' and now() <= date_add(reg_date, interval 2 year)");

		//입금한 데이터는 1차적으로 무조건 입금 입력 목록으로 insert
		$giro_idx	=	fn_select_fetch_order("idx", "giro_list", "idx desc");
		$giro_idx	=	$giro_idx['idx'] +1;

		$giro_list_rs	=	fn_insert("idx, c_ceo_nm,	
								c_corp_nm,	
								gu_office,	
								chk_pay,	
								c_tel,
							   input_date,		
							   input_pay_type,	
							   matching_yn, 
							   insert_id,		
							   insert_date",

								"'$giro_idx', 
								'$c_ceo_nm[$i]',	
								'$c_corp_nm[$i]', 
								'$gu_office[$i]',
								'$check_pay[$i]', 
								'$c_tel[$i]',
							   '$input_money_date[$i]', 
							   '$input_pay_type[0]', 
							   'ALL', 
							   '$insert_id',
							   now()",

								"giro_list");


		//접수된 데이터이며 신청자,업체이름,설치구,신청일 조건이 맞으면 확인리스트(tbl:confirm_list)에 insert
		if($result['c_ceo_nm'] || $result['c_corp_nm']){

		$con_idx	=	fn_select_fetch_order("idx", "confirm_list", "idx desc");
		$con_idx	=	$con_idx['idx'] +1;

		$con_list_rs	=	fn_insert("idx,				c_ceo_nm,
										c_corp_nm,		gu_office,
										chk_pay,		c_tel,
										input_date,		input_pay_type,
										matching_yn,	insert_id,
										insert_date",

										"'$con_idx', 			'$c_ceo_nm[$i]',	
										'$c_corp_nm[$i]', 		'$gu_office[$i]',
										'$check_pay[$i]', 		'$c_tel[$i]',
										'$input_money_date[$i]','$input_pay_type[0]', 
										'Y',					'$insert_id',
										now()",

										"confirm_list"
									);
			$rs0	=	fn_update("chk_pay='$check_pay[$i]'", "soaa_reg_check", "reg_no='" . $result['reg_no'] . "'");
		}else{
		//만일 접수된 데이터와 입력한 데이터의 매칭 안되면 미확인리스트(no_confirm_list)에 insert
			$no_con_idx	=	fn_select_fetch_order("idx", "no_confirm_list", "idx desc");
			$no_con_idx	=	$no_con_idx['idx'] +1;

			$rs1	=	fn_insert("idx, c_ceo_nm,			c_corp_nm,		gu_office,		chk_pay,		c_tel,
									input_date, input_pay_type,		insert_id,		insert_date",

									"'$no_con_idx','$c_ceo_nm[$i]',	'$c_corp_nm[$i]', '$gu_office[$i]','$check_pay[$i]', '$c_tel[$i]',
									'$input_money_date[$i]','$input_pay_type[0]','$insert_id', now()",

									"no_confirm_list");
		}
	}

	echo "<script>
			alert(\"저장되었습니다.\");
			location.href=\"./giro_reg.php\";
	      </script>
	
	";
?>