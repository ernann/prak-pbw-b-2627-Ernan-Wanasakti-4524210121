<?php 
$hasil = null;
$pesan = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $a = (float) ($_POST['a'] ?? 0);
    $a = (float) ($_POST['b'] ?? 0);
    $operator = $_COOKIE_POST['operator'] ?? '+';
}