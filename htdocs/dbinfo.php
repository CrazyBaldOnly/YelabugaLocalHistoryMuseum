<?php
$dbhost="localhost";
$dbname="museumdb";
$dbpassword="";
$dbuser="root";

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$mysqli->set_charset("utf8");
?>