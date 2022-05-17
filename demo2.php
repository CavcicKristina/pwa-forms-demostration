<?php
include "config.php";
$instance = Connection::link();
$conn = $instance->getConnection();

$sqlMsg = "";
$displayMsg = "";
$displayClass = "";
$data = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fruit = $_POST['var1'];
    $sql = "SELECT * FROM fruits WHERE name = '$fruit';";
    mysqli_multi_query($conn, $sql);
    $result = mysqli_store_result($conn);
    if($result == false) $sqlMsg = "SQL Query: ".$sql;
    elseif($result->num_rows < 1) {
        $sqlMsg = "SQL Query: ".$sql;
        $displayMsg = "There is no such fruit.";
        $displayClass = "displayerr";
    } else {
        $sqlMsg = "SQL Query: ".$sql;
        $displayMsg = "Login successful.";
        $displayClass = "displaygood";
        while($row = $result->fetch_assoc()) $data = $row;
    }
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

    <?php if(!empty($data)){ ?>
        <div class="displayfruit">
            <h4><?=$data['name']?></h4>
            <p><?=$data['content']?></p>
        </div>
    <?php } ?>
    

    <form action="demo2.php" method="post">
        <?php if($displayClass == "displayerr"){?>
                <h4 class="<?=$displayClass?>"><?=$displayMsg?></h4>
            <?php }elseif(empty($displayClass)){?>
        <?php }?>
        <h4>Deleting data from table</h4>
        <input type="text" name="var1" placeholder="Enter Fruit">
        <input type="submit" value="Submit" class="submit">
    </form>

    <?php if(!empty($sqlMsg)){?>
        <div class="sqlMsgInjection">
            <p><?=$sqlMsg?></p>
        </div>
    <?php }?>
    
    
</body>
</html></h1>
    
</body>
</html>