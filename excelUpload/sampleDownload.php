<?

//
//	$ftp_server = "localhost";
//	$ftp_user_name = "soaa";
//	$ftp_user_pass = "2013";
//
//	$conn_id = ftp_connect($ftp_server);
//
//	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//
//	$file = __FILE__;  
//
//	echo "파일=" . $file. "<br>";
//
//	$fp = fopen($file, 'w');  
//
//	$ret = ftp_nb_fget($conn_id, $fp, 'public_html/userid/test.php', FTP_BINARY);  
$fileName = "upload_sample_fullData.xls";
$DownloadPath = "../excelDownload/" . $fileName;


Header("Content-Type: file/unknown");
Header("Content-Disposition: attachment; filename=". $fileName);
Header("Content-Length: " . filesize($DownloadPath));
Header("Content-Transfer-encoding: binary");
Header("Pragma: no-cache");
Header("Expires: 0");
flush();
readfile($DownloadPath);


?>
