<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       create-bookings.php
    PURPOSE:                    Page to process the bookings
                                registration.
-->

<?php

if(isset($_POST)){
    require_once '../private/connect.php';
    require_once 'helper.php';

    //customer data
    $first_name = isset($_POST['first_name']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['first_name']))): false;
    $last_name = isset($_POST['last_name']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['last_name']))): false;
    $mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($db, trim($_POST['mobile'])): false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']): false;
    $id_cust = (integer)(isset($_POST['id_cust']) ? mysqli_real_escape_string($db, $_POST['id_cust']): false);
 
    //booking data
    $comments = isset($_POST['comments']) ? strtoupper(mysqli_real_escape_string($db, $_POST['comments'])): false;
    $type_serv = isset($_POST['typeserv']) ? strtoupper(mysqli_real_escape_string($db, $_POST['typeserv'])): false;
    $adm_time = isset($_POST['adm_time'])? mysqli_real_escape_string($db, $_POST['adm_time']): false;
    $adm_date = isset($_POST['adm_date'])? date('Y/m/d',strtotime(mysqli_real_escape_string($db, $_POST['adm_date']))): false;
    

    //car data
    $lic_plate = isset($_POST['lic_plate']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['lic_plate']))): false;
    $type_veh = isset($_POST['type_veh']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['type_veh']))): false;
    $engine_type = isset($_POST['engine_type']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['engine_type']))): false;
    $make = isset($_POST['make']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['make']))): false;
    $colour = isset($_POST['colour']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['colour']))): false;
    $veh_year = isset($_POST['veh_year']) ? mysqli_real_escape_string($db, trim($_POST['veh_year'])): false;
    $mileage = isset($_POST['mileage']) ? (int)($_POST['mileage']): false;

    //Validation

    $sql2=("SELECT * FROM vehicles WHERE lic_plate='$lic_plate';");
    $lic = mysqli_query($db, $sql2);
    if($lic && mysqli_num_rows!=1){
        $sql3="INSERT INTO vehicles VALUES('$lic_plate',$id_cust, '$type_veh','$engine_type','$make','$colour','$veh_year',$mileage);";
        $save_veh= mysqli_query($db,$sql3);
     }
    $errors = array();

    if(empty($first_name)){
        $errors['first_name'] = 'Not valid first name';
    }

    if(empty($last_name)){
        $errors['last_name'] = 'Not valid last name';
    }
    if(empty($mobile)){
        $errors['mobile'] = 'Not valid mobile';
    } 

    // Counting the number of bookings on this date
    if($adm_date== '1970/01/01'){   //user left an empty field on date
        $errors['adm_date'] = 'Please choose a date';
        echo "<script> 
                alert('There was an error: Please choose a date... $adm_date, $adm_time' );
                window.history.go(-1);
                </script>";
        die();
    }
    
    $howManyBookings = 0;    
    $howManyBookings = countBookings2($db, $adm_date, $adm_time);

    if($howManyBookings >= 4) {  
        $errors['adm_date'] = 'No availability on this day/time';
        echo "<script> 
                alert('There was an error: No availability, please choose another date/time $adm_date, $adm_time' );
                window.history.go(-1);
              </script>";
        die();
    }

    if(count($errors==0)){
        $sql = "INSERT INTO bookings VALUES(null, $id_cust, null,'$lic_plate','$comments','$type_serv', '$adm_time', '$adm_date', 'BOOKED');";
        $save_book = mysqli_query($db, $sql);
        if($save_book){
            echo "<script> 
                    alert('The booking was save on: $adm_date, $adm_time' );
                    window.history.go(-2);
                </script>";
            die();
        }else{
            echo "<script> 
                alert('Unexpected error: $errors, $save_book' );
                window.history.go(-1);
              </script>";
        die();
        }
    }else{
        $_SESSION["errors_bookings"] = $errors;
        mysqli_free_result($save_book);
        //echo $errors;
        echo "<script> 
                alert('There was an error: $errors' );
                window.history.go(-1);
              </script>";
        die();
    }
}
mysqli_free_result($save_book);
mysqli_close($db);
header("Location: index.php");
?>