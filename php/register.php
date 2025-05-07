<?php
session_start();

$usersFile = __DIR__ . '/users.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Check if username already exists
foreach ($users as $user) {
    if ($user['username'] === $username) {
        die('Username already exists.');
    }
}

// Hash the password and add the user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$newUser = [
    'username' => $username,
    'email' => $email,
    'password' => $hashedPassword,
    'profile_pic' => '/assets/default-user.png'
];

$users[] = $newUser;
file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

// Log the user in and redirect
$_SESSION['user'] = $newUser;
header("Location: /index.php");
exit;
