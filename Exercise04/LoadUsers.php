<?php

loadUsers();

function loadUsers() {
    //error reporting
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $conn = new mysqli("mysql.eecs.ku.edu", "c228g429", "EeY4saic",
    "c228g429");

    /* check connection */
    if ($conn->connect_error) {
        printf("Connect failed: %s\n", $conn->connect_error);
        exit();
    }
    //check for duplicates
    echo "<form action='ViewUserPosts.php' method='post' id='userBox'>
            <label for='users'>Choose a User:</label>
            <select name='users' id='users'>";
    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["user_id"]."'>".$row["user_id"]."</option>";
        }
    }
    echo "</select>
    <input type='submit' value='Submit'></form>";

    /* close connection */
    $conn->close();
}

?>