<?php
session_start();

$uname = $_POST['username'];
$upass = $_POST['password'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
$stmt->bind_param('s', $uname);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (password_verify($upass, $row['password'])) {
  $_SESSION['username'] = $row['username'];
  header('Location: home.php');
}
