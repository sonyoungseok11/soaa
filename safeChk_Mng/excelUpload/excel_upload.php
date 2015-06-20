<!doctype html>
<html lang="ko">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<?

$name = $_POST["name"];
$mobile = $_POST["mobile"];
?>
<form name="form" method="post" enctype="multipart/form-data" action="./excel_proc.php">
	<table>
		<tr>
			<td>이름<input type="text" name="name" value="<?=$name?>"></td>
			<td>이름<input type="text" name="mobile" value="<?=$mobile?>"></td>
			<td>파일<input type="file" name="src"></td>
			<td><input type="submit" value="전송"></td>
		</tr>
	</table>
</form>
</body>
</html>