<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context="admin";?>
<?php
find_selected_page();
?>
<?php include("../includes/layouts/header.php"); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          
          <?php echo navigation($current_subject,$current_page); ?>
          
        </div>


     <div class="col-sm-9  col-sm-offset-3 col-md-10 col-md-offset-2 main">
     <?php
     echo massage(); 
       ?>  
       <?php 

       $errors=errors();

       ?>
       <?php 
        echo form_errors($errors);
       ?>
         
         <form class="form-horizontal" action="create_subject.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>CREATE SUBJECT</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Subject_name</label>  
  <div class="col-md-4">
  <input id="textinput" name="menu_name" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">position</label>
  <div class="col-md-4">
    <select id="selectbasic" name="position" class="form-control">
    <?php
             $subject_set=find_all_subject();
             $subject_count=mysqli_num_rows($subject_set);
             for($count=1; $count <= ($subject_count+1);$count++){
               echo" <option value=\"{$count}\">{$count}</option>";
             }
                 
                 ?>
    </select>
  </div>
</div>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">visible</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input type="radio" name="visible"  value="0" >
      No
    </label>
    </div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="visible"  value="1">
      Yes
    </label>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" type="submit" name="submit" class="btn btn-success">Create_Subject</button>
    
  </div>
</div>

</fieldset>
</form>

    <a href="manage_content.php">Cancel</a>
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
       
    <?php include("../includes/layouts/footer.php") ?>
   
  </body>
</html>
 <?php
if(isset($connection)){
  mysqli_close($connection); 
}
?>
