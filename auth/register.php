<?php
$name = $_POST['name'];
$email = $_POST['email'];
$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('INSERT INTO user (name, email, pass) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $name, $email, $pass);
$stmt->execute();
$db->close();

header('Location: /login.php');
exit;
