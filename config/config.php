<?php
require 'managerDbi.php';
session_start();

function generateToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, $max)];
    }

    return $token;
}

?>