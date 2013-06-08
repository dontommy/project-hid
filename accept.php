<?php include('connec.php'); ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>ADMIN PAGE</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="robots" content="index,follow" />
</head>
<body>
    <div id="container">
    <h1>ADMIN PAGE</h1>
    <?php include('header.php'); ?>
<center>
    <h2>WHO WANNA GET IN?</h2>
    <table width="400">
        <?php
    $sql = "SELECT * FROM pics WHERE isaccept = 0 ORDER BY id";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $pic = $row['picturename'];
        $id = $row['id'];
        $thetime = date('H:i d-m-Y',$row['thetime']);
        echo "<tr><td width=200><img src='uploads/thumbs/$pic'><br />$thetime</td>";
        echo "<td width=200><a href='?id=$id&a=1'>ACCEPT</a><br /><br /><a href='?id=$id&a=2'>BLOCK</a></td>";
        
    }
    
    
    ?>
    </table>
    
    <br /><br />
    <h2>WHO WAS ACCEPTED?</h2>
        <table width="400"><tr>
        <?php
        $thecount = 0;
    $sql = "SELECT * FROM pics WHERE isaccept = 1 ORDER BY id";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $pic = $row['picturename'];
        $id = $row['id'];
        $thecount++;
        $thetime = date('H:i d-m-Y',$row['thetime']);
        echo "<td width=200><img src='uploads/thumbs/$pic'><br />$thetime</td>";
        if($thecount == 4) {
            echo "</tr>";
            $thecount = 0;
        }
        
    }
    
    
    ?>
    </table>
    
    <br /><br />
    <h2>WHO WAS BLOCKED?</h2>
        <table width="400"><tr>
        <?php
        $thecount = 0;
    $sql = "SELECT * FROM pics WHERE isaccept = 2 ORDER BY id";
    $result = $objconn->query($sql);
    while($row = $result->fetch_assoc()) {
        $pic = $row['picturename'];
        $id = $row['id'];
        $thecount++;
        $thetime = date('H:i d-m-Y',$row['thetime']);
        echo "<td width=200><img src='uploads/thumbs/$pic'><br />$thetime</td>";
        if($thecount == 4) {
            echo "</tr>";
            $thecount = 0;
        }
        
    }
    
    
    ?>
    </table>
    
    <br /><br />
    </div>
    <?php
    if(isset($_GET['id'])) {
        $theid = $_GET['id'];
        $a = $_GET['a'];
        $sql = "UPDATE pics SET isaccept = '$a' WHERE id = '$theid'";
        $result = $objconn->query($sql);
        header("Location: accept.php");
    }
    
    ?>
    
</body>
</html>
