<!--
BookStrore is a library management software.
Copyright (C) 2016  Simon Meusel

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<?php include ("include/init.php");

// Check account
if ($_SESSION["username"] != "") {
  //Recieve Post request
  $name = $_POST['name'];
  $class = $_POST['class'];
  $deadline = $_POST['deadline'];
  $book = $_POST['book'];

  $deadline = date("Y-m-d", strtotime($deadline));

  // Connect to MySQL database
  $connect = mysql_connect("localhost", "$mysqlUsername", "$mysqlPassword") or die("Could not connect to database!");
  // Select batabase
  mysql_select_db("BookStore") or die("Table BookStore does not exist!");

  // Add book to database
  $sql = "INSERT INTO took (name, date, deadline, class, book)
  VALUES ('$name', NOW(), '$deadline', '$class', $book)";

  // Run command
  $response = mysql_query($sql, $connect);
  $took = mysql_insert_id();

  echo "Took id = $took ; $book";

  $sql = "UPDATE book SET taken=$took WHERE id=$book";
  $response = mysql_query($sql, $connect);

}

?>

<?php include ("include/templateTop.php"); ?>

<!-- Login complete? -->

<?php
if ($_SESSION["username"] != "") {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
  Buch ausgeliehen!
  <p>Befehl: '.$sql.'<p>
  <p>Antwork: '.$response.'</p>
  </div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
  Du hast nicht die Erlaubnis ein Buch auszuleihen! <a data-toggle="modal" data-target="#loginModal">Login</a>
  </div>';
}
?>

<?php include ("include/templateBottom.php"); ?>
