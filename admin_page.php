<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   <style>
   @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

:root{
   --purple:#8e44ad;
   --red:#c0392b;
   --orange:#f39c12;
   --black:#333;
   --white:#fff;
   --light-color:#666;
   --light-white:#ccc;
   --light-bg:#f5f5f5;
   --border:.1rem solid var(--black);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}

*{
   font-family: 'Rubik', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   transition:all .2s linear;
}
html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.title{
   text-align: center;
   margin-bottom: 2rem;
   text-transform: uppercase;
   color:red;
   font-size: 4rem;
}
.dashboard .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
   gap:3.5rem;
   max-width: 1200px;
   margin:0 auto;
   align-items: flex-start;
}

.dashboard .box-container .box{
   border-radius: .5rem;
   padding:2rem;
   background-color: blue;
   box-shadow: var(--box-shadow);
   border:var(--border);
   text-align: center;
}

.dashboard .box-container .box h3{
   font-size: 5rem;
   color:red; 
}

.dashboard .box-container .box p{
   margin-top: 1.5rem;
   padding:1.5rem;
   background-color:green;
   color:Black;
   font-size: 2rem;
   border-radius: .5rem;
   border:var(--border);
}

       .menu {
            width: 100%;
            background: red;
            overflow: auto;
        }

            .menu ul {
                margin: 0;
                padding: 0;
                list-style: none;
                line-height: 60px;
            }

            .menu li {
                float: left;
            }

            .menu ul li a {
                background: red;
                text-decoration: none;
                width: 130px;
                display: block;
                text-align: center;
                color: #f2f2f2;
                font-size: 18px;
                letter-spacing: 0.5px;
            }

            .menu li a:hover {
                color: #fff;
                opacity: 0.5;
                font-size: 19px;
            }

        .search-form {
            margin-top: 15px;
            float: right;
            margin-right: 100px;
        }

        input[type=text] {
            padding: 7px;
            border: none;
            font-size: 16px;
        }
        .header {
            background-image: url(yellow.jpg);
            height: 680px;
            background-color: black;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover
        }
   </style>

   <nav class="menu">
        <ul>
           
            <li>
                 <a href="admin_products.php">Add Marvel  </a>
            </li>
            <li>
                 <a href="admin_products second.php">Add DC  </a>
            </li>
            <li> 
                <a href="admin_orders.php">Orders</a>
            </li>
             <li>
                <a href="admin_users.php">Users</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
        </nav>
        <div class="header">
        <br>
         <br>
          <br>
           <br>
            <br>
            <br>
            <br>
<!-- admin dashboard section starts  -->
<section class="dashboard">

   <h1 class="title">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_pendings; ?>/-</h3>
         <p>Total Pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_completed; ?>/-</h3>
         <p>Complete Payment</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Get Order</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p> Add Marvel Product</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products second`") or die('query failed');
            $number_of_products   = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Add DC Product</p>
      </div>
     
      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Users Login</p>
      </div> 

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>Admin Users</p>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Total Accounts</p>
      </div>
   </div>
 
</section>
</div>
<!-- admin dashboard section ends -->
</body>
</html>