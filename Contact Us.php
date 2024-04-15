<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Contact Us</title>
     </head>
<style>

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
    .form-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        padding-bottom: 60px;
        
    }
     .form-container form {
            padding: 20px;
            border-radius: 5px;
            border-shadow: 0 5px 10px #00ffff;
            background: #00ffff;
            border-radius: 25px;
            text-align: center;
            width: 500px;
        }
           .text{
                text-align:center;
                padding:30px;
               color:darkblue;
            }
    .header {
        height:100%;
        background-image: url(boom.jpg);          
    }
</style>

<body>
    <div class="header">
    
    <nav class="menu">
        <ul>
         <li>
                <a href="First Page.php">Home</a>
            </li>
            <li>
                <a href="About.php">About</a>
            </li>
             <li>
                <a href="orders.php">Orders</a>
            </li>          
             <li>
                <a href="cart.php">Cart</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="form-container">
        <form action="" method="post">
            <div class="text">
                <h1><b>Contact Us</b></h1>
                <p><b>If you have any problem then contact with</b></p>
                <p><b>Phone Number:91+9960594340</b></p>
                <p><b>Email:Comic-Verse@gmail.com</b></p>
            </div>
    </div>
    </div>


</body>
</html>
