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
          <title>Deleting Products</title>
         <link rel="stylesheet" type="text/css" href="ad-order.css"/>
        <style>
            .red-text{
                color:red;
                text-align:center;
            }
            .entries-ver{

                background-color: rgb(0,0,0, 0.7);
                font-family: Helvetica, Arial, sans-serif;
                width: 50%;
                height: 150px;
                padding: 20px;
                text-align: center;
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%,-50%);
                border-radius:30px;
                display:flex;
                flex-direction:column;
                justify-content:center;
                align-items:center;

                }
                .entries-ver h1{
                    display:flex;
                    justify-content:center;
                    align-items:center;
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
               
                <?php
                

                    $host = 'localhost:3308';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                    $user = 'root';
                    $passwd= '';
                    $database='orderdb';
                    $table_name='product';
                    
                    
                    $connect=mysqli_connect($host,$user,$passwd,$database) or die("could not connect to database");
                    mysqli_select_db($connect,$database);
                    $aproductid=$_POST["aproductid"];
                    $query="SELECT * FROM $table_name WHERE product_id ='".$aproductid."'";
                    $sql="delete from $table_name where product_id='".$aproductid."'";
                    mysqli_select_db($connect,$database);
                    $result= mysqli_query($connect,$query);
                

                    $myrow = mysqli_fetch_array($result,MYSQLI_ASSOC);
                
                    if(!$myrow){
                        print"<h1 class='red-text'>No such record with Product ID '".$aproductid."' found</h1><br>";
                        print"<div><a href='delete.php' title='delete' class='btn btn-transition'>Search Again</a></div>";
                    }
                    else{
                        $productid=$myrow['product_id'];
                        $catname=$myrow['catname'];
                        $Proname=$myrow['productname'];
                        $Price=$myrow['price'];
                        $Photo=$myrow['photo'];
                        mysqli_query($connect,$sql);
                        print "<h1>Product Id '$aproductid' has been deleted from the database!</h1>";
                        print"<div><a href='apview.php' title='product' class='btn btn-transition'>View Products</a></div>";

                    }
                    mysqli_close($connect);
                    ?>
            </div>
</div>
</body>
</html>
<?php
}
?>