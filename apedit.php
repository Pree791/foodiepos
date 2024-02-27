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
          <title>TMC Student Club</title>
         <link rel="stylesheet" type="text/css" href="ad-order.css"/>
         <style>
                 img {
               width: 300px;
               height: 200px;
               border-radius:20px;   
             }
            .entries-ver{

                background-color: rgb(0,0,0, 0.7);
                font-family: Helvetica, Arial, sans-serif;
                width: 80%;
                height: calc(100vh - 100px);
                padding: 20px;
                text-align: center;
                position:absolute;
                top:60%;
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
                
               
                .scroll{
                position: relative;
                height: 100vh;
                overflow:auto;
                width:100%;
                }
                .scroll table {
                    background-color: rgb(0, 0, 0, 0.7);
                  
                }
                .sticky-header {
                position: sticky;
                top: 0;
                z-index: 1;
                background-color:beige;
                font-size:18px;
        
                color:black;

                }
                .left{
                    margin-left:20px;
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


                echo "<h3>Enter the Product ID of the item you want to edit:</h3>
                
                <form name='editform' action='edit1.php' method='post'>
                    <table>
                   
                        <tr>
                            <td><h2><b style='margin-left:50px'>Product ID</b></h2></td>
                            <td><b style='margin-left:20px'><input type='text' name='aproductid' class='text-radius'></b></td>
                            <td><input type='submit' value='Go' class='sbtn transition1'/>
                           
                        </tr>
                       
                    </table>
                </form>

                <div>
                <hr><br>";
                echo "<div class='scroll'>";
                    if ($result) {
                        print "<table align=center border=1 style='width:100%'>";
                        print "<thead class='sticky-header'>";
                        print "<th style='width:12%'>Product ID<th style='width:300px'>Menu<th>Food Code<th>Name<th>Price";
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
                echo "</div>" ;
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