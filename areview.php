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

                background-color: rgb(0,0,0, 0.7);
                font-family: Helvetica, Arial, sans-serif;
                width: 80%;
              
                padding: 20px;
                text-align: center;
                position:absolute;
                top:14%;
                left:50%;
                transform:translate(-50%,-3%);
                border-radius:30px;

                }
               
                thead{
                  background-color: beige;
                  color:black;
                }
                .scroll{
                  position: relative;
                  height: 100vh;
                  overflow:auto;
                  width:100%;
                
                }
                .sticky-header {
                position: sticky;
                top: 0;
                z-index: 1;
                background-color: rgb(0,0,0, 0.5);
          
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
    <div class=scroll>
        <div class=entries-ver>  
          <center>
          <?php
          $host = "localhost:3308";
          $user = "root";
          $passwd = "";
          $database = "orderdb";
          $table_name = "review";
          $connect = mysqli_connect($host,$user,$passwd,$database) 
                      or die("could not connect to database");

          $query = "SELECT * FROM $table_name";
          mysqli_select_db($connect,$database);
          $result = mysqli_query($connect,$query);

          
            echo "<h1 align=center>Customer Comments</h1>";

            if ($result) {
                print "<table align=center border=1 style='width:90%'>";
                print "<thead><th>ID<th>Customer Name<th>Email<th>Product Name<th>Comments<th>Date</thead>";
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                  $rid=$row['rid'];
                  $customer=$row['customer'];
                  $cemail=$row['email'];
                  $pname=$row['productname'];
                  $comment=$row['comment'];
                  $cdate=$row['Date'];
                  
                  print "<tr style='text-align:center'>";  
                    print "<td>".$rid."</td>";
                    print "<td>".$customer."</td>";
                    print "<td>".$cemail."</td>";
                    print "<td>".$pname."</td>";
                    print "<td>".$comment."</td>";
                    print "<td>".$cdate."</td>";
                print "</tr>";
                }
                print "</table>";
            }
            else 
            { 
                die ("Query=$query failed!"); 
            }
          // echo "</div>" ;
          mysqli_close($connect);
          ?>
          </center>
        </div>
      </div>
</div>
</body>
</html>
<?php
}
?>
