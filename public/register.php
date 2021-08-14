<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       register.php
    PURPOSE:                    Page with the right validations
                                to process the register of the
                                customers.
-->

<?php
    //Start the session
    session_start();
    
    if(isset($_POST)){

        //Connection to the database
        require_once '../private/connect.php';

        //receive the values from the register form
        //clean the string received, not admitting especial characters
        $first_name = isset($_POST['first_name']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['first_name']))) : false;
        $last_name = isset($_POST['last_name']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['last_name']))) : false;
        $address = isset($_POST['address']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['address']))) : false;
        $DOB = isset($_POST['DOB']) ? mysqli_real_escape_string($db, trim($_POST['DOB'])) : false;
        $mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($db, trim($_POST['mobile'])) : false;
        $username = isset($_POST['username']) ? mysqli_real_escape_string($db, trim($_POST['username'])) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $psw = isset($_POST['psw']) ? mysqli_real_escape_string($db, trim($_POST['psw'])) : false;
        $psw_repeat = isset($_POST['psw_repeat']) ? mysqli_real_escape_string($db, trim($_POST['psw_repeat'])) : false;

        // Errors Array
        $errors = array();

        //Validate data before store it on db
        //Validate first name 
        if(!empty($first_name) && !is_numeric($first_name) && !preg_match("/[0-9]/", $first_name)){
            $valid_firstname = true;
        }else{
            $valid_firstname = false;
            $errors['first_name'] = "Invalid first name";
        }
        //Validate last name
        if(!empty($last_name) && !is_numeric($last_name) && !preg_match("/[0-9]/", $last_name)){
            $valid_lastname = true;
        }else{
            $valid_lastname = false;
            $errors['last_name'] = "Invalid last name";
        }

        //Validate Address
        if(!empty($address)){
            $valid_address = true;
        }else{
            $valid_address = false;
            $errors['address'] = "Invalid Address";
        }

        //Validate date of birth
        if(!empty($DOB)){
            $valid_DOB = true;
        }else{
            $valid_DOB = false;
            $errors['DOB'] = "Empty date of birth";
        }

        //Validate Mobile
        if(!empty($mobile) && preg_match("/[0-9]/", $mobile)){
            if(strlen($mobile) == 10){
                $valid_mobile = true;
            }else{
                $errors['mobile'] = "Mobile number must be 10 characteres long";
            }
        }else{
            $valid_mobile = false;
            $errors['mobile'] = "Invalid mobile";
            
        }

        //Validate Username
        if(!empty($username)){
            if(strlen($username)<11 && strlen($username)>7){
                $query_user = mysqli_query($db, "SELECT * FROM customer WHERE username = '$username';");
                $result_query = mysqli_fetch_array($query_user);
                if($result_query >0){
                    $valid_username = false;
                    $errors['username'] = "Username is already registered";
                }else{
                    $valid_username = true;
                }
            }else{
                $errors['username'] = "Username must be 8-10 characters long";
            }
        }else{
            $valid_username = false;
            $errors['username'] = "Empty username";
        }

        //Validate Email
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $query_email = mysqli_query($db, "SELECT * FROM customer WHERE email = '$email';");
            $result_query = mysqli_fetch_array($query_email);
                if($result_query >0){
                    $valid_email = false;
                    $errors['email'] = "Email is already registered";
                }else{
                    $valid_email = true;
                }
        }else{
            $valid_email = false;
            $errors['email'] = "Invalid email";
        }

        //Validate Password
        if(!empty($psw)){
            
            if($psw != $psw_repeat){
                $valid_psw_repeat = false;
                $valid_psw = false;
                $errors['psw_repeat'] = "Passwords does not match";
                $errors['psw'] = "Passwords does not match";
            }else{
                $valid_psw = true;
                $valid_psw_repeat = true;
            }
        }else{
            $valid_psw = false;
            $errors['psw'] = "Empty password";
        }

        $save_user = false;
        if(count($errors) == 0){
            //INSERT USER IN CUSTOMERS TABLE
            
            $save_user = true;

            //Encode the password
            //cost = the number of times the password will be encrypted
            $safe_psw = password_hash($psw, PASSWORD_BCRYPT,['cost'=>4]);
            
            $sql = "INSERT INTO customers VALUES(null, '$first_name', '$last_name', '$address', '$DOB', '$mobile', '$email', '$username', '$safe_psw');";
            $save = mysqli_query($db, $sql);

            if($save){
                $_SESSION['completed'] = 'Register completed successfully';
            }else {
                $_SESSION['errors']['general'] = "Error saving the user: ".mysqli_error($db);
            }

        }else{
            $_SESSION['errors'] = $errors;
            
        }
    }
        mysqli_close($db);
        header('Location: signup.php');
?>