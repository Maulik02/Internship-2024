<?php
session_start();
require_once '../config/funtion.php';

if (isset($_SESSION['auth'])) {
    logoutSession();
    redirect('../login.php', 'Logged out Successfully');
} else {
    redirect('../login.php', 'You are not logged in');
}
?>
