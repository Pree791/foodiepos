<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:Login.php");
} 
else {
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset = 'utf-8'>
        <title>Edit Products</title>
        <link rel="stylesheet" type="text/css" href="ad-order.css"/>
        
        <style>
        .red-text {
            color: red;
        }
        .entries-ver{
            border-radius:20px;
            background-color: rgba(0,0,0,0.7);
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            width: 500px;
            padding: 20px;
            text-align: center;
            position:absolute;
            top:57%;
            left:50%;
            transform:translate(-50%,-50%);

            }
            .entries-ver a:hover{
            
                color: #F5F5DC;

             }
             .inline-btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #ff4500;
                color:black;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                border-radius: 10px;
                margin:20px;
            }
             td{
                font-weight:bold;
               
             }
             .img-radius{
                width:180px;
                height:100px;
                border-radius:10px;  
                margin:10px;
             }
             .left{
                align:center;
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

    <div class=entries-ver> 

            
            <center>
           
            <?php
            
                $host = 'localhost:3308';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                $user = 'root';
                $passwd= '';
                $database='orderdb';
                $table_name='product';
                
                $aproductid =$_POST["aproductid"];
          
                $connect=mysqli_connect($host,$user,$passwd,$database) or die("could not connect to database");
                
                
                $query="SELECT * FROM $table_name WHERE product_id ='".$aproductid."'";
                mysqli_select_db($connect,$database);
                $result=mysqli_query($connect,$query);
                $myrow = mysqli_fetch_array($result,MYSQLI_ASSOC);

                if(!$myrow){
                    echo "<p><h2 class='red-text'>No such record found</h2></p>";
                    echo "<div><a href='apedit.php' title='edit' class='btn btn-transition'>Search Again</a></div>";

                }else{
                    echo "<h2>Update the food item information:</h2>";
                    echo "<hr>";
                    $productid=$myrow['product_id'];
                    $catname=$myrow['catname'];
                    $pname=$myrow['productname'];
                    $price=$myrow['price'];
                    $photo=$myrow['photo'];
                
                    
                    print "<form name='editform' action='edit2.php' method ='post' enctype='multipart/form-data'>
                    <table>
                    <tr><td>Product ID</td><td><p style='margin-left:55px'>{$productid}<input type='hidden' name='aproductid' value='$productid' ></p></td></tr>
                    <tr><td>Food Code</td><td><b style='margin-left:40px'><input type='text' name='acatname' value='$catname' class='text-radius'></b></td></tr>
                    <tr><td>Product Name</td><td><b style='margin-left:40px'><input type='text' name='aproname' value='$pname' class='text-radius'></b></td></tr>
                    <tr><td>Price</td><td><b style='margin-left:40px'><input type='text' name='aprice' value='$price' class='text-radius'></b></td></tr>
                    <tr><td>Photo</td><td><img src='http://localhost:8080/order/{$photo}' class='img-radius' style='margin-left:40px'>
                                          <input type='hidden' name='photo' value='$photo'></td></tr>

                    <tr><td>Change Photo</td><td><input type='file' name='pfile' class='text-radius' style='margin-left:40px'></td></tr>
                    </table>
                    <div>
                    
                        <tr><td><input type='submit' name='submit' value='SAVE' class='inline-btn transition1'/>
                        <input type='reset' value = 'Reset' class='inline-btn transition1'/></td>
                        </tr>
                 
                    </div>
                   
                    </form>";
                  
                }
                mysqli_close($connect);
                ?>
            </center>    
    </div>
</div>
      
</body>
</html>
    
<?php
}
?>