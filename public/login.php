<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       login.php
    PURPOSE:                    Page to process the login
                                information and verification
                                to enter to the system.
                                
-->

<?php

//Start the session
require_once '../private/connect.php';
session_start();

require_once 'helper.php';

//Receive data from the form 
if(isset($_POST)){
 
    //delete the last error
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    //receive data from form
    $username = trim($_POST['username']);
    $psw = $_POST['psw'];


    //Query to verify the user id
    $sql = "SELECT * FROM customers WHERE username= '$username'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        $user = mysqli_fetch_assoc($login);
        
        
        //Verify password
        $verify = password_verify($psw, $user['psw']);

        if($verify){
            // Use the session to save the data from the logged user
            $_SESSION['user'] = $user;     

        }else{
            //If something fails, send an error session
            $_SESSION['error_login'] = "Incorrect Password";
        
        }
    }else{
        //Error message
        $_SESSION['error_login'] = "Incorrect Login: not found";
        //window.alert("Incorrect Login:not found");

    }
    mysqli_close($db);
}
        //Redirect to index.php
        header('Location:index.php');
?>