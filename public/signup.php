<?php 

    require "../private/autoload.php";

 $Error = "";
 $email = "";
 $username = "";

 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
    print_r($_POST);
    $email = $_POST["email"];
    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email))
    {
        $Error = "Please enter a valid email";
    }

    $date = date("Y-m-d H:i:s");
    $url_address = get_random_string(60);

    $username = trim($_POST['username']);
    if(!preg_match("/^[a-zA-Z]+$/", $username))
    {
        $Error = "Please enter a valid username";
    }

    $username = esc($_POST["username"]);
    $password = esc($_POST["password"]);

    //check if email exists
    $arr = false;
    $arr['email'] = $email;
    $query = "select * from users where email = :email limit 1";
    $stm = $connection->prepare($query);
    $check = $stm->execute($arr);


    if($check)
    {
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data) > 0)
        {
            
            $Error = "Someone is already using that email";
        }
       
    }

    if($Error == "")
    {

        $arr ['url_address'] = $url_address;
        $arr ['username'] = $username;
        $arr ['password'] = $password;
        $arr ['email'] = $email;
        $arr ['date'] = $date;


    $query = "insert into users (url_address,username,password,email,date) values (:url_address,:username,:password,:email,:date)";
    $stm = $connection->prepare($query);
    $stm->execute($arr);


    header("Location: login.php");
    die;
    }
}

 

?>

<!DOCTYPE html>
<html>
    <title>VskInsaan -- Sign Up</title>
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
    <div id="title">SignUp</div>

    <input id="text" type="text" name="user_name" placeholder="Username" value="<?=$username?>" required> <br><br>
    <input id="text" type="email" name="user_email" placeholder="Email" value="<?=$email?>" required> <br><br>
    <input id="text" type="password" name="password" placeholder="Password" required><br><br>

    <input id="button" type="submit" value="Sign Up"><br><br>

    <p>Already have an account? - </p> <a href="login.php">Login In</a><br><br>
   </form>



</body>
</html>