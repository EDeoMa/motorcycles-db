<?php
	include 'main.php';
	echo ">";
	if ($go) {
		$res = mysql_query('SELECT * from `news` where `news_id`=0');
		while ($pole = mysql_fetch_object($res)){
			echo "<div class=\"welcome\">";
			echo "<div class=\"wtitle\">".$pole->news_title.'</div><img src="news_pics\\'.$pole->news_id.'.jpg"><div class="text"><p>'.$pole->news_text.'</p></div>';
			echo "<h2>В первый раз? Щёлкай на вопрос!</h2></div>";
		}

	}
	echo "</div>";
	include 'footer.php';
?>
</body>
</html> 