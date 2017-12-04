<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_login(); ?>
<?php 
$layout_context="admin";
?>
<?php
find_selected_page();
?>
<?php include("../includes/layouts/header.php"); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          
          <?php echo navigation($current_subject,$current_page); ?>
          <br>
          <a href="new_subject.php">+ Add New Subject</a>
          
        </div>


     <div class="col-sm-9  col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <?php 
         echo massage();
        
        
     ?>
    
     <?php if($current_subject){ ?>
     <h2 class="page-header" style="color: #345">
     Manage Subject</h2>
     Menu_name:<?php echo htmlentities($current_subject["menu_name"]); ?><br>
     Position:<?php echo $current_subject["position"]; ?><br>
     Visible:<?php echo $current_subject["visible"]=1?'yes':'No'; ?><br><br>
     <a href="Edit_subject.php?subject=<?php echo $current_subject["id"];?>">Edit_Subject</a><br>
     <div class="panel"> 
<h3 class="page-header" style="color: #e16">Pages in this subject:</h3>
<ul>
<?php
$subject_page=find_page_for_subject($current_subject["id"]);
while($page=mysqli_fetch_assoc($subject_page)){
echo "<li >";
$safe_page_id=urlencode($page["id"]);
echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
echo htmlentities($page["menu_name"]);
echo "</a>";
echo "</li>";

}
    ?>
</ul>
<br>
+<a href="new_page.php?subject=<?php echo urlencode($current_subject["id"])?>">Add New page for this subject</a>
</div>

     <?php } elseif($current_page){ ?>
<h2 class="page-header" style="color: #e26">
     Manage Page</h2>
     Menu_name:<?php echo htmlentities( $current_page["menu_name"]);?><br>
     
     Position:<?php echo $current_page["position"]; ?><br>
     Visible:<?php echo $current_page["visible"]=1?'yes':'No'; ?><br>
     Content:
     <div class="well">
         <?php echo htmlentities($current_page["content"])?>
     </div>
     <a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">Edit_page</a>
     <?php } 
     else{?>
     please select the subject or page......
     <?php }  ?>
     
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
