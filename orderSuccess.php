<?php
session_start();
if(!isset($_SESSION["sess_pid"])){
    header("location:order1.php");
} 
else {
?>
<html>
<head>
    <meta charset = 'utf-8'>
    <title>TMC Student Club</title>
    <link rel="stylesheet" type="text/css" href="order.css"/>
    <style>  
         .error {color: #FF0001;}  
         .entries-ver{

            background-color: rgba(0,0,0,0.7);
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            width: 900px;
            margin-top:60px;
            padding: 20px;
            text-align: center;
            position:absolute;
            top:46%;
            left:50%;
            transform:translate(-50%,-50%);
            border-radius:20px;

            } 
        .entries-ver h1 {
            color: #FF6600;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .entries-ver p {
            color: #FF6600;
            font-size: 18px;
            margin: 10px 0;
        }

        .entries-ver h3 {
            color: #FF6600;
            font-size: 24px;
            margin-top: 20px;
        }
    </style>          
</head>
<body>
<div class="banner">
   <div class="navbar">
      
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
            
            <div class="entries-ver" >
           
                <h1>Order Success!!!</h1>
                <p><b>Thank you for shopping with us!! We hope to hear reviews from you!</b></p>
                <p><h3>Your Order ID is  <?=$_SESSION['sess_pid'];?>!</h3></p><br>
                <p><a href="ureview.php" class="btn btn-transition">Give Reviews</a></p>
           
            </div>
       
   
</div>
 </body>
</html>
<?php
}
?>
