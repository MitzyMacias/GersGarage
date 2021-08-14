<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       registerpart.php
    PURPOSE:                    Page with the validations to
                                register the vehicle part. The
                                information comes from the 
                                addpart.php page.
                                Admin user only.
                                
-->

<?php
    if(isset($_POST)){

        //Connection to the database
        require_once '../private/connect.php';
        //Start the session
        session_start();
        //receive the values from the addpart form
        //clean the string received, not admitting especial characters
        $id_part = isset($_POST['id_part']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['id_part']))) : false;
        $concept = isset($_POST['concept']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['concept']))) : false;
        $price = isset($_POST['price']) ? mysqli_real_escape_string($db, trim($_POST['price'])) : false;
        $qty = isset($_POST['qty']) ? mysqli_real_escape_string($db, trim($_POST['qty'])) : false;
        
        // Errors Array
        $errors = array();

        //Validate data before store it on db
        //Validate id_part
        if(!empty($id_part)){
            if(strlen($id_part)== 6){
                $query_part = mysqli_query($db, "SELECT * FROM parts WHERE id_part = '$id_part';");
                $result_qp = mysqli_fetch_array($query_part);
                //echo var_dump($query_part);

                if($result_qp > 0){
                    $valid_idpart = false;
                    $errors['id_part'] = "ID Part is already registered";
                }else{
                    $valid_idpart = true;
                }
            }else{
                $errors['id_part'] = "ID part must be 6 characters long";
            }
        }else{
            $valid_idpart = false;
            $errors['id_part'] = "Empty ID Part";
        }

        //Validate concept/name of the part
        if(!empty($concept) ){
            $valid_concept = true;
        }else{
            $valid_concept = false;
            $errors['concept'] = "Invalid concept/name";
        }
        
        //Validate price of the part
        if(!empty($price) ){
            $valid_price = true;
        }else{
            $valid_price = false;
            $errors['price'] = "Invalid price";
        }

        //Validate quantity of the part
        if(!empty($qty) ){
            $valid_qty = true;
        }else{
            $valid_qty = false;
            $errors['qty'] = "Invalid qty";
        }

        $save_part = false;
        if(count($errors) == 0){
            //INSERT PART IN PARTS TABLE
            
            $save_part = true;

            $sql = "INSERT INTO parts VALUES('$id_part',null, '$concept', '$price', '$qty');";
            $save = mysqli_query($db, $sql);

            if($save){
                $_SESSION['completed'] = 'Register completed successfully';
            }else {
                $_SESSION['errors']['general'] = "Error saving the part: ".mysqli_error($db);
            }

        }else{
            $_SESSION['errors'] = $errors;
            
        }
    }
        mysqli_close($db);
        header('Location: addpart.php');
?>