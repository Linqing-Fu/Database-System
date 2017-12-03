<?php
session_start();

$i=$_GET['ticket_num']; 
$huancheng = $_SESSION['huancheng'];
$huancheng_num = $_SESSION['huancheng_num'];
$row=$huancheng[$i];
$trid=$row[0];
$dstopid=$row[1];
$astopid=$row[2];
$seattype=$row[7];
$date=$row[3];

$dbconn = pg_connect("dbname=train user=dbms password=dbms")
    	or die('Could not connect: ' . pg_last_error());

$query = '
select Tickets.Ti_TrID, Tickets.Ti_Sorder, Tickets.Ti_Torder, Tickets.Ti_SDate, V1.V_STime, Tickets.Ti_SStation, 
		Tickets.Ti_TDate, V2.V_TTime, Tickets.Ti_TStation, 
		Tickets.Ti_SeatType, Tickets.Ti_price, Tickets.Ti_price + 5 as totalprice

from Tickets, Via_Station as V1, Via_Station as V2

where Tickets.Ti_TrID = \''.$trid.'\' and 
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SeatType = \''.$seattype.'\' and
	Tickets.Ti_SDate = \''.$date.'\' and
	Tickets.Ti_SStation = \''.$dstopid.'\' and Tickets.Ti_TStation = \''.$astopid.'\' and
	V1.V_Station = Tickets.Ti_SStation and V2.V_Station = Tickets.Ti_TStation;
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$piao_num=2;

$i=0;
$line = pg_fetch_array($result, null, PGSQL_BOTH); 
$piao[$i++]=$line;
////////////////////////////////
$trid=$row[10];
$dstopid=$row[11];
$astopid=$row[12];
$seattype=$row[17];
$date=$row[13];



$query = '
select Tickets.Ti_TrID, Tickets.Ti_Sorder, Tickets.Ti_Torder, Tickets.Ti_SDate, V1.V_STime, Tickets.Ti_SStation, 
		Tickets.Ti_TDate, V2.V_TTime, Tickets.Ti_TStation, 
		Tickets.Ti_SeatType, Tickets.Ti_price, Tickets.Ti_price + 5 as totalprice

from Tickets, Via_Station as V1, Via_Station as V2

where Tickets.Ti_TrID = \''.$trid.'\' and 
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SeatType = \''.$seattype.'\' and
	Tickets.Ti_SDate = \''.$date.'\' and
	Tickets.Ti_SStation = \''.$dstopid.'\' and Tickets.Ti_TStation = \''.$astopid.'\' and
	V1.V_Station = Tickets.Ti_SStation and V2.V_Station = Tickets.Ti_TStation;
	';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$line = pg_fetch_array($result, null, PGSQL_BOTH); 
$piao[$i++]=$line;




$_SESSION['piao'] = $piao;
$_SESSION['piao_num']=$piao_num;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>购票</title>
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_book.php'>".$_SESSION['name']."的订单</a>"?>
            <?php echo "<a href='a1_mainpage.php'>首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>
<div class="container w3layouts agileits">
    <table>  
        <caption>购票信息</caption>  
        <thead>  
            <tr>  
                <th>列车号  
                <th>起点站  
                <th>终点站
                <th>座位类型 
                <th>出发日期
                <th>出发时间
                <th>到达日期 
                <th>到达时间  
                <th>票价（元）  
        </thead>  
        <tbody>  

        <?php for ($i=0;$i<$piao_num;$i++){$row=$piao[$i]?>
            <tr>  
                <td><?php echo $row['ti_trid'] ?>
                <td><?php echo $row['ti_sstation'] ?>
                <td><?php echo $row['ti_tstation'] ?>
                <td><?php echo $row['ti_seattype'] ?>
                <td><?php echo $row['ti_sdate'] ?>
                <td><?php echo $row['v_stime'] ?>
                <td><?php echo $row['ti_tdate'] ?>
                <td><?php echo $row['v_ttime'] ?>
                <td><?php echo $row['totalprice'] ?>
        <?php }?>
        </tbody>  
    </table>  
</trip>
    <?php echo "<a href='a1_confirm.php?ticket_num={$i}'>买买买！</a>"?>
</body>
</html>

