<?php

//error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' href='styles.css'><body>";

$conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
"c228g429");

/* check connection */
if ($conn->connect_error) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
echo "<form action='DeletePost.php' method='post'>
<div id='gridPosts'>
    <div id='TopgridBox'>Posts</div>
    <div id='TopgridBox'>Authors</div>
    <div id='TopgridBox'>Delete?</div>";
//check for duplicates
$sql = "SELECT * FROM Posts";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div id='gridBox'>".$row['author_id']."</div>";
        echo "<div id='gridBox'>".$row['content']."</div>";
        echo "<div id='gridBox' value='".$row['post_id']."'><input type='checkbox' id='deleteBox' name='deleteBox[]' value='".$row['post_id']."'></div>";
    }
}
echo "</div>
<input type='submit' value='Submit' name='submit'></form></body>";

/* close connection */
$conn->close();

?>