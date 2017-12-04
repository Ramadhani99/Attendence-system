<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>


<?php 
if(isset($_POST["submit1"])){
	$subject_id=$current_subject["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];
$content=mysql_prep($_POST["content"]);
$required_field=(array("menu_name","position","visible","content"));
validate_presence($required_field);
if(!empty($errors)){
	$_SESSION["errors"]=$errors;
	redirect_to("new_page.php");
}

$query="INSERT INTO pages(";
$query.=" subject_id,menu_name,position,visible,content";
$query.=" ) VALUES ( ";
$query.=" {$subject_id},'{$menu_name}', {$position}, {$visible},'{$content}'";
$query.=" )";
$result=mysqli_query($connection,$query);
if($result){
	//success
$_SESSION["massage"]="page created";
	redirect_to("manage_content.php");
}
else{
	$_SESSION["massage"]="page failed to be created";
	redirect_to("new_page.php");
}
}
else{
	//this is probally GET request
	redirect_to("manage_content.php");

}
?>
<?php
if(isset($connection)){
  mysqli_close($connection); 
}
?>