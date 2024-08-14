<?php
session_start();
require_once 'config/funtion.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['auth'] = true;
                $_SESSION['loggedInUserRole'] = $row['role'];
                $_SESSION['loggedInUser'] = [
                    'email' => $row['email'],
                ];

                if ($row['role'] == 'admin') {
                    redirect('admin/admin.php', 'Welcome Admin');
                } else {
                    redirect('index.php', 'Login Successful');
                }
            } else {
                redirect('login.php', 'Invalid Password');
            }
        } else {
            redirect('login.php', 'No User Found');
        }
    } else {
        redirect('login.php', 'Something went wrong!');
    }
} else {
    redirect('login.php', 'Access Denied');
}
?>
