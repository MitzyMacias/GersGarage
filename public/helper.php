<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       helper.php
    PURPOSE:                    Page with some functions
                                applied on the webpage.
                                
-->

<?php
    //function to display the error array according to each field.
    function displayError($errors, $field){
        $alert = '';
        if(isset($errors[$field]) && !empty($field)){
            $alert = "<div class='alert alert-error'>". $errors[$field].'<div>';
        }
        return $alert;
    }

    //function to delete the error session to reset its values
    function deleteErrors(){
        $deleted = false;
        if(isset($_SESSION['errors'])){
            $_SESSION['errors'] = null;
            $deleted = true;
        }
        if(isset($_SESSION['errors_enter'])){
            $_SESSION['errors_enter'] = null;
            $deleted = true;
        }
        if(isset($_SESSION['completed'])){
            $_SESSION['completed'] = null;
            $deleted = true;
        }
        
        return $deleted;
    }
    //function to get the bookings from a customer
    function getBookings($connect, $id_cust){
        $sql = "SELECT * FROM bookings WHERE id_cust=$id_cust; ";
        $bookings2 = mysqli_query($connect, $sql);

        $result = array();
        if($bookings2 && mysqli_num_rows($bookings2) >=1){
            $result = $bookings2;
        }
       // mysqli_free_result($bookings2);
        return $result;
    }

    //function to check bookings booked before the current date to cancel by system.
    // - expiration date - 
    function checkCancellations($connect){
        $sql_book = "SELECT * from bookings";
        $result_book = mysqli_query($connect, $sql_book);
        $cur_date = strtotime(date("d-m-Y H:i:00",time()));
        
        while($st = mysqli_fetch_assoc($result_book)){
            
            if (strtotime("$st[adm_date] 18:00:00") < $cur_date && strtoUpper($st[status]) == "BOOKED"){
                $st[status] = "Cancelled";
                $st[comments] = $st[comments]+"Cancelled by the system";
            }
        }mysqli_free_result($result_book);
    }

    // function to count the bookings on a specific date
    function countBookings($connect, $date){
        $sql_b = "SELECT * from bookings where adm_date= '$date'";
        $result_b = mysqli_query($connect, $sql_b); 
        $totalb=0;
        $bo="";
        while($bo = mysqli_fetch_assoc($result_b)){
            $totalb++; 
        }mysqli_free_result($result_b);
        return $totalb;
    }

    //function to count the bookings on a specific date and time
    function countBookings2($connect, $date, $time){
        $sql_b = "SELECT * from bookings where adm_date= '$date' AND adm_time= '$time'";
        $result_b = mysqli_query($connect, $sql_b); 
        $totalb=0;
        $bo="";
        while($bo = mysqli_fetch_assoc($result_b)){
            $totalb++; 
        }mysqli_free_result($result_b);
        return $totalb;
    }

?>