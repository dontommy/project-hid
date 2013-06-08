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
    <h2>ADD PINCODE</h2>
    
    <form action="" method="POST">
        <label for="pin">Add Pincode:</label><input type="password" name="pin" id="pin"><br /><br />
        <input type="submit" name="submit" class="submit" value="Insert Pincode">
        
        
    </form>
    <br /><br />
    
    <?php
    if(isset($_POST['submit'])) {
        $pin = md5($_POST['pin']);
        
        $sql = "INSERT INTO pincodes (pincode) VALUES ('$pin')";
        $result = $objconn->query($sql);
        echo "Pincode Added!";
    }
    
    
    ?>
    
    
    <br /><br />
    
    <form action="" method="POST">
        <input type="submit" name="clean" value="Flush Cookie" class="submit">

    </form>
    
    <?php
    if(isset($_POST['clean'])) {
        setcookie('dtwebcam', "tjek", time() - (60*60*24*30));
        setcookie('dtcount', "0", time() - (60*60*24*30));
        header("Location: accept.php");
        
    }
    
    ?>
    </div>
</body>
</html>
