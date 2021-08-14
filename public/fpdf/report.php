<?php
    require_once 'fpdf.php';
    //require_once '../private/connect.php';

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../images/logo.png',10,6,50);
    //$this->Ln(5);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Move to the right
    $this->Cell(85);
    // Title
    $this->Cell(100,10,"Report of Bookings",1,0,'C');
    // Line break
    $this->Ln(20);
    $this->SetFillColor(252,191,71);
    $this->SetFont('Arial','B',10);

    $this->Cell(9,10, 'ID',1,0,'C',1);
    $this->Cell(30,10, 'Name',1,0,'C',1);
    $this->Cell(18,10, 'L Plate',1,0,'C',1);
    $this->Cell(50,10, 'Vehicle',1,0,'C',1);

    $this->Cell(15,10, 'Mileage',1,0,'C',1);
    $this->Cell(20,10, 'Serv Type',1,0,'C',1);
    $this->Cell(20,10, 'Date',1,0,'C',1);
    $this->Cell(15,10, 'Time',1,0,'C',1);
    $this->Cell(55,10, 'Comments',1,0,'C',1);
    $this->Cell(18,10, 'Mechanic',1,0,'l',1);
    $this->Cell(20,10, 'Status',1,1,'C',1);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Page number
    $this->Cell(0,10,utf8_decode('Page ').$this->PageNo().'/{nb}',0,0,'C');
}
}

if(isset($_POST)):
    //start connection...
    $server= 'localhost';
    $usernamedb = 'u255030716_administrator';
    $password = 'Admin1234';
    $database = 'u255030716_garage';

    $db = mysqli_connect($server, $usernamedb,$password, $database);
    
     //require_once '../private/connect.php';
    //$querypdf = "SELECT * from bookings;";
    $querypdf = "SELECT b.id_booking, CONCAT(c.first_name,' ', c.last_name) AS 'Name', b.lic_plate, CONCAT(v.make,' ', v.type_veh,' ', v.engine_type,' ', v.veh_year,' ', v.colour) AS 'Vehicle', v.mileage, b.type_serv, b.adm_date, b.adm_time, b.comments, b.status, b.id_mech, m.first_name AS 'mechanic'
    FROM customers c, bookings b, vehicles v, mechanics m 
    WHERE c.id_cust = b.id_cust AND b.lic_plate = v.lic_plate AND b.id_mech = m.id_mech
    ORDER BY b.adm_date DESC;";

    $resultpdf = $db->query($querypdf);
    //$resultpdf = mysqli_query($db, $querypdf);
        
        $pdf = new PDF('L','mm','A4');
        $pdf-> AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',8); // se elimina la B de Bold


    while($row = $resultpdf -> fetch_assoc()){
       //while($row = mysqli_fetch_assoc($resultpdf)){
        $pdf->Cell(9,20, $row['id_booking'],1,0,'C');
        $pdf->Cell(30,20, $row['Name'],1,0,'C');
        $pdf->Cell(18,20, $row['lic_plate'],1,0,'C');
        $pdf->Cell(50,20, $row['Vehicle'],1,0,'C');
        /*
        $pdf->Cell(20,20, $row['make'],1,0,'C');
        $pdf->Cell(15,20, $row['type_veh'],1,0,'C');
        $pdf->Cell(20,20, $row['engine_type'],1,0,'C');
        $pdf->Cell(9,20, $row['veh_year'],1,0,'C');
        $pdf->Cell(15,20, $row['colour'],1,0,'C');
        */
        $pdf->Cell(15,20, $row['mileage'],1,0,'C');
        $pdf->Cell(20,20, $row['type_serv'],1,0,'C');
        $pdf->Cell(20,20, $row['adm_date'],1,0,'C');
        $pdf->Cell(15,20, $row['adm_time'],1,0,'C');
        $pdf->Cell(55,20, $row['comments'],1,0,'L');
        //$pdf->MultiCell(25,20, ($row['comments']),1,0,0,'L');
        $pdf->Cell(18,20, $row['mechanic'],1,0,'C');
        $pdf->Cell(20,20, $row['status'],1,1,'C');

    }
    
    $pdf->Output(); 
    else: 
        header('Location: ../index.php');    
    endif; 
?>
