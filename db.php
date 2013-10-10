<?php
try
{
  $pdo = new PDO('mysql:host=sql100.byethost14.com;port=3306;dbname=b14_13744063_misc', 
    'b14_13744063','YNkanami');
}catch (Exception $ex){
  die($ex->getMessage());
}
?>		