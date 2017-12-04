<?php
          $subject_set=find_all_subject();

?>
          <?php
          while($subject=mysqli_fetch_assoc($subject_set)){
            ?>
            <?php
            echo "<li"; 
            if($subject["id"]==$select_subject_id){
            echo " class=\"selected \"";
            }
            echo ">";
            ?>
          
            <a href="manage_content.php?subject=<?php echo urlencode($subject["id"]); ?>">
            <?php echo $subject["menu_name"]; ?></a >
              <ul class="nav nav-sidebar">
                <?php
                $page_set=find_page_for_subject($subject["id"]);

?>
              
              <?php
          while($page=mysqli_fetch_assoc($page_set)){
            ?>
            <?php
            echo "<li"; 
            if($["id"]==$select_subject_id){
            echo " class=\"selected \"";
            }
            echo ">";
            ?>
            <a href="manage_content.php?page=<?php echo urlencode($page["id"]); ?>"><?php echo $page["menu_name"]; ?></a>
       </li>
            <?php } ?>
            <?php mysqli_free_result($page_set); ?>
            </ul>
                  </li>
            <?php } ?>
            <?php mysqli_free_result($subject_set); ?>
          </ul>
          function find_subject_by_id($subject_id){
  global $connection;
  $safe_subject_id=mysqli_real_escape_string($connection,$subject_id);
$query="SELECT * ";
$query.="FROM subjects ";
$query.="WHERE id={$safe_subject_id} ";
$query.="LIMIT 1";
$subject_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($subject);
if($subject=mysqli_fetch_assoc($subject_set)){
return $subject;
}
else{
  return null;
}

}
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if(isset($_GET["subject"])){
  $select_subject_id=$_GET["subject"];
  $select_page_id=null;
}
elseif(isset($_GET["page"])){
  $select_page_id=$_GET["page"];
  $select_subject_id=null;
}
else{
   $select_subject_id=null;
    $select_page_id=null;
}
?>
<?php include("../includes/layouts/header.php"); ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          
          <?php echo navigation($select_subject_id,$select_page_id); ?>
          
        </div>


     <div class="col-sm-9  col-sm-offset-3 col-md-10 col-md-offset-2 main">
         
    <h1 class="page-header" style="color: #ed6">
     Manage Content</h1>
     <?php if($select_subject_id){ ?>
     <h2 class="page-header" style="color: #e16">
     Manage Subject</h2>
     <?php $current_subject=find_subject_by_id($select_subject_id); ?>
     Menu_name:<?php echo $current_subject["menu_name"]; ?>

     <?php } elseif($select_page_id){ ?>
<h2 class="page-header" style="color: #e26">
     Manage Page</h2>
     <?php $current_page=find_page_by_id($select_page_id); ?>
     Menu_name:<?php echo $current_page["menu_name"]; ?>
     <?php } else{?>
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
<?php
//index
function find_admin_by_id($admin_id){
global $connection;
$safe_admin_id=mysqli_real_escape_string($connection,$admin_id);
$query="SELECT * ";
$query.="FROM admins ";
$query.="WHERE id={$safe_admin_id} ";
$query.="LIMIT 1";
$admin_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($admin_set);
if($admin=mysqli_fetch_assoc($admin_set)){
return $admin;
}
else{
  return null;
}
}


?>