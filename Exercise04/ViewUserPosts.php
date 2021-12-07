<?php
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

$user = $_POST["users"];

echo "<link rel='stylesheet' href='styles.css'>
<body>";


$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
	printf("Connect failed: %s\n", $conn->connect_error);
	exit();
}

$sql = "SELECT * FROM Posts WHERE author_id='".$user."'";
echo "<h1>".$user."'s Post:</h1>";
echo "<div id='topboxViewPost'>Posts:</div>";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div id='boxViewPost'>".$row["content"]."</div>";
    }
  }

/* close connection */
$conn->close();
echo "</body>";

?>