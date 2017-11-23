<?php
session_start();
  $lien = "controller/";
 require_once('model/Billet.php'); 
 header('location:controller/routeur.php');
?>