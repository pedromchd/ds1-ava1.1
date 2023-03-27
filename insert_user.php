<?php
$email = $_POST['email'];
$uname = $_POST['username'];
$upass = password_hash($_POST['password'], PASSWORD_BCRYPT);

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('INSERT INTO user (username, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $uname, $email, $upass);
$stmt->execute();

header('Location: login.php?msg=OK');
