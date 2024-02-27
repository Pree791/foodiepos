<!Doctype html>
<html>
<head>
         <meta charset = 'utf-8'>
         <title>TMC Student Club</title>
         <link rel="stylesheet" type="text/css" href="order.css"/>
         <style>

            .text-radius1{
                border-radius: 20px;
                height:35px;
                opacity:0.4;
                /* margin-left: 30px; */
                padding:10px;
                font-size: 25px;
                margin:10px;
            }
            form,h1{
                color:black;
            }
        
            .text-color{
                /* color: #F5F5DC; */
                color:black;
                font-weight:bold;
                font-size:20px;
            }
            .entries-ver{

                background-color: rgb(0,0,0, 0.5);
                font-family: Helvetica, Arial, sans-serif;

                width: 500px;
            
                padding: 30px;
                text-align: center;
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%,-50%);
                border-radius:30px;

                }
                .entries-ver h1 {
                /* color: #FF6600; */
                color: #F5F5DC;
                font-size: 25px;
                margin-bottom: 20px;
                }

                .entries-ver p {
                color: #F5F5DC;
                font-size: 18px;
                margin: 10px 0;
                }
            .entries-ver a:hover{
            
                color: #F5F5DC;

             }
             .entries-ver b{
                font-size:20px;
                color:red;
                align:center;
                margin-top:20px;
             }
            </style>
</head>
<body> 
<div class="banner">
   <div class="navbar">
       <!-- <div class="display-vertical">  -->
            <ul>
            <li><a href='logout.php' title='Logout' class='logout-btn'>Logout</a></li>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="upview.php">Food</a></li>
            <li><a href="order.php">Order</a></li>
            <li><a href="ureview.php">Review</a></li>
            <li><a href="login.php">Admin Log In</a></li>
            </ul>
    </div>
            <div class="entries-ver"><h1>LOGIN FORM</h1><hr>
                <form action="" method="POST">
                <p class="text-color">Username: <input type="text" name="user" class="text-radius1"><br /></p>
                <p class="text-color">Password: <input type="password" name="pass" class="text-radius1"><br /></p>
                <input type="submit" value="Login" name="submit" class="btn btn-transition"/>
                </form>
          
                    <?php
                    if(isset($_POST["submit"])){
                        if(!empty($_POST['user']) && !empty($_POST['pass'])) {
                            $user=$_POST['user'];
                            $pass=$_POST['pass'];
                            $con=mysqli_connect('localhost:3308','root','','orderdb') or die(mysql_error());
                            $query=mysqli_query($con,"SELECT * FROM users WHERE username='".$user."' AND password='".$pass."'");
                            $numrows=mysqli_num_rows($query);
                                if($numrows!=0)
                                {
                                    while($row=mysqli_fetch_assoc($query))
                                    {
                                    $dbusername=$row['username'];
                                    $dbpassword=$row['password'];
                                    }
                                    if($user == $dbusername && $pass == $dbpassword)
                                    {
                                    session_start();
                                    $_SESSION['sess_user']=$user;
                                    header("Location: adminWelcome.php");
                                    }
                                }else {
                                 echo "<b>Invalid username or password!</b>";
                                }
                        } else {
                            echo "<b>All fields are required!</b>";
                        }
                    }
                    ?>
                <div>
            </div>
        <!-- </div> -->
    
</div>
</body>
</html>
