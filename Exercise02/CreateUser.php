<?php
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

$user = $_POST["newUser"];

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
	printf("Connect failed: %s\n", $conn->connect_error);
	exit();
}

//check for duplicates
$duplicate = "no";
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["user_id"] == $user)
		{
			$duplicate = "Yes";
		}
	}
}

//runs if there is content and it is not a duplicate
if ($user == NULL)
{
	echo "<h1>No input submitted</h1>";
}
else if ($duplicate === "Yes")
{
	echo "<h1>There is a duplicate</h1>";
}
else
{
	$sql = "INSERT INTO Users (user_id) VALUES ('$user')";
	if ($conn->query($sql) === TRUE)
	{
		echo "<h1>New User '".$user."' was stored in the database</h1>";
	}
	else
	{
		echo"<h1>Error: " . $sql . "<br>" . $conn->error;"</h1>";
	}
}

/* close connection */
$conn->close();

?>
