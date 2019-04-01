<!DOCTYPE html>
<html>
<head>
    <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php

if (!isset($_POST['searchtype']) || !isset($_POST['searchterm'])) {
    echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
} else {
    // create short variable names
    $searchtype = $_POST['searchtype'];
    $searchterm = "%{$_POST['searchterm']}%";

    // whitelist the searchtype
    switch ($searchtype) {
        case 'Title':
        case 'Author':
        case 'ISBN':
            break;
        default:
            echo '<p>That is not a valid search type. <br/>
        Please go back and try again.</p>';
            exit;
    }

    // set up for using PDO
    $user = 'bookorama';
    $pass = 'bookorama123';
    $host = '127.0.0.1';
    $db_name = 'books';

    // set up DSN
    $dsn = "mysql:host=$host;dbname=$db_name";


    try {
        // connect to database
        $db = new PDO($dsn, $user, $pass);

        // Make sure that PDO will throw exceptions if there is an error.
	// see http://php.net/manual/en/pdo.error-handling.php
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // perform query
        $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype like :searchterm";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':searchterm', $searchterm);
        $stmt->execute();

        // get number of returned rows
        echo "<p>Number of books found: " . $stmt->rowCount() . "</p>";

        // display each returned row
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            echo "<p><strong>Title: " . $result->Title . "</strong>";
            echo "<br />Author: " . $result->Author;
            echo "<br />ISBN: " . $result->ISBN;
            echo "<br />Price: \$" . number_format($result->Price, 2) . "</p>";
        }

        // disconnect from database
        $db = NULL;
    } catch (PDOException $e) {
        echo "Sorry, an error occurred.<br/>\nError: " . $e->getMessage();
        echo "<br/>\nAny extended information: " . $e->errorInfo . "\n";
    }
}
?>
</body>
</html>
