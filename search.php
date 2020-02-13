<?php
$db = new PDO('mysql:host=localhost;dbname=crm', "root", "plop");
if(isset($_POST["q"])) {
                            
    $req=$db->query('SELECT * FROM clients WHERE name LIKE  "%'.$_POST["q"].'%"');
}
else {

    $req = $db->query('SELECT * FROM clients');
}
?>