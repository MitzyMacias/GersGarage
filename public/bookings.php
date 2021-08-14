
<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       bookings.php
    PURPOSE:                    Page to Book the Appointments.
                                Login required.       
-->

<?php
require_once '../private/connect.php';
require_once 'helper.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles2.css">

    <!--  Flatpicker Styles  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--  Flatpickr  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
                
    <link rel="stylesheet" href="../css/jquery-ui.min.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    
    <!--  The following 13 lines of code(line 15 to 27) has been sourced
          from https://gist.github.com/jomasero/5853295 to sort elements
          inside a SELECT form. by user: @jomasero.
    -->  
    <script>
    function ordenarSelect(id_componente)
    {
      var selectToSort = jQuery('#' + id_componente);
      var optionActual = selectToSort.val();
      selectToSort.html(selectToSort.children('option').sort(function (a, b) {
        return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
      })).val(optionActual);
    }
    $(document).ready(function () {
      ordenarSelect('sel-makes');
    });
  </script>   
  
    <title>Make your Booking</title>
</head>
<body>
<h1 class="main-title"><span class="colour-span"><a href="index.php">Ger's</a></span> Garage</h1>
       
   <?php if(isset($_SESSION['user'])):?>
   
        <div class= "signup-box">

            <!-- Form to fill the data information to book the appointment -->
            <form action="create-bookings.php" class="form-register" method="post">
                <div class="container-inputs">
                    <h1>Book your Appointment</h1>
                    <p>Please Make your appointment filling the fields.</p>
                    <hr>
                    
                    <label for="first_name"><b>First Name: </b></label>
                    <input type="text" name="first_name" id="first_name"
                    placeholder="" class="input-48" pattern="[A-Za-z]+" required />
                    <script>document.getElementById('first_name').value='<?php echo $_SESSION['user']['first_name']?>'</script>

                    <label for="last_name"><b>Last Name: </b></label>
                    <input type="text" name="last_name" id="last_name"
                    placeholder="" class="input-48"pattern="[A-Za-z]+" required />
                    <script>document.getElementById('last_name').value='<?php echo $_SESSION['user']['last_name']?>'</script>

                    <label for="mobile"><b>Mobile: </b></label>
                    <input type="text" placeholder="" name="mobile" id="mobile" pattern="[0-9]+" required />
                    <script>document.getElementById('mobile').value='<?php echo $_SESSION['user']['mobile']?>'</script>

                    <label for="email"><b>Email: </b></label>
                    <input type="text" placeholder="" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                    <script>document.getElementById('email').value='<?php echo $_SESSION['user']['email']?>'</script>
                    

                    <script>
                        function carFunction() {
                        var x = document.getElementById("cars").value;
                        
                        document.getElementById("demo").innerHTML = x;
                           
                        if(x!="0"){ 
                            var carList=document.getElementById("cars");
                            var index = carList.selectedIndex;
                            var selection= carList.options[index]; 
                            var todo= selection.text;
                            //Select the information and split it to assign to the fields on the screen.
                            myArr= todo.split(' ');
                            
                            document.getElementById('lic_plate').value=document.getElementById('cars').value;
                            document.getElementById('type_veh').value=myArr[1];
                            document.getElementById('engine_type').value=myArr[2];
                            document.getElementById('make').value=myArr[3];
                            document.getElementById('colour').value=myArr[4];
                            document.getElementById('veh_year').value=myArr[5];
                            document.getElementById('sel-makes').disabled = true;
                        }else{
                            document.getElementById('lic_plate').value="";
                            document.getElementById('veh_year').value="";
                            document.getElementById('sel-makes').disabled = false;
                            document.getElementById('make').disabled = false;
                            document.getElementById('make').value="";
                            
                            document.getElementById('mileage').value="";
                            document.getElementById('colour').value="";
                            document.getElementById('engine_type').value="";
                            document.getElementById('type_veh').value="";
                        }}
                    </script>
                    <!-- Select the vehicle previously registered -->
                    <label for="cars">Vehicles:</label>
                    <select name="cars" id="cars" form="carform" onchange="carFunction()">
                        <option value="0">New Vehicle...</option>
                        <?php
                            $id_cust=$_SESSION['user']['id_cust'];
                            $sql = "SELECT lic_plate, CONCAT(lic_plate, '  ', type_veh, '  ' , engine_type, '  ', make, '  ', colour, '  ' , veh_year) AS vehicles FROM vehicles WHERE id_cust='$id_cust';";
                            $veh = mysqli_query($db, $sql);
                            
                            while($vehicle = mysqli_fetch_assoc($veh)){
                            echo "<option value='".$vehicle[lic_plate]."'>".$vehicle[vehicles]."</option>";
                            }
                        ?>
                    </select>
                    <br/><br/>
                    
                    
                    <p id="demo" name="demo" style="display:none"></p>
                    
                    <label for="veh_year"><b>Year: </b></label>
                    <input type="text" placeholder="" id="veh_year" name="veh_year" pattern="[0-9]+" required />
                    <!-- <input type="text" placeholder="<?php //echo $vehs2['veh_year']?>" name="veh_year" pattern="[0-9]+" required> -->

                    <label for="lic_plate"><b>License Plate: </b></label>
                    <input type="text" placeholder="" name="lic_plate" id="lic_plate" pattern="[A-Za-z0-9]+" required />

                    <label for="type_veh"><b>Type of Vehicle(sedan, van, pick-up...): </b></label>
                    <input type="text" placeholder="" name="type_veh" id="type_veh" pattern="[A-Za-z-]+" required />

                    <label for="engine_type"><b>Engine Type: (petrol, hybrid...) </b></label>
                    <input type="text" placeholder="" name="engine_type" id="engine_type" pattern="[A-Za-z]+" required />

                    <label for="colour"><b>Colour: </b></label>
                    <input type="text" placeholder="" name="colour" id="colour" pattern="[A-Za-z]+" required />
    
                    <label for="make"><b>Make: </b></label>
                    
                    <select name="sel-makes" id="sel-makes" form="selform" onchange="changeMake()">
                        <option value="0">New Make...</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="opel">Opel</option>
                        <option value="audi">Audi</option>
                        <option value="toyota">Toyota</option>
                        <option value="rover">Rover</option>
                        <option value="lexus">Lexus</option>
                        <option value="volkswagen">Volkswagen</option>
                        <option value="mazda">Mazda</option>
                        <option value="mercedes">Mercedes Benz</option>
                        <option value="peugeot">Peugeot</option>
                        <option value="mitsubishi">Mitsubishi</option>
                        <option value="nissan">Nissan</option>
                        <option value="renault">Renault</option>
                        <option value="ford">Ford</option>
                        <option value="porsche">Porsche</option>
                        <option value="fiat">Fiat</option>
                        <option value="bentley">Bentley</option>
                        <option value="acura">Acura</option>
                        <option value="suzuki">Suzuki</option>
                        <option value="hyundai">Hyundai</option>
                        <option value="subaru">Subaru</option>
                        <option value="jaguar">Jaguar</option>
                        <option value="tesla">Tesla</option>
                        <option value="smart">Smart</option>
                        <option value="rolls-royce">Rolls Royce</option>
                        <option value="ram">Ram</option>
                        <option value="nicola">Nicola</option>
                        <option value="lincoln">Lincoln</option>
                        <option value="kia">Kia</option>
                        <option value="jeep">Jeep</option>
                        <option value="gmc">GMC</option>
                        <option value="cadillac">Cadillac</option>
                        <option value="buick">Buick</option>
                        <option value="lexus">Lexus</option>
                        <option value="genesis">Genesis</option>
                        <option value="infiniti">Infiniti</option>
                        <option value="honda">Honda</option>
                        <option value="bmw">BMW</option>
                        <option value="lotus">Lotus</option>
                        <option value="mini">Mini</option>
                    </select>
                    <br/><br/>
                    <script>
                        function changeMake() {
                            var y = document.getElementById("sel-makes").value;
                            if(y!="0"){
                                document.getElementById('make').value=document.getElementById('sel-makes').value;
                            }else{
                                document.getElementById('make').value="";
                            }
                        }
                    </script>        


                    <input type="text" name="make" id="make"
                    placeholder="" class="input-48" pattern="[A-Za-z]+" required />
                    

                    <label for="mileage"><b>Mileage:</b></label>
                    <input type="text" name="mileage" id="mileage"
                    placeholder="" class="input-48"pattern="[0-9]+" required />

                    <!-- FUNCTION FOR THE DATE FIELD -->
                    <script>
                        $(document).ready(function(){
                        $('#adm_date').datepicker({
                            minDate: +1,
                            beforeShowDay:disablesunday
                        });

                        function disablesunday(sunday){
                            var calendarday=sunday.getDay();
                            return [(calendarday>0)];
                        };
                    });

                    </script>
                    <hr/>
                    
                    <label for="adm_date"><b>Select Date (Sundays closed):</b></label>
                    <input type="text" id="adm_date" name="adm_date" readonly="true" required/>
                    <script src="../js/jquery.js"></script>
                    <script src="../js/jquery-ui.min.js"></script>

                    <label for="adm_time">Choose prefered time:</label>
                        <select name="seladm_time" id="seladm_time" onchange="changetime()">
                            <option value="09:00:00">9:00 - 10:00</option>
                            <option value="10:00:00">10:00 - 11:00</option>
                            <option value="11:00:00">11:00 - 12:00</option>
                            <option value="12:00:00">12:00 - 13:00</option>
                        </select>
                    <br/><br/>
                    <hr/>
                    <input type="text" name="adm_time" id="adm_time" style="display:none" />
                    
                    <script>document.getElementById('adm_time').value=document.getElementById('seladm_time').value;</script>
                    <script>
                        function changetime() {
                            document.getElementById('adm_time').value=document.getElementById('seladm_time').value;
                        }
                    </script>  

                    <label for="type_serv">Service needed:</label>
                        <select name="type_serv" id="type_serv" onchange="changeService()" required>
                            <option value="annual">Annual Service</option>
                            <option value="major">Major Service</option>
                            <option value="fault repair">Repair/Fault</option>
                            <option value="major repair">Major Repair</option>
                        </select>
                        <input type="text" name="typeserv" id="typeserv" style="display:none" />
                        
                        <script>document.getElementById('typeserv').value=document.getElementById('type_serv').value;</script>
                        <script>
                        function changeService() {
                            document.getElementById('typeserv').value=document.getElementById('type_serv').value;
                        }
                    </script>   
                    
                   
                    <input type="text" id="id_cust" name="id_cust" readonly="true" style="display:none" value="<?php echo $_SESSION['user']['id_cust']?>"/>
                    <label for="comments"><br/><br/><br/>Additional Questions or Comments:<br/><br/></label>
                    <input type="textarea" name="comments" id="comments"
                    placeholder="" class="areacomments" />
                           
                    <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="location.href='index.php'">Cancel</button>
                    <button type="submit" class="signupbtn">Book</button>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <nav><h3>You need to Log In first... </h3></nav>
        <button class="signupbtn" onclick="location.href='index.php'"><span>Go Back</span></a></button>
    <?php endif; mysqli_close($db); ?>
</body>
</html>