<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       process_updateb.php
    PURPOSE:                    Page with the process of updating
                                the mechanic and status by booking.
                                It receives the information from 
                                adminpage.php
                                
-->

<?php
    session_start();
    //checking the session of admin

        if(isset($_POST)){

        //Connection to the database
        require_once '../private/connect.php';

        //receive the values from the update form
        $mech = (int)(isset($_POST['mec'])? mysqli_real_escape_string($db, trim($_POST['mec'])) : false);
        $status = isset($_POST['stat']) ? mysqli_real_escape_string($db, trim($_POST['stat'])) : false;
        $idb = (int)(isset($_POST['idb']) ? mysqli_real_escape_string($db, trim($_POST['idb'])) : false);


        // Errors Array
        $errors = array();

        //Validate data before store it on db
        //Validate $mech 
        if(!empty($mech) || $mech!=0){
            $valid_mech = true;
        }else{
            $valid_mech = false;
            $errors['id_mech'] = "Invalid Mechanic";
        }

        //Validate status
        if(!empty($status)){
            $valid_status = true;
        }else{
            $valid_status = false;
            $errors['status'] = "Invalid status";
        } 


        $save_changes = false;
        if(count($errors) == 0){
            //UPDATE BOOKINGS IN CUSTOMERS TABLE
            $save_changes == true;

            $booking = $idb;
            $sql = "UPDATE bookings SET id_mech = $mech, status = '$status' WHERE id_booking= $idb";

            $save = mysqli_query($db, $sql);

            
            if($save){
                //$_SESSION['completed'] = 'Register updated successfully';
                echo "<script>
                    alert('User updated successfully! Please update the page to see them correctly');
                    window.history.go(-2);
                </script>";
                die();
            }else {
                //$_SESSION['errors']['general'] = "Error saving the user: ".mysqli_error($db);
                echo "<script> 
                    alert('There was an error: Make sure you pick one mechanic and one status');
                    window.history.go(-2);
                    </script>";
                    die();
            } 
        }

    }
    mysqli_close($db);
    header("Location:index.php");

?>
