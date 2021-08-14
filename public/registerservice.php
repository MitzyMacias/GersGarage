<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       registerservice.php
    PURPOSE:                    Page with the validations to
                                register a new service. The
                                information comes from the 
                                addservice.php page.
                                Admin user only.
                                
-->

<?php
    if(isset($_POST)){

        //Connection to the database
        require_once '../private/connect.php';
        //Start the session
        session_start();
        //receive the values from the addservice form
        //clean the string received, not admitting especial characters
        //$id_service = isset($_POST['id_service']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['id_service']))) : false;
        $concept = isset($_POST['concept']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['concept']))) : false;
        $price = isset($_POST['price']) ? mysqli_real_escape_string($db, trim($_POST['price'])) : false;
        
        // Errors Array
        $errors = array();

        //Validate data before store it on db
        //Validate service concept/name
        if(!empty($concept)){
                $query_service = mysqli_query($db, "SELECT * FROM parts WHERE concept = '$concept';");
                $result_sv = mysqli_fetch_array($query_service);
               
                if($result_sv > 0){
                    $valid_concept = false;
                    $errors['concept'] = "Service name is already registered";
                }else{
                    $valid_concept = true;
                }
        }else{
            $valid_concept = false;
            $errors['concept'] = "Empty Service name";
        }
        
        //Validate price of the part
        if(!empty($price) ){
            $valid_price = true;
        }else{
            $valid_price = false;
            $errors['price'] = "Invalid price";
        }

        $save_part = false;
        if(count($errors) == 0){
            //INSERT PART IN PARTS TABLE
            
            $save_part = true;

            $sql = "INSERT INTO services VALUES(null, null, '$concept', '$price');";
            $save = mysqli_query($db, $sql);

            if($save){
                $_SESSION['completed'] = 'Register completed successfully';
            }else {
                $_SESSION['errors']['general'] = "Error saving the service: ".mysqli_error($db);
            }

        }else{
            $_SESSION['errors'] = $errors;
            
        }
    }
        mysqli_close($db);
        header('Location: addservice.php');
?>