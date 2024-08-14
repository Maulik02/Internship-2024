<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/funtion.php';

if (isset($_SESSION['auth'])) {
    if (isset($_SESSION['loggedInUserRole'])) {
        $role = validate($_SESSION['loggedInUserRole']);
        $email = validate($_SESSION['loggedInUser']['email']);

        $query = "SELECT * FROM users WHERE email = '$email' AND role = '$role' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) == 0) {
                logoutSession();
                redirect('../login.php', 'Access Denied');
            } else {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row['role'] != 'admin') {
                    logoutSession();
                    redirect('../login.php', 'Access Denied');
                }
                if ($row['is_ban'] == 1) {
                    logoutSession();
                    redirect('../login.php', 'Your account has been banned. Please contact the administrator');
                }
            }
        } else {
            logoutSession();
            redirect('../login.php', 'Something went wrong!');
        }
    }
} else {
    redirect('../login.php', 'Login to Continue...');
}
?>
