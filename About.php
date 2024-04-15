<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>About</title>
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
    .header {
        background-image: url(pop.jpg);
        height: 680px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover
    }
    .Head {
        padding: 0;
        margin-top: 0px;
        text-align: center;
        font-size: 50px;
        font-family: sans-serif;
        box-sizing: border-box;
        border-bottom: 4px solid #555;
        position: absolute;
        margin-left: 42%;
        text-shadow: 0 20px 30px rgba(0,0,0,.8);
        border-radius: 5px;
        color:#0026ff;
        }
        .container{
            max-width:80%;
            margin-top:50px;
            margin-left:10%;
        }
        p{
            padding:15px;
            font-size:25px;
            border-radius:10px;
            border:1px solid #ccc9c3;
            color:white;
        }
        .read-more-state{
            display:none;
        }
        .read-more-target{
            max-height:0;
            opacity:0;
            font-size:0;
            transition:0.45s ease;
        }
        .read-more-state:checked~.read-more-wrap .read-more-target{
            opacity:1;
            font-size:inherit;
        }
        .read-more-state~.read-more-trigger:before{
            content:'Read More';
        }
        .read-more-state:checked~.read-more-trigger:before{
            content:'Read More';
        }
        .read-more-state:checked~.read-more-trigger:before{
            content:'Read Less';
        }
        .read-more-trigger{
            margin-top:20px;
            padding:0 25px;
            display:inline-block;
            cursor:pointer;
            font-size:20px;
            line-height:2;
            border-radius:10px;
            background-color:#00ff90;
        }
</style>
<body>

    <nav class="menu">
        <ul>
             <li>
                <a href="First Page.php">Home</a>
            </li>
            <li>
                <a href="Contact Us.php">Contact US</a>
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
    <div class="header">
        <br> <br> <br> <br><br>
        <p class="Head"><b>About</b></p>
        <br>
        <div class="container">
            <input type="checkbox" class="read-more-state" id="post" />

            <p class="read-more-wrap">
                <b>
                    I am a fronted-end and back-end web developer.I have provide a clean and systematically code.
                    I make my code by college studies.I have done my best to create this website and I am really very
                    very happy to create my own website.<span class="read-more-target">
   Comics is a narrative used to express our ideas with images,often combined with text or other visual information.It takes the
   form of sequence of panels of images.It's a language to increase innovating ideas and imagination power.This website made for children's 
   and youngster's because today's generation mostly spent their time on playing games on mobile and computer.This games changes childeren's behaviour,dopamine addiction & social disconnection
   etc.We create this website for same purpose or motive to youngster's leave their gadgets and purchase our comics.This web application created 
   using PHP and MYSQL language because it is easy to learn.
</b>
                </span>
            </p>
            <label for="post" class="read-more-trigger"></label>
        </div>
    </div>
</body>
</html>