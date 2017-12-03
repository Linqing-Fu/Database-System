<?php
session_start();

$trainid=$_POST['checi'];
if ($_POST['riqi'])
	$_SESSION['buydate']=$_POST['riqi'];
else
	$_SESSION['buydate']='2017-12-01';
$_SESSION['buytrid']=$_POST['checi'];

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = 
'select  Via_Station.V_order, Via_Station.V_Station,  Via_Station.V_STime, Via_Station.V_TTime,
		Via_Station.V_hard_price, 
		Via_Station.V_soft_price, 
		Via_Station.V_hard_up_price, 
		Via_Station.V_hard_mid_price, 
		Via_Station.V_hard_dw_price,
		Via_Station.V_soft_up_price, 
		Via_Station.V_soft_dw_price
from Via_Station
where 
	Via_Station.V_TID =  \''.$trainid.'\'

order by Via_Station.V_order asc;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$totalnum=pg_num_rows($result);
$i = 0;

while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
	$train[$i++]=$line;
}

$_SESSION['train']=$train;
$_SESSION['totalnum'] = $totalnum;

header("refresh:0;url=a1_dis_train.php");

exit;
?>


