<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:login.php");
} 
else {
?>
<!DOCTYPE html>
<html>
<head>
           <meta charset = 'utf-8'>
           <title>TMC Student Club</title>
          <link rel="stylesheet" type="text/css" href="ad-order.css"/>
          <style>
            
        .entries-ver{

            background-color: rgb(0,0,0, 0.5);
            font-family: Helvetica, Arial, sans-serif;
            width: 400px;
            height:200px;
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
        .entries-ver a{
            text-decoration:none;
           
            font-weight:bold;
           
        }
        .entries-ver a:hover{
            
            color: #F5F5DC;

        }
          </style>

</head>

<body>

<div class="banner">
        <div class="navbar">
            
            <ul>
            <li><a href='logout.php' title='Logout' class='logout-btn btn-transition'>Logout</a></li>

            <li class="transition1"><a href="apview.php">View Products</a></li>
            <li class="transition1"><a href="apadd.php">Add Product</a></li>
            <li class="transition1"><a href="apedit.php">Edit Product</a></li>
            <li class="transition1"><a href="delete.php">Delete Product</a></li>
            <li class="transition1"><a href="aoview.php">View Orders</a></li>
            <li class="transition1"><a href="areview.php">Read Reviews</a></li>        
            <p class="welcome transition1">Welcome, <?=$_SESSION['sess_user'];?>!</p>       

            </ul>
        </div>

            <div class="entries-ver">
                <center style="margin:40px 0px"><p><h1>Log In successfull!!!!</h1></p>
                <p>You can log out of Admin below</p><a href="logout.php" title="Logout" class="btn btn-transition">Logout</a>
                </center>
            </div> 

        <!-- </div> -->
    
</div>  
</body>
</html>
<?php
}
?>
