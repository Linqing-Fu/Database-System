<?php
header("Content-type: text/html; charset=utf-8");
session_start();

$i=$_GET['ticket_num']; 
$train = $_SESSION['train'];
$row=$train[$i];

$chufa_c=$_SESSION['chufa_c'];
$daoda_c=$row[1];
$chufa_r=$_SESSION['buydate'];
$chufa_s='00:00';


$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());



	$query = '
	select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
			Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price, Tickets.Ti_SDate, Tickets.Ti_TDate
	from Tickets, Via_Station as V1, Via_Station as V2
	where 
		Tickets.Ti_SStation = \''.$chufa_c.'\' and Tickets.Ti_TStation = \''.$daoda_c.'\' and
		Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and 
                Tickets.Ti_TrID = \''.$_SESSION['buytrid'].'\' and
		Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
		Tickets.Ti_SDate = \''.$chufa_r.'\' and V1.V_STime >= \''.$chufa_s.'\' and
		V1.V_Station = Tickets.Ti_SStation and V2.V_Station = Tickets.Ti_TStation and
		Tickets.Ti_quantity > 0 
	order by Tickets.Ti_price asc
	limit 10;
	';
	
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$zhida_num=pg_num_rows($result);
	echo $zhida_num;
	$i = 0;

	while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
		$zhida[$i++]=$line;
	}

	$_SESSION['zhida']=$zhida;
	$_SESSION['zhida_num'] = $zhida_num;
	header("refresh:0;url=a1_dis_trip.php");
	exit;
?>



