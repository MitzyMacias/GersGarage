<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       services.php
    PURPOSE:                    Page with the list of services
                                offered by the Garage and there's
                                a button with the link to make the
                                booking.
                                
-->
<?php
    require_once '../private/connect.php';
    require_once 'helper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ger's Garage</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <header class="main-header">
        <div class="container container-flex">
        <h1 class="main-title"><a href="index.php"><span class="colour-span">Ger's</span> Garage</a></h1>
            <nav class="main-nav">
                <span class="icon-menu" id="btn-menu"><i class="fas fa-bars"></i></span>
                <ul class="menu" id="menu">
                    <li class="menu_item"><a href="index.php" class="menu_link"><span>Home</span></a></li>
                    <li class="menu_item"><a href="services.php" class="menu_link menu_link-select"><span>Services</span></a></li>
                    <li class="menu_item"><a href="bookings.php" class="menu_link"><span>Bookings</span></a></li>
                    <!-- <li class="menu_item"><a href="" class="menu_link" onclick="document.getElementById('id01').style.display='block'"><span>Log In</span></a></li> -->
                    <?php if(!isset($_SESSION['user'])):?>
                        <button class="menu_item-btn" onclick="document.getElementById('id01').style.display='block'"><span>Log In</span></button>
                    <?php endif; ?>
                    <div class= "nav-social">
                        <a href="" class="nav-social_item"><i class="fab fa-facebook-f"></i></a>
                        <a href="" class="nav-social_item"><i class="fab fa-twitter"></i></a>
                        <a href="" class="nav-social_item"><i class="fab fa-youtube"></i></a>
                    </div>
                </ul>
            </nav>
        </div>
    </header>
    <div class="banner">
        <div class="banner_content">    
            <div class="container">
                    <h2 class="banner_title"></h2>
                    <p class="banner_txt"></p>
            </div>
        </div>    
    </div>

    <nav class="main-nav">
        <?php if(isset($_SESSION['user'])):?>
        <div id="logged-user" class="block">
            <h3>Welcome, <?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']. '!';?></h3>
                <a href="logout.php" class="welcome_btn2"><span>Log Out</span></a>
                <!--<a href="change.php" class="welcome_btn2"><span>My details</span></a>-->
        </div>
        <?php endif; ?> 
        
        <?php if(isset($_SESSION['error_login'])):?>
            <div class="alert alert-error">
                <?=$_SESSION['error_login'];?>
            </div>
        <?php endif; ?> 
    </nav> 
    <!-- display of the services -->
    <main class="main2">
        <h1>Services Offered</h1>    
        <section class="container-design">
            <div class="design_item">
                <h3 class="design_title">ANNUAL SERVICE</h3> 
                <ul>
                    <li>Engine oil change and/or filter replacement</li>
                    <li>Checking lights, tyres, exhaust and operations breaks</li>
                    <li>Ensuring your engine is 'tuned' to run in its peak condition</li>
                    <li>Checking hydraulic fluids and coolant levels</li>
                    <li>Checking cooling system</li>
                    <li>Suspension checks</li>
                    <li>Steering alignment</li>
                    <li>Testing the car's battery condition</li>
                </ul>
                <a href="bookings.php" class="bookbutton"><span> Book now </span></a>
                <img src="../images/garage6.jpg" alt="" class="design_img">
                
            </div>
            <div class="design_item">
                <h3 class="design_title">MAJOR SERVICE</h3>
                <ul>
                    <li>Check brake fluid level, top up and replacement</li>
                    <li>Check clutch and power steering fluid level</li>
                    <li>Check battery terminals and security level</li>
                    <li>Replace spark plugs(long life/iridium spark plugs</li>
                    <li>Replace fuel filter</li>
                    <li>Replace air filter</li>
                    <li>Replace oil filter</li>
                    <li>Replace engine oil</li>
                </ul>
                <a href="bookings.php" class="bookbutton"><span> Book now </span></a>
                <img src="../images/garage3.jpg" alt="" class="design_img">
            </div>
            <div class="design_item">
                <h3 class="design_title">REPAIR/FAULT</h3> 
                <ul>
                    <li>Sputtering Engine</li>
                    <li>Shaking Steering Wheels</li>
                    <li>Squeaking/Grinding</li>
                    <li>Flat Tyres</li>
                    <li>Too much oil consumption</li>
                    <li>Leaking Radiator</li>
                    <li>Rust in the car</li>
                    <li>Overheating</li>
                </ul>
                <a href="bookings.php" class="bookbutton"><span> Book now </span></a>
                <img src="../images/garage4.jpg" alt="" class="design_img">
            </div>
            <div class="design_item">
                <h3 class="design_title">MAJOR REPAIR</h3>
                <ul>
                    <li>Electrical problems: Flat Battery</li>
                    <li>Water in transmisstion System</li>
                    <li>Clogged Transmission Filters</li>
                    <li>Leaking Transmission Fluid</li>
                    <li>Gear Box Problems/Transmission Failures</li>
                    <li>Malfunctioning Sensors</li>
                    <li>Excessive Emissions</li>
                    <li>Start Motos Failures</li>
                </ul>
                <a href="bookings.php" class="bookbutton"><span> Book now </span></a>
                <img src="../images/garage5.jpg" alt="" class="design_img">
            </div>
        </section>
    </main>

    <!-- LOGIN FORM-->    
            
            <!-- The Modal -->
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'"
                class="close" title="Close Modal">&times;</span>

                <!-- Modal Content -->
                
                <form class="modal-content animate" action="login.php" method="POST">
                    <div class="imgcontainer">
                        <img src="../images/avatar3.png" alt="Avatar" class="avatar">
                    </div>

                    <div class="container2">
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <button type="submit" name="submit">Login</button>
                        <label>
                            <a href="signup.php" class="signup" name="signup"> Sign Up</a> 
                        </label>
                    </div>

                    <div class="container2" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                        <span class="psw">Forgot <a href="#">password?</a></span>
                    </div>
                </form>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>

    <!-- END OF LOGIN FORM-->
    <?php require 'footer.php'; mysqli_close($db); ?>
    
</body>
</html>