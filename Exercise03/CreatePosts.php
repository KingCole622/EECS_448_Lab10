<?php
//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' href='styles.css'>
<body>";

$user = $_POST["Username"];
$posts = $_POST["post"];

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
	printf("Connect failed: %s\n", $conn->connect_error);
	exit();
}

//check is user exist
$exist = "no";
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["user_id"] == $user)
		{
			$exist = "Yes";
		}
	}
}


do {
	$postID = rand(0, 1000000000);
	$sql = "SELECT * FROM Posts";
	$redo = false;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["post_id"] == $postID)
			{
				$redo = true;
			}
		}
	}
} while ($redo == true);

//runs if there is content and it is not a duplicate
if ($exist == "no")
{
	echo "That username is not in our database";
}
else
{
	if ($posts == NULL)
	{
		echo "The post had no text.";
	}
	else
	{
		$sql = "INSERT INTO Posts (post_id, author_id, content) VALUES ('$postID', '$user', '$posts')";
		if ($conn->query($sql) === TRUE)
		{
			echo "<h1>Post was saved!</h1>";
		}
		else
		{
			echo"<h1>Error: " . $sql . "<br>" . $conn->error;"</h1>";
		}
	}
}

/* close connection */
$conn->close();

echo "</body>";






















/*

//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "<link rel='stylesheet' href='styles.css'>
<body>";

$posts = $_POST["post"];
$user = $_POST["Username"];

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection 
if ($conn->connect_error) {
	printf("Connect failed: %s\n", $conn->connect_error);
	exit();
}

//check for duplicates
$duplicate = false;
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["user_id"] == $user)
		{
			$duplicate = $row["user_id"];
		}
	}
}

do {
	$postID = rand(0, 1000000000);
	$sql = "SELECT * FROM Posts";
	$redo = false;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["post_id"] == $postID)
			{
				$redo = true;
			}
		}
	}
} while ($redo == true);


if ($duplicate == false)
{
	echo "That username is not in our database";
}
else 
{
	if ($posts == NULL)
	{
		echo "The post had no text.";
	}
	else
	{
		$sql = "INSERT INTO Posts (post_id, author_id, content) VALUES ('$postID', '$user', '$posts')";
		echo "<h1>".$user." has made post:</h1>";
	}
}

/* close connection 
$conn->close();

echo "</body>";
?>
