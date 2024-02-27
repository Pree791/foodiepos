<?php
    $host = "localhost:3308";
    $user = "root";
    $passwd = "";
    $database = "orderdb";                        
    $conn = mysqli_connect($host,$user,$passwd,$database) 
    or die("could not connect to database");

      
            $customer=$_POST['customer'];
            $age=$_POST['age'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $datetime=$_POST['datetime'];
            $note=$_POST['note'];
    
            $sql="insert into purchase (customer, date_purchase,address,age,phone,email,datetime,note) values ('$customer', NOW(),'$address','$age','$phone','$email','$datetime','$note')";
            $conn->query($sql);
            $pid=$conn->insert_id;
     
            $total=0;
     
            foreach($_POST['productid'] as $product){
            $proinfo=explode("||",$product);
            $productid=$proinfo[0];
            $iterate=$proinfo[1];
            $sql="select * from product where product_id='$productid'";
            $query=$conn->query($sql);
            $row=$query->fetch_array();
     
                
            $quantity = $_POST['quantity_'.$iterate];
            
            if ($quantity != '') {
                $subt = $row['price'] * $quantity;
                $total += $subt;
                $sql = "insert into purchase_detail (purchaseid, productid, quantity) values ('$pid', '$productid', '$quantity')";
                $conn->query($sql);

            }
                
               
            
    
            // endforeach;
            
        } 
        $sql="update purchase set total='$total' where purchaseid='$pid'";
        $conn->query($sql);        
        session_start();
        $_SESSION['sess_pid']=$pid;        
        header('location:orderSuccess.php');     
    
              
 

?>
