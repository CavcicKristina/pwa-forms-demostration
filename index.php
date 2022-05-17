<?php
include "config.php";
$instance = Connection::link();
$conn = $instance->getConnection();

$stmt = $conn->prepare("SELECT * FROM `users`");
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while($row = $result->fetch_assoc()) $data[] = $row;
/* password_hash("wewe",PASSWORD_BCRYPT) */
$sqlMsg = "";
$displayMsg = "";
$displayClass = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $sql = "SELECT * FROM users WHERE username = '".$_POST['var1']."' AND password = '".$_POST['var2']."'";
    $result = mysqli_query($conn, $sql);
    if($result == false) $sqlMsg = "SQL Query: ".$sql;
    elseif($result->num_rows < 1) {
        $sqlMsg = "SQL Query: ".$sql;
        $displayMsg = "Wrong username or password.";
        $displayClass = "displayerr";
    } else {
        $sqlMsg = "SQL Query: ".$sql;
        $displayMsg = "Login successful.";
        $displayClass = "displaygood";
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

    <div class="phpoutput">
        <?php
        //foreach($data as $dat) echo "<p> id:".$dat['id']."<br/> username:".$dat['username']."<br/> password:".$dat['password']."<br/></p><br/><br/>";
        ?>
    </div>
    

    <form action="index.php" method="post">
        <?php if($displayClass == "displaygood" || $displayClass == "displayerr"){?>
            <h4 class="<?=$displayClass?>"><?=$displayMsg?></h4>
        <?php }elseif(empty($displayClass)){?>
        <?php }?>

        <h4>Forced Login</h4>
        <input type="text" name="var1" placeholder="Username">
        <input type="text" name="var2" placeholder="Password">
        <input type="submit" value="Submit" class="submit">
    </form>

    <?php if(!empty($sqlMsg)){?>
        <div class="sqlMsgInjection">
            <p><?=$sqlMsg?></p>
        </div>
    <?php }?>
    
    
</body>
</html>