<?php 
$errors=array();
function fieldname_as_text($fieldname){
	$fieldname=str_replace("_"," ", $fieldname);
	$fieldname=ucfirst($fieldname);
	return $fieldname;
}
function has_presence($value){
	return isset($value) && $value!=="";
}
function validate_presence($required_field){
	global $errors;
	foreach ($required_field as $key => $field) {
		$value=trim($_POST[$field]);
		if(!has_presence($value)){
			$errors[$field]=fieldname_as_text($field) . " can't be blank";
		}
	}

}

function has_max_length($value,$max){
	return strlen($value)<=$max;
}
function validate_max_length($field_with_max_length){
	global $errors;
	foreach ($field_with_max_length as $field => $max) {
		$value=trim($_POST[$field]);
		if(!has_max_length($value,$max)){
			$errors[$field]=fieldname_as_text($field) . "is too long";
		}
	}

}
function has_inclusion($value,$set){
	return in_array($value, $set);
}



?>