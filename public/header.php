<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       header.php
    PURPOSE:                    Page to display the header
                                of the pages.
                                
-->

<?php
    require_once '../private/connect.php';
    require_once 'helper.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ger's Garage</title>
    <script> language="javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <header class="main-header">
        <div class="container container-flex">
            <h1 class="main-title"><span class="colour-span"><a href="index.php">Ger's</a></span> Garage</h1>
            <nav class="main-nav">
                <span class="icon-menu" id="btn-menu"><i class="fas fa-bars"></i></span>
                <ul class="menu" id="menu">
                    <li class="menu_item"><a href="index.php" class="menu_link menu_link-select"><span>Home</span></a></li>
                    <?php if(isset($_SESSION) && $_SESSION['user']['username']=='admin'): ?>
                        <li class="menu_item"><a href="adminpage.php" class="menu_link"><span>Management</span></a></li>
                    <?php else: ?>
                        <li class="menu_item"><a href="services.php" class="menu_link"><span>Services</span></a></li>
                    <?php endif; ?>
                    <li class="menu_item"><a href="bookings.php" class="menu_link"><span>Bookings</span></a></li>
                    <!-- <li class="menu_item"><a href="" class="menu_link" onclick="document.getElementById('id01').style.display='block'"><span>Log In</span></a></li> -->
                    <?php if(!isset($_SESSION['user'])):?>
                        <button class="menu_item-btn" onclick="document.getElementById('id01').style.display='block'"><span>Log In</span></a></button>
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
        <?php
            function phpAlert($msg) {
                echo '<script type="text/javascript">alert("' . $msg . '")</script>';
            }
        ?>

        <?php if(isset($_SESSION['error_login'])):?>
            <div class="alert alert-error">
                <?=$_SESSION['error_login'];
                phpAlert($_SESSION['error_login']); 
                session_destroy();
                ?>
                
            </div>
        <?php endif; ?> 
    </nav> 

    <?php if(isset($_SESSION['user'])):?>
        <nav class="main-nav2">
            <div class="nextBookings">
                <h3>Next Bookings... </h3>
                <?php  
                //checkCancellations($db);
                $id_cust = $_SESSION['user']['id_cust']; 
                $bookings = getBookings($db,$id_cust); 
                if(!empty($bookings)): ?>
                    <div class="tableb">
                        <table role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                <th role="columnheader">ID Booking</th>
                                <th role="columnheader">Service Type</th>
                                <th role="columnheader">Admission Date</th>
                                <th role="columnheader">Admission Time</th>
                                <th role="columnheader">License Plate</th>
                                <th role="columnheader">Status</th>
                            </thead>
                            <tbody role="rowgroup">
                                <?php
                                while($booking = mysqli_fetch_assoc($bookings)): ?>
                                    <tr role="row">
                                            <td role="cell"><?php echo $booking["id_booking"];?></td>
                                            <td role="cell"><?php echo strtoupper($booking["type_serv"]);?></td>
                                            <td role="cell"><?php echo date("d-m-Y",strtotime($booking["adm_date"]));?></td>
                                            <td role="cell"><?php echo $booking["adm_time"];?></td>
                                            <td role="cell"><?php echo $booking["lic_plate"];?></td>
                                            <td role="cell"><?php echo $booking["status"];?></td>
                                    </tr>
                                <?php
                                endwhile; 
                                mysqli_free_result($bookings); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <h3>No bookings</h3>
                <?php endif; ?>
            </div>        
        </nav>
    <?php else:?>
        <nav class="main-nav2">
            <div class="videoframe">
                <h2 style="color:white">Welcome to the best Garage in Dublin!</h2>
                <iframe class="video" src="https://www.youtube.com/embed/SFTp8xZIyx8" >
                </iframe>
            </div>
        </nav>

    <?php endif; ?>

    <!-- LOGIN FORM-->    
            
            <!-- Button to open the modal login form -->
           <!-- <button onclick="document.getElementById('id01').style.display='block'">Login</button>  -->

            <!-- The Modal -->
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'"
                class="close" title="Close Modal">&times;</span>

                <!-- Modal Content -->
                <!-- <form class="modal-content animate" action="/action_page.php"> -->
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
                            <button class="signup" name="signup" onclick="location.href='signup.php'"> Sign Up</button>
                        </label>
                    </div>

                    <div class="container2" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
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
