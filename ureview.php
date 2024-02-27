<!DOCTYPE html>
<html>
<head>
           <meta charset = 'utf-8'>
           <title>Give Reviews</title>
          <link rel="stylesheet" type="text/css" href="order.css"/>
          <style>  
             .error {color: #FF0001;
            margin-left:10px;} 
             .entries-ver{

                background-color: rgba(0,0,0,0.7);
                font-family: Helvetica, Arial, sans-serif;
                font-size: 15px;
                width: 900px;
                margin-top:60px;
                padding: 15px;
                text-align: center;
                position: relative;
                top:33%;
                left:32%;
                transform:translate(-50%,-50%);
                border-radius:20px;
                height:1000px;

                } 
                .entries-ver h1{
                    color: #FF6600;
                }
                .entries-ver tr,td{
                    color: #FF6600;
                    font-size: 18px;
                    font-weight:530;
                   
                }
                .entries-ver .left-align {
                    text-align: left;
                    margin-left: 30px;
                    font-weight:bold;
                }
                .entries-ver input[type="text"][name="comment"] {
                    height: 80px;
                }
                h3{
                    color:#FF6600;
                }
                .btn-transition1{
                    transition: all 0.3s ease;
                }
                
                .btn-transition1:hover {
                    background-color: #ff6347;
                    transform: scale(1.1);
                    color:rgb(255, 234, 167);
                }
                .alignment {
                    position: absolute;
                    bottom: 10px; /* Adjust the distance from the bottom as needed */
                    left: 30%;
                    right: 0;
                    margin: 0 auto; 
                    margin-top:20px;
                }
               
          </style>          
</head>
<body>
<?php
        $customerErr = $emailErr = $pnameErr = $commentErr = "";
        $customer = $email = $pname = $comment = "";

        if(isset($_POST['submit'])) 
        {     
            // Form validation
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //   Validate name
                if (empty($_POST["cname"])) {
                    $customerErr = "Name is required";
                } else {
                    $customer = test_input($_POST["cname"]);
                    // Check if name contains only letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $customer)) {
                        $customerErr = "Only letters and space";
                    }
                }
            
            
                // Validate email
                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                    // Check if email address is valid
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                    }
                }
                if (empty($_POST["comment"])) {
                    $commentErr = "Comment is required";
                } else {
                    $comment = test_input($_POST["comment"]);
                }

                if (empty($_POST["pname"])) {
                    $pnameErr = "Product Name is required";
                } else {
                    $pname = test_input($_POST["pname"]);
                    
                }

                
        
        
             }
        }
    
            // Helper function to sanitize input data
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }  
    ?>
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

            <div class="entries-ver">
                <h1>Review Form</h1>
                <hr>
                </br>
                <form name="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>
                <table border=0 cellpadding=5 align="center">

                    <tr>
                    <td class="left-align">Customer Name :</td>
                    <td><input type="text" name="cname"  class="text-radius" value="<?php echo isset($_POST['cname']) ? $_POST['cname'] : ''; ?>"></td>
                    <td <span class="error"><?php echo $customerErr; ?> </span></td>
                    </tr>

                    <tr>
                        <td class="left-align">Email :</td>
                        <td><input type="text" name="email"  class="text-radius" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></td>
                        <td><span class="error"><?php echo $emailErr; ?></span></td>
                    </tr>

                    <tr>
                    <td class="left-align">Product Name :</td>
                    <td><input type="text" name="pname"  class="text-radius" value="<?php echo isset($_POST['pname']) ? $_POST['pname'] : ''; ?>"></td>
                    <td><span class="error"><?php echo $pnameErr; ?></span></td>
                    </tr>

                    <tr>
                        <td class="left-align">Comment :</td>
                        <td><input type="text" name="comment"  class="text-radius" value="<?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?> "></td>
                        <td><span class="error"><?php echo $commentErr; ?></span></td>
                    </tr>
                
                    
                    
                    <tr class="alignment">
                    <td>
                        
                        <input type="submit" name="submit" value="submit" class="btn transition" style="margin:0px 20px 0px 20px">
                        <input type="reset" value="Reset Form" class="btn transition" style="margin:20px">
                       
                    </td>
                    </tr>
                    
                    
                </table>
                </form>

                <?php  
                   

                        $host = "localhost:3308";
                        $user = "root";
                        $passwd = "";
                        $database = "orderdb";
                        $table_name = "review";

                        $connect = mysqli_connect($host,$user,$passwd,$database) 
                        or die("could not connect to database");
                        
                        if($customer != "" && $comment != "" && $pname != "" && $email != "") {  
                            $sql="INSERT INTO $table_name(customer,email,productname,comment,Date)
                            VALUES('$_POST[cname]','$_POST[pname]','$_POST[email]','$_POST[comment]',NOW())";
                              echo "<h3 color = #FF0001> <b style='margin-left:550px'>Successfully reviewed</b> </h3>";
                            
                            if (!mysqli_query($connect,$sql))
                            {
                                die('Error: ' . mysqli_error($connect));
                            }else{
                                $customer = $email = $pname = $comment = "";
                            }

                        }else{
                            echo "<h3 color = #FF0001><b style='margin-left:450px'>Fill up all form.</b> </h3>";  
                        }

                       
                            
                            mysqli_close($connect); 
                    
                    ?>
            </div>

        
       
</div>
</body>
</html>
