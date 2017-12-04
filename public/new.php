<?php 
if(isset($_POST["submit"])){

$required_field=array("username","password");
validate_presence($required_field);
if (empty($errors)) {
  $username=
  $password=$_POST["password"]
  $found_admin=attempt_login($username,$password);
  if ($found_admin) {
    //sucess
    //mark user as login



    $_SESSION["admin_id"]=$found_admin["id"];
    $_SESSION["username"]=$found_admin["username"];
    redirect_to("admin.php");

  }
  else{
    $_SESSION["massage"]="username/password not found";
  }
}
?>