<?php
define("DB_SERVER","localhost" );
define("DB_USER", "root");
define("DB_PASS", "madega");
define("DB_NAME", "rahaso");
//create database connection

$connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//test if connection succeeded
if(mysqli_connect_errno()){
die("Database failed to connect: " .
mysqli_connect_error() .
"(".mysqli_connect_errno.")"
);
}
 ?>