<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>chanchush</title>
</head>
<body>



<?php
session_start();

$piao=$_SESSION['myorders'];


$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

for ($i=0;$i<1;$i++){


	$row=$piao[$i];
	$query = '
update User_Order
set O_status = \'canceled\'
where O_ID = \''.$row[0].'\';
	';

	pg_query($query) or die('Query failed: ' . pg_last_error());

	$query = '
update Tickets
set Ti_quantity = Ti_quantity + 1
where 
	Tickets.Ti_TrID = \''.$row[1].'\' and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = \''.$row[1].'\' and Tickets.Ti_SStation = \''.$row[3].'\' and Tickets.Ti_TStation = \''.$row[Z4].'\') 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = \''.$row[1].'\' and Tickets.Ti_SStation = \''.$row[3].'\' and Tickets.Ti_TStation = \''.$row[4].'\')) and
	Tickets.Ti_SeatType = \''.$row[5].'\' and Tickets.Ti_SDate = \''.$row[2].'\';
	';
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
}
?>

	<p>取消啦！！！</p>
        <a href='a1_mainpage.php'>返回首页</a>
</body>
</html>


