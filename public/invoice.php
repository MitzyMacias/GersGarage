<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       invoice.php
    PURPOSE:                    Page to Generate invoices
                                
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
            <title>Welcome to Ger's Garage - Administrator Page | Add Parts </title>
            <script> language="javascript" src="js/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="../css/styles_invoice.css">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->
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
                    <h3 style="text-align:center; display:block" >INVOICES</h3>
                    <ul>
                        <a href="adminpage.php" class="welcome_btn3">Admin Page</a>
                        <a href="prices.php" class="welcome_btn3">Part List</a>
                        <a href="addpart.php" class="welcome_btn3">Add Part</a>
                        <a href="servicepage.php" class="welcome_btn3">Services</a>    
                    </ul>
                </div>
            </nav>  

            <section class="containerin">
                <div class="title_page">
                    <h3 style="color:black; text-align:center; border-style: double; border-color: #eead33">New Invoice</h3>
                </div>
                <div class="customer_info">
                    <h4>Customer Information</h4>
                    <a href="#" class="btn_new_customer"><i class="fas fa-plus"></i>New customer</a>
                </div>

                <script>
                    $(function(){
                        $("#buscar").on("keyup", function(){
                            var buscar = $("#buscar").val();

                            $.ajax({
                                type: "post",
                                url: "invoice.php",
                                data: {
                                    busqueda: buscar
                                },
                                success: function(respuesta){
                                    $("#resultados").html(respuesta);
                                }
                            })

                        })
                    })
                </script> 
                
                <?php 
                $busqueda = $_POST["username"];

                $sql = "SELECT * FROM customers
                        WHERE username LIKE '$busqueda'";

                $consulta = mysqli_query($db, $sql);
                mysqli_num_rows($consulta);
                $salida = "";

                $customer = mysqli_fetch_array($consulta);                
                echo $salida;
                ?>
                

                <form name="form_newinvoice" id="form_new_invoice" class="data" action="">
                    <input type="hidden" name="action" value="addCustomer">
                    <input type="hidden" id="id_cust" name="id_cust" value="" required>
                    <!-- <div class="wd30">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username">
                    </div> -->
                    <div class="wd30">
                        <label for="">Name</label>
                        <input type="text" name="cust_name" id="cust_name" required>
                    </div>
                    <div class="wd30">
                        <label for="">Mobile</label>
                        <input type="text" name="cust_mobile" id="cust_mobile" required>
                    </div>
                    <div class="wd30">
                        <label for="">Address</label>
                        <input type="text" name="cust_address" id="cust_address" required>
                    </div>
                    <div id="cust_register_div" class="wd100">
                        <button type="submit" class="signupbtn">Save</button>
                    </div>
                </form>
                <div class="invoice_data">
                    <h4>Invoice Information</h4>
                    <div class="data">
                        <div class="wd50">
                            <label for="">Mechanic:</label>
                            <p>Ger McGuiness</p>
                        </div>
                        <div class="wd50">
                            <label for="">Actions</label>
                            <div class="invoice_actions">
                                <a href="#" class="btn_ok textcenter" id="btn_deleteinvoice"><i class="fas fa-ban"></i>Delete</a>
                                <a href="#" class="btn_new textcenter" id="btn_processinvoice"><i class="far fa-edit"></i>Process</a>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="tbl_invoice">
                    <thead>
                        <tr> 
                            <th width="100px">ID</th>
                            <th>Concept</th>
                            <th>Stock</th>
                            <th width="100px">Quantity</th>
                            <th class="textright">Price</th>
                            <th class="textright">Total Price</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="txt_id_product"></td>
                            <td id="txt_concept"></td>
                            <td id="txt_stock"></td>
                            <td><input type="text" name="txt_qty" id="txt_qty" value="0" min="1" disabled></td>
                            <td id="txt_price" class="textright">0.00</td>
                            <td id="txt_price_total" class="textright">0.00</td>
                            <td><a href="#" id="add_invoice" class="link_add"><i class="fas fa-plus"></i>Add</a></td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th colspan="2">Concept</th>
                            <th>Quantity</th>
                            <th class="textright">Price</th>
                            <th class="textright">Total price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="invoice_detail">
                        <tr>
                            <td>1</td>
                            <td colspan="2"> Annual Service</td>
                            <td class="textcenter">1</td>
                            <td class="textright">200.00</td>
                            <td class="textright">200.00</td>
                            <td class="">
                                <a class="link_delete" href="#" onclick="event.preventDefault(); from_detail_product(1);"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>OIF001</td>
                            <td colspan="2">Oil Filter</td>
                            <td class="textcenter">1</td>
                            <td class="textright">15.00</td>
                            <td class="textright">15.00</td>
                            <td class="">
                                <a class="link_delete" href="#" onclick="event.preventDefault(); from_detail_product(1);"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="textright">SUBTOTAL</td>
                            <td class="textright">215.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="textright">VAT(10%)</td>
                            <td class="textright">21.50</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="textright">TOTAL</td>
                            <td class="textright">236.50</td>
                        </tr>
                    </tfoot>
                </table>

            </section>



            </body>
    </html>


    <?php  mysqli_close($db); }
    else{
        header("Location:index.php");
    }?>