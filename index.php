<?php
require_once "db.php";
session_start();
?>
<html>
<head><title>Ni Yan</title></head><body>
<p>Welcome to the music repository!</p>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT title, plays, rating, id FROM tracks");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['title']));
    echo("</td><td>");
    echo(htmlentities($row['plays']));
    echo("</td><td>");
    echo(htmlentities($row['rating']));
    echo("</td><td>");
    echo('<a href="edit.php?id='.htmlentities($row['id']).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row['id']).'">Delete</a>');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New</a>
