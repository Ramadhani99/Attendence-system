<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>

<?php
find_selected_page();
?>

<?php
if(isset($_POST["submit"])){
  $required_field=(array("menu_name","position","visible","content"));
validate_presence($required_field);
if(!empty($errors)){
  $_SESSION["errors"]=$errors;
}
  else
    {
      $subject_id=$current_subject["id"];
        $menu_name=mysql_prep($_POST["menu_name"]);
        $position=(int) $_POST["position"];
        $visible=(int) $_POST["visible"];
        $content=mysql_prep($_POST["content"]);

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
          
        }
      }

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

       $errors=errors();

       ?>
       <?php 
        echo form_errors($errors);
       ?>
         
         <form class="form-horizontal" action="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>" method="post">
<fieldset>

<!-- Form Name -->
<legend>CREATE PAGE</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Page_name</label>  
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
             $page_set=find_page_for_subject($current_subject["id"]);
             $page_count=mysqli_num_rows($page_set);
             for($count=1; $count <= ($page_count+1);$count++){
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

  <div class="form-group col-lg-12">
      <label>Content</label>
      <textarea class="form-control" name="content" rows="6"></textarea>
       </div>
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" type="submit" name="submit" class="btn btn-success">Create_page</button>
    
  </div>
</div>

</fieldset>
</form>

    <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]);?>">Cancel</a>
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
