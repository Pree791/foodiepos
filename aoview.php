<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:login.php");
} 
else {
?>
<html>
<head>
    <meta charset = 'utf-8'>
    <title>View Order Details</title>
    <link rel="stylesheet" type="text/css" href="ad-order.css"/>
    <style>  
         .error {color: #FF0001;}  
         .entries-ver{

            background-color: rgb(0,0,0, 0.7);
            font-family: Helvetica, Arial, sans-serif;
            width: 90%;
            
            padding: 20px;
            text-align: center;
            position:absolute;
            top:24%;
            left:50%;
            transform:translate(-50%,-3%);
            border-radius:30px;
           

            }
            .entries-ver h1 {
            /* color: #FF6600; */
            color: #F5F5DC;
            font-size: 25px;
            margin-bottom: 20px;
            
            }
            table{
                width:100%;
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
            <div class="entries-ver">
                <h1>Customer Orders</h1>
                <table border=1 align=center>
                    <thead>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Total Sales</th>
                        <th>Details</th>
                    </thead>
                    <tbody>
                        <?php 
                            $host = "localhost:3308";
                            $user = "root";
                            $passwd = "";
                            $database = "orderdb";                        
                            $conn = mysqli_connect($host,$user,$passwd,$database) 
                            or die("could not connect to database");

                            $sql="select * from purchase order by purchaseid desc";
                            $query=$conn->query($sql);
                            while($row=$query->fetch_array()){
                                ?>
                                <tr>
                                    <td align=center><?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></td>
                                    <td align=center><?php echo $row['customer']; ?></td>
                                    <td align=center>&#8369; <?php echo number_format($row['total'], 2); ?></td>
                                    
                                    <td align=center><a href="#details<?php echo $row['purchaseid']; ?>" 
                                    <?php include('aoviewDetail.php'); ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
      
 </div>
 </body>
</html>
<?php
}
?>
