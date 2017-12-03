<?php
$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = 'SELECT * FROM nation';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
	echo "\t<tr>\n";
	echo $line['n_name'];
	//foreach ($line as $col_value) {
	//	echo "\t\t<td>$col_value</td>\n";
	//}
	echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);
pg_close($dbconn);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>用户资料显示</title>
</head>
<body>
<form action="a1_trip_test.php" method="get">
 	<input type="submit" value="搜索">
</form>
<br/>
</body>
</html>
