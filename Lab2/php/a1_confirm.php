<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>购票成功</title>
</head>
<body>



<?php
session_start();

$piao=$_SESSION['piao'];
$piao_num=$_SESSION['piao_num'];

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

for ($i=0;$i<$piao_num;$i++){


	$row=$piao[$i];
        $orderid=mktime()+$i;
	$query = '
	insert into User_Order
	values (\''.$orderid.'\',\''.$row['ti_trid'].'\',\''.$row['ti_sstation'].'\',\''.$row['ti_tstation'].'\',\''.$row['ti_seattype'].'\',\''.$row['totalprice'].'\', \''.$row['v_stime'].'\',\''.$row['ti_sdate'].'\', \''.$row['v_ttime'].'\', \''.$row['ti_tdate'].'\', \''.$_SESSION['u_id'].'\', \'confirmed\');
	';

	pg_query($query) or die('Query failed: ' . pg_last_error());

	$query = '
update Tickets
set Ti_quantity = Ti_quantity - 1
where 
	Tickets.Ti_TrID = \''.$row['ti_trid'].'\' and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = \''.$row['ti_trid'].'\' and Tickets.Ti_SStation = \''.$row['ti_sstation'].'\' and Tickets.Ti_TStation = \''.$row['ti_tstation'].'\') 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = \''.$row['ti_trid'].'\' and Tickets.Ti_SStation = \''.$row['ti_sstation'].'\' and Tickets.Ti_TStation = \''.$row['ti_tstation'].'\')) and
	Tickets.Ti_SeatType = \''.$row['ti_seattype'].'\' and Tickets.Ti_SDate = \''.$row['ti_sdate'].'\';
	';

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
}

?>



	<p>剁手成功！！！</p>
        <a href='a1_mainpage.php'>返回首页</a>
</body>
</html>


