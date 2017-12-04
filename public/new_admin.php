<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php $layout_context="admin";?>
<?php confirm_login(); ?>
<?php

?>
<?php 
if(isset($_POST["submit"])){

$required_field=(array("username","password"));
validate_presence($required_field);
if(empty($errors)){
	$username=mysql_prep($_POST["username"]);
	$password=mysql_prep($_POST["password"]);
	$query="INSERT INTO admins(";
	$query.=" username,password";
	$query.=" ) VALUES ( ";
	$query.="'{$username}', '{$password}'";
	$query.=" )";
	$result=mysqli_query($connection,$query);
	if($result){
		//success
	$_SESSION["massage"]="Admin created";
	redirect_to("manage_admin.php");
		
	}
	else{
		$_SESSION["massage"]="admin failed to be created";
		redirect_to("manage_admin.php");
	}
	}
	else{
		//this is probally GET request
		//redirect_to("admin.php");

	}
}
?>

<?php include("../includes/layouts/header.php"); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          
          
          
        </div>


     <div class="col-sm-9  col-sm-offset-3 col-md-10 col-md-offset-2 main">
     <?php
     echo massage(); 
       ?>  
      
       <?php 
        echo form_errors($errors);
       ?>

<div class="row row-bottom-padded-sm">
					<div class="col-md-6" id="fh5co-content">
						<form action="new_admin.php" method="post">
							<div class="form-group">
								<label for="username">username</label>
								<input type="text" name="username"
								class="form-control" id="name">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" id="name">
							</div>
							
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="submit" value="Create Admin">
							</div>
						</form>
					</div>

</div></div></div></div>

					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
       
    <?php include("../includes/layouts/footer.php") ?>
     </body>
</html>
 <?php
if(isset($connection)){
  mysqli_close($connection); 
}
?>