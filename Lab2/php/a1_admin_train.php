<?php
session_start();

$zhida = $_SESSION['hot_train'];
$zhida_num = $_SESSION['hot_train_num'];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/table.css" type="text/css" media="all">
<title>热门路线</title>
</head>
<body>

 	 <div class="nav"> 
            <?php echo "<a href='a1_admin.php'>管理员首页</a>"?>
            <?php echo "<a href='a1_index.html'>注销</a>"?>
 	</div>
<div class="container w3layouts agileits">
    <table>  
        <caption>热门路线</caption>  
        <thead>  
            <tr>  
                <th>车次号
        </thead>  
        <tbody>  


        <?php for ($i=0;$i<$zhida_num;$i++){$row=$zhida[$i]?>
            <tr>  
                <td><?php echo $row[0] ?>
        <?php }?>
        </tbody>  
    </table>  
</table>
</div>
</body>
</html>
