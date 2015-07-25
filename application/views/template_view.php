<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Document</title>
		<link rel="stylesheet" href="<?=$data['conf']->addres?>/css/style.css"  type="text/css" />
	</head>
	<body>
		<?php include 'application/views/'.$content_view; ?>
		<script src="<?=$data['config']->addres?>/js/jquery.js"></script>
		<script src="<?=$data['config']->addres?>/js/main.js"></script>
	</body>
</html>

