<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       editservice.php
    PURPOSE:                    Page to edit the services.
                                Administrator user only.
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';

    // Errors Array
    $errors = array();


    if(!empty($_POST)){

        $id_service = isset($_POST['id_service']) ? mysqli_real_escape_string($db, trim($_POST['id_service'])) : false;
        $concept = isset($_POST['concept']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['concept']))) : false;
        $price = isset($_POST['price']) ? mysqli_real_escape_string($db, trim($_POST['price'])) : false;
        
        $query2= mysqli_query($db, "SELECT * FROM services WHERE (concept = '$concept' AND id_service = '$id_service')");

        $result2= mysqli_fetch_array($query2);

        $sql_update = mysqli_query($db, "UPDATE services SET concept = '$concept', price = '$price'
                                         WHERE id_service= '$id_service'");

    if ($sql_update){
        $_SESSION['completed'] = 'Register changed successfully';
    }else{
        $_SESSION['errors']['general'] = "Error saving the part: ".mysqli_error($db);
    }
    }

    //Show Data
    
    if(empty($_GET['id'])){
        header('Location: servicepage.php');
    }

    $id_s = $_GET['id'];
    $sql = mysqli_query($db, "SELECT * FROM services WHERE id_service= '$id_s'");
    $result_sql = mysqli_num_rows($sql);

    if($result_sql ==0){
        header('Location: servicepage.php');
    }else{
        while($service = mysqli_fetch_array($sql)){
            $id_service = $service['id_service'];
            $concept = $service['concept'];
            $price = $service['price'];
        }
    }

    //check the session for Administrator = 'admin'
    if(isset($_SESSION) && $_SESSION['user']['username']=='admin'){

        $services_query = "SELECT * FROM services;";

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome to Ger's Garage - Administrator Page | Edit Services </title>
            <script> language="javascript" src="js/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
            <link rel="stylesheet" href="../css/styles.css">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        </head>
        <body>
            <header class="main-header">
                <div class="container container-flex">
                    <h1 class="main-title"><span class="colour-span">Ger's</span> Garage</h1>
                    
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
                    <h3 style="text-align:center; display:block" >EDIT SERVICE</h3>
                    <ul>
                        <a href="adminpage.php" class="welcome_btn3">Admin Page</a>
                        <a href="servicepage.php" class="welcome_btn3">Service List</a>
                        <a href="addservice.php" class="welcome_btn3">Add Service</a>
                        <a href="invoice.php" class="welcome_btn3">Invoice</a>    
                    </ul>
                </div>
            
                
                <div class="partframe" id="partframe" style="background-color:white; width:fit-content">  
                    <h3 style="color:black; width: fit-content">Edit Service: </h3> 
                    <form action="" class="form-register" method="post">
                        <!-- Display errors -->
                                <?php
                                    if(isset($_SESSION['completed'])) : ?>
                                        <div class="alert alert-success" style="color: #eead33">
                                            <?=$_SESSION['completed'];?>
                                        </div>
                                    <?php elseif(isset($_SESSION['errors']['general'])): ?>
                                        <div class="alert alert-error" style="color: crimson">
                                            <?=$_SESSION['errors']['general']; deleteErrors();?>
                                        </div>
                                <?php endif; ?>
                            
                            <label for="id_service"><b>Service ID:</b></label>
                            <input type="text" name="id_service" id="id_service" readonly="true" style="color:grey" value="<?php echo $id_service; ?>" 
                            class="input-48" pattern="[A-Za-z0-9]+" required>
                            <p class="alert-error" style="color:crimson"><?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'id_service') : ''; ?></p>

                            <label for="concept"><b>Concept/Name:</b></label>
                            <input type="text" name="concept" id="concept" value="<?php echo $concept; ?>"
                            placeholder="" class="input-48"pattern="[A-Za-z0-9 ]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'concept') : ''; deleteErrors(); ?>
                            
                            <label for="price"><b>Price:</b></label>
                            <input type="text" name="price" id="price" value="<?php echo $price; ?>"
                            placeholder="" class="input-48" pattern="[0-9.]+" required>
                            <?php echo isset($_SESSION['errors']) ? displayError($_SESSION['errors'], 'price') : ''; deleteErrors(); ?>

                            <div class="clearfix">
                                <button type="submit" class="signupbtn" name="submit">Update</button>
                                <button type="button" class="cancelbtn" onclick="location.href='servicepage.php'">Cancel</button>
                            </div>
                    </form>
                
                </div>
                                   
    </nav>
    </body>
    </html>

    <?php mysqli_close($db);}
    else{
        header("Location:index.php");
    }?>