<?php
$hostname ='localhost';
$username ='root';
$senha ='';
$banco ='saboresdomundo';
$db = @mysqli_connect($hostname,$username,$senha,$banco) or die (@mysql_error());
@mysqli_select_db($banco, $db);
?>

