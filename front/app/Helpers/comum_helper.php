<?php 
function v($arr,$key){ 
 if (isset($arr[$key])){ 
 return $arr[$key]; 
 } else { 
 return null; 
 } 
}
?>