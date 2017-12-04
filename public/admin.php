
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_login(); ?>
<?php $layout_context="admin";?>
<?php include("../includes/layouts/header.php"); ?>
<br><br>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            
          </ul>
          
        </div>
      

     <div class="col-sm-9  col-sm-offset-3 col-md-10 col-md-offset-2 main">
     <div class="col-sm-8  col-md-9  main">
         
    <h1 class="page-header">
     Admin Menu</h1>
     Wellcome to admin panel <?php echo htmlentities($_SESSION["username"]) ; 
     echo $sms; ?>
     <div class="list-group">
  <a href="manage_content.php" class="list-group-item">Manage website content</a>
  <a href="manage_admin.php" class="list-group-item">Manage admins</a>
  <a href="logout.php" class="list-group-item">Logout</a>
</div> 
</div>
  </div>
   </div>
</div>

   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <?php include("../includes/layouts/footer.php"); ?>
  </body>
</html>
