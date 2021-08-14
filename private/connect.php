<?php
/* Attempt to connect to MySQL database */
/*
$server= 'localhost';
$usernamedb = 'u255030716_administrator';
$password = 'Admin1234';
$database = 'u255030716_garage';
*/
$server = 'localhost';
$usernamedb = 'administrator';
$password = 'admin';
$database = 'garage';

$db = mysqli_connect($server, $usernamedb,$password, $database);

//mysqli_query($db, "SET NAMES 'utf8'");

if(mysqli_connect_errno()){
    echo "Connection to DB has failed: ".mysqli_connect_error();
}




/*
include('session.php');

session_start();
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: /logout.php");
        }
    }
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
*/

?>