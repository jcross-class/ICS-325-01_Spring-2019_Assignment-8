<!DOCTYPE html>
<html>
<head>
    <title>Bob's Auto Parts - View Orders</title>
</head>
<body>
<?php

// change to true when running in production
$production_mode = false;

try {
    // set up the database connection
    // set up for using PDO
    $user = 'root';
    $pass = '';
    $host = '127.0.0.1';
    $db_name = 'bobs';

    // set up DSN
    $dsn = "mysql:host=$host;dbname=$db_name";

    $db = new PDO($dsn, $user, $pass);

    // Make sure that PDO will throw exceptions if there is an error.
    // see http://php.net/manual/en/pdo.error-handling.php
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // YOUR CODE HERE: SELECT all the orders from the database.
    // Make sure to join the orders table with the how_find_bobs table.

    // YOUR CODE: Modify the while loop below to loop through a SQL SELECT result
    while(feof($orders_file) === false) {
        // only strip \n or \r so we don't strip off any empty fields (normally \t would be stripped)
        $line = trim(fgets($orders_file), "\n\r");
        // skip empty lines
        if ($line == '') {
            continue;
        }

        // put the order into an array
        $order = explode("\t", $line);
        // unpack the array into individual variables
        list($order_date, $tireqty, $oilqty, $sparkqty, $totalamount, $how_find_bob, $notes) = $order;

        // print out the order for this line
        echo "Date: $order_date<br/>\n";
        echo "Tire Qty: $tireqty<br/>\n";
        echo "Oil Qty: $oilqty<br/>\n";
        echo "Spark Qty: $sparkqty<br/>\n";
        echo "Total Cost: $totalamount<br/>\n";
        echo "How did you find Bob's?:" . how_find_bob_decode($how_find_bob) . "<br/>\n";
        echo "Notes: $notes<br/>\n<br/>\n";
    }

    // disconnect from the database
    $db = NULL;
} catch (PDOException $exception) {
    if ($production_mode === false) {
        echo "PDO Error: " . $exception->getMessage();
        echo "<br/>Any extended information: " . $exception->errorInfo . "\n";
    } else {
        echo "Error: There was an internal error during your order.  Please contact support.<br />\n";
    }
} catch (Exception $exception) {
    echo "Sorry, there was a problem with your order.<br />\n";
    echo "Error: " . $exception->getMessage() . "\n";
}

?>
</body>
</html>
