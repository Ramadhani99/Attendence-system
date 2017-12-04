<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$current_admin=find_admin_by_id($_GET["id"]);

if(!$current_admin){
  redirect_to("manage_admin.php");
}



$id=$current_admin["id"];
$query="DELETE FROM admins WHERE id={$id} LIMIT 1";
$result=mysqli_query($connection,$query);
if($result&& mysqli_affected_rows($connection)==1){
  //success
$_SESSION["massage"]  ="Admin deleted";
  redirect_to("manage_admin.php");
}
else{
  $_SESSION["massage"]="page failed to delete";
}

?>