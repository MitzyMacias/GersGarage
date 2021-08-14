<?php
    require_once 'fpdf.php';

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
    if($_POST['from_date'] == $_POST['to_date']){
        $this->Cell(100,10,"Bookings on ".date("d-m-Y", strtotime($_POST['from_date'])),1,0,'C');
    }else{
        $this->Cell(100,10,"Bookings from ".date("d-m-Y", strtotime($_POST['from_date']))." to ".date("d-m-Y", strtotime($_POST['to_date'])),1,0,'C');
    }
    // Line break
    $this->Ln(20);
    $this->SetFillColor(252,191,71);
    $this->SetFont('Arial','B',10);

    //$this->Cell(9,10, 'ID',1,0,'C',1);
    $this->Cell(20,10, 'Date',1,0,'C',1);
    $this->Cell(15,10, 'Time',1,0,'C',1);
    $this->Cell(30,10, 'Name',1,0,'C',1);
    $this->Cell(18,10, 'L Plate',1,0,'C',1);
    $this->Cell(50,10, 'Vehicle',1,0,'C',1);
    /*
    $this->Cell(20,10, 'Make',1,0,'C',1);
    $this->Cell(15,10, 'Veh Type',1,0,'C',1);
    $this->Cell(20,10, 'Engine',1,0,'C',1);
    $this->Cell(9,10, 'Year',1,0,'C',1);
    $this->Cell(15,10, 'Colour',1,0,'C',1);
    */
    $this->Cell(15,10, 'Mileage',1,0,'C',1);
    $this->Cell(20,10, 'Serv Type',1,0,'C',1);
    
    
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
//receiving the variables by POST
if(isset($_POST)):
    //start connection...
    $server= 'localhost';
    $usernamedb = 'u255030716_administrator';
    $password = 'Admin1234';
    $database = 'u255030716_garage';

    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $db = mysqli_connect($server, $usernamedb,$password, $database);
     
     //require_once '../private/connect.php';
    //$querypdf = "SELECT * from bookings;";
    $querypdf = "SELECT b.id_booking, CONCAT(c.first_name,' ', c.last_name) AS 'Name', b.lic_plate, CONCAT(v.make,' ', v.type_veh,' ', v.engine_type,' ', v.veh_year,' ', v.colour) AS 'Vehicle', v.mileage, b.type_serv, b.adm_date, b.adm_time, b.comments, b.status, b.id_mech, m.first_name AS 'mechanic'
    FROM customers c, bookings b, vehicles v, mechanics m
    WHERE c.id_cust = b.id_cust AND b.lic_plate = v.lic_plate AND b.id_mech = m.id_mech
    AND adm_date BETWEEN '$from_date' AND '$to_date'
    ORDER BY adm_date;";

    $resultpdf = $db->query($querypdf);
    
    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8); // se elimina la B de Bold


    while($row = $resultpdf -> fetch_assoc()){
      
        $pdf->Cell(20,20, date("d-m-Y", strtotime($row['adm_date'])),1,0,'C');
        $pdf->Cell(15,20, $row['adm_time'],1,0,'C');
        $pdf->Cell(30,20, $row['Name'],1,0,'C');
        $pdf->Cell(18,20, $row['lic_plate'],1,0,'C');
        $pdf->Cell(50,20, $row['Vehicle'],1,0,'C');
       
        $pdf->Cell(15,20, $row['mileage'],1,0,'C');
        $pdf->Cell(20,20, $row['type_serv'],1,0,'C');
        
        
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
