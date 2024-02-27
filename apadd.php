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
             .error {
                color: #FF0001;
                line-height:25px;
            }  
             
             .entries-ver{

                background-color: rgb(0,0,0, 0.5);
                font-family: Helvetica, Arial, sans-serif;
                width: 500px;
                height:480px;
                padding: 30px;
                text-align: center;
                position:absolute;
                top:52%;
                left:50%;
                transform:translate(-50%,-50%);
                border-radius:30px;

                }
                .entries-ver h1 {
                /* color: #FF6600; */
                color: #F5F5DC;
                font-size: 25px;
                margin-bottom: 10px;
                }
             

                .entries-ver td {
                color: #F5F5DC;
                font-size: 15px;
                margin:20px;
                /* margin: 10px; */
                }

               
                .entries-ver a{
                text-decoration:none;
                color: black;
                font-weight:bold;

                }
                .entries-ver a:hover{

                color: #F5F5DC;

                }
      
                .red-text {
                    color: red;
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
        <h1 align="center">Add new Menu</h1>
        <br>
        <center>
        <form name="registerForm" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>
            <table border=0 cellpadding=5 >
                <center>
            <tr>
            <td><b>Category ID</b></td>
            <td><b style='margin-left:40px'><input type="text" name="pcategory"  class="text-radius"></b></td>
            </tr>
            <tr>
            <td><b>Product Name</b></td>
            <td><b style='margin-left:40px'><input type="text" name="pname" class="text-radius"></b></td>
            </tr>
            <tr>
                <td><b>Price</b></td>
                <td><b style='margin-left:40px'><input type="text" name="price" class="text-radius"></b></td>
            </tr>
            <tr>
                <td><b>Photo</b></td>
                <td><b style='margin-left:40px'><input type="file" name="pfile" class="text-radius"></td>
            </tr>
            <tr>
                <td colspan=2 style="text-align:center">
                <input type="submit" name="submit" value="ADD" class="sbtn btn-transition" style="margin:20px">
                <input type="reset" value="Clear" class="sbtn btn-transition" >
                </td>
            </tr>
            <center>
            </table>
        </form>
        <center>
        
        <?php  
                if(isset($_POST['submit'])) 
                {  
                    // Validate input fields
                    $errors = array();

                    if (empty($_POST['pcategory'])) {
                        $errors[] = "Category ID is required";
                    }

                    if (empty($_POST['pname'])) {
                        $errors[] = "Product Name is required";
                    }

                    if (empty($_POST['price'])) {
                        $errors[] = "Price is required";
                    }

                    if (empty($_FILES['pfile']['name'])) {
                        $errors[] = "Photo is required";
                    }

                    if (empty($errors)) {       
                        $host = "localhost:3308";
                        $user = "root";
                        $passwd = "";
                        $database = "orderdb";
                        $table_name = "product";

                        $connect = mysqli_connect($host,$user,$passwd,$database) 
                        or die("could not connect to database");
                        
                                            
                                //$name = $_FILES['pfile']['name'];
                                $target_dir = "orderphoto/";
                                $target_file = $target_dir . $_FILES["pfile"]["name"];
                                $maxsize = 5242880; // 5MB

                                // Select file type
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                                // Valid file extensions
                                $extensions_arr = array("png","jpeg","jpg");

                                // Check extension
                                if( in_array($imageFileType,$extensions_arr) ){
                                    
                                    // Check file size
                                    if(($_FILES['pfile']['size'] >= $maxsize) || ($_FILES["pfile"]["size"] == 0)) {
                                        echo "<h1 class='red-text'>File too large. File must be less than 5MB.</h1>";
                                    }else
                                    {
                                                            
                                            // Insert record
                                            $sql="INSERT INTO $table_name(catname,productname,price,photo)
                                            VALUES('$_POST[pcategory]','$_POST[pname]','$_POST[price]','".$target_file."')";

                                            if (!mysqli_query($connect,$sql))
                                            {
                                                die('Error: ' . mysqli_error($connect));
                                            }
                                            else{       
                                            echo "<center><h1><b style='background-color: #ff4500'>Successfully added</b></h1></center>";       
                                            }
                                            mysqli_close($connect);  
                                        }
                                    
                                }else{
                                    echo "<center><b class='error'>Invalid file extension.</b></center>";
                                }        
                    } else {
                                foreach ($errors as $error) {
                                    echo "<center><b class='error'>*$error</b></center>";
                                }
                            }
                } 
        ?>
        </div>
</div>
</body>
</html>
<?php
}
?>
