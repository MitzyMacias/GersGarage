<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       loginform.php
    PURPOSE:                    Page with the form to fill
                                by the user to enter to the
                                system.
                                
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Login Form</title>
</head>
<body>
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
                            <!-- <input type="checkbox" checked="checked" name="remember"> Remember me -->
                            <a href="signup.php" class="signup" name="signup"> Sign Up</a> 
                            <!-- <button class="signup" name="signup" onclick="document.getElementById('id02').style.display='block'"> Sign Up</button> -->
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
    
</body>
</html>
