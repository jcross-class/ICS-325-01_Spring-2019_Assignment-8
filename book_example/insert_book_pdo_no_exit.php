<!DOCTYPE html>
<html>
<head>
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
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

    // set up for using PDO
    $user = 'bookorama';
    $pass = 'bookorama123';
    $host = '127.0.0.1';
    $db_name = 'books';

    // set up DSN
    $dsn = "mysql:host=$host;dbname=$db_name";

    // connect to database
    try {
        $db = new PDO($dsn, $user, $pass);

        // Make sure that PDO will throw exceptions if there is an error.
        // see http://php.net/manual/en/pdo.error-handling.php
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO Books VALUES (:isbn, :author, :title, :price)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<p>Book inserted into the database.</p>";
        } else {
            echo "<p>An error has occurred.<br/>
              The item was not added.</p>";
        }

        // disconnect from database
        $db = NULL;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<br/>Any extended information: " . $e->errorInfo . "\n";
    }
}
?>
</body>
</html>
