<?php
$name = $_POST['name'];
$year = $_POST['year'];
$system = $_POST['system'];
$developer = $_POST['developer'];
$user = $_POST['user'];

$cover = $_FILES['cover'];
if ($file = $cover['tmp_name']) {
  $path = 'uploads/' . uniqid() . $cover['name'];
  move_uploaded_file($file, $path);
}

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('INSERT INTO game (name, year, system, developer, cover, user) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssssss', $name, $year, $system, $developer, $path, $user);
$stmt->execute();
$db->close();

header('Location: /home.php');
exit;
