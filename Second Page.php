<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
  

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
   padding:0rem 0rem;
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



.products .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: flex-start;
   gap:1.5rem;
   justify-content: center;
}

.products .box-container .box{
   border-radius: .5rem;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   padding:2rem;
   text-align: center;
   border:var(--border);
   position: relative;
}

.products .box-container .box .image{
   height: 30rem;
}

.products .box-container .box .name{
   padding:1rem 0;
   font-size: 2rem;
   color:var(--black);
}


.products .box-container .box .price{
  
   border-radius: .5rem;
   padding:1rem;
   font-size: 2.5rem;
   color:var(--white);
   background-color: var(--red);
}

.heading h3{
   font-size: 5rem;
   color:var(--black);
   text-transform: uppercase;
}
.header {
            background-image: url(yellow.jpg);
            height:1000px;
            background-color: black;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .sale{             
            margin: 0 0 0 20px;
            letter-spacing: 1px;
            font-size: 50px;         
            top: 60px;
            width: 100%;
        }
        .empty{
   padding:1.5rem;
   text-align: center;
   border:var(--border);
   background-color: var(--white);
   color:var(--red);
   font-size: 2rem;
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
                <a href="cart.php">Cart</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul> 
</nav>
<div class="header"> 
<section class="products">
 <div class="container-fluid p-4 bg-primary text-white text-center">
            <h1 class="sale"><b>Marvel Comics</b></h1>
        </div>
  

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
    
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No Products Added</p>';
      }
      ?>
   </div>

</section>




<!--For old comics  !-->
</body>
</html>