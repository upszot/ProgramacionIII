<?php
	//$path = "test.php";
	$path = "upload.php";
?>
<!doctype html>
<html>
	<head>
		<title>Subir archivos con PHP</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<form action="<?php echo $path; ?>" method="post" enctype="multipart/form-data" >
			<input type="file" name="archivo" /> 
			<br/>
			<input type="submit" value="Subir" />
		</form>
	</body>
</html>