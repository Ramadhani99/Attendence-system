<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php
find_selected_page();
?>
<?php 
if(!$current_page["id"]){
  redirect_to("manage_content.php");
}
?>
<?php 
if(isset($_POST["submit"])){
$id=$current_page["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];
$content=mysql_prep($_POST["content"]);

$required_field=array("menu_name","position","visible","content");
validate_presence($required_field);


if(empty($errors)){
  //update process
 
$query="UPDATE pages SET ";
$query.="menu_name= '{$menu_name}', ";
$query.="position= {$position}, ";
$query.="visible= {$visible} ,";
$query.="content= '{$content}' ";
$query.="WHERE id={$id} ";
$query.="LIMIT 1";
$result=mysqli_query($connection,$query);
if($result&& mysqli_affected_rows($connection)==1){
  //success
$_SESSION["massage"]  ="page Updated";
  redirect_to("manage_content.php");
}
else{
  $_SESSION["massage"]="subject failed to update";
}

}
}//end  
  //if(isset($_POST["submit"])){

else{
  //this is probally GET request
  //redirect_to("Edit_subject.php");

}
?>
<?php $layout_context="admin";?>
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
        echo form_errors($errors);
       ?>
         
         <form class="form-horizontal" action="Edit_page.php?page=<?php echo $current_page["id"];?> " method="post">
<fieldset>

<!-- Form Name -->
<legend>Edit_Subject <?php echo $current_page["menu_name"]; ?></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Subject_name</label>  
  <div class="col-md-4">
  <input id="textinput" name="menu_name" type="text" placeholder="" class="form-control input-md"
  value="<?php echo $current_page["menu_name"]; ?>">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">position</label>
  <div class="col-md-4">
    <select id="selectbasic" name="position" class="form-control">
    <?php
             $page_set=find_page_for_subject($current_page["subject_id"],false);
             $page_count=mysqli_num_rows($page_set);
             for($count=1; $count <=   $page_count;$count++){
               echo" <option value=\"{$count}\"";
               if ($current_page["position"]==$count) {
                 echo " selected";
               }
               
               echo ">{$count}</option>";
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
      <input type="radio" name="visible"  value="0" 
      <?php if ($current_page["visible"]==0) {echo "checked";} ?>>
      No
    </label>
    </div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="visible"  value="1"
      <?php if ($current_page["visible"]==1) {echo "checked";} ?>>
      Yes
    </label>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Content</label>
  <div class="col-md-8">
  <textarea name="content" cols="50" rows="5">
    <?php echo htmlentities($current_page["content"]);?>
  </textarea>
  </div></div>
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" type="submit" name="submit" class="btn btn-success">Edit_Subject    </button>
    
  </div>
</div>

</fieldset>
</form>

    <a href="manage_content.php">Cancel</a>
    <a href="delete_page.php?page=<?php echo $current_page["id"];?>" 
    onclick="return confirm('Are you sure you want to delete')">Delete</a>
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
