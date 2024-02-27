
<html>
<head>
    <meta charset="utf-8">
    <title>TMC Student Club</title>
    <link rel="stylesheet" type="text/css" href="order.css"/>
    <style>  
        .error {
            color: #FF0001;
            margin-left:0px;
            
        } 
        .entries-ver{

            background-color: rgba(0,0,0,0.7);
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            width: 1300px;
            margin-top:60px;
            padding: 20px;
            text-align: center;
            position:absolute;
            top:49%;
            left:50%;
            transform:translate(-50%,-50%);
            border-radius:20px;

            } 
            .entries-ver h1{
                color: #FF6600;
            }
            .entries-ver tr,td{
                color: #FF6600;
                font-size: 18px;
                font-weight:530;
            }
            .text-radius1{
                border-radius: 20px;
                height:35px;
                opacity:0.4;
             
                padding:10px;
                font-size: 20px;
                margin:10px;
            }
            .text-radius2{
                border-radius: 20px;
                height:65px;
                opacity:0.4;
                
                padding:10px;
                font-size: 20px;
                margin:10px;
            }
            .text-radius3{
                border-radius: 20px;
                height:35px;
                opacity:0.4;
                width:270px;
                padding:10px;
                font-size: 20px;
                margin:10px;
            }
                
            .tables-container {
                display: flex;
                justify-content: space-between;
            }
            table{
            color:#F5F5DC;
          
             }
             .order-table{
                width:600px;
             }
           

            .customer-detail {
                width: 55%; 
            }

            .order-table table,
            .customer-detail table {
                width: 100%;
            }
           
            .label{
                width: 140px;
                margin-left: 20px;
                margin-top:17px;
                display: inline-block;
                color: #F5F5DC;
            }
            .scroll{
                max-height: 300px; 
                overflow-y: auto;
            }
            .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: rgb(0,0,0, 0.5);
      
           }
           .alignment {
            position: absolute;
            bottom: 10px; 
            right: 0;
            left:15%;
            margin: 0 auto; 
            margin-top:20px;
        }

    </style>          
</head>
<body>


    <?php
        // error_reporting(0);
        $customerErr = $ageErr = $phoneErr = $emailErr = "";
        $customer = $age = $phone = $email = "";
        if(isset($_POST['submit'])) { 
    
        // Form validation
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //   Validate name
                if (empty($_POST["customer"])) {
                    $customerErr = "Name is required";
                } else {
                    $customer = test_input($_POST["customer"]);
                    // Check if name contains only letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $customer)) {
                        $customerErr = "Only letters and space";
                    }
                }
            
                // Validate age
                if (empty($_POST["age"])) {
                    $ageErr = "Age is required";
                } else {
                    $age = test_input($_POST["age"]);
                    // Check if age is a positive integer
                    if (!is_numeric($age) || $age <= 0 || $age != round($age)) {
                        $ageErr = "Age must be a positive";
                    }
                }
            
                // Validate phone
                if (empty($_POST["phone"])) {
                    $phoneErr = "Phone is required";
                } else {
                    $phone = test_input($_POST["phone"]);
                    // Check if phone number is valid
                    if (!preg_match("/^[0-9]{10}$/", $phone)) {
                        $phoneErr = "Invalid phone number format";
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
             
            }

            if($customer != "" && $age != "" && $phone != "" && $email != "") { //if there is value
                header("Location: order1.php"); //move to the next page
                exit();
            }
           
        }
       
            // function to sanitize input data
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
            <h1>ORDER FOOD HERE</h1>

         
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  name="orderForm">

                <div class="tables-container">
                    <div class="order-table scroll">
                        <table border="1">
                            <thead>
                                <th>Check</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </thead>
                            <tbody>
                            
                            <?php  
                            
                                
                                $host = "localhost:3308";
                                $user = "root";
                                $passwd = "";
                                $database = "orderdb";                        
                                $conn = mysqli_connect($host,$user,$passwd,$database) 
                                or die("could not connect to database");
                                $sql="select * from product order by productname asc";                    
                                $query=$conn->query($sql);
                                $iterate=0;
                                while($row=$query->fetch_array()){
                                    ?>
                                    <tr>
                                        <td>
                                        <input type="checkbox" value="<?php echo $row['product_id']; ?>||<?php echo $iterate; ?>" name="productid[]" style="">
                                        </td>
                                        <td><?php echo $row['catname']; ?></td>
                                        <td><?php echo $row['productname']; ?></td>
                                        <td>&#8369; <?php echo number_format($row['price'], 2); ?></td>
                                        <td><input type="text" name="quantity_<?php echo $iterate; ?>"></td>
                                    </tr>
                                    <?php
                                        $iterate++;
                                }
                            ?>              
                            </tbody>
                                
                        </table>
                    </div>
                
                    <div class="customer-detail">
                        <table >
                            <tr>
                                <td class="label">Customer Name</td>
                                <td><input type="text" class="text-radius1" name="customer" 
                                 value="<?php echo isset($_POST['customer']) ? $_POST['customer'] : ''; ?>" style="margin-left:10px" ></td>
                                <td><span class="error"><?php echo $customerErr; ?> </span></td>
                                
                            </tr>
                            <tr>
                                <td class="label">Customer Age</td>
                                <td><input type="text" class="text-radius1" name="age" 
                                value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>"style="margin-left:10px" ></td>
                                <td><span class="error"><?php echo $ageErr; ?> </span></td>
                                
                            </tr>
                            <tr>
                                <td class="label">Address</td>
                                <td><input type="text" class="text-radius1" name="address" 
                                value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>"style="margin-left:10px" required></td>
                                 
                            </tr>
                            <tr>
                                <td class="label">Phone</td>
                                <td><input type="text" class="text-radius1" name="phone" 
                                value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"style="margin-left:10px"></td>
                                <td><span class="error"><?php echo $phoneErr; ?> </span></td>
                                </tr>
                            <tr>
                                <td class="label">Email</td>
                                <td><input type="text" class="text-radius1" name="email" 
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"style="margin-left:15px"></td>
                                <td><span class="error"><?php echo $emailErr; ?></span></td>
                                </tr>
                            <tr>
                                <td class="label">Deliver on</td>
                                <td><input type="datetime-local" class="text-radius3" name="datetime" style="margin-left: 10px;" ></td>
                               
                            </tr>
                            <tr>
                                <td class="label">Special Note</td>
                                <td><input type="text" class="text-radius2" name="note" style="margin-left:10px" ></td>
                                 
                            </tr>
                            <tr class="alignment">
                            <td>
                                
                                <input type="submit" name="submit" value="submit" class="btn transition1" style="margin:0px 20px 0px 20px">
                                <input type="reset" value="Reset Form" class="btn transition1">
                            
                            </td>
                            </tr>
                            
                        </table>
                    </div>
                </div>

                
            </form>
            
          
                
                
        </div>
          
       
   

 </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js">

            $(document).ready(function(){
                $("#checkAll").click(function(){
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
            });

        </script>
</body>
</html>

