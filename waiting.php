<?php
session_start();
include('connec.php');
$theid = $_SESSION['theid'];
$sql = "SELECT isaccept FROM pics WHERE id = '$theid'";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) {
    $isaccept = $row['isaccept'];
}
if($isaccept == 1) {
    header("Location: in.php");
}
if($isaccept == 2) {
    header("Location: out.php"); 
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Waiting</title>
    <meta name="robots" content="index,follow" />
    <meta http-equiv="refresh" content="1;url=waiting.php" />
</head>
<body>
    <div id="container">
    <h1>WAITING FOR ACCEPTENCE</h1>
    </div>
</body>
</html>
