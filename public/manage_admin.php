<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_login(); ?>
<?php $layout_context="admin";?>
<?php
$admin_set=find_all_admin();
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
      
       <h1>Manage Admins</h1>
       <table class="table">
       	<tr>
       		<th>Username</th>
       		<th>Actions</th>
       		<th>Actions</th>

       </tr><?php
       	while($admin=mysqli_fetch_assoc($admin_set)){
       		?>
       	
       	<tr>
       		<td><?php echo htmlentities($admin["username"]); ?>
           
          </td>
       		<td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);  ?>">Edit </a></td>
       		<td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]);  ?>">Delete </a></td>
       	</tr>
       	<?php }?>
       </table>

</div></div>

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