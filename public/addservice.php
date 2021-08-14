<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       addservice.php
    PURPOSE:                    Page to Add Services
                                to the database
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';
    //check the session for Administrator = 'admin'
    if(isset($_SESSION) && $_SESSION['user']['username']=='admin'){

        $parts_query = "SELECT * FROM parts;";

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome to Ger's Garage - Administrator Page | Add Services </title>
            <script> language="javascript" src="js/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
            <link rel="stylesheet" href="../css/styles.css">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        </head>
        <body>
            <header class="main-header">
                <div class="container container-flex">
                <h1 class="main-title"><a href="index.php"><span class="colour-span">Ger's</span> Garage</a></h1>
                    
                </div>
                
            </header>
            <div class="banner">
                <div class="banner_content">    
                    <div class="container">
                        <h2 class="banner_title"></h2>
                        <p class="banner_txt"></p>
                    </div>
                </div>    
            </div>
            <nav class="main-serv">
                <div id="logged-user" class="block">
                    <h3 style="text-align:center; display:block" >SERVICES</h3>
                    <ul>
                        <a href="adminpage.php" class="welcome_btn3">Admin Page</a>
                        <a href="servicepage.php" class="welcome_btn3">Services List</a>
                        <a href="addservice.php" class="welcome_btn3">Add Service</a>
                        <a href="invoice.php" class="welcome_btn3">Invoice</a>    
                    </ul>
                </div>
            
                <div class="partframe" id="partframe" style="background-color: white">  
                    <h3 style="color:black">Adding Services: </h3> 
                    <form action="registerservice.php" class="form-register" method="post">
                        <!-- Display errors -->
                                <?php
                                    //deleteErrors();
                                    if(isset($_SESSION['completed'])) : ?>
                                        <div class="alert alert-success" style="color: #eead33"> 
                                            <?=$_SESSION['completed'];?>
                                        </div>
                                    <?php elseif(isset($_SESSION['errors']['general'])): ?>
                                        <div class="alert alert-error" style="color: crimson"> 
                                            <?=$_SESSION['errors']['general']; deleteErrors();?>
                                        </div>
                                <?php endif; ?>
                            <!--
                            <label for="id_part"><b>Service ID:</b></label>
                            <input type="text" name="id_service" id="id_part" value="" 
                            class="input-48" pattern="[A-Za-z0-9]+" required> -->
                            <?php// echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'id_part') : '';deleteErrors(); ?>
                            
                            <br/>                
                            <label for="concept"><b>Concept/Name:</b></label>
                            <input type="text" name="concept" id="concept" value=""
                            placeholder="" class="input-48" pattern="[A-Za-z0-9 ]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'concept') : '';deleteErrors(); ?>
                            
                            <label for="price"><b>Price:</b></label>
                            <input type="text" name="price" id="price" 
                            placeholder="" class="input-48" pattern="[0-9.]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'price') : ''; deleteErrors();?>

                            <div class="clearfix">
                                <button type="submit" class="signupbtn" name="submit">Register</button>
                                <button type="button" class="cancelbtn" onclick="location.href='servicepage.php'">Cancel</button>
                            </div>
                    </form>
                
                </div>
    </nav>
    </body>
    </html>


    <?php  mysqli_close($db); }
    else{
        header("Location:index.php");
    }?>