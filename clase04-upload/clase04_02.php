<?php
	$path = "test.php";
	//$path = "upload_multiple.php";
?>
<!doctype html>
<html>
	<head>
		<title>Subir archivos múltiples con PHP</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<form action="<?php echo $path; ?>" method="post" enctype="multipart/form-data" >
			<input type="file" name="archivo[]" multiple accept="image/*"/> 
			<br/>
			<input type="submit" value="Subir" />
		</form>
	</body>
</html>