<?php
$uname = $_POST['username'];
$upass = $_POST['password'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('SELECT * FROM user WHERE name = ?');
$stmt->bind_param('s', $uname);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (password_verify($upass, $row['password'])) {
  session_start();
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['username'] = $row['name'];
  header('Location: /home/');
  exit;
}
header('Location: login.php?code=500');
