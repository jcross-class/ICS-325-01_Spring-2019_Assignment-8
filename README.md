ICS 325-01 Spring 2019 - Assignment 8
=====================================

Purpose
-------
To help you learn the basics of:
* MySQL (and MariaDB)
* MySQL Workbench
* Importing databases from SQL scripts
* Using PHP to query and report from a MySQL database

Collaboration
-------------
You can talk about the assignment with your peers in the class. You can work with 1 or 2 other people on the assignment, but make sure to mention who they are when you turn your code in.

Resources and Examples
----------------------
Chapters 9, 10, and 11 in the book goes over the basics of databases.

If you want to practice using MySQL you may find it helpful to go through the following example topics:
* [basics of the SELECT statement](http://www.mysqltutorial.org/mysql-select-statement-query-data.aspx) (read from the database)
* [basics of the WHERE clause](http://www.mysqltutorial.org/mysql-where/) (used with SELECT, INSERT, UPDATE)
* [basics of the ORDER BY clause](http://www.mysqltutorial.org/mysql-order-by/) (sorting SELECT results)
* [basics of the IN operator](http://www.mysqltutorial.org/sql-in.aspx) (part of WHERE clause)
* [basics of the AS keyword](http://www.mysqltutorial.org/mysql-alias/) (aliases for tables, select values, etc)
* [basics of the GROUP BY clause](http://www.mysqltutorial.org/mysql-group-by.aspx) (used with SELECT for calculating aggregates)
* [basics of the INNER JOIN clause](http://www.mysqltutorial.org/mysql-inner-join.aspx) (the default JOIN for MySQL):
* [basics of a sub-query](http://www.mysqltutorial.org/mysql-subquery/)
* [basics of aggregate functions](http://www.mysqltutorial.org/mysql-aggregate-functions.aspx)

Prerequisites
-------------
* You will need MySQL installed.  If you are not part of the database course, install XAMPP.  If you are part of the MySQL course, you can use the MySQL version you installed already.
* Instructions for loading SQL will be given using MySQL Workbench.  You can do this a different way if you like if you don't want to install MySQL Workbench.  MySQL Workbench is available for free from [mysql.com](https://www.mysql.com/products/workbench/)
  - Note: If you use Windows, you may need to install Visual C++ Redistributable for Visual Studio 2015 and/or Microsoft .NET Framework 4.5 Client Profile.  Both are listed on the download page for MySQL Workbench.  If MySQL Workbench doesn't work, then try installing Visual C++ Redistributable for Visual Studio 2015 first.  If it still doesn't work, then try installing Microsoft .NET Framework 4.5 Client Profile.
* For the assignment, you will need to import `assignment/setup.sql` into your MySQL database using MySQL workbench.
* To run the book examples, you need to import all the sql files in `book_example/sql/` into your MySQL database using MySQL workbench.
* You will need the PDO with MySQL support.  The PHP version that comes with XAMPP has this built-in.

### Instructions to set up the code to run
First you need to clone your git repository to your computer.  Open GitKraken and make sure you are logged into your github.com account.  Next go to `File->Clone Repo`.  Select the `GitHub.com` icon.  A list of your repositories in github.com should pop up.  Select your assignment 8 repo.  If you want, change `Where to clone to` by clicking browser and selecting a folder for your git repo to be cloned into.  Finally, hit the `Clone the repo!` button.  The repo should now clone to your computer.

We will be using the built-in PHP CGI server for this assignment.  To do so, first make sure you have the git repo open in PhpStorm by using the Open Directory menu item under File in PhpStorm (`File->Open Directory`).  Next go to `Run->Edit Configurations...` Click the green `+` to create a new configuration.  Select `PHP Built-in Web Server`.  Change the name to `MySQL Lab`.  Leave host as `localhost`.  Set the port to `8080`.  Set the `Document root` to your git repo directory by clicking the `...` button next to the field and using the file chooser to select it.  If there is a red ! icon near the bottom right of the window, click the `Fix` button and specify your PHP interpreter.  Once done, click `Ok` to exit the Edit Configurations window.  Next hit the green run button to start the PHP CGI web server.  **Note that before the following URLs will work**, you need to import the `book_example/sql/` sql files into MySQL.  Here are the URLS you can try that are part of the book examples:
* [http://localhost:8080/book_example/search_pdo_no_exit.html](http://localhost:8080/book_example/search_pdo_no_exit.html) - perform a search using the PDO driver.
* [http://localhost:8080/book_example/newbook_pdo_no_exit.html](http://localhost:8080/book_example/newbook_pdo_no_exit.html) - insert a new record using the mysqli driver.

Assignment Set Up
-----------------
Make sure that MySQL is running.  If you have XAMPP, open the XAMPP control panel and click the `start` button next to MySQL.  If you are in the database course, MySQL may already be running in the background on your machine.

Open MySQL workbench.  If there is a button in the top left that says `Local instance 3306` click it and you will be logged into the MySQL server.

If not, click the `+` button next to `MySQL Connections`.  Name the connection `Local instance 3306`.  Hostname should be `127.0.0.1`.  Port should be `3306`.  Username should be `root`.  The password is blank if you use XAMPP.  If you installed MySQL for the database course, you may need to enter a password.  Hit okay and then open the connection by clicking on it.

Once you are in MySQL Workbench, go to `File->Run SQL Script...`  Select the `assignment/setup.sql` script.  Hit the `Run` button.  If it asks for a password, you do not need one if you use XAMPP. Once it is done, in the bottom left side of the screen is a panel that says `SCHEMAS`.  Click the 2 headed arrow button next to it.  That will show you the schemas (databases) you have running.  Hit the refresh button (2 arrows in a circle) to see the bobs database that was created by `assignment/setup.sql`.  Click on the `+` next to examples to see the orders table.  To run queries against a database, double click it.  The database name will turn bold.  Any queries you execute in you query window will run against the bolded database by default.

Now go to `File->Run SQL Script...` again, but this time select `book_example/sql/1_create_db_and_grant.sql`.  Import it the same way.  Then do `book_example/sql/2_bookorama.sql` and `book_example/sql/3_book_insert.sql`.  Once you are done and refresh the schemas, you will see the books database.  Double click that database to select it.

Assignment Work
------------------
You need to modify `assignment/processorder_v4.php` to store data submitted into the `orders` table in `bobs` database in MySQL.  Next you need to modify `assignment/vieworders.php` to query all the orders from the `orders` table in `bobs` database and display them to the user.  Note you should join the `orders` table to the `how_found_bob` table in order to display how the user found Bob's.  Note that the assignment code is set up to use the PDO driver.  So, you should look at `insert_book_pdo_no_exit.php` and `results_pdo_no_exit.php` to see how the PDO driver is used.

Use the order form [http://localhost:8080/assignment/orderform_v2.html](http://localhost:8080/assignment/orderform_v2.html) to submit data to `assignment/processorder_v4.php`.

Grading
-------
Points|Requirement
------|-----------
1 | Use the PDO driver to insert data into the `orders` table.
1 | The correct data inserted.
1 | A PDO prepared statement with bind parameters is used to perform the insert.
1 | Use the PDO driver to query data from the `orders` table.
1 | The correct data is displayed to the user.
1 | A join is used to with the `how_found_bob` in order to display how Bob's was found.
1 | Turn in via github.
**7**| **Total**

How to Turn in the Assignment
-----------------------------
You need to clone your private git repo for assignment 8 and then make the required changes.  Once you are done, commit your modifications to your master branch and push them to GitHub.  Then go to D2L and turn in the assignment to let me know I can go look at your repo and grade you.  D2L requires you to upload a file, so upload a txt file with a link to your private git repo in it.
