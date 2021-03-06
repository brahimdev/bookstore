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
  $bid = mysql_real_escape_string($_POST['bid']);
  $name = mysql_real_escape_string($_POST['name']);
  $isbn =  mysql_real_escape_string($_POST['isbn']);
  $author = mysql_real_escape_string($_POST['author']);
  $message = mysql_real_escape_string($_POST['message']);
  // SQL function NOW() $date = $_POST['date'];
  $publisher = mysql_real_escape_string($_POST['publisher']);
  $giver = mysql_real_escape_string($_POST['giver']);
  $field = mysql_real_escape_string($_POST['field']);
  $publishingdate = mysql_real_escape_string($_POST['publishingdate']);
  $price = mysql_real_escape_string($_POST['price']);

  // Connect to MySQL database
  $connect = mysql_connect("localhost", "$mysqlUsername", "$mysqlPassword") or die("Could not connect to database!");
  // Select batabase
  mysql_select_db("BookStore") or die("Table BookStore does not exist!");

  // Add book to database
  $sql = "INSERT INTO book (bid, name, isbn, author, message, date, publisher, giver, field, publishingdate, price, taken)
  VALUES ('$bid', '$name', '$isbn', '$author', '$message', NOW(), '$publisher', '$giver', '$field', '$publishingdate', '$price', 0)";

  // Run command
  $response = mysql_query($sql, $connect);
}

?>

<?php include ("include/templateTop.php"); ?>

<!-- Book added? -->
<?php
if ($_SESSION["username"] != "") {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
  Buch hinzugefügt!
  <p>Befehl: '.$sql.'<p>
  <p>Antwork: '.$response.'</p>
  </div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
  Du hast nicht die Erlaubnis ein Buch hinzuzufügen! <a data-toggle="modal" data-target="#loginModal">Login</a>
  </div>';
}
?>

<?php include ("include/templateBottom.php"); ?>
