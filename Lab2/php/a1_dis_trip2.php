<?php
session_start();

$huancheng = $_SESSION['huancheng'];
$huancheng_num = $_SESSION['huancheng_num'];
 
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>候选车次</title>
</head>
<body>
 	 <div class="nav"> 
            <?php echo "<a href='a1_book.php'>".$_SESSION['name']."的订单</a>"?>
            <?php echo "<a href='a1_mainpage.php'>首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>

<div class="container w3layouts agileits">
    <table>  
        <caption>候选车次</caption>  
        <thead>  
            <tr>  
                <th>首班列车号  
                <th>首班起点站  
                <th>首班终点站 
                <th>首班出发日期
                <th>首班出发时间  
                <th>首班到达日期
                <th>首班到达时间  
                <th>首班座位类型  
                <th>首班余票（张）
                <th>首班票价（元）  
                <th>换乘列车号  
                <th>换乘起点站  
                <th>换乘终点站 
                <th>换乘出发日期
                <th>换乘出发时间  
                <th>换乘到达日期
                <th>换乘到达时间  
                <th>换乘座位类型  
                <th>换乘余票（张）
                <th>换乘票价（元）  
                <th>总价（元）  
        </thead>  
        <tbody>  


        <?php for ($i=0;$i<$huancheng_num;$i++){$row=$huancheng[$i]?>
            <tr>  
                <td><?php echo $row[0] ?>
                <td><?php echo $row[1] ?>
                <td><?php echo $row[2] ?>
                <td><?php echo $row[3] ?>
                <td><?php echo $row[4] ?>
                <td><?php echo $row[5] ?>
                <td><?php echo $row[6] ?>
                <td><?php echo $row[7] ?>
                <td><?php echo $row[8] ?>
                <td><?php echo $row[9] ?>
                <td><?php echo $row[10] ?>
                <td><?php echo $row[11] ?>
                <td><?php echo $row[12] ?>
                <td><?php echo $row[13] ?>
                <td><?php echo $row[14] ?>
                <td><?php echo $row[15] ?>
                <td><?php echo $row[16] ?>
                <td><?php echo $row[17] ?>
                <td><?php echo $row[18] ?>
                <td><?php echo $row[19] ?>
                <td><?php echo "<a href='a1_buy_trip2.php?ticket_num={$i}'>".$row[20]."</a>"?>
        <?php }?>


        </tbody>  
    </table>  
</div>
</table>
</body>
</html>
