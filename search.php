<?php
include 'main.php';
if ($go) {
	$res = mysql_query('SELECT * from `vendors` order by `ven_name`');
	session_start();
	$_SESSION["vname"]=$_GET["vname"];
	$vname = isset($_SESSION["vname"])? $_SESSION["vname"]: 0;
	$_SESSION["mname"]=$_GET["mname"];
	$mname= isset($_SESSION["mname"])? $_SESSION["mname"]: 0;
	$_SESSION["year"]=$_GET["year"];
	$year = isset($_SESSION["year"])? $_SESSION["year"]: 0;
	$_SESSION["n"]=$_GET["n"];
	$n = isset($_SESSION["n"])? $_SESSION["n"]: 1;
	if ($vname) echo "style=\"display: none;\">";
	else{
		echo ">\n";
		while ($pole = mysql_fetch_object($res)){
			echo "<a href=\"search.php?vname=".$pole->ven_name."&mname=0\"><div class=\"motobox\"><img src=\"ven_logos\\".$pole->ven_name.".png\" title=\"".$pole->ven_name."\"></div></a>\n";
		}
	}
	echo "</div>\n";
	if ($vname){
		$res1 = mysql_query('SELECT distinct `motors`.`moto_name` from `motors`, `vendors` where `motors`.`id_ven`=`vendors`.`id_ven` and `vendors`.`ven_name`=\''.$vname.'\' order by `moto_name`');
		echo "<div class=\"ven_view\"><img src=\"ven_logos\\".$vname.".png\"> ".$vname.'</div>';
		echo "<div class=\"main_pole\" style=\"height: 70%;\">\n";
		echo '<ul>';
		while ($pole1 = mysql_fetch_object($res1)) {
			if (!$mname){
				$mname=$pole1->moto_name;
				header("Location:search.php?vname=".$vname."&mname=".$mname);
			}
			echo '<a href="search.php?vname='.$vname.'&mname='.$pole1->moto_name.'"><li ';
			if ($mname==$pole1->moto_name)
				echo "style=\"border: solid #888 3px;\"";
			echo '>'.$pole1->moto_name.'</li></a>';
		}				
		echo '</ul>';
		if($year==0){
			$res2 = mysql_query('select `year` from `motors` where `moto_name`=\''.$mname.'\' order by `year`');
			while($pole2=mysql_fetch_object($res2)){
				$year=$pole2->year;
			}
		}
		$res3=mysql_query('SELECT * from `motors` where `moto_name`= \''.$mname.'\' and `year`=\''.$year.'\'')
		?>
		<div class="spoiler">
			<input type="checkbox" id="spoilerid_1">
				<label for="spoilerid_1">
				<?php echo $mname;?>
				</label>
				<div class="spoiler_body">
					<?php while($pole3=mysql_fetch_object($res3)){ ?>
				<div class="inspoiler"><p>Двигатель:</p><?php echo $pole3->engtype;?></div>
				<div class="inspoiler"><p>Объем:</p><?php echo $pole3->cc2;?> сс<sup>2</sup></div>
				<div class="inspoiler"><p>Мощность:</p><?php echo $pole3->hp;?> лс</div>
				<div class="inspoiler"><p>Макс. скорость:</p><?php echo $pole3->maxs;?> км/ч</div>
				</div>
		</div>
		<?php
		}
		echo '<div class="moto_pic"><img src="moto_pics\\'.strtolower($vname.$mname.$year).$n.'.jpg"></div>';
		echo '<div class="another"><div class="year_box">';
		$res2 = mysql_query('select `year` from `motors` where `moto_name`=\''.$mname.'\' order by `year`');
		while($pole2=mysql_fetch_object($res2)){
			echo "<a href=\"search.php?vname=".$vname."&mname=".$mname."&year=".$pole2->year.'"><div class="butt"';
			if ($pole2->year==$year)
				echo " style=\"font-size: 1.32em;\"";
			echo '>'.$pole2->year.'</div></a>';
		}
		echo '</div></div>';
		echo '<div class="other_pics">';
		$i=1;
		while(file_exists("moto_pics/".strtolower($vname.$mname.$year).$i.'.jpg'))
			$i++;
		for ($j=1; $j<$i; $j++){
			echo "<a href=\"search.php?vname=".$vname."&mname=".$mname."&year=".$year.'&n='.$j."\"><img src=\"moto_pics\\".strtolower($vname.$mname.$year).$j.".jpg\"";
			if ($j==$n)
				echo " style=\"border: solid #888 3px;\"";
			echo '></a>';
		}
		echo '</div></div>';		
	}
	mysql_close($db);
}
include 'footer.php';
?>