<?php
include "config.php";
$instance = Connection::link();
$conn = $instance->getConnection();

$sqlMsg = "";
$displayMsg = "";
$displayClass = "";

$data = [];
$sql = "SELECT * FROM drinks";
$result = mysqli_query($conn, $sql);
while($row = $result->fetch_assoc()) $data[] = $row;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $drink = $_POST['var1'];
    $sql = "INSERT INTO drinks (name) VALUES ('$drink')";
    mysqli_query($conn, $sql);
    header("Refresh:0;");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PWA Form</title>
</head>
<body>

    <nav>
        <a href="index.php" class="navigation">SQL Injection - Forced login</a>
        <a href="demo2.php" class="navigation">SQL Injection - Delete data</a>
        <a href="demo3.php" class="navigation">Code Injection</a>
    </nav>

    <?php if(!empty($data)){?>
        <ol class="displaydrinks">
        <?php foreach($data as $drink){ ?>
            <li><?=$drink['name']?></li>
        <?php } ?>
        </ol>
    <?php } ?>
    

    <form action="demo3.php" method="post">
        <h4>Code Injection</h4>
        <input type="text" name="var1" placeholder="Enter drink">
        <input type="submit" value="Submit" class="submit">
    </form>
    
    
</body>
</html></h1>
    
</body>
</html>