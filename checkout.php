<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
   if(!preg_match("/^[a-z-A-Z -]*$/",$name)){
  $message[] = 'Enter only characters!';
       }else{
           if(strlen($number)<10||strlen($number)>10){
               $message[]='Enter under 10 number';
           }else{
               if(strlen($_POST['pin_code'])<6){
                   $message[]='enter under 6 digit';
               }else{
                   if(strlen($_POST['flat'])>3){
                       $message[]='Enter under 3 digit';
                   }else{
   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
       }
}
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

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


.btn,
.white-btn{
   display: inline-block;
   margin-top: 1rem;
   padding:1rem 3rem;
   cursor: pointer;
   color:var(--white);
   font-size: 1.8rem;
   border-radius: .5rem;
   text-transform: capitalize;
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
}
.white-btn,
.btn{
   background-color: green;
}
.message{
   position: sticky;
   top:0;
   margin:0 auto;
   max-width: 100%;
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   z-index: 10000;
   gap:1.5rem;
   background-color:#FF4500;

}

.message span{
   font-size: 2rem;
   color:var(--white);
}

.message i{
   cursor: pointer;
   color:var(--red);
   font-size: 2.5rem;
}

.message i:hover{
   transform: rotate(90deg);
}
.title{
   text-align: center;
   margin-bottom: 2rem;
   text-transform: uppercase;
   color:var(--black);
   font-size: 4rem;
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

.heading h3{
   font-size: 5rem;
   color:red;
   text-transform: uppercase;
}

.heading p{
   font-size: 2.5rem;
   color:var(--light-color);
}

.heading p a{
   color:var(--purple);
}





.shopping-cart .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: center;
   gap:1.5rem;
   justify-content: center;
}

.shopping-cart .box-container .box{
   text-align: center;
   padding:2rem;
   border-radius: .5rem;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   position: relative;
   border:var(--border);
}

.shopping-cart .box-container .box .fa-times{
   position: absolute;
   top:1rem; right:1rem;
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.5rem;
   font-size: 2rem;
   background-color: var(--red);
   color:var(--white);
   border-radius: .5rem;
}

.shopping-cart .box-container .box .fa-times:hover{
   background-color: var(--black);
}

.shopping-cart .box-container .box img{
   height: 30rem;
}

.shopping-cart .box-container .box .name{
   padding:1rem 0;
   font-size: 2rem;
   color:var(--black);
}

.shopping-cart .box-container .box .price{
   padding:1rem 0;
   font-size: 2.5rem;
   color:var(--red);
}

.shopping-cart .box-container .box input[type="number"]{
   margin:.5rem 0;
   border:var(--border);
   border-radius: .5rem;
   padding:1.2rem 1.4rem;
   font-size: 2rem;
   color:var(--black);
   width: 9rem;
}

.shopping-cart .box-container .box .sub-total{
   padding-top: 1.5rem;
   font-size: 2rem;
   color:var(--light-color);
}

.shopping-cart .box-container .box .sub-total span{
   color:var(--red);
}

.shopping-cart .cart-total{
   max-width: 1200px;
   margin:0 auto;
   border:var(--border);
   padding:2rem;
   text-align: center;
   margin-top: 2rem;
   border-radius: .5rem;
}

.shopping-cart .cart-total p{
   font-size: 2.5rem;
   color:var(--light-color);
}

.shopping-cart .cart-total p span{
   color:var(--red);
}

.shopping-cart .cart-total .flex{
   display: flex;
   flex-wrap: wrap;
   column-gap:1rem;
   margin-top: 1.5rem;
   justify-content: center;
}

.shopping-cart .disabled{
   pointer-events: none;
   opacity: .5;
   user-select: none;
}

.display-order{
   max-width: 1200px;
   margin: 0 auto;
   text-align: center;
   padding-bottom: 0;
}

.display-order p{
   background-color: var(--light-bg);
   color:var(--black);
   font-size: 2rem;
   padding:1rem 1.5rem;
   border:var(--border);
   display: inline-block;
   margin:.5rem;
}

.display-order p span{
   color:var(--red);
}

.display-order .grand-total{
   margin-top: 2rem;
   font-size: 2.5rem;
   color:var(--light-color);
}

.display-order .grand-total span{
   color:var(--red);
}

.checkout form{
   max-width: 1000px;
   padding:2rem;
   margin:0 auto;
   border:var(--border);
   background-color: var(--light-bg);
   border-radius: .5rem;
}

.checkout form h3{
   text-align: center;
   margin-bottom: 2rem;
   color:red;
   text-transform: uppercase;
   font-size: 3rem;
}

.checkout form .flex{
   display: flex;
   flex-wrap: wrap;
   gap:1.5rem;
}

.checkout form .flex .inputBox{
   flex:1 1 40rem;
}

.checkout form .flex span{
   font-size: 2rem;
   color:var(--black);
}

.checkout form .flex select,
.checkout form .flex input{
   border:var(--border);
   width: 80%;
   border-radius: .5rem;
   width: 90%;
   background-color: var(--white);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   margin:1rem 0;
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
.header {
            background-image: url(yellow.jpg);
            height:100%;
            background-color: black;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }



   </style>
   
   

</head>
<body>
   <nav class="menu">
        <ul>
         <li>
                <a href="First Page.php">Home</a>
            </li>
            <li>
                <a href="About.php">About</a>
            </li>
            <li>
                <a href="Contact Us.php">Contact Us</a>
            </li>
             <li>
                <a href="orders.php">Orders</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            
        </ul>
        </nav>
        <?php 
        if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
        }
        ?>
        <div class="header">
<div class="heading">
   <h3>checkout</h3>
  
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method on cash on delivery:</span>
            <select name="method">
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>







</body>
</html>