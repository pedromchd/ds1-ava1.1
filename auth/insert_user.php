<?php
$email = $_POST['email'];
$uname = $_POST['username'];
$upass = password_hash($_POST['password'], PASSWORD_BCRYPT);

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('INSERT INTO user (email, username, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $email, $uname, $upass);
$stmt->execute();

header('Location: login.php');
