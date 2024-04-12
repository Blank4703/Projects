<?php
session_start();

if (isset($_POST["logout"]) && $_POST["logout"] === "true") {
  $_SESSION = array();

  session_destroy();

  header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/login.html");
  exit;
}
?>