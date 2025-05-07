<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$usersFile = __DIR__ . '/users.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: /index.php");
        exit;
    }
}

// If no match found
echo "<script>alert('Invalid username or password.'); window.location.href = '/php/signin.php';</script>";
exit;
