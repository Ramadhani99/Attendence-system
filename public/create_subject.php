<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>


<?php 
if(isset($_POST["submit"])){
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];
$required_field=(array("menu_name","position","visible"));
validate_presence($required_field);
if(!empty($errors)){
	$_SESSION["errors"]=$errors;
	redirect_to("new_subject.php");
}

$query="INSERT INTO subjects(";
$query.=" menu_name,position,visible";
$query.=" ) VALUES ( ";
$query.=" '{$menu_name}', {$position}, {$visible}";
$query.=" )";
$result=mysqli_query($connection,$query);
if($result){
	//success
$_SESSION["massage"]="subject created";
	redirect_to("manage_content.php");
}
else{
	$_SESSION["massage"]="subject failed to be created";
	redirect_to("new_subject.php");
}
}
else{
	//this is probally GET request
	redirect_to("new_subject.php");

}
?>
<?php
if(isset($connection)){
  mysqli_close($connection); 
}
?>