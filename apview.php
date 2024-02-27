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
          <title>View all Products</title>
         <link rel="stylesheet" type="text/css" href="ad-order.css"/>
         <style>
          table{
            background-color: beige;
            align:center;
            opacity:0.9; 
            width:90%;  
            font-weight:bold; 
            font-size:18px;    
            color:black; 
            padding:20px;
            border-radius:20px;
          
          }
          th{
            height:20px;
            border-radius:10px;
            font-size:22px;
            color:#F5F5DC;
          }
           
             h1 {
            color: #F5F5DC;
            font-size: 25px;
            margin-bottom: 20px;
            }
            .scroll{ //for scroll view
              position: relative;
              height: 100vh;
              overflow:auto;
              width:100%;
             
            }
            .sticky-header { //to make head fixed while scroll
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: rgb(0,0,0, 0.5);
      
           }
            img {
               width: 300px;
               height: 200px;
               border-radius:20px;   
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

      <div class="scroll">  
        <center>
        <?php
        $host = "localhost:3308";
        $user = "root";
        $passwd = "";
        $database = "orderdb";
        $table_name = "product";
        $connect = mysqli_connect($host,$user,$passwd,$database) 
                    or die("could not connect to database");

        $query = "SELECT * FROM $table_name";
        mysqli_select_db($connect,$database);
        $result = mysqli_query($connect,$query);

        echo "<div>";
        echo "<h1>Product List</h1>";
        echo "</div>" ;
          if ($result) {
              print "<table border=2>";
              print "<thead class='sticky-header'>";
              print "<th style='width:12%'>Product ID<th style='width:300px'>Menu<th style='height:20%'>Food Code<th>Name<th>Price";
              print "</thead>";
              while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
              {
                $pid=$row['product_id'];
                $pcat=$row['catname'];
                $pname=$row['productname'];
                $price=$row['price'];
                $photo=$row['photo'];
                
                print "<tr style='text-align:center'>";      
              
                  print "<td>".$pid."</td>";
                  print "<td>"."<img src='".$photo."'controls width='100px' height='100px'>"."</td>";
                  print "<td>".$pcat."</td>";
                  print "<td>".$pname."</td>";
                  print "<td>".$price."</td>";                 
              print "</tr>";
              }
              print "</table>";
          }
          else 
          { 
              die ("Query=$query failed!"); 
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
