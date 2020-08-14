<?php



$server = "localhost";
$username = "root";
$password= "";
$db = "school";


$conn = new mysqli($server,$username,$password,$db);
if($conn){

}
else{
  echo 'error' .$conn->error;
}














?>