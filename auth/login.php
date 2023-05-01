<?php
$email = $_POST['email'];
$pass = $_POST['pass'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('SELECT * FROM user WHERE user.email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$db->close();

if (!$result || !$row) {
  header('Location: /login.php');
  exit;
}

if (password_verify($pass, $row['pass'])) {
  session_start();
  $_SESSION['user'] = $row['id'];
  $_SESSION['name'] = $row['name'];
  header('Location: /home.php');
  exit;
}
header('Location: /login.php');
exit;
