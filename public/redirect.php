<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       redirect.php
    PURPOSE:                    Page that verifies the user
                                and relocate it in case it
                                is admin.
                                
-->
<?php
    session_start();

    if(!isset($_SESSION['user'])){
        if($_SESSION['user']['username']== 'admin'){
                header("Location: adminpage.php");
        }
    }
?>