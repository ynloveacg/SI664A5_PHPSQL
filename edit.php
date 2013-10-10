<?php
require_once "db.php";
session_start();

if ( isset($_POST['title']) && isset($_POST['plays']) 
     && isset($_POST['rating']) && isset($_POST['id']) ) {

    $title= mysql_entities_fix_string($_POST['title']);
    $plays= mysql_entities_fix_string($_POST['plays']);
    $rating=mysql_entities_fix_string($_POST['rating']);
    
    function mysql_entities_fix_string($string)
    {
    return htmlentities(mysql_fix_string($string));
    }

    function mysql_fix_string($string)
    {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return mysql_real_escape_string($string);
    }

    $sql = "UPDATE tracks SET title = :title, 
            plays = :plays, rating = :rating
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':title' => $title,
        ':plays' => $plays,
        ':rating' => $rating,
        ':id' => $_POST['id']));

    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

$stmt = $pdo->prepare("SELECT * FROM tracks where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}

$t = $row['title'];
$p = $row['plays'];
$r = $row['rating'];
$id =$row['id']);

echo <<< _END
<p>Edit User</p>
<form method="post">
<p>Title:
<input type="text" name="title" value="$t"></p>
<p>Plays:
<input type="text" name="plays" value="$p"></p>
<p>Rating:
<input type="text" name="rating" value="$r"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
_END
?>

	