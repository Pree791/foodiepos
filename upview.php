<!DOCTYPE html>
<html>
<head>
           <meta charset = 'utf-8'>
          <title>TMC Student Club</title>
         <link rel="stylesheet" type="text/css" href="order.css"/>
         <style>
         .item-container {
               display: flex;
               justify-content: center;
               align-items: center;
               flex-wrap: wrap; //add scroll view for the menu
               overflow: auto;
               height: 100vh; 
               width: 100%;
        
         }
         .item {
               display: flex;
               flex-direction: column;
               align-items: center;
               margin: 30px;
               position: relative;
         }
         .item img {
               width: 300px;
               height: 200px;
               border-radius:20px;   
         }
         .dish-info {
               position: absolute;
               top: 50%;
               left: 50%;
               transform: translate(-50%, -50%);
               background-color: rgba(0, 0, 0, 0.7);
               padding: 10px;
               text-align: center;
               opacity: 0;
               visibility: hidden;
               transition: opacity 0.3s, visibility 0.3s;
               border-radius: 10px;
               color: #fff;
               font-size: 14px;
               width: 200px;
               line-height:25px;
               
               }
         .item:hover .dish-info{
               opacity: 1;
               visibility: visible;
         }
         .dish-info h3, .dish-info p {
                margin: 5px 0;
         }
       </style>
</head>

<body>
<div class="banner">
   <div class="navbar">
      
         <ul>
         <li><a href='logout.php' title='Logout' class='logout-btn'>Logout</a></li>

         <li class='transition1'><a href="home.html">Home</a></li>
         <li class='transition1'><a href="about.html">About</a></li>
         <li class='transition1'><a href="upview.php">Food</a></li>
         <li class='transition1'><a href="order.php">Order</a></li>
         <li class='transition1'><a href="ureview.php">Review</a></li>
         <li class='transition1'><a href="login.php">Admin Log In</a></li>
         </ul>
   </div>

         <div class="item-container">
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


            if ($result) {
               
              
               while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
               {
               //  $pid=$row['product_id'];
                 $pcat=$row['catname'];
                 $pname=$row['productname'];
                 $price=$row['price'];
                 $photo=$row['photo'];
                 
                 echo "<div class='item pop-trans'>";
                 echo "<img src='" . $photo . "' alt='Product Image'>";
                     echo "<div class='dish-info'>";
                    
                     echo "<h3>" . $pname . "</h3>";
                     echo "<p>Price: $" . $price . "</p>";
                     echo "<p>Food Code: " . $pcat . "</p>";
                     echo "</div>";
                 echo "</div>";

               }
            }
               else 
               { 
                     die ("Query=$query failed!"); 
               }
               
               mysqli_close($connect);
               ?>
           
         </div>
     
   <!-- </div> -->

</div>      

</body>
</html>
