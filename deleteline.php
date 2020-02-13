<?php
$db = new PDO('mysql:host=localhost;dbname=crm', "root", "plop");
echo 'DELETE FROM clients WHERE id = '.$_POST["id"];
$reqqo = $db->query('DELETE FROM clients WHERE id = '.$_POST["id"]);
?>