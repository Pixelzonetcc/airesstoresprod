<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = mysqli_connect('localhost', 'hostdeprojetos_airesstores', 'tcc@2024pz', 'hostdeprojetos_airesstores');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
