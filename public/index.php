<!--
                        CCT COLLEGE 
            HIGHER DIPLOMA IN SCIENCE IN COMPUTING
                DUBLIN, IRELAND, AUGUST 2021

           FINAL PROJECT - GER'S GARAGE
    WEB PAGE MADE BY STUDENT:   MITZY MACIAS DE LA TORRE
    STUDENT NUMBER:             2020426 
    FOR THE SUBJECT:            GUIDED TECHNOLOGY PROJECT
    PROJECT TITLE:              GER'S GARAGE
    
    PAGE:                       index.php
    PURPOSE:                    Main page of the webpage
                                contains the links to other
                                pages.
                                
-->

<?php
require_once 'header.php'; //it calls the header file to execute on the top
require_once '../private/connect.php';
require_once 'helper.php';
?>
<main class="main">
    <section class="welcome">
        <h2 class="section_title"> WELCOME</h2>
        <p class="welcome_txt">
            Since 2018, Ger's Garage has been the best option in Dublin on all related to your vehicle:
                motorbike, cars, small vans and small buses... Do not overthink! We are the best option in
                Dublin!  
        </p>
        <a href="aboutus.php" class="welcome_btn">READ MORE</a>
    </section>

        <section class="container-testimonials">
            <h3 class="section_title">WHAT PEOPLE ARE SAYING</h3>
            <img src="../images/person.jpg" alt="" class="testimonials_img">
            <p class="testimonials_txt">I have gone there many times, they have excellent staff and high
                 quality service! I highly recommend this place!
            </p>
            <p class="testimonials_name">Mitzynela Mc</p>
        </section>
    </main>
    <?php require 'footer.php'; mysqli_close($db);?>
</body>
</html>