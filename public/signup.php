<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       signup.php
    PURPOSE:                    Page with the information required
                                to be filled to register a new 
                                into the database customer.
                                
-->

<?php

require_once 'helper.php';
session_start();
?>
   <?php if(!isset($_SESSION['user'])):?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/styles2.css">
            <title>Sign Up Page</title>
        </head>
        <body>
            <h1 class="main-title"><a href="index.php"><span class="colour-span">Ger's</span> Garage</a></h1>
        
                <div class= "signup-box">
                    
                    <form action="register.php" class="form-register" method="POST">
                        <div class="container-inputs">
                            <h1>Sign Up</h1>
                            <p>Please fill in this form to create an account.</p>
                            <hr>

                            <!-- Display errors -->
                            <?php 
                                if(isset($_SESSION['completed'])) : ?>
                                    <div class="alert alert-success">
                                        <?=$_SESSION['completed']?>
                                    </div>
                            <?php elseif(isset($_SESSION['errors']['general'])): ?>
                                    <div class="alert alert-error">
                                        <?=$_SESSION['errors']['general']?>
                                    </div>
                            <?php endif; ?>

                            <label for="first_name"><b>First Name</b></label>
                            <input type="text" name="first_name" id="first_name" value="" 
                            class="input-48" pattern="[A-Za-z]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'first_name') : ''; ?>

                            <label for="last_name"><b>Last Name</b></label>
                            <input type="text" name="last_name" id="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];}?>"
                            placeholder="Last Name" class="input-48"pattern="[A-Za-z]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'last_name') : ''; ?>
                            

                            <label for="email"><b>Address</b></label>
                            <input type="text" name="address" id="address" 
                            placeholder="Address" class="input-100" pattern="[A-Za-z0-9 ]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'address') : ''; ?>

                            <label for="date_of_birth"><b>Date of birth</b></label>
                            <input type="date" placeholder="" name="DOB" 
                            required><br/><br/>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'DOB') : ''; ?>

                            <label for="mobile"><b>Mobile (10 digits, e.g. 0831234567): </b></label>
                            <input type="text" placeholder="Enter Mobile Number" name="mobile" pattern="[0-9]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'mobile') : ''; ?>

                            <label for="username"><b>Username (from 8 to 10 letters/numbers)</b></label>
                            <input type="text" placeholder="Enter Username" name="username" pattern="[A-z0-9_\-]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'username') : ''; ?>        

                            <label for="email"><b>Email:</b></label>
                            <input type="text" placeholder="Enter Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'email') : ''; ?>

                            <label for="psw"><b>Password: Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'psw') : ''; ?>

                            <label for="psw-repeat"><b>Repeat Password:</b></label>
                            <input type="password" placeholder="Repeat Password" name="psw_repeat" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'psw_repeat') : ''; ?>

                            <p>By creating an account you agree to our <a href="policy.php" style="color:dodgerblue">Terms & Privacy</a>.</p>

                            <div class="clearfix">
                                <button type="button" class="cancelbtn" onclick="location.href='index.php'">Cancel</button>
                                <button type="submit" class="signupbtn" name="submit">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <?php deleteErrors();?>
                </div>
        </body>
        </html>
    <?php else: 
        header("Location:index.php");
    endif; ?>
