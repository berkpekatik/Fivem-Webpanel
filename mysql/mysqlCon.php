<?php
try {
     $db = new PDO("mysql:host=x;dbname=x", "x", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>