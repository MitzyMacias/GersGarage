<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       delete_confirm_part.php
    PURPOSE:                    Page to delete the part/item. 
                                Administrator user only.
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';
    //check the session for Administrator = 'admin'
    if(isset($_SESSION) && $_SESSION['user']['username']=='admin'){
        //checking errors
        if(!empty($_POST)){
            $id_part = $_POST['id_part'];
            $query_delete = mysqli_query($db, "DELETE FROM parts WHERE id_part= '$id_part'");
            
            if($query_delete){
                header("location: prices.php"); 
            }else{
                echo "Error in deleting";
            }
        }
        //request to obtain the parts
        if(empty($_REQUEST['id'])){
            header("location: prices.php");
        }else{
            $id_part = $_REQUEST['id'];
            $query_del = mysqli_query($db, "SELECT * from parts where id_part = '$id_part'");

            $result_q = mysqli_num_rows($query_del);

            if($result_q){
                while ($part = mysqli_fetch_array($query_del)){
                    $id_part = $part['id_part'];
                    $concept = $part['concept'];
                    $price = $part['price'];
                    $qty = $part['qty'];
                }
            }else{
                mysqli_close($db);
                header('location: prices.php');
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome to Ger's Garage - Administrator Page | Delete Parts </title>
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
                    <h3 style="text-align:center; display:block" >PARTS AND SERVICES</h3>
                    <ul>
                        <a href="adminpage.php" class="welcome_btn3">Admin Page</a>
                        <a href="prices.php" class="welcome_btn3">Part List</a>
                        <a href="addpart.php" class="welcome_btn3">Add Part</a>
                        <a href=".php" class="welcome_btn3">Services</a>    
                    </ul>
                </div>
            
                
                <div class="data_delete">
                    
                    <h3 style="color:black">Delete Vehicle Parts: </h3> 
                   
                    <h2>Are you sure you want to delete the next item: ?</h2>
                    
                    <p>ID Part: </p> <span><?php echo $id_part ?></span>
                    <p>Part Concept/Name: </p><span><?php echo $concept ?></span>
                    <p>Price: </p><span><?php echo $price ?></span>
                    <form action="" name="btnform" class="btnform" method="post">
                        <input type="hidden" name="id_part" value= "<?php echo $id_part ?>">
                        <a href="prices.php" class="cancelbtn2">Cancel</a>
                        <input type="submit" class="signupbtn2" name="delete" value="Delete"/>
                        <br/>
                    </form>

                </div>

            </nav>

    </body>
    </html>

    <?php mysqli_close($db);}
    else{
        header("Location:index.php");
    }?>