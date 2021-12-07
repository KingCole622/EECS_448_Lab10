<?php
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' href='styles.css'>
<body>";

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
	printf("Connect failed: %s\n", $conn->connect_error);
	exit();
}

$sql = "SELECT * FROM Users";
echo "<h1>Users:</h1>";
echo "<div id='topbox'>User_id</div>";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div id='box'>".$row["user_id"]."</div>";
    }
  }

/* close connection */
$conn->close();
echo "</body>";
?>
