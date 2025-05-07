<?php
session_start();

$usersFile = __DIR__ . '/users.json';

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}

$updatedUsername = trim($_POST['username'] ?? '');
$updatedEmail = trim($_POST['email'] ?? '');

// Validate input
if ($updatedUsername === '' || $updatedEmail === '') {
    die('All fields are required.');
}

$users = json_decode(file_get_contents($usersFile), true);
$currentUsername = $_SESSION['user']['username'];

foreach ($users as &$user) {
    if ($user['username'] === $currentUsername) {
        $user['username'] = $updatedUsername;
        $user['email'] = $updatedEmail;
        $_SESSION['user'] = $user; // Update session data
        break;
    }
}

file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

header("Location: /index.php");
exit;
