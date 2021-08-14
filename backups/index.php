<?php
//File to do backups
/*
$db_host= 'localhost';
$db_name = 'garage';
$db_user = 'administrator';
$db_pass = 'admin';
*/
$server= 'localhost';
$usernamedb = 'u255030716_administrator';
$password = 'Admin1234';
$database = 'u255030716_garage';

$date_back = date("dmY-his");

$final_sql = $db_name.'_'.$date_back.'.sql';

//Command to generate the MySQL backup, connection and destination variables required.
$dump = "/Applications/MAMP/Library/bin/mysqldump -user='.$db_user.' --password='.$db_pass.' --host='.$db_host.' '.$db_name.' > $final_sql";
system($dump, $output); //Execute the command for the backup

//system($dump, $output);

?>