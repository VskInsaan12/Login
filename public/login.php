<?php 

 require "../private/autoload.php";

 $Error = "";


 if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['tocken']) && isset($_POST['tocken']) && $_SESSION['tocken'] == $_POST['tocken'])
 {
    print_r($_POST);
    $email = $_POST["email"];
    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email))
    {
        $Error = "Please enter a valid email";
    }


    $password = $_POST["password"];

    if($Error == "")
    {

        $arr ['password'] = $password;
        $arr ['email'] = $email;


    $query = "select * from users where email = :email && password = :password limit 1";
    $stm = $connection->prepare($query);
    $check = $stm->execute($arr);


    if($check)
    {
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data) > 0)
        {
            
            $data = $data[0];
            $_SESSION['username'] = $data->username;
            $_SESSION['url_address'] = $data->url_address;
            header("Location: index.php");
            die;
        }
       
    }

    $_SESSION['tocken'] = get_random_string(60);


  
    }
    $Error = "Wrong email or password";
}

 

?>

<!DOCTYPE html>
<html>
    <title>VskInsaan -- Login</title>
    <link rel="icon" type="image/x-icon" href="../private/channel.ico">
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="Default page" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: verdana;">

<styel type="text/css">
    
    form{
        margina: auto;
        border: solid thin #aaa;
        padding: 6px;
        max-width: 200px;
    }

    #title{
        background-color: lightblue;
        padding: .5em;
        text-align: center;
        border-radius: 6px;
        color: white;
    }

    #text{
        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        margin-top: 6px;
        width: 98%;
    }

    #button{
        padding: 10px;
        width: 100px;
        color: white;
        background-color: lightblue;
        border: none;
    }


</style>

 

   <form method="post">
    <div><?php 
        if(isset($Error) && $Error != "")
        {
            echo $Error;
        }
    ?></div> 
    <div id="title">LoginIn</div>

    <input id="text" type="email" name="user_email" placeholder="Email" required> <br><br>
    <input id="text" type="password" name="password" placeholder="Password" required><br><br>
    <input type="hidden" name="tocken" value="<?=$_SESSION['tocken']?>"
    <input id="button" type="submit" value="Login"><br><br>

    <p>Dont have an account? - </p> <a href="signup.php">Sign Up</a><br><br>
   </form>



</body>
</html>