<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
		$idx			=	$_POST['idx'];

		$input_date		=	$_POST['input_date'];		//입금일자
		$refund_nm		=	$_POST['refund_nm'];		//환불자성명
		$refund_date	=	$_POST['refund_date'];		//환불일자
		$rf_payment		=	str_replace(",", "", $_POST['check_pay']);	//환불금액
		$memo1			=	$_POST['memo1'];			//환불이유

//		$where			=	$_POST['where'];			//환불이유
		
		$rs		=	fn_select_fetch_array("*", "giro_list", "idx='$idx'");
		$giro_idx	=	$rs['idx'];
		$c_ceo_nm	=	$rs['c_ceo_nm'];
		$c_corp_nm	=	$rs['c_corp_nm'];
		$gu_office	=	$rs['gu_office'];
		$chk_pay	=	$rs['chk_pay'];
		$input_date	=	$rs['input_date'];
		$input_pay_type	=	$rs['input_pay_type'];

		//입금입력 목록 업데이트.
		$field	=	" input_pay_type_result = 'refund' ";
		$tbl	=	"giro_list";
		$where	=	"idx='$idx'";

		$giro_rs	=	fn_update($field, $tbl, $where);

		//환불입력 목록 추가
		$field	=	"
						idx,		-- //idx
						c_ceo_nm,	-- //성명<br>
						refund_nm,	-- //환불자명<br>
						c_corp_nm,	-- //업체명<br>
						gu_office,	-- //해당구<br>
						chk_pay,	-- //원래 입금액<br>
						rf_payment,	-- //환불금액<br>
						input_pay_type,-- //통장지로구분<br>
						input_payment_date,-- //입금날짜<br>
						refund_date,-- //환불날짜<br>
						memo1,		-- //환불이유<br>
						insert_id,   -- //관리자<br>
						insert_date   -- //추가한 날짜<br>
					";
		$data	=	"
						'$giro_idx',	-- //idx<br>
						'$c_ceo_nm',	-- //성명<br>
						'$refund_nm',			-- //환불자명<br>
						'$c_corp_nm',	-- //업체명<br>
						'$gu_office',	-- //해당구<br>
						'$chk_pay',		-- //원래 입금액<br>
						'$rf_payment',		-- //환불금액<br>
						'$input_pay_type',-- //통장지로구분<br>
						'$input_date',		-- //입금날짜<br>
						'$refund_date',		-- //환불날짜<br>
						'$memo1',			-- //환불이유<br>
						'soaa',				-- //관리자<br>
						'now()'				-- //추가한 날짜<br>

					";
		$tbl	=	"return_list";

		$return_rs	=	fn_insert($field, $data, $tbl);

	if($giro_rs > 0 && $return_rs > 0){
		echo "
				<script>
				alert(\"저장 되었습니다.\");
				location.href=\"./giro_list.php\";
				self.close();
				</script>
			";
	}
?>