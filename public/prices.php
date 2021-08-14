<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       prices.php
    PURPOSE:                    Page with the list of parts
                                and a menu to interact with
                                the parts and invoices.
                                Admin user only.
                                
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';
    //check the session for Administrator = 'admin'
    if(isset($_SESSION) && $_SESSION['user']['username']=='admin'){

        

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome to Ger's Garage - Administrator Page | Prices </title>
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
                    <h3>PARTS AND SERVICES PRICES</h3>
                    <ul>
                        <a href="adminpage.php" class="welcome_btn3">Admin Page</a>
                        <a href="prices.php" class="welcome_btn3">Part List</a>
                        <a href="addpart.php" class="welcome_btn3">Add Part</a>
                        <a href="servicepage.php" class="welcome_btn3">Services</a>    
                    </ul>
                </div>
            
                <div class=table3 id="table3frame">   
                <h3 style="color:black; background-color:white">View Vehicles Parts: </h3> 
                
                
                    <table role="table" id="table3">   
                          
                        <thead role="rowgroup">
                            <tr role="row">
                                <th role="columnheader">ID Part</th>
                                <th role="columnheader">Concept</th>
                                <th role="columnheader">Price</th>
                                <th role="columnheader">Quantity</th>
                                <th role="columnheader">Action</th>
                            </tr>
                        </thead>
                        <tbody role="rowgroup">
                            <?php 

                            //thepager
                            $sql_register = mysqli_query($db, "SELECT count(*) as total_parts FROM parts");
                            $result_r = mysqli_fetch_array($sql_register);    
                            $total_parts = $result_r['total_parts'];

                            //to show 10 registers per page
                            $per_page = 10;
                            if(empty($_GET['page'])){
                                $page = 1;
                            }else{
                                $page = $_GET['page'];
                            }
                            //to determine the range of pages fot the pager
                            $from = ($page -1) * $per_page;
                            $total_pages = ceil($total_parts / $per_page);

                            $parts_query = "SELECT * FROM parts ORDER BY id_part LIMIT  $from, $per_page;";
                            $result_q = mysqli_query($db, $parts_query);  
                            $row="";
                            while($row = mysqli_fetch_assoc($result_q)){ 
                                $theparts="";
                                $theparts= $row["id_part"];
                                ?>
                                
                                <form action="" method="post">
                                    <tr role="row">
                                        <td role="cell"><?php echo $row["id_part"];?>
                                        </td>
                                        <td role="cell"><?php echo strtoupper($row["concept"]);?></td>
                                        <td role="cell"><?php echo $row["price"];?></td>
                                        <td role="cell"><?php echo $row["qty"];?></td>
                                        <td role="cell">
                                            <a class= "link_edit" href="editpart.php?id=<?php echo $row["id_part"];?>">Edit</a>
                                            |
                                            <a class="link_delete" href="delete_confirm_part.php?id=<?php echo $row["id_part"];?>">Delete</a>
                                        </td>
                                        
                                    </tr>
                                </form>
                            <?php
                            }mysqli_free_result($result_q); ?>
                            
                        </tbody>
                    </table>
                    <div class="thepager">
                    <ul>
                        <?php 
                            if($page != 1){
                        ?>
                        <li><a href="?page=<?php echo 1; ?>">|<</a></li>
                        <li><a href="?page=<?php echo $page -1; ?>"><<</a></li>
                        <?php 
                            }
                            for($i =1; $i <= $total_pages ; $i++){
                                if($i == $page){
                                    echo '<li class="pageSelected">'.$i. '</li>';
                                }else{
                                    echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($page != $total_pages){
                        ?>
                        
                        <li><a href="?page=<?php echo $page + 1; ?> ">>></a></li>
                        <li><a href="?page=<?php echo $total_pages; ?> ">>|</a></li>

                        <?php } ?>
                    </ul>      
                </div>
                </div>
            </nav>
        </body>
        </html>
    <?php mysqli_close($db);}
    else{
        header("Location:index.php");
    }?>