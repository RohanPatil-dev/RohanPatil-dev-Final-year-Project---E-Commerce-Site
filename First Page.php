<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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


        .container-fluid {
            font-size: 35px;
            color:danger;
            text-align: center;          
            background-position: center;
            color: #00ff21;
            position: absolute;
            top:8%;
        }

        h1 {
            margin: 0 0 0 20px;
            letter-spacing: 1px;
            font-size: 20px;
            color: #111;
            bgcolor ="Blue";
            color: springgreen;
            top: 60px;
            width: 100%;
        }

        .marquee {
            font-size: 50px;
            color: black;
            background-color: #0026ff;
            position: absolute;
            top: 119px;
            width: 100%;
        }

        .header {
            background-image: url(yellow.jpg);
            height: 680px;
            background-color: black;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .button {
            padding: 0;
            margin: 0;
            width: 30%;
            height: 30%;
            text-align: center;
            top: 300px;
            left: 22%;
            position: relative;
            border: 3px solid;
            border-radius: 5px;
            transition-duration: .60s;
        }

        .button1 {
            box-shadow: 0 30px 60px rgba(0,0,0.5);
            background-image: url(Marvel.gif);
        }

            .button1:hover {
                box-shadow: 0 5px 10px rgba(0,0,0.5);
                transform: scale(.95);
            }

        .button2 {
            box-shadow: 0 30px 60px rgba(0,0,0.5);
            background-image: url(DC.gif);
        }

            .button2:hover {
                box-shadow: 0 5px 10px rgba(0,0,0.5);
                transform: scale(.95);
            }

        p {
            padding: 0;
            margin-top: 100px;
            text-align: center;
            font-size: 50px;
            font-family: sans-serif;
            box-sizing: border-box;
            border-bottom: 4px solid #555;
            position: absolute;
            margin-left: 22%;
            text-shadow: 0 20px 30px rgba(0,0,0,.8);
            border-radius: 10px;
            color: #ff148f;
        }
    </style>
</head>
<body>

    <nav class="menu">
        <ul>        
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
                <a href="cart.php">Cart</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            
        </ul>
        
    </nav>
    <div class="container-fluid p-1 bg-primary text-white text-center">
        <H1<b>Welcome To Mighty Comic Store</b></H1>
        </div>
        <div class="header">
            <marquee class="marquee" behavior="alternate" scrollamount="10">

                <h1>
                    <b>We have more discount in new comics</b>
                </h1>
            </marquee>
            <p><b>WHAT'S YOUR FAVOURITE UNIVERSE</b></p>
            <a href="Second Page.php"><button class="button button1"></button></a>
            <a href="Third Page.php"><button class="button button2"></button></a>

        </div>
</body>
</html>

