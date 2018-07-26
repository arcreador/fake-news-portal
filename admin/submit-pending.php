<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "mysql", "fake_news_portal");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$admin_clarification = mysqli_real_escape_string($link, $_REQUEST['admin_clarification']);
$title = mysqli_real_escape_string($link, $_REQUEST['title']);
 
// attempt insert query execution
$sql = "UPDATE fake_news SET admin_clarification = $admin_clarification WHERE title = $title ";
if(mysqli_query($link, $sql)){
    echo "Records updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>