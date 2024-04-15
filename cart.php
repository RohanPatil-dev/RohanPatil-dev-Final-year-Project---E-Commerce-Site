<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

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


html{
   font-size: 62.5%;
   overflow-x: hidden;
}

section{
   padding:3rem 2rem;
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

.btn,
.option-btn,
.delete-btn,
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



.white-btn,
.btn{
   background-color:green;
}
.option-btn{
   background-color: var(--orange);
}

.delete-btn{
   background-color: var(--red);
}



.heading{
   min-height: 30vh;
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
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

.heading p a:hover{
   text-decoration: underline;
}

.empty{
   padding:1.5rem;
   text-align: center;
   border:var(--border);
   background-color: var(--white);
   color:var(--red);
   font-size: 2rem;
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
   color:black;
   border-radius: .5rem;
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
    border-radius: .5rem;
                    padding: 1rem;
                    font-size: 1.5rem;
                    color: var(--white);
                    background-color: var(--red);
}

.shopping-cart .box-container .box input[type="number"]{
  
   border:var(--border);
   border-radius: 2rem;
   padding:1.2rem 1.4rem;
   font-size: 1.5rem;
   color:var(--black);
   width: 9rem;
   text-align:center;
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
                <a href="logout.php">Logout</a>
            </li>
        </ul> 
</nav>
<div class="header">  


<div class="heading">
   <h3>shopping cart</h3>
   
</div>

<section class="shopping-cart">

  

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');">X</a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty"> cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
         <a href="First Page.php" class="option-btn">continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
      </div>
   </div>

</section>

</body>
</html>