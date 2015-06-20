<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?
function nemo_change($var1, $var2, $var3){
	//찾을문자열, 치환할문자열, 대상
	$temp_str	=	str_replace($var1, $var2, $var3);
	return $temp_str;
}
function remove_HTML($obj){
	$tmp_str =	strip_tags($obj);
	return $tmp_str;
}
function str_change($source_str, $destination_str, $str){
	$tmp_str	=	str_replace($source_str, $destination_str, $str);
	return $tmp_str;
}

//임의의 문자열 생성후 리턴
function random_string($length){

	$string = "013456789";
	$string .="abcdefghijklmnopqrstuvwxyz";
	$string .="ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	$string_generated = "";

	//변수로 받은 숫자를 루프 돌림.
	$nmr_loops = $length;

	while($nmr_loops--){

		$string_generated .= $string[mt_rand(0,strlen($string))];
	}
	return $string_generated;
}


//엑셀의 날짜를 DB에 올릴때 날짜 형식 변환
// 421423 -> Y-m-d
function fn_time_convert_EXCEL_to_PHP($time){
	$t=( $time- 25569) * 86400-60*60*9;
	$t=round($t*10)/10;
	return $t;
}


//이미지 파일 업로드
function fn_fileupload($upload_url){
	if ($_FILES["src"]["error"] > 0){
		echo "업로드 파일의 오류입니다.<br>";
		echo "Error: " . $_FILES["src"]['error'];
		exit;
	}else{

	
		$ori_file_name		=	"[" . date('Y-m-d') . "] - " . date('G:i:s') . "_" . $_FILES["src"]["name"];
		$client_file_name	=	$_FILES["src"]["tmp_name"];
		$file_size			=	$_FILES["src"]["size"];

		include "dbconn.php";

		$ftp = ftp_connect($db_host);
		$ftplogin = ftp_login($ftp, $db_user, $db_passwd);

		$ftp_dir = ftp_pwd($ftp);

		$server_file_nm = $upload_url . $ori_file_name;
		$ori_file_name = "/";

//		echo "server_file_nm=".$server_file_nm . "<br>";
		$upload = ftp_put($ftp, $server_file_nm, $client_file_name,FTP_BINARY);

		if($upload ==1){
			$src = str_replace("/www", "", $server_file_nm);
		
		}else{
			echo "업로드 실패";
			ftp_close($ftp);
			exit;

		}
	}

	$ftp_close = ftp_close($ftp);
	return $src;
}

//규격에 맞지 않는 이미지 삭제
function fn_fileupDel($upload_url){
	if ($_FILES["src"]["error"] > 0){
				echo "업로드 파일의 오류입니다.<br>";
				echo "Error: " . $_FILES["src"]['error'];
				exit;
	}else{

		$ori_file_name		=	$_FILES["src"]["name"];
		$client_file_name	=	$_FILES["src"]["tmp_name"];
		$file_size			=	$_FILES["src"]["size"];

		include "dbconn.php";

		$ftp = ftp_connect($db_host);
		$ftplogin = ftp_login($ftp, $db_user, $db_passwd);

		$ftp_dir = ftp_pwd($ftp);

		$server_file_nm = $upload_url . $ori_file_name;
		$ori_file_name = "/";

		$delete =ftp_delete($ftp, $server_file_nm);
		if($delete ==1){
			$src = $delete;
		
		}else{
			echo "파일 삭제 실패";
			ftp_close($ftp);
			exit;

		}
	}

	$ftp_close = ftp_close($ftp);
	return $src;
}
function fn_select($condition, $tbl, $where){
	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;


	if($where){
		$sql .= " WHERE " . $where;
	}

//	echo "<br>fn_select=<br>" . $sql . "<br>";
//	exit;

	$result = mysql_query($sql);
	
	return $result;
}
function fn_select_orderby($condition, $tbl, $orderby){
	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;


	if($orderby){
		$sql .= " ORDER BY  " . $orderby;
	}

//	echo "<br>fn_select_orderby=" . $sql . "<br>";
//	exit;

	$result =	mysql_query($sql);
//	$rs		=	mysql_fetch_array($result);

	return $result;
}
function fn_select_fetch_array($condition, $tbl, $where){
	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;

	if($where){
		$sql .= " WHERE " . $where;
	}

//	echo "select_fetch_array=<br>" . $sql . "<br>";
//	exit;

	$result =	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);
	
	return $rs;
}
function fn_select_fetch_order($condition, $tbl, $orderby){
	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;

	if($orderby){
		$sql .= " order by " . $orderby;
	}

//	echo $sql;
//	exit;

	$result =	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);
	
	return $rs;
}

function fn_select_cnt($condition, $tbl, $where){

	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;
	
	if($where){
		$sql .= " WHERE " . $where;
	}

//	echo "fn_select_cnt=<br>" . $sql . "<br>";
	
	$result =	mysql_query($sql);
	$rs_cnt	=	mysql_num_rows($result);


//	echo "rs_cnt=" . $rs_cnt . "<br>";

	return $rs_cnt;
}
function fn_select_grp($condition, $tbl, $grp){
	$sql =  "SELECT " . $condition;
	$sql .= " FROM " . $tbl;
	$sql .= " GROUP BY  " . $grp;

//	echo "function=" .$sql . "<br>";

	$result =	mysql_query($sql);
	$rs = mysql_fetch_array($result);
	return $rs;
}
function fn_insert($condition, $condition1, $tbl){
	$sql =  "INSERT $tbl($condition) ";
	$sql .= " VALUES($condition1);";

//	echo "fn_insert=<br>" .$sql . "<br>";
//	exit;
//
	$result =	mysql_query($sql);
	if(!$result){
		echo "Error : " . mysql_error() . "<br>";
		echo "Error No : " . mysql_errno() . "<br>";
		exit;
	}

	$rs_cnt =	mysql_affected_rows();
	return $rs_cnt;
}
function fn_update($condition, $tbl, $where){

	$sql = "UPDATE $tbl set ";
	$sql .= "$condition";
	
	if($where){
		$sql .= " WHERE " . $where;
	}

//	echo "fn_update=<br>" .$sql . "<br>";
//	exit;
//
	$result		=	mysql_query($sql);

	if(!$result){
		echo "Error : " . mysql_error() . "<br>";
		echo "Error No : " . mysql_errno() . "<br>";
		exit;
	}

	$rs_cnt		=	mysql_affected_rows();

	return $rs_cnt;
}

function fn_delete($tbl, $condition){
	
	$sql = "DELETE from $tbl ";
	$sql .= "WHERE " . $condition;

//	echo "function=" .$sql . "<br>";
//	exit;

	$result = mysql_query($sql);

	if(!$result){
		echo "Error : " . mysql_error() . "<br>";
		echo "Error No : " . mysql_errno() . "<br>";
		exit;
	}

	$rs_cnt		=	mysql_affected_rows();

	return $rs_cnt;
}

function fn_total_sum($select, $table, $where){
	$sql = "SELECT sum($select) as tot_sum ";
	$sql .= "FROM $table";

	if($where){
		$sql .= " WHERE " . $where;
	}

//echo "fn_total_sum=" .$sql . "<br>";
//exit;

	$result = mysql_query($sql);

	if(!$result){
		echo "Error : " . mysql_error() . "<br>";
		echo "Error No : " . mysql_errno() . "<br>";
		exit;
	}

	$rs_total_sum		=	mysql_fetch_array($result);
	return $rs_total_sum;
}
?>
