<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       adminpage.php
    PURPOSE:                    Page to Manage the Bookings,
                                parts of the vehicles, reports
                                and adding information to the
                                database. Administrator user only.
-->

<?php
    require_once '../private/connect.php';
    session_start();
    require_once 'helper.php';
    //check the session for Administrator = 'admin'
    if(isset($_SESSION) && $_SESSION['user']['username']=='admin'){

        $status_query="SELECT * FROM bookings;";
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome to Ger's Garage - Administrator Page</title>
            <script> language="javascript" src="js/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
            <link rel="stylesheet" href="../css/styles.css">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
           
           <!--  Flatpicker Styles  -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
    
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link rel="stylesheet" href="../css/jquery-ui.min.css">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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

            <script>
                function showTable(){
                    if(document.getElementById("table2").style.display == "none"){
                        document.getElementById("table2").style.display="block";
                        document.getElementById("print_buttons").style.display="block";
                        document.getElementById("table2frame").style.display="block";
                    }else{
                        document.getElementById("table2").style.display="none";
                        document.getElementById("print_buttons").style.display="none";
                        document.getElementById("table2frame").style.display="none";
                    }
                }
                function showForm(){
                    if(document.getElementById("form-fromto").style.display == "none"){
                        document.getElementById("form-fromto").style.display="block";
                    }else{
                        document.getElementById("form-fromto").style.display="none";
                    }
                }
            </script>

            <nav class="main-nav">
                <?php if(isset($_SESSION['user'])):?>
                <div id="logged-user" class="block">
                    <h3>Welcome, <?=$_SESSION['user']['first_name']. '!';?></h3>
                    <div class="firstmenu">
                        <a href="logout.php" class="welcome_btn2"><span>Log Out</span></a>
                        <input type="button" value="Manage Bookings" class="welcome_btn2">
                        <input type="button" value="Allocate Prices" class="welcome_btn2" onclick="location.href='prices.php'">   
                        <input type="button" value="Invoices" class="welcome_btn2" onclick="location.href='invoice.php'"> 
                    
                        <div class="print_buttons" id="print_buttons">
                        <h3>PRINTING</h3>
                        <input type="button" value="All Bookings" id="allb" class="welcome_btn2"  onclick="location.href='../fpdf/report.php'">
                        <input type="button" value="By Date" id="allb" class="welcome_btn2"  onclick="showForm()">
                        <form action="../fpdf/reportdates.php" class="form-fromto" id="form-fromto" method="POST" style="display:none">
                            <label for="fromdate"><b>From: </b></label>
                            <input type="date" name="from_date" id="from_date" 
                            placeholder="DD/MM/YYY" required/>
                            <label for="todate"><b>To: </b></label>
                            <input type="date" name="to_date" id="to_date" 
                            placeholder="DD/MM/YYY" required/>
                            <input type="submit" value="View" id="allb" class="welcome_btn2"/>
                        </form>
                    </div>
                    </div>   
                    
                     
                </div>
                <?php endif; ?> 
                
                <?php if(isset($_SESSION['error_login'])):?>
                    <div class="alert alert-error">
                        <?=$_SESSION['error_login'];?>
                    </div>
                <?php endif; ?> 
            </nav> 

            

            <nav class="box-nav">
                
                <div class=table2 id="table2frame">
                <h3 style="color:black">View All Bookings: </h3> 
                
                
                    <table role="table" id="table2">
                          
                        <thead role="rowgroup">
                            <tr role="row">
                            <th role="columnheader">ID Booking</th>
                            <th role="columnheader">Name</th>
                            <th role="columnheader">License Plate</th>
                            <th role="columnheader">Make</th>
                            <th role="columnheader">Vehicle Type</th>
                            <th role="columnheader">Engine Type</th>
                            <th role="columnheader">Vehicle Year</th>
                            <th role="columnheader">Colour</th>
                            <th role="columnheader">Mileage</th>
                            <th role="columnheader">Service Type</th>
                            <th role="columnheader">Admission Date</th>
                            <th role="columnheader">Admission Time</th>
                            <th role="columnheader">Comments</th>
                            <th role="columnheader">Mechanic</th>
                            <th role="columnheader">Status</th>
                            <th role="columnheader">Action</th>
                            </tr>
                        </thead>
                        <tbody role="rowgroup">
                            <?php 
                            
                             //thepager
                             $sql_register = mysqli_query($db, "SELECT count(*) as total_bookings FROM bookings");
                             $result_r = mysqli_fetch_array($sql_register);    
                             $total_customers = $result_r['total_bookings'];
 
                             //to show 10 registers per page
                             $per_page = 10;
                             if(empty($_GET['page'])){
                                 $page = 1;
                             }else{
                                 $page = $_GET['page'];
                             }
                             //to determine the range of pages fot the pager
                             $from = ($page -1) * $per_page;
                             $total_pages = ceil($total_bookings / $per_page);



                            $customers_query="SELECT b.id_booking, CONCAT(c.first_name,' ', c.last_name) AS 'Name', b.lic_plate, v.make, v.type_veh, v.engine_type, v.veh_year, v.colour, v.mileage, b.type_serv, b.adm_date, b.adm_time, b.comments, b.status, b.id_mech 
                                              FROM customers c, bookings b, vehicles v
                                              WHERE c.id_cust=b.id_cust AND b.lic_plate=v.lic_plate
                                              ORDER BY b.adm_date DESC
                                              LIMIT $from, $per_page
                                              ";
                            $result = mysqli_query($db, $customers_query);  
                            $row="";
                            while($row = mysqli_fetch_assoc($result)){ 
                                $thebooking="";
                                $thebooking= $row["id_booking"];
                                ?>
                                
                                
                                <form action="updatebooking.php" method="POST">
                                    <tr role="row">
                                        <td role="cell"><?php echo $row["id_booking"];?>
                                            <!-- 1st DISPLAY NONE! -->
                                            <input type="text" name="idb" id="idb" style="display:none" value="<?php echo $thebooking?>" /> <!-- style="display:none" -->
                                        </td>
                                        <td role="cell"><?php echo strtoupper($row["Name"]);?></td>
                                        <td role="cell"><?php echo $row["lic_plate"];?></td>
                                        <td role="cell"><?php echo strtoupper($row["make"]);?></td>
                                        <td role="cell"><?php echo strtoupper($row["type_veh"]);?></td>
                                        <td role="cell"><?php echo strtoupper($row["engine_type"]);?></td>
                                        <td role="cell"><?php echo $row["veh_year"];?></td>
                                        <td role="cell"><?php echo strtoupper($row["colour"]);?></td>
                                        <td role="cell"><?php echo $row["mileage"];?></td>
                                        <td role="cell"><?php echo strtoupper($row["type_serv"]);?></td>
                                        <td role="cell"><?php echo date("d-m-Y",strtotime($row["adm_date"]));?></td>
                                        <td role="cell"><?php echo $row["adm_time"];?></td>
                                        <td role="cell"><?php echo strtoupper($row["comments"]);?></td>
                                        <td role="cell"><?php 
                                            $idm = $row["id_mech"];
                                            $mech_query="";
                                            $mech_query="SELECT first_name from mechanics WHERE id_mech= '$idm'";
                                            $resultMech = mysqli_query($db, $mech_query);
                                            $mechanic = mysqli_fetch_assoc($resultMech);
                                            //echo var_dump($mechanic['first_name']);    
                                                if($mechanic['first_name'] != NULL){
                                                    echo strtoupper($mechanic['first_name']);
                                                    
                                                }else{                                                 
                                                    echo strtoupper("Not assigned");
                                            
                                                }
                                                mysqli_free_result($resultMech)
                                        ?></td>
                                        <td role="cell"><?php echo strtoupper($row["status"]);?></td>
                                        <td role="cell"><button class="signupbtn"><span>Update</span></a></button></td>
                                    </tr>
                                </form>
                            <?php
                            }mysqli_free_result($result); ?>
                            
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
    <?php  mysqli_close($db);}
    else{
        header("Location:index.php");
    }?>