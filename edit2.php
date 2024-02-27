    <?php
    session_start();
    if(!isset($_SESSION["sess_user"])){
        header("location:Login.php");
    } 
    else{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
            <meta charset = 'utf-8'>
            <title>TMC Student Club</title>
            <link rel="stylesheet" type="text/css" href="ad-order.css"/>
            <style>
            .entries-ver{
                border-radius:20px;
                background-color: rgba(0,0,0,0.7);
                font-family: Helvetica, Arial, sans-serif;
                font-size: 15px;
                width: 500px;
                padding: 20px;
                text-align: center;
                position:absolute;
                top:50%;
                left:50%;
                transform:translate(-50%,-50%);

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
                if(isset($_POST['submit'])){
                    $host='localhost:3308';
                    $user='root';
                    $passwd='';
                    $database='orderdb';
                    $table_name='product';

                    $connect=mysqli_connect($host,$user,$passwd,$database) or die("could not connect to database");
                    
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
                            echo "File too large. File must be less than 5MB.";
                        }else
                        {
                            $productid =$_POST["aproductid"];
                            $catname=$_POST["acatname"];
                            $pname=$_POST["aproname"];
                            $price=$_POST["aprice"];
                            $photo=$target_file;
                            $oldphoto=$_POST["photo"];
                        
                        
                            $query="update $table_name set catname='".$catname."', productname='".$pname."', price='".$price."' , photo='".$photo."' where product_id='".$productid."'";
                            mysqli_select_db($connect,$database);
                                if(!mysqli_query($connect,$query))
                                {
                                    die('Error.'.mysqli_error($connect));
                                    
                                }else{
                                print "<p><h2>Your information has been updated in the database</h2></p>";
                                print "<p><a href='apview.php' class='btn btn-transition'>View Menu</a></p>";
                                }
                            mysqli_close($connect);
                        } 
                                
                    }else
                    { 
                        $productid =$_POST["aproductid"];
                        $catname=$_POST["acatname"];
                        $pname=$_POST["aproname"];
                        $price=$_POST["aprice"];
                        $photo=$target_file;
                        $oldphoto =$_POST["photo"];
                    
                        $query="update $table_name set catname='".$catname."', productname='".$pname."', price='".$price."' , photo='".$oldphoto."' where product_id='".$productid."'";
                        mysqli_select_db($connect,$database);

                        if (!mysqli_query($connect, $query)) {
                            die('Error.'.mysqli_error($connect));
                        }else{
                            print "<p><h2>Your information has been updated in the database</h2></p>";
                            print "<p><a href='apview.php' class='btn btn-transition'>View Menu</a></p>";
                        }     
                        mysqli_close($connect);
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