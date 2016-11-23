<?php
	switch (basename($_SERVER["SCRIPT_FILENAME"], '.php')){
		case 'index': $pagename="Главная";
						break;
		case 'search': $pagename="Поиск";
						break;
		case 'help': $pagename="Помощь";
						break;	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $pagename ?> - 2WD</title>
	<link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="menu">
		<a href="index.php" title="На главную"><div class="header"><img src="icons/moto.png"></div></a>
		<a href="search.php" title="Поиск"><div class="butt"><img src="icons/search.png"></div></a>
		<a href="help.php" title="Как пользоваться сайтом"><div class="butt"><img src="icons/how-to.png"></div></a>
	</div>
	<div class="main_pole"
<?php
	if ($db = @mysql_connect("localhost", "root", "")) {
		mysql_select_db("motorcycles");
		mysql_query("SET NAMES utf8");
		$go=1;
	}
	else {
		$go=0;
		echo "Не удалось установить подключение к базе данных";
	}
?>
