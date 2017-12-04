<?php

function redirect_to($new_location){
	header("Location: ".$new_location);
	exit;
}
function mysql_prep($string){
  global $connection;
 $escape= mysqli_real_escape_string($connection,$string);
 return $escape;
}
function confirm_query($result_set){
	if(!$result_set){
		die("database query failed");
	}
}
function find_all_subject($public=true){
	//perform database query
	global $connection;
$query="SELECT * ";
$query.="FROM subjects ";
if($public){
  $query.="WHERE visible = 1 ";
}

$query.="ORDER BY position ASC";
$subject_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($subject_set);
return $subject_set;
}
function find_all_admin(){
  global $connection;
  $query="SELECT * ";
$query.="FROM admins ";
$query.="ORDER BY username ASC";
$admin_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($admin_set);
return $admin_set;
}



function find_page_for_subject($subject_id,$public=true){
	//perform database query
	global $connection;
$query="SELECT * ";
$query.="FROM pages ";
$query.="WHERE subject_id ={$subject_id} ";
if ($public) {
  $query.="AND visible = 1 ";
}

$query.="ORDER BY position ASC";
$page_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($page_set);
return $page_set;
}
function find_default_page_for_subject($subject_id){
  $page_set=find_page_for_subject($subject_id);
  if($first_page=mysqli_fetch_assoc($page_set)){
return $first_page;
} 
else{
  return null;
}

}
function find_selected_page($public=false){
	global $current_subject;
		global $current_page;
		if(isset($_GET["subject"])){
   $current_subject=find_subject_by_id($_GET["subject"]); 
   if ($public) {
      $current_page=find_default_page_for_subject($current_subject["id"]);
   }
 else{
  $current_page=null;
}
 }

elseif(isset($_GET["page"])){
$current_subject=null;
$current_page=find_page_by_id($_GET["page"]);
  
}
else{
    $current_subject=null;
    $current_page=null;
}
}

function find_subject_by_id($subject_id){
	global $connection;
	$safe_subject_id=mysqli_real_escape_string($connection,$subject_id);
$query="SELECT * ";
$query.="FROM subjects ";
$query.="WHERE id={$safe_subject_id} ";
$query.="LIMIT 1";
$subject_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($subject_set);
if($subject=mysqli_fetch_assoc($subject_set)){
return $subject;
}
else{
	return null;
}

}
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

function find_page_by_id($page_id){
	global $connection;
	$safe_page_id=mysqli_real_escape_string($connection,$page_id);
$query="SELECT * ";
$query.="FROM pages ";
$query.="WHERE id={$safe_page_id} ";
$query.="LIMIT 1";
$page_set=mysqli_query($connection,$query);
//test if there is any error in query
confirm_query($page_set);
if($page=mysqli_fetch_assoc($page_set)){
return $page;
}
else{
	return null;
}

}
//navigation take 2 arguments
//-current subject array or null
//current page id or null
function navigation($subject_array,$page_array){
	 $output="<ul class=\"nav nav-sidebar\">";
    $subject_set=find_all_subject(false);
	while($subject=mysqli_fetch_assoc($subject_set)){
      $output.="<li";     
    if($subject_array&&$subject["id"]==$subject_array["id"]){
     $output.=" class=\"selected \"";
            }

     $output.=">";

      $output.="<a href=\"manage_content.php?subject=";
      $output.=urlencode($subject["id"]);
      $output.="\">";
      $output.=$subject["menu_name"];
      $output.="</a >";
    
      $output.="<ul >";
      $page_set=find_page_for_subject($subject["id"],false);
while($page=mysqli_fetch_assoc($page_set)){
       $output.="<li"; 
        if($page_array&&$page["id"]==$page_array["id"]){
            $output.=" class=\"selected \"";
            }
      $output.=">";
         
      $output.="<a href=\"manage_content.php?page=";
      $output.=urlencode($page["id"]); 
      $output.="\">";
      $output.=$page["menu_name"]; 
      $output.="</a>";

       $output.="</li>";
        }
       mysqli_free_result($page_set);
       $output.="</ul>";
       $output.="</li>";
  }
        mysqli_free_result($subject_set); 
        $output.="</ul>";
    
      return $output;    
}
function form_errors($errors=array()){
  if(!empty($errors)){
    $output="<div class=\"error\"";
     $output.=" <ul>";
    $output.=" Please fix the following errors";
   
    foreach ($errors as $key => $error) {
      $output.=" <li> {$error} </li>";
    }
    $output.=" </ul>";
    $output.=" </div>";
return $output;

  }
  
 }
 function public_navigation($subject_array,$page_array){
   $output="<ul";
   $output.="class=\"nav navbar-nav\"";

     $output.=">"; 
    $subject_set=find_all_subject();
  while($subject=mysqli_fetch_assoc($subject_set)){
      $output.="<li";     
    if($subject_array&&$subject["id"]==$subject_array["id"]){
     $output.=" class=\"selected \"";
            }

     $output.=">";

      $output.="<a href=\"index.php?subject=";
      $output.=urlencode($subject["id"]);
      $output.="\">";
      $output.=$subject["menu_name"];
      $output.="</a >";
    if ($subject_array["id"]==$subject["id"]||$page_array["subject_id"]==$subject["id"]) {
        $output.="<ul >";
      $page_set=find_page_for_subject($subject["id"]);
while($page=mysqli_fetch_assoc($page_set)){
       $output.="<li"; 
        if($page_array&&$page["id"]==$page_array["id"]){
            $output.=" class=\"selected \"";
            }
      $output.=">";
         
      $output.="<a href=\"index.php?page=";
      $output.=urlencode($page["id"]); 
      $output.="\">";
      $output.=$page["menu_name"]; 
      $output.="</a>";

       $output.="</li>";
        }
       mysqli_free_result($page_set);
       $output.="</ul>";
    }
      
       $output.="</li>";
  }
        mysqli_free_result($subject_set); 
        $output.="</ul>";
    
      return $output;    
}

//paswwor ecrypt
function password_encrypt($password){
  $hash_format="$2y$10$";
  //$salt_length=22;
  $salt="Salt22charactersormore";
  $format_and_salt=$hash_format . $salt;
  $hash=crypt($password,$format_and_salt);
  return $hash;
}
function generate_salt($length){
  //Not 100% Not 100% Random but good enough for salt
  //MD5 return 32 character
  $unique_random_string=md5(uniqid(mt_rand(),true));
  //valid character for salt are [a-z,A-Z,0-9]
  $base64_string=base64_encode($unique_random_string);
  //But not '+' which is valid base64 encoding
  $modified_base64_string=str_replace("+", ".", $base64_string);

  //truncate string to the correct length
  $salt=substr($modified_base64_string,0,$length);
  return $salt;
}
function find_admin_by_username($username){
global $connection;
$safe_username=mysqli_real_escape_string($connection,$username);
$query="SELECT * ";
$query.="FROM admins ";
$query.="WHERE username='{$safe_username}' ";
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
function password_check($password,$existing_hash){
  $hash1=password_encrypt($password);
  if ($hash1===$existing_hash){
    return true;
  }
  else{
    return false;
  }
}
function attempt_login($username,$password){
  $admin=find_admin_by_username($username);
  if ($admin) {
    //found admin now check password
      $password=password_encrypt($password);
    if ($password===$admin["password"]){
      return $admin;
  
    }
    else{
      //password is not match

      return false;
    }
  }
  else{
  
    return false;
  }
}
function logged_in(){
  return isset($_SESSION["admin_id"]);
}
function confirm_login(){
  if (!logged_in()) {
    redirect_to("login.php");
  }
}
?>