<?php

 // include('connect.php');
   session_start();
   if(!isset($_SESSION)){
      session_start();
      $inactividad = 600; //(10 mins);
      // Check if $_SESSION["timeout"] is set
      if(isset($_SESSION["timeout"])){
          // Calculate TTL (TTL = Time To Live)
          $sessionTTL = time() - $_SESSION["timeout"];
          if($sessionTTL > $inactividad){
              session_destroy();
              header("Location: logout.php");
          }
      }
      // The next key is created when the session starts
      $_SESSION["timeout"] = time();
  }
  