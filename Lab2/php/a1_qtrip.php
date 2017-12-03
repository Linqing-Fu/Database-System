<?php
session_start();

$chufa_c=$_POST['chufa_c'];
$daoda_c=$_POST['daoda_c'];
if ($_POST['chufa_r'])
	$chufa_r=$_POST['chufa_r'];
else 
	$chufa_r='2017-12-01';

if ($_POST['chufa_s'])
	$chufa_s=$_POST['chufa_s'];
else 
	$chufa_s='00:00';

$huancheng=$_POST['checkbox'];
$fancheng=$_POST['checkbox2'];

if($fancheng[0]) {
	$chufa_c=$_POST['daoda_c'];
	$daoda_c=$_POST['chufa_c'];
	$chufa_s='00:00';
	$chufa_r=$_POST['chufa_r'];
	$chufa_r[9] = strval(intval($chufa_r[9])+1);
	
}

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());


if($huancheng[0]){
	$query = '
select T1.Ti_TrID, T1.Ti_SStation, T1.Ti_TStation, T1.Ti_SDate, V1.V_STime, T1.Ti_TDate, V2.V_TTime,
		T1.Ti_SeatType, T1.Ti_quantity, T1.Ti_price,

		T2.Ti_TrID, T2.Ti_SStation, T2.Ti_TStation, T2.Ti_SDate, V3.V_STime, T2.Ti_TDate, V4.V_TTime,
		T2.Ti_SeatType, T2.Ti_quantity, T2.Ti_price,
		(T1.Ti_price + T2.Ti_price) as pricesum 

from Tickets as T1, Tickets as T2,
	Station as S1, Station as S2, Station as S3, Station as S4,
	Via_Station as V1, Via_Station as V2, Via_Station as V3, Via_Station as V4

where S1.S_city = \''.$chufa_c.'\' and S4.S_city = \''.$daoda_c.'\' and 
	T1.Ti_SDate = \''.$chufa_r.'\' and V1.V_STime >= \''.$chufa_s.'\' and
	
	T1.Ti_TrID = V1.V_TID and T1.Ti_TrID = V2.V_TID and
	T2.Ti_TrID = V3.V_TID and T2.Ti_TrID = V4.V_TID and
	T1.Ti_SStation = S1.S_name and T1.Ti_TStation = S2.S_name and
	T2.Ti_SStation = S3.S_name and T2.Ti_TStation = S4.S_name and
	
	S2.S_city = S3.S_city and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	V3.V_Station = S3.S_name and V4.V_Station = S4.S_name and
	T1.Ti_quantity > 0 and 
	T2.Ti_quantity > 0 and 


	((T2.Ti_SDate = T1.Ti_TDate and V3.V_STime - V2.V_TTime <= \'04:00:00\' and
	      (S2.S_ID  = S3.S_ID and V3.V_STime - V2.V_TTime >= \'01:00:00\'
		or S2.S_ID != S3.S_ID and V3.V_STime - V2.V_TTime >= \'02:00:00\'))

	or

	(T2.Ti_SDate > T1.Ti_TDate and  V3.V_STime < V2.V_TTime and V3.V_STime - V2.V_TTime <= \'04:00:00\'  and
		  (S2.S_ID  = S3.S_ID and V3.V_STime  - V2.V_TTime >= \'01:00:00\'
		or S2.S_ID != S3.S_ID and V3.V_STime  - V2.V_TTime >= \'02:00:00\')))
	order by pricesum asc
        limit 10;
	';
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$huancheng_num=pg_num_rows($result);
	$i = 0;

	while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
		$huancheng[$i++]=$line;
	}
	$_SESSION['huancheng']=$huancheng;
	$_SESSION['huancheng_num'] = $huancheng_num;
	header("refresh:0;url=a1_dis_trip2.php");
	exit;
}
else{
	$query = '
	select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
			Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price, Tickets.Ti_SDate, Tickets.Ti_TDate
	from Tickets, Station as S1, Station as S2, Via_Station as V1, Via_Station as V2
	where S1.S_city = \''.$chufa_c.'\' and S2.S_city = \''.$daoda_c.'\' and 
		Tickets.Ti_SStation = S1.S_name and Tickets.Ti_TStation = S2.S_name and
		Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
		Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
		Tickets.Ti_SDate = \''.$chufa_r.'\' and V1.V_STime >= \''.$chufa_s.'\' and
		V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
		Tickets.Ti_quantity > 0 
	order by Tickets.Ti_price asc
	limit 10;
	';
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$zhida_num=pg_num_rows($result);
	$i = 0;

	while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
		$zhida[$i++]=$line;
	}

	$_SESSION['zhida']=$zhida;
	$_SESSION['zhida_num'] = $zhida_num;

	header("refresh:0;url=a1_dis_trip.php");

	exit;
}
?>

