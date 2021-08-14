<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       updatebooking.php
    PURPOSE:                    Page with the process to update
                                the booking.
                                
-->

<?php 

    require_once '../private/connect.php';
    require_once 'helper.php';
    //check the session for Administrator = 'admin'
    
        if(isset($_POST)){
            require_once '../private/connect.php';
            //receive the booking number to update
            $idb = isset($_POST['idb']) ? strtoUpper(mysqli_real_escape_string($db, trim($_POST['idb']))) : false;
            
            ?> 
            <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Update Booking</title>
                        <link rel="stylesheet" href="../css/styles.css">
                    </head>
                    <body>
                        <header class="main-header">
                            <div class="container container-flex">
                                <!-- <h1 class="main-title"><span class="colour-span">Ger's</span> Garage</h1>-->
                                <h1 class="main-title"><a href="index.php"><span class="colour-span">Ger's</span> Garage</a></h1>
                            </div>
                        </header>
                        
                        <div class="bannerB">
                            <div class="bannerB_content">    
                                <div class="container">
                                    <h2 class="bannerB_title"></h2>
                                    <p class="bannerB_txt"></p>
                                </div>
                            </div>
                        </div>
                        <div class="thetitleb">
                            <h2>Update of Booking Number: <?php echo $idb ?></h2>
                        </div>
                            <nav class="box-nav-update">
                                <div class="table2">
                                <table role="table" id="table2">
                                        <thead role="rowgroup">
                                            <tr role="row">
                                                
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
                                        <form action="process_updateb.php" method="POST">
                                            <tr role="row">
                                            
                                            <?php $bookings_query="SELECT b.id_booking, CONCAT(c.first_name,' ', c.last_name) AS 'Name', 
                                                                    b.lic_plate, v.make, v.type_veh, v.engine_type, v.veh_year, v.colour, 
                                                                    v.mileage, b.type_serv, b.adm_date, b.adm_time, b.comments, b.status, b.id_mech 
                                                                    FROM customers c, bookings b, vehicles v
                                                                    WHERE c.id_cust=b.id_cust AND b.lic_plate=v.lic_plate AND b.id_booking='$idb'";
                                                  $result = mysqli_query($db, $bookings_query);  
                                                  $row="";
                                                  $row = mysqli_fetch_assoc($result);
                                                      $thebooking="";
                                                      $thebooking= $row["id_booking"];
                                            ?>
                                        

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
                                            
                                            
                                            <!-- Menu Select Mechanic -->
                                            <?php
                                                $quer="";
                                                $quer="SELECT id_mech from bookings WHERE id_booking=$idb";
                                                $thisresult= mysqli_query($db, $quer);
                                                $themechid="";
                                                while($mechid = mysqli_fetch_assoc($thisresult)){    
                                                    $themechid=$mechid[id_mech];
                                                }mysqli_free_result($thisresult);
                                                
                                                
                                                if($themechid ==NULL){
                                                    $themechid= 0;
                                                }
                                                
                                                
                                            ?>
                                            <td role="cell">


                                            <!-- 2nd display NONE!! -->   
                                            <!-- store the value to send to the next page-->
                                            <input type="text" name="mec" style="display:none" id="mec" value="<?php echo $themechid?>" />  
                                            <?php        
                                                $mech_query="";
                                                $mech_query="SELECT * from mechanics WHERE id_mech= $themechid;";
                                                $resultMech = mysqli_query($db, $mech_query);
                                                $mechanic = mysqli_fetch_assoc($resultMech);
                                            ?>
                                            <select name="selMechanic" id="selMechanic" onchange="changeMec()">    
                                                <option value="0">Select...</option>;
                                                <?php 
                                                    if($themechid==1){
                                                        echo '<option value="1" selected>Ger</option>;';
                                                    }else{
                                                        echo '<option value="1">Ger</option>;';
                                                    }
                                                    if($themechid==2){
                                                        echo '<option value="2" selected>Patrick</option>;';
                                                    }else{
                                                        echo '<option value="2">Patrick</option>;';
                                                    }
                                                    if($themechid==3){
                                                        echo '<option value="3" selected>Bryan</option>;';
                                                    }else{
                                                        echo '<option value="3">Bryan</option>;';
                                                    }
                                                    if($themechid==4){
                                                        echo '<option value="4" selected>James</option>;';
                                                    }else{
                                                        echo '<option value="4">James</option>;';
                                                    }
                                                    if($themechid==5){
                                                        echo '<option value="5" selected>Noah</option>;';
                                                    }else{
                                                        echo '<option value="5">Noah</option>;';
                                                    }
                                                    
                                                    mysqli_free_result($resultMech);
                                                ?>
                                            </select>
                                            
                                            <script>            
                                                
                                                function changeMec() {
                                                    document.getElementById('mec').value=document.getElementById('selMechanic').value;
                                                }
                                            </script>  
                                            </td>

                                            <!-- Menu Select Status -->
                                            <?php        
                                                $quer2="";
                                                $quer2="SELECT status from bookings WHERE id_booking=$idb";
                                                $thisresult2 = mysqli_query($db,$quer2);
                                                $thestatus="";
                                                while($stat = mysqli_fetch_assoc($thisresult2)){    
                                                    $thestatus=$stat[status];
                                                }mysqli_free_result($thisresult2);
                                            ?>        
                                            <td role="cell">
                                                <select name="selStatus" id="selStatus" onchange="changeStatus()">
                                                <?php
                                                    if($thestatus=="booked"){
                                                        echo '<option value="booked" selected>Booked</option>;';
                                                    }else{
                                                        echo '<option value="booked">Booked</option>;';
                                                    }
                                                    if($thestatus=="inservice"){
                                                        echo '<option value="inservice" selected>In Service</option>;';
                                                    }else{
                                                        echo '<option value="inservice">In Service</option>;';
                                                    }
                                                    if($thestatus=="completed"){
                                                        echo '<option value="completed" selected>Completed</option>;';
                                                    }else{
                                                        echo '<option value="completed">Completed</option>;';
                                                    }
                                                    if($thestatus=="collected"){
                                                        echo '<option value="collected" selected>Collected</option>;';
                                                    }else{
                                                        echo '<option value="collected">Collected</option>;';
                                                    }
                                                    if($thestatus=="unrepairable"){
                                                        echo '<option value="unrepairable" selected>Unrepairable</option>';
                                                    }else{
                                                        echo '<option value="unrepairable">Unrepairable</option>';
                                                    }
                                                    if($thestatus=="cancelled"){
                                                        echo '<option value="cancelled" selected>Cancelled</option>';
                                                    }else{
                                                        echo '<option value="cancelled">Cancelled</option>';
                                                    }
                                                ?>
                                                </select>
                                                
                                                <script>
                                                    document.getElementById('stat').value=document.getElementById('selStatus').value;
                                                    function changeStatus() {
                                                        document.getElementById('stat').value=document.getElementById('selStatus').value;
                                                    }
                                                </script>  

                                                <!-- 3RD DISPLAY NONE ! -->
                                                <input type="text" name="stat" id="stat" style="display:none"/>

                                            </td>
                                            <td role="cell">
                                                <script>
                                                       function GoBack(){
                                                            history.go(-1); 
                                                       }
                                                </script>
                                                <!-- 1st DISPLAY NONE! -->
                                                <input type="text" name="idb" id="idb" style="display:none" value="<?php echo $idb?>" />     
                                                <button class="signupbtn"><a><span>Update</span></a></button>
                                                <button class="cancelbtn" onClick="GoBack();"><a><span>Go Back</span></a></button>
                                            </td>
                                            </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </nav>
                        
                    </body>
                </html>
        <?php } 
            mysqli_close($db); //closing the connection to the database
            header("Location:adminpage.php");
    ?>


    
