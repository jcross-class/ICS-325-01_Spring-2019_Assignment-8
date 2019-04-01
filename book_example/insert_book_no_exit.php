<?php

# keep track of what we want to tell the user
$message = '';

if (!isset($_POST['ISBN']) || !isset($_POST['Author'])
    || !isset($_POST['Title']) || !isset($_POST['Price'])) {
    $message = "<p>Error: You have not entered all the required details.<br />
             Please go back and try again.</p>";
} else {
    // create short variable names
    $isbn = $_POST['ISBN'];
    $author = $_POST['Author'];
    $title = $_POST['Title'];
    $price = $_POST['Price'];
    $price = doubleval($price);

    @$db = new mysqli('127.0.0.1', 'bookorama', 'bookorama123', 'books');

    if (mysqli_connect_errno()) {
        $message = "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
    } else {

        $query = "INSERT INTO Books VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssd', $isbn, $author, $title, $price);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<p>Book inserted into the database.</p>";
        } else {
            echo "<p>An error has occurred.<br/>
              The item was not added.</p>";
        }

        $db->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php echo $message; ?>
</body>
</html>
