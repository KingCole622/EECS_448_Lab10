<?php
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "<link rel='stylesheet' href='styles.css'>
<body>";
echo "<h1>All these Posts were deleted:</h1>";

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
  printf("Connect failed: %s\n", $conn->connect_error);
  exit();
}

if(isset($_POST['submit'])) 
{
  if (!empty($_POST['deleteBox']))
  {
    foreach($_POST['deleteBox'] as $value){
      $sql = "DELETE FROM Posts WHERE post_id='".$value."'";
      echo "<div>".$value."</div>";
      $result = $conn->query($sql);
    }
  }
}
      
/* close connection */
$conn->close();
echo "</body>";


?>