<?php
session_start();

$zhida = $_SESSION['all_user'];
$zhida_num = $_SESSION['all_user_num'];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>用户列表</title>
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_admin.php'>管理员首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>

<div class="container w3layouts agileits">

    <table>  
        <caption>用户列表</caption>  
        <thead>  
            <tr>  
                <th>真实姓名  
                <th>用户名 
                <th>身份证号
                <th>电话
                <th>信用卡号
                <th>密码
                <th>订单详情
        </thead>  
        <tbody>  


        <?php for ($i=0;$i<$zhida_num;$i++){$row=$zhida[$i]?>
            <tr>  
                <td><?php echo $row[0] ?>
                <td><?php echo $row[1] ?>
                <td><?php echo $row[2] ?>
                <td><?php echo $row[3] ?>
                <td><?php echo $row[4] ?>
                <td><?php echo $row[5] ?>
                <td><?php echo "<a href='a1_admin_detail.php?ticket_num={$i}'>看看TA</a>"?>
        <?php }?>
        </tbody>  
    </table>  
</table>
</div>
</body>
</html>
