<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$current_subject=find_subject_by_id($_GET["subject"]);

if(!$current_subject){
  redirect_to("manage_content.php");
}

$pages_set=find_page_for_subject($current_subject["id"]);
if(mysqli_num_rows($pages_set)>0){
	$_SESSION["massage"]="Can't delete subject with a page";
	redirect_to("manage_content.php?subject={$current_subject["id"]}");
}

$id=$current_subject["id"];
$query="DELETE FROM subjects WHERE id={$id} LIMIT 1";
$result=mysqli_query($connection,$query);
if($result&& mysqli_affected_rows($connection)==1){
  //success
$_SESSION["massage"]  ="subject deleted";
  redirect_to("manage_content.php");
}
else{
  $_SESSION["massage"]="subject failed to update";
}

?>