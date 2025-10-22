

<?php 

 $db = new mysqli("localhost", "root", "", "onlinevotingsystem");
 if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}
?>