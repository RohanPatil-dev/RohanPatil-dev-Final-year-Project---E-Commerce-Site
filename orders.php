<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
.empty{
   padding:1.5rem;
   text-align: center;
   border:var(--border);
   background-color: var(--white);
   color:var(--red);
   font-size: 2rem;
}


html{
   font-size: 62.5%;
   overflow-x: hidden;
    background-image: url(yellow.jpg);
     background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
}


.heading h3{
   font-size: 5rem;
   color:red;
   text-transform: uppercase;
}
.heading{
   min-height: 30vh;
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
   gap:1rem;
   background-size: cover;
   background-position: center;
   text-align: center;
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

.placed-orders .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: flex-start;
   gap:1.5rem;
   justify-content: center;
}

.placed-orders .box-container .empty{
   flex:1;
}

.placed-orders .box-container .box{
   flex:1 1 40rem;
   border-radius: .5rem;
   padding:2rem;
   border:var(--border);
   background-color: var(--white);
   padding:1rem 2rem;
}

.placed-orders .box-container .box p{
   padding:1rem 0;
   font-size: 2rem;
   color:red;
}

.placed-orders .box-container .box p span{
   color:green;
}

         
</style>
<nav class="menu">
        <ul>
        <li>
                <a href="First Page.php">Home</a>
            </li>
            <li>
                <a href="cart.php">Cart</a>
            </li>
            <li>
                <a href="About.php">About</a>
            </li>
            <li>
                <a href="Contact Us.php">Contact Us</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul> 
        </nav>
       
<div class="heading">
 <h3>placed orders</h3>
   
</div>

<section class="placed-orders">


   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">No Ordered Here</p>';
      }
      ?>
   </div>

</section>

</section>







</body>
</html>