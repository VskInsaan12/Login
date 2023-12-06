<?php 


 require "../private/autoload.php";

 $user_data = check_login($connection);

    $username = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VskInsaan | Official Site</title>
        <link rel="icon" type="image/x-icon" href="../private/channel.ico">
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="Default page" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <br>
    <div id="header">
        <?php if(username != ""): ?>

    |<br><br>

    <div><h1>Hi <?=$_SESSION['username']?></h1></div>
    <?php endif; ?>
    <div style="float:right">
   <a href="logout.php"> LogOut </a>
</div>
    </div>
<br><hr><br>
    <h4>This is the index page</h4>
    
</body>
</html>